import React from 'react';
import { Route, BrowserRouter, Switch } from 'react-router-dom';
import { routesByName } from 'constants/routes';
import HomePage from 'modules/pages/HomePage';
import Page404 from 'modules/pages/Page404';
import UnderConstruction from 'modules/pages/UnderConstruction';
import SignUpContainer from 'modules/auth/signUp/SignUpContainer';

function App() {
  return (
    <BrowserRouter>
      <div className="container">
        <Switch>
          <Route exact path={routesByName.home} component={HomePage} />
          <Route exact path={routesByName.signUp} component={SignUpContainer} />
          <Route exact path={routesByName.signIn} component={UnderConstruction} />
          <Route exact path={'*'} component={Page404} />
        </Switch>
      </div>
    </BrowserRouter>
  );
}

export default App;
