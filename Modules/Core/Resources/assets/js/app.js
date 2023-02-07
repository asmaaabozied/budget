import './bootstrap';
import '../sass/app.scss'

import Vue from 'vue'
import App from './App.vue'

new Vue({
        render: h => h(App),
}).$mount('#core-app')
