import WorkSpaces from "../components/WorkSpaces.vue"
import Workspace from "../components/WorkSpace.vue"
import Login from '../components/auth/Login.vue'
import NotAuthorized from '../components/pages/NotAuthorized.vue'
import Error403 from '../components/pages/error/Error403.vue'
import TaskDetailPopup from '../components/popups/TaskDetailPopup.vue'

export default [
    {
        path: "/",
        name: "workspaces",
        component: WorkSpaces
    },
    {
        path: "/workspace/:id",
        name: "workspace",
        component: Workspace,
        // component: () => import(''),
        // meta: {
        //     showModal: false
        // },
        children: [
            {
                path: 't/:taskSlug',
                name: 'task',
                components: {
                    page: TaskDetailPopup,
                    rule: TaskDetailPopup
                },
                // meta: {
                //     showModal: true
                // }
            }
        ]
    },
    {
        path: '/auth/login',
        name: 'auth-login',
        component: Login
    },
    {
        path: '/not-authorized',
        name: 'not-authorized',
        component:NotAuthorized
    },
    {
      path: '/403',
      name: 'error-403',
      component: Error403
    }
]