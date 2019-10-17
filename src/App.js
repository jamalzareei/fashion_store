import React, { Component } from 'react';
import { BrowserRouter as Router, Route, Switch } from "react-router-dom";
// import Progress from 'react-progress';

// import logo from './logo.svg';
import './App.css';
import Main from './Views/Main/Main';
import Error404 from './Views/Error404';
import Register from './Views/Register/Register';
import Menu from './Componetns/Menu';
import COnfirm from './Views/Confirm/Confirm';

class App extends Component {
  render() {

    return (
      <div className="App">
        <Router>
          <Menu />
          <div>
            <Switch>
              <Route exact path="/" component={Main} />
              {/* <Route path="/login" component={Login} /> */}
              <Route path="/register" component={Register} />
              <Route path="/confirm/:uuid" component={COnfirm} />


              <Route component={Error404} />
              <hr className="my-5" />
            </Switch>
          </div>
        </Router>
      </div >
    );
  }
}

export default App;