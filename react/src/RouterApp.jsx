import React, { useContext, useEffect } from 'react';

import { BrowserRouter as Router, Route, Switch, Redirect } from "react-router-dom";

import Axios from './Axios';

import { authContext } from './Contexts/AuthContext';

import PrivateRoute from './PrivateRoute';
import Main from './Views/Main/Main';
import Register from './Views/Auth/Register/Register';
import Menu from './Componetns/Menu';
import Confirm from './Views/Auth/Confirm/Confirm';
import Login from './Views/Auth/Login/Login';
import PasswordCreate from './Views/Auth/PasswordCreate/PasswordCreate';
import PasswordReset from './Views/Auth/PasswordReset/PasswordReset';
import Error404 from './Views/Errors/Error404';
import RequestCode from './Views/Auth/RequestCode/RequestCode';
// import { AuthConsumer } from './Contexts/AuthContext';
import Dashboard from './Views/Panel/Dashboard/Dashboard';
import Profile from './Views/Panel/User/Profile';
// import Profile from './Views/Panel/User/Profile';
// import { authContext } from './App';

function RouterApp() {

  const userContext = useContext(authContext)

  useEffect(() => {
    if (localStorage.getItem("token") !== null) {
        console.log(2)

        Axios({
            method: 'get',
            url: 'auth/refresh?token='+localStorage.getItem("token"),// 
        })
            .then(response => {
                // console.log(userContext)
                localStorage.setItem("token", response.data.token);
                userContext.setUser({ type: 'LOGIN', token: response.data.token, user: response.data.data })
            }, (errors) => {
                // setErrors(errors.response.data.errors)
                // setLoader(false)
                console.log(errors)
            })
            .catch(function (error) {
                // setData(error)
                // setLoader(false)
                console.log(error)
            });
    }else{
        console.log('userContext')
    }
},[])


  return (
    <>
      <Router>
        <Menu />
        <div>
          <Switch>
            <Route exact path="/" component={Main} />
            {/* <Route path="/login" component={Login} /> */}
            <Route path="/register" render={() => ((userContext.data && userContext.data.token) ? (<Redirect to="/" />) : (<Register />))} />
            <Route path="/confirm/:uuid" component={Confirm} />
            <Route path="/login" render={() => ((userContext.data && userContext.data.token) ? (<Redirect to="/" />) : (<Login />))} />
            <Route path="/request-code" component={RequestCode} />
            <Route path="/password/create" component={PasswordCreate} />
            <Route path="/password/reset/:token" component={PasswordReset} />


            {/* <Route path="/panel/dashboard"  render={() => ( (token) ? (<Dashboard />) : (<Redirect to="/login" />) )} />
                
                <Route path="/panel/profile"  render={() => ( (token) ? (<Profile />) : (<Redirect to="/login" />) )} /> */}


            <PrivateRoute path="/panel/dashboard" component={Dashboard} />
            <PrivateRoute path="/panel/profile" component={Profile} />

            {/* <Route path="/panel/dashboard" component={Dashboard} />
                <Route path="/panel/profile" component={Profile} /> */}


            <Route component={Error404} />
            <hr className="my-5" />
          </Switch>
        </div>
      </Router>

    </>
  );


}

export default RouterApp;

// export default class RouterApp extends Component {
//   render() {

//     return (
//       <AuthConsumer>
//         {({ token, setToken }) => (


//         )}
//       </AuthConsumer>
//     )
//   }
// }
