import axiosIns from "./../libs/axios"
import getters from "./getters";
import useJwt from '../auth/jwt/useJwt'
import { isUserLoggedIn, getUserData, getHomeRouteForLoggedInUser } from '../auth/utils'

export default {

    LOGIN_USER(state, payload) {
        let router = payload.router // important

        // state.userData = payload.userData
        axiosIns.post('/tasks/auth/login', {
            email: payload.email,
            password: payload.password,
            remember_me: payload.remember_me,
        })
            .then(response => {
                const userData  = response.data.userData
                useJwt.setToken(response.data.accessToken)
                useJwt.setRefreshToken(response.data.refreshToken)
                localStorage.setItem('userData', JSON.stringify(userData))
                // TO DO , Manage permissions , abilities
                // this.$ability.update(userData.permissions)

                // toast alert success msg , must before bus event
                if (userData) {
                    window.emitter.emit("open-toast-msg", {
                        type:"success",
                        message:'Welcome ,, You Are Loggeged In Successfully ^_^',
                    });
                    // redirect user
                    router.push({ name: 'workspaces'})
                }

            })
            .catch(e => {
                if (e.response.data.message) {
                    window.emitter.emit("open-toast-msg", {
                        type:"error",
                        message:e.response.data.message,
                    });
                }
                state.loginUserFormErrors = e.response.data.errors;
            })
    },

    LOGOUT_USER(state, payload) {
        // state.userData = payload.userData
        axiosIns.post('/tasks/auth/logout', {
            email: payload.email,
        })
            .then(response => {
                const userData  = response.data;
                useJwt.setToken('')
                useJwt.setRefreshToken('')
                localStorage.removeItem('userData')
                localStorage.removeItem(useJwt.jwtConfig.storageTokenKeyName)
                localStorage.removeItem(useJwt.jwtConfig.storageRefreshTokenKeyName)

                // Redirect to login page
                this.$router.push({ name: 'auth-login' })
            })
            .catch(e => {
                state.logoutUserFormErrors = e.response.data.errors;
            })
    },


    // Set Initial Data
    SET_INITIAL_DATA(state, payload) {
        state.workspaces = payload
    },

    SET_COMPANY_USERS(state, payload) {
        state.companyUsers = payload
    },

    GET_COMPANY_USERS(state, payload) {
        return state.companyUsers ? state.companyUsers : [];
    },

    // SET_ACTIVE_WORKSPACE_USERS(state, payload) {
    //     state.activeworkspaceUsers = payload
    // },

    // GET_ACTIVE_WORKSPACE_USERS(state, payload) {
    //     return state.activeworkspaceUsers = payload
    // },

    // Set Loading State
    SET_LOADING_STATE(state, payload) {
        state.isLoading = payload
    },

    CREATE_NEW_WORKSPACE(state, payload) {
        const workspace = state.workspaces.find(b => b.id == payload.id)
        const itemIdx = state.workspaces.findIndex(b => b.id == payload.id)

        // For existing item
        if (itemIdx > -1) {
            workspace.name = payload.name
            workspace.description = payload.description
            Object.assign(state.workspaces,{ itemIdx: workspace})
        }
        // For new item
        else {
            axiosIns.post('/tasks/tasks_workspaces', {
                name: payload.name,
                description: payload.description,
                users: payload.users,
            })
                .then(response => {
                    let newworkspace = response.data.data;
                    state.workspaces.push(newworkspace);

                    if (response.data.message) {
                        window.emitter.emit("open-toast-msg", {
                            type:"success",
                            message:response.data.message,
                        });
                        state.createSpaceFormErrors = {};
                    }
                    window.emitter.emit('close-workspace-popup')
                })
                .catch(e => {
                    // translated response error
                    if (e.response.data.message) {
                        window.emitter.emit("open-toast-msg", {
                            type:"error",
                            message:e.response.data.message,
                        });
                    }
                    state.createSpaceFormErrors = e.response.data.errors;
                })
        }
    },

    UPDATE_WORKSPACE(state, payload) {
        return new Promise((resolve, reject) => {
            axiosIns.put(`/tasks/tasks_workspaces/${payload.id}`, {
                name: payload.name,
                description: payload.description,
                users: payload.users,
            })
                .then(response => {
                    let updatedWorkspace = response.data.data;
                    let workspaceIdx = state.workspaces.findIndex(b => b.id == payload.id)
                    state.workspaces[workspaceIdx] = updatedWorkspace;

                    // toast alert success msg , must before bus event
                    if (response.data.message) {
                        window.emitter.emit("open-toast-msg", {
                            type:"success",
                            message:response.data.message,
                        });
                        state.createSpaceFormErrors = {};
                    }
                    window.emitter.emit('close-workspace-popup')
                })
                .catch(reject => {
                    if (reject.response.data.message) {
                        window.emitter.emit("open-toast-msg", {
                            type:"error",
                            message:reject.response.data.message,
                        });
                    }
                    state.createSpaceFormErrors = reject.response.data.errors;
                })
        })
    },

    DELTE_WORKSPACE(state, payload) {
        return new Promise((resolve, reject) => {
            axiosIns.delete(`/tasks/tasks_workspaces/${payload.id}`)
                .then(resolve => {
                    // For existing item
                    if (resolve.data.deleted) {
                        const workspaceIdx = state.workspaces.findIndex(b => b.id == payload.id)
                        const workspace = state.workspaces.find(b => b.id == payload.id)
                        state.workspaces.splice(workspaceIdx, 1)

                        // toast alert success msg , must before bus event
                        if (resolve.data.message) {
                            window.emitter.emit("open-toast-msg", {
                                type:"warning",
                                message:resolve.data.message,
                            });
                            window.emitter.emit('close-workspace-popup')
                        }
                    }
                })
                .catch(e => {
                    if (e.response.data.error) {
                        window.emitter.emit("open-toast-msg", {
                            type:"error",
                            message:e.response.data.error,
                        });
                    }
                })
        })
    },

    // Archive Task workspace
    ARCHIVE_WORKSPACE(state, payload) {
        const workspace = state.workspaces.find(b => b.id == payload.workspaceId)
        const workspaceIdx = state.workspaces.findIndex(b => b.id == payload.workspaceId)
        workspace.archived = true
        Object.assign(state.workspaces,{ workspaceIdx: workspace})
    },

    // Restore Task workspace
    RESTORE_WORKSPACE(state, payload) {
        const workspace = state.workspaces.find(b => b.id == payload.workspaceId)
        const workspaceIdx = state.workspaces.findIndex(b => b.id == payload.workspaceId)
        workspace.archived = false
        Object.assign(state.workspaces,{ workspaceIdx: workspace})
    },

    // new Task List
    CREATE_NEW_LIST(state, payload) {
        const workspace = state.workspaces.find(b => b.id == payload.space_id);
            return new Promise((resolve, reject) => {
                axiosIns.post('/tasks/tasks_statuses', {
                    space_id: payload.space_id,
                    name: payload.name,
                    color: payload.color,
                    position: payload.position,
                })
                .then(resolve => {
                        let createdList =  resolve.data.data.data;
                        // const listIdx = createdList.order ? createdList.order : workspace.statuses.length - 1;

                        // must update for workspace and activeworkspace
                        workspace.statuses.push(createdList);
                        state.activeworkspace.statuses.push(createdList)

                        if (resolve.data.message) {
                            window.emitter.emit("open-toast-msg", {
                                type:"success",
                                message:resolve.data.message,
                            });
                            state.createListFormErrors = {};
                        }
                        window.emitter.emit('close-list-popup')
                })
                .catch(reject => {
                        if (reject.response.data.message) {
                            window.emitter.emit("open-toast-msg", {
                                type:"error",
                                message:reject.response.data.message,
                            });
                        }
                        state.createListFormErrors = reject.response.data.errors;
                })
            })
    },

    UPDATE_LIST(state, payload) {
        return new Promise((resolve, reject) => {
            axiosIns.put(`/tasks/tasks_statuses/${payload.id}`, {
                space_id: payload.space_id,
                name: payload.name,
                color: payload.color,
                position: payload.position,
            })
                .then(response => {
                    const updatedList = response.data.data.data;
                    const workspace = state.workspaces.find(b => b.id == payload.space_id);
                    const listIdx = workspace.statuses.findIndex(l => l.id == payload.id)
                    workspace.statuses[listIdx] = updatedList;
                    state.activeworkspace.statuses[listIdx] = updatedList;

                    // toast alert success msg , must before bus event
                    if (response.data.message) {
                        window.emitter.emit("open-toast-msg", {
                            type:"success",
                            message:response.data.message,
                        });
                        state.createListFormErrors = {};
                    }
                    window.emitter.emit('close-list-popup')
                })
                .catch(reject => {
                    if (reject.data.message) {
                        window.emitter.emit("open-toast-msg", {
                            type:"error",
                            message:reject.data.message,
                        });
                    }
                    state.createListFormErrors = reject.response.data.errors;
                })
        })
    },

    DELTE_LIST(state, payload) {
        return new Promise((resolve, reject) => {
            axiosIns.delete(`/tasks/tasks_statuses/${payload.id}`)
                .then(response => {
                    // For existing item
                    if (response.data.deleted) {
                        const workspace = state.workspaces.find(b => b.id == payload.space_id)
                        const itemIdx = workspace.statuses.findIndex(item => item.id == payload.id)
                        workspace.statuses.splice(itemIdx, 1)
                        state.activeworkspace.statuses.splice(itemIdx, 1)

                        if (response.data.message) {
                            window.emitter.emit("open-toast-msg", {
                                type:"warning",
                                message:response.data.message,
                            });
                        }
                    }
                })
                .catch(e => {
                    if (e.response.data.error) {
                        window.emitter.emit("open-toast-msg", {
                            type:"error",
                            message:e.response.data.error,
                        });
                    }
                })
        })
    },

    CREATE_LINK(state, payload) {
        const workspace = state.workspaces.find(b => b.id == payload.space_id);
            return new Promise((resolve, reject) => {
                axiosIns.post('/tasks/workspace_links', {
                    space_id: payload.space_id,
                    name: payload.name,
                    link: payload.link,
                    icon: payload.icon,
                    icon_color: payload.icon_color,
                    parent_id: payload.parent_id,
                    notes: payload.notes,
                })
                .then(resolve => {
                        let createdLink =  resolve.data.data;
                        workspace.links.push(createdLink)
                        state.activeworkspace.links.push(createdLink)

                        if (resolve.data.message) {
                            window.emitter.emit("open-toast-msg", {
                                type:"success",
                                message:resolve.data.message,
                            });
                            state.linkFormErrors = {};
                        }
                        window.emitter.emit('close-link-popup')
                })
                .catch(reject => {
                        if (reject.message) {
                            window.emitter.emit("open-toast-msg", {
                                type:"success",
                                message:reject.message,
                            });
                        }
                        state.linkFormErrors = reject.response.data.errors;
                })
            })
    },

    UPDATE_LINK(state, payload) {
        return new Promise((resolve, reject) => {
            axiosIns.put(`/tasks/workspace_links/${payload.id}`, {
                space_id: payload.space_id,
                name: payload.name,
                link: payload.link,
                icon: payload.icon,
                icon_color: payload.icon_color,
                parent_id: payload.parent_id,
                notes: payload.notes,
            })
            .then(response => {
                    const updatedList = response.data.data;
                    const workspace = state.workspaces.find(b => b.id == payload.space_id);
                    const linkIdx = workspace.links.findIndex(l => l.id == payload.id)
                    workspace.links[linkIdx] = updatedList;
                    state.activeworkspace.links[linkIdx] = updatedList;

                    if (response.data.message) {
                        window.emitter.emit("open-toast-msg", {
                            type:"success",
                            message:response.data.message,
                        });
                        state.linkFormErrors = {};
                    }
                    window.emitter.emit('close-link-popup')
            })
            .catch(reject => {
                    if (reject.data.message) {
                        window.emitter.emit("open-toast-msg", {
                            type:"error",
                            message:reject.data.message,
                        });
                    }
                    state.linkFormErrors = reject.data.errors;
            })
        })
    },

    DELTE_LINK(state, payload) {
        return new Promise((resolve, reject) => {
            axiosIns.delete(`/tasks/workspace_links/${payload.id}`)
                .then(response => {
                    // For existing item
                    if (response.data.deleted) {
                        const workspace = state.workspaces.find(b => b.id == payload.space_id)
                        const itemIdx = workspace.links.findIndex(item => item.id == payload.id)
                        // For existing item
                        if (itemIdx > -1) {
                            workspace.statuses.splice(itemIdx, 1)
                            state.activeworkspace.statuses.splice(itemIdx, 1)
                        }

                        // toast alert success msg , must before bus event
                        if (response.data.message) {
                            window.emitter.emit("open-toast-msg", {
                                type:"success",
                                message:response.data.message,
                            });
                        }
                    }
                })
                .catch(e => {
                    if (e.response.data.error) {
                        window.emitter.emit("open-toast-msg", {
                            type:"error",
                            message:e.response.data.message,
                        });
                    }
                })
        })
    },


    // Archive Task List
    ARCHIVE_TASKLIST(state, payload) {
        const workspace = state.workspaces.find(b => b.id == payload.workspaceId)
        const list = workspace.statuses.find(l => l.id == payload.listId)
        const listIdx = workspace.statuses.findIndex(l => l.id == payload.listId)
        list.archived = true
        Object.assign(workspace.statuses,{ listIdx: list})
    },

    // Restore Task List
    RESTORE_TASKLIST(state, payload) {
        const workspace = state.workspaces.find(b => b.id == payload.workspaceId)
        const list = workspace.statuses.find(l => l.id == payload.listId)
        const listIdx = workspace.statuses.findIndex(l => l.id == payload.listId)
        list.archived = false
        Object.assign(workspace.statuses,{ listIdx: list})
    },

    // Reorder TaskBoad Lists
    REORDER_SPACE_LISTS(state, payload) {
        const workspace = state.workspaces.find(b => b.id == payload.space_id)
        Object.assign(workspace,{ 'lists': payload.lists})
    },

    // Reorder Task List Items
    REORDER_LIST_TASKS(state, payload) {
        // magic way to update tasks with all events
        let newOrderedTasks =  payload.tasks.map(function (item, index) {
            // just change order, according to new order
            // avoid 0 value for order
            item.order = index+1;
            item.status_id = payload.new_status_id;
            return item;
        })

        return new Promise((resolve, reject) => {
            axiosIns.post(`/tasks/reorder_tasks`,{
                tasks: newOrderedTasks,
            })
                .then(response => {
                    if (response.data) {
                        const workspace = state.workspaces.find(b => b.id == payload.space_id)
                        const listIdx = workspace.statuses.findIndex(l => l.id == payload.new_status_id)
                        Object.assign(workspace.statuses[listIdx],{ 'tasks': newOrderedTasks})

                        // toast alert success msg , must before bus event
                        if (response.data.message) {
                            window.emitter.emit("open-toast-msg", {
                                type:"success",
                                message:response.data.message,
                            });
                        }
                    } else {
                        return;
                    }
                })
                .catch(reject => {
                    if (reject.response.data.message) {
                        window.emitter.emit("open-toast-msg", {
                            type:"error",
                            message:reject.response.data.message,
                        });
                    }
                })
        })
    },

    GET_ACTIVE_WORKSPACE(state, payload) {
        return new Promise((resolve, reject) => {
            axiosIns.get(`/tasks/tasks_workspaces/${payload.space_id}`)
                .then(response => {
                    state.activeworkspace = response.data.data;
                })
                .catch(reject => {
                    if (reject.response.data.message) {
                        window.emitter.emit("open-toast-msg", {
                            type:"error",
                            message:reject.response.data.message,
                        });
                    }
                    state.createSpaceFormErrors = reject.response.data.errors;
                })
        })
    },

    // Save Task List Item
    CREATE_NEW_TASK(state, payload) {
        return new Promise((resolve, reject) => {
            // axiosIns.defaults.headers.post['Content-Type'] = 'multipart/form-data'; // support upload files
            axiosIns.post('/tasks/tasks', {
                    name: payload.name,
                    description: payload.description,
                    space_id: payload.space_id,
                    status_id: payload.status_id,
                    priority: payload.priority,
                    progress: payload.progress,
                    expiry_time: payload.expiry_time,
                    users: payload.users,
                    attachments: payload.attachments,
                },
            )
                .then(resolve => {
                    // must return task from here to avoid issues when update tasks
                    const updatedTask = resolve.data.data;
                    const workspace = state.workspaces.find(b => b.id == payload.space_id)
                    const list = workspace.statuses.find(l => l.id == payload.status_id)
                    const activeSpaceList = state.activeworkspace.statuses.find(l => l.id == payload.status_id)
                    list.tasks.unshift(updatedTask) // unshift puh item to the top of list
                    activeSpaceList.tasks.unshift(updatedTask)

                    // toast alert success msg , must before bus event
                    if (resolve.data.message) {
                        window.emitter.emit("open-toast-msg", {
                            type:"success",
                            message:resolve.data.message,
                        });
                        state.createTaskFormErrors = {};
                    }
                    window.emitter.emit('close-task-popup')
                })
                .catch(reject => {
                    if (reject.response.data.message) {
                        window.emitter.emit("open-toast-msg", {
                            type:"error",
                            message:reject.response.data.message,
                        });
                    }
                    state.createTaskFormErrors =  reject.response.data.errors;
                })
        })
    },

    UPDATE_TASK(state, payload) {
        return new Promise((resolve, reject) => {
            axiosIns.put(`/tasks/tasks/${payload.id}`, {
                id: payload.id,
                name: payload.name,
                description: payload.description,
                space_id: payload.space_id,
                status_id: payload.status_id,
                priority: payload.priority,
                progress: payload.progress,
                expiry_time: payload.expiry_time,
                users: payload.users,
                attachments: payload.attachments,
            })
                .then(response => {
                    const workspace = state.workspaces.find(b => b.id == payload.space_id)
                    const updatedTask = response.data.data;
                    const oldListId = payload.old_status_id;
                    const oldlist = workspace.statuses.find(l => l.id == oldListId)
                    const activeWorkspaceOldlist = state.activeworkspace.statuses.find(l => l.id == oldListId)
                    const newlist = workspace.statuses.find(l => l.id == updatedTask.status_id)
                    const activeWorkspaceNewlist = state.activeworkspace.statuses.find(l => l.id == updatedTask.status_id)
                    const oldTaskIdx = oldlist.tasks.findIndex(l => l.id == payload.id)
                    if(updatedTask.status_id != oldListId) {
                        oldlist.tasks.splice(oldTaskIdx, 1)
                        activeWorkspaceOldlist.tasks.splice(oldTaskIdx, 1)

                        newlist.tasks.unshift(updatedTask)
                        activeWorkspaceNewlist.tasks.unshift(updatedTask)
                    } else {
                        oldlist.tasks[oldTaskIdx] = updatedTask;
                        activeWorkspaceOldlist.tasks[oldTaskIdx] = updatedTask;
                    }
                    // toast alert success msg , must before bus event
                    if (response.data.message) {
                        window.emitter.emit("open-toast-msg", {
                            type:"success",
                            message:response.data.message,
                        });
                        state.createTaskFormErrors = {};
                    }
                    window.emitter.emit('close-task-popup')
                })
                .catch(e => {
                    if (e.response.data.message) {
                        window.emitter.emit("open-toast-msg", {
                            type:"error",
                            message:e.response.data.message,
                        });
                    }
                    state.createTaskFormErrors =  e.response.data.errors;
                })
        })
    },

    DELTE_TASK(state, payload) {
        return new Promise((resolve, reject) => {
            axiosIns.delete(`/tasks/tasks/${payload.id}`)
                .then(resolve => {
                    // For existing item
                    if (resolve.data.deleted) {
                        const workspace = state.workspaces.find(b => b.id == payload.space_id)
                        const list = workspace.statuses.find(l => l.id == payload.status_id)
                        const activeWorkspaceList = state.activeworkspace.statuses.find(l => l.id == payload.status_id)
                        const taskIdx = list.tasks.findIndex(l => l.id == payload.id)
                        if (taskIdx > -1) {
                            list.tasks.splice(taskIdx, 1)
                            activeWorkspaceList.tasks.splice(taskIdx, 1)
                        }
                        // toast alert success msg , must before bus event
                        if (resolve.data.message) {
                            window.emitter.emit("open-toast-msg", {
                                type:"warning",
                                message:resolve.data.message,
                            });
                        }
                    }
                })
                .catch(e => {
                    if (e.response.data.error) {
                        window.emitter.emit("open-toast-msg", {
                            type:"error",
                            message:e.response.data.message,
                        });
                    }
                })
        })
    },

    FETCH_ACTIVE_TASK(state, payload) {
        return new Promise((resolve, reject) => {
            axiosIns.get(`/tasks/task/get_task_byslug/${payload.slug}`)
                .then(response => {
                    // For existing item
                    if (response.data) {
                        state.activeTask  = response.data.data;
                    }
                })
                .catch(reject => {
                    if (reject.response.data.message) {
                        window.emitter.emit("open-toast-msg", {
                            type:"error",
                            message:reject.response.data.message,
                        });
                    }
                })
        })
    },

    RESET_ACTIVE_TASK(state, payload) {
        state.activeTask  = {};
    },

    FETCH_TASK_COMMENTS(state, payload) {
        return new Promise((resolve, reject) => {
            axiosIns.delete(`/tasks/comments/${payload.task_id}`)
                .then(response => {
                    if (response.data.deleted) {
                        const workspace = state.workspaces.find(b => b.id == payload.space_id)
                        const list = workspace.statuses.find(l => l.id == payload.status_id)
                        const taskIdx = list.tasks.findIndex(l => l.id == payload.id)
                        if (taskIdx > -1) {
                            delete list.tasks.taskIdx
                        }
                    }
                })
                .catch(reject => {
                    if (reject.response.data.message) {
                        window.emitter.emit("open-toast-msg", {
                            type:"error",
                            message:reject.response.data.message,
                        });
                    }
                })
        })
    },

    CREATE_TASK_COMMENT(state, payload) {
        // it is needed to avoid errors with params inside response block
        let parentComment = payload.parent ? payload.parent : null;
        return new Promise((resolve, reject) => {
            axiosIns.post(`/tasks/comments`,{
                content: payload.content,
                task_id: payload.task_id,
                parent_id: parentComment ? parentComment.id : null,
            }).then(response => {
                if (response.data.data) {
                    const task = state.activeTask;
                    const addedComment = response.data.data;
                    if(addedComment.parent_id) {
                        let taskParent = task.comments.find(l => l.id == parentComment.id)
                        taskParent.replies.push(addedComment);
                    } else {
                        task.comments.push(addedComment);
                    }
                    // toast alert success msg , must before bus event
                    if (response.data.message) {
                        window.emitter.emit("open-toast-msg", {
                            type:"success",
                            message:response.data.message,
                        });
                    }
                    window.emitter.emit('reset-comment-form-content')
                }
            })
                .catch(e => {
                    if (reject.response.data.message) {
                        window.emitter.emit("open-toast-msg", {
                            type:"error",
                            message:e.response.data.message,
                        });
                    }
                    state.createCommentFormErrors =  e.response.data.errors;
                })
        })
    },


}