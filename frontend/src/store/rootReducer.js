import { connectRouter } from 'connected-react-router';
import { combineReducers } from 'redux';
import authReducer from 'modules/auth/store/reducer';


export default function createRootReducer(history) {
  return combineReducers({
    auth: authReducer,
    router: connectRouter(history),

  });
}
