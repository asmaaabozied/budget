// const INITIAL_DATA_URL = "https://raw.githubusercontent.com/ayazsayyed/vue-kanban/master/src/store/data.json"
// local file contain test data

const INITIAL_DATA_URL = "/tasks/tasks_workspaces"

import axiosIns from "./../libs/axios"

export default {

   async loginUser({ commit }, payload) {
        commit("LOGIN_USER", payload)
  },
  async logoutUser({ commit }, payload) {
        commit("LOGOUT_USER", payload)
  },
  async fetchData({ commit }, payload) {
    commit("SET_LOADING_STATE", true)
    return axiosIns.get(INITIAL_DATA_URL).then(res => {
      commit("SET_INITIAL_DATA", res.data.data)
      commit("SET_LOADING_STATE", false)
    });
  },

  async fetchCompanyUsers({ commit }, payload) {
        return axiosIns.get('/tasks/company_users_list').then(res => {
            let users = res.data.data;
            commit("SET_COMPANY_USERS",users)
        });
  },

  async getCompanyUsers({ commit },payload) {
        await commit("GET_COMPANY_USERS")
    },

    // not needed for now, will get from state.activeworkspace
 // async fetchActiveWorkspaceUsers({ commit }, payload) {
 //        return axiosIns.post('/tasks/workspace_users_list', {
 //            workspace_id: payload.space_id,
 //         })
 //         .then(res => {
 //                    let users = res.data.data;
 //                    commit("SET_ACTIVE_WORKSPACE_USERS",users)
 //                })
 // },

 async getWorkspaceUsers({ commit },payload) {
        await commit("GET_ACTIVE_WORKSPACE_USERS")
    },

async saveWorkspace({ commit }, payload) {
    commit("CREATE_NEW_WORKSPACE", payload)
  },
  async UpdateWorkspace({ commit }, payload) {
        commit("UPDATE_WORKSPACE", payload)
  },
  async deleteWorkSpace({ commit }, payload) {
        commit("DELTE_WORKSPACE", payload)
    },
  async archiveWORKSPACE({ commit }, payload) {
    commit("ARCHIVE_WORKSPACE", payload)
  },
  async restoreWORKSPACE({ commit }, payload) {
    commit("RESTORE_WORKSPACE", payload)
  },
  async getActiveWorkspace({ commit }, payload) {
    commit("GET_ACTIVE_WORKSPACE", payload)
  },
  async createNewList({ commit }, payload) {
      commit("CREATE_NEW_LIST", payload)
  },
  async updateList({ commit }, payload) {
        commit("UPDATE_LIST", payload)
    },
  async deleteList({ commit }, payload) {
      commit("DELTE_LIST", payload)
  },
 async createNewLink({ commit }, payload) {
        commit("CREATE_LINK", payload)
 },
 async updateLink({ commit }, payload) {
        commit("UPDATE_LINK", payload)
},
async deleteLink({ commit }, payload) {
        commit("DELTE_LINK", payload)
},
  async archiveTaskList({ commit }, payload) {
    commit("ARCHIVE_TASKLIST", payload)
  },
  async restoreTaskList({ commit }, payload) {
    commit("RESTORE_TASKLIST", payload)
  },
  async reorderSpaceLists({ commit }, payload) {
    commit("REORDER_SPACE_LISTS", payload)
  },
  async reorderListTasks({ commit }, payload) {
    commit("REORDER_LIST_TASKS", payload)
  },
  async createNewTask({ commit }, payload) {
      commit("CREATE_NEW_TASK", payload)
  },
  async updateTask({ commit }, payload) {
        commit("UPDATE_TASK", payload)
    },
  async deleteTask({ commit }, payload) {
        commit("DELTE_TASK", payload)
    },
  async fetchActiveTask({ commit }, payload) {
        commit("FETCH_ACTIVE_TASK", payload)
    },
  async resetActiveTask({ commit }, payload) {
        commit("RESET_ACTIVE_TASK", payload)
  },
  async fetchTaskComments({ commit }, payload) {
        commit("FETCH_TASK_COMMENTS", payload)
    },
  async createTaskComment({ commit }, payload) {
        commit("CREATE_TASK_COMMENT", payload)
    },
  async updateTaskComment({ commit }, payload) {
        commit("UPDATE_TASK_COMMENT", payload)
    },
  async deleteTaskComment({ commit }, payload) {
        commit("DELETE_TASK_COMMENT", payload)
    },

}
