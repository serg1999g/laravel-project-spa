export const routesByName = {
  home: '/',
  signIn: '/sign-in',
  signUp: '/sign-up',
  roteWithParams(param = ':param'){
    return `/prefix/${param}`
  },
};
