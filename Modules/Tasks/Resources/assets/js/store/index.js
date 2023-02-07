import { createStore } from 'vuex'
import state from "./state"
import getters from "./getters"
import mutations from "./mutations"
import actions from "./actions"

// re declare it here because it is not defined in mutations
const localemitter =  this.emitter;

// modules
// import tasks from './tasks'
// import spaceLists from './spaceLists'

const store = createStore({
   state,
  getters,
  mutations,
  actions,

    modules: {
        // 'tasks': tasks,
        // 'spaceLists': spaceLists,
    }
})

export default store;