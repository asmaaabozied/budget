/*
* custom axios request , we will use this customized axios config for all requests in app as axiosIns
*/
import axios from 'axios'
import { isUserLoggedIn, getUserData, getHomeRouteForLoggedInUser } from './../auth/utils'

// https://axios-http.com/docs/instance  // axios has been defined in app.js // https://www.npmjs.com/package/vue-axios
const axiosIns = axios.create({
    // custom headers here
    baseURL: getBaseAppUrl(),
    //baseURL: 'https://budget-help.test/api/v1',
    // timeout: 10000, // to avoid problems in live
})

// https://axios-http.com/docs/config_defaults
axiosIns.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
axiosIns.defaults.withCredentials = true;
// axios.defaults.headers.common['Authorization'] = AUTH_TOKEN; // not needed for now

/*
function getBaseUrl() {
    // this is if we will use web routes in budget app without api , this will return url withou api
    let webUserToken = document.querySelector('meta[name="csrf-token"]').content; //get token from blade
    // just for users inside budget app , we will use web and auth not sanctum to avoid problems with auth in tasks
    if(typeof webUserToken != undefined && typeof webUserToken != null && typeof webUserToken === 'string') {
        return 'dashboard';
    } else {
        return import.meta.env.VITE_APP_ENV == 'production' ? import.meta.env.VITE_BASE_URL_LIVE : import.meta.env.VITE_BASE_URL_DEV
    }
}
*/

function getBaseAppUrl() {
    let appEnv = import.meta.env.VITE_APP_ENV;
    switch (appEnv) {
        case 'production':
            return import.meta.env.VITE_BASE_URL_LIVE;
        case 'development':
            return import.meta.env.VITE_BASE_URL_DEV;
        case 'local':
            return import.meta.env.VITE_BASE_URL_LOCAL;
        default:
            return import.meta.env.VITE_BASE_URL_LIVE;
    }
}

// https://axios-http.com/docs/interceptors
// Add a request interceptor
// because laravel sanctum need to send your cookie with every request
axiosIns.interceptors.request.use(
    config => {
        const token = isUserLoggedIn();
        if (token) {
            config.headers['Authorization'] = 'Bearer ' + token; // Set JWT token for Request
            // config.headers.post['Content-Type'] = 'multipart/form-data';
            // config.headers.post['Content-Type'] = 'application/x-www-form-urlencoded';
        }
        return config;
    },
    error => {
        Promise.reject(error);
    }
);

// response pre-processing
axiosIns.interceptors.response.use(
    response => {
        return response;
    },
    error => {
        return Promise.reject(error);
    }
);

export default axiosIns

