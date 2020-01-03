import React, { Component } from 'react';
import "@babel/polyfill";
import "core-js/stable";
import "regenerator-runtime/runtime";
// import Progress from 'react-progress';

// import logo from './logo.svg';
import './App.css';
import RouterApp from './RouterApp';
import { AuthProvider } from './Contexts/AuthContext';
import Axios from './Axios';

class App extends Component {

  setToken = token => {
    if(token === null){
      Axios.post(`auth/logout`)
      .then(res => {
        this.setState({ token });
        localStorage.removeItem('token_');
      })
    }else{
      this.setState({ token });
    }
  };
  

  state = {
    token: (localStorage.getItem("token_") !== null) ? localStorage.getItem("token_") : null,
    setToken: this.setToken
  };


  componentDidMount(){
    // if(localStorage.getItem("token_") !== null){
    //   let token = localStorage.getItem("token_");
    //   Axios.get(`auth/refresh?token=`+token)
    //   .then(response => {
    //     token = response.data.token;
    //     this.setState({ token });
    //     localStorage.setItem("token_", token);
    //   })
    // }
  }


  render() {

    return (
      <AuthProvider value={this.state}>
          <div className="App">
            <RouterApp />
          </div >
      </AuthProvider>
    );
  }
}

export default App;