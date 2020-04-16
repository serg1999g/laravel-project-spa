import axios from 'axios';
import appConfig from 'constants/appConfig';


const BaseAxiosInstance = axios.create(
  {
    baseURL: appConfig.apiUrl,
    withCredentials: true,
  }
);

BaseAxiosInstance.interceptors.response.use(
  ({ data }) => data,
  ({ response: { data } }) => {
    throw new Error(data.message);
  },
);

export default BaseAxiosInstance;
