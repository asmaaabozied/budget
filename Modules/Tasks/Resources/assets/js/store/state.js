export default {
  userData:'',
  ability:'',
  isLoggegdIn:false,
  isLoading: true,
  showResponseMsg: {
    show: false,
    message: '',
    type: 'error',
    position: 'top-right',
    duration: 10000,
    dismissible: true,
  },
  activeworkspace: null,
  activeTask: {},
  workspaces: [],
  companyUsers:[],
  activeworkspaceUsers:[],

  loginUserFormErrors:{},
  logoutUserFormErrors:{},
  createTaskFormErrors:{},
  createListFormErrors:{},
  createSpaceFormErrors:{},
  createCommentFormErrors:{},
  linkFormErrors:{},
}
