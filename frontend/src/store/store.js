import { createStore, compose, applyMiddleware } from 'redux';
import { createBrowserHistory } from 'history';

import logger from 'redux-logger';
import { routerMiddleware } from 'connected-react-router';

import createRootReducer from 'store/rootReducer';
import appConfig from 'constants/appConfig';

const composeEnhancers = typeof window === 'object'
// eslint-disable-next-line no-underscore-dangle
&& window.__REDUX_DEVTOOLS_EXTENSION_COMPOSE__
  // eslint-disable-next-line no-underscore-dangle
  ? window.__REDUX_DEVTOOLS_EXTENSION_COMPOSE__({
    // Specify extension's options like name, actionsBlacklist, actionsCreators, serialize...
  }) : compose;

const middlewares = [];

export const history = createBrowserHistory();

/**
 * Start logger only on dev environment
 */
if (appConfig.isDev) {
  middlewares.push(logger);
}

const store = createStore(
  createRootReducer(history),
  {},
  composeEnhancers(
    applyMiddleware(
      routerMiddleware(history),
      ...middlewares,
    ),
  ),
);

if (module.hot) {
  module.hot.accept('./rootReducer', () => {
    const createRootReducerHot = require('./rootReducer').default;
    store.replaceReducer(createRootReducerHot(history));
  });
}

export default store;
