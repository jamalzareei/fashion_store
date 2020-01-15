import React, { useContext, useReducer } from 'react';
import "@babel/polyfill";
import "core-js/stable";
import "regenerator-runtime/runtime";
// import Progress from 'react-progress';

// import logo from './logo.svg';
import './App.css';
import RouterApp from './RouterApp';
import { AuthProvider } from './Contexts/AuthContext';
import Axios from './Axios';

//  const authContext = useContext();


  const initialValeue = 0;
  const reducer = (state , action) => {
    switch (action) {
      case 'LOGIN':
        return 
      default:
        return state
    }
  }
function App(){

  const [token, dispatch] = useReducer(reducer, initialValeue)

    return (
      <AuthProvider value={{ token: token, setToken: dispatch }}>
          <div className="App">
            <RouterApp />
          </div >
      </AuthProvider>
    );
    
}

export default App;