import React, { Component } from 'react';

import { BrowserRouter as Router, Route, Switch } from "react-router-dom";
import Main from './Views/Main/Main';
import Register from './Views/Auth/Register/Register';
import Menu from './Componetns/Menu';
import Confirm from './Views/Auth/Confirm/Confirm';
import Login from './Views/Auth/Login/Login';
import PasswordCreate from './Views/Auth/PasswordCreate/PasswordCreate';
import PasswordReset from './Views/Auth/PasswordReset/PasswordReset';
import Error404 from './Views/Errors/Error404';
import RequestCode from './Views/Auth/RequestCode/RequestCode';

export default class RouterApp extends Component {
  render() {
    return (
      <Router>
        <Menu />
        <div>
          <Switch>
            <Route exact path="/" component={Main} />
            {/* <Route path="/login" component={Login} /> */}
            <Route path="/register" component={Register} />
            <Route path="/confirm/:uuid" component={Confirm} />
            <Route path="/login" component={Login} />
            <Route path="/request-code" component={RequestCode} />
            <Route path="/password/create" component={PasswordCreate} />
            <Route path="/password/reset/:token" component={PasswordReset} />


            <Route component={Error404} />
            <hr className="my-5" />
          </Switch>
        </div>
      </Router>
    )
  }
}
