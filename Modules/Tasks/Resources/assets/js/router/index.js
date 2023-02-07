import { createRouter, createWebHashHistory , createMemoryHistory} from 'vue-router'
import routes from "./routes"
import { isUserLoggedIn, getUserData, getHomeRouteForLoggedInUser } from '../auth/utils'
import { canNavigate } from '../libs/acl/routeProtection'

const router = createRouter({
    // https://router.vuejs.org/guide/essentials/history-mode.html#html5-mode
    history: createWebHashHistory(),
    routes
})

const isLoggedIn = isUserLoggedIn()

// protect routes
router.beforeEach((to, from, next) => {
    // redirect if not loggeged in ,, this is the true way
    if (to.name !== 'auth-login' && !isLoggedIn) next({ name: 'auth-login' })
    else next()
  })

export default router