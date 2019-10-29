import React, { Component } from 'react';
// import Progress from 'react-progress';

// import logo from './logo.svg';
import './App.css';
import RouterApp from './RouterApp';
import { AuthProvider } from './Contexts/AuthContext';

class App extends Component {

  setToken = token => {
    this.setState({ token });
    localStorage.removeItem('token');
  };
  
  state = {
    token: (localStorage.getItem("token_") !== null) ? localStorage.getItem("token_") : null,
    setToken: this.setToken
  };



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