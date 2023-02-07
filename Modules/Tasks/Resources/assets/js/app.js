// we need some libraies in this app, because we do not use vuejs in main workspaces
import './bootstrap';
import '../sass/app.scss'
import {createApp, configureCompat} from 'vue'
import store from './store/index'
import router from "./router"
import App from './App.vue'
import i18n from './libs/i18n'
import axios from 'axios'
import VueAxios from 'vue-axios'
import axiosIns from "./libs/axios"
import moment from 'moment'
import Toaster from "@meforma/vue-toaster"
import mitt from 'mitt'
const emitter = mitt()
// important to let us use emitter from mutations
window.emitter = emitter;


const tasksApp = createApp(App)
tasksApp.use(router)
tasksApp.use(store)
tasksApp.use(i18n)
tasksApp.use(VueAxios, axios)
tasksApp.use(Toaster)
tasksApp.use(emitter)
tasksApp.use(moment)
tasksApp.provide('emitter', emitter) // for comp API

tasksApp.config.globalProperties.store = store
tasksApp.config.globalProperties.moment = moment
tasksApp.config.globalProperties.toast = Toaster
tasksApp.config.globalProperties.emitter = emitter // for global
// https://v3-migration.vuejs.org/breaking-changes/global-api.html
tasksApp.config.globalProperties.$http = axiosIns
tasksApp.config.globalProperties.append = (path, pathToAppend) =>
    path + (path.endsWith('/') ? '' : '/') + pathToAppend

tasksApp.mount('#tasks-app')