import BaseAxiosInstance from 'libs/axios/BaseAxiosInstance';

const AuthService = {
  signUp(formValues){
    return BaseAxiosInstance.post('/sign-up', formValues);
  }
};

export default AuthService;
