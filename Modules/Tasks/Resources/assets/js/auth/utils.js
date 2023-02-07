import useJwt from './jwt/useJwt'

/**
 * Return if user is logged in
 * This is completely up to you and how you want to store the token in your frontend application
 * e.g. If you are using cookies to store the application please update this function
 */
// eslint-disable-next-line arrow-body-style

export const isUserLoggedIn = () => {
  let webUserToken = document.querySelector('meta[name="csrf-token"]').content; //get token from blade

  // just for users inside budget app , we will use web and auth not sanctum to avoid problems with auth in tasks
  if(typeof webUserToken != undefined && typeof webUserToken != null && typeof webUserToken === 'string') {
    return webUserToken;
  }
  return localStorage.getItem('userData') && localStorage.getItem(useJwt.jwtConfig.storageTokenKeyName)
}

// this is best paractice to handle login via web and api
let webUserData = window.loggedInWebUser;
let userinfo = '';
// just for users inside budget app
if(typeof webUserData != undefined && typeof webUserData != null && typeof webUserData == 'object') {
  userinfo = webUserData;
} else {
  userinfo = JSON.parse(localStorage.getItem('userData'));
}
export const getUserData = userinfo

/**
 * This function is used for demo purpose route navigation
 * In real app you won't need this function because your app will navigate to same route for each users regardless of ability
 * Please note role field is just for showing purpose it's not used by anything in frontend
 * We are checking role just for ease
 * NOTE: If you have different pages to navigate based on user ability then this function can be useful. However, you need to update it.
 * @param {String} userRole Role of user
 */
export const getHomeRouteForLoggedInUser = userRoles => {
  if (userRoles.includes('Super Admin')) return 'home'
  if (userRoles.includes('manger')) return 'home'
  // TO DO , Handle this with logic
  // if (userRole === 'Employee') return { name: 'access-control' }
  if (userRoles.includes('Employee')) return { name: 'home' }
  return { name: 'auth-login' }
}
