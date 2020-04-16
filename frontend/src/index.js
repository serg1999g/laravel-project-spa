import React from 'react';
import ReactDOM from 'react-dom';
import { Provider, ReactReduxContext } from 'react-redux';
import { ConnectedRouter } from 'connected-react-router';
import 'styles/index.scss';
import appConfig from 'constants/appConfig';
import { ReactComponent as Sprite } from 'assets/sprite.svg';
import store, { history } from 'store/store';
import App from 'App';

ReactDOM.render(
  <Provider store={store} context={ReactReduxContext}>
    <ConnectedRouter history={history} context={ReactReduxContext}>
      <Sprite />
      <App />
    </ConnectedRouter>
  </Provider>,
  document.getElementById('root'),
);

// If you want your app to work offline and load faster, you can change
// unregister() to register() below. Note this comes with some pitfalls.
// Learn more about service workers: https://bit.ly/CRA-PWA
// serviceWorker.unregister();

if (appConfig.isDev && module.hot) {
  module.hot.accept();
}
