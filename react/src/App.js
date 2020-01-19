import React, { useContext, useReducer } from 'react';
import "@babel/polyfill";
import "core-js/stable";
import "regenerator-runtime/runtime";
// import Progress from 'react-progress';

// import logo from './logo.svg';
import './App.css';
import RouterApp from './RouterApp';
// import { AuthProvider } from './Contexts/AuthContext';
import Axios from './Axios';
import { authContext, reducer, initialValeue } from './Contexts/AuthContext';

//  const authContext = useContext();

function App(){

  const [data, dispatch] = useReducer(reducer, initialValeue)

    return (
      <authContext.Provider value={{ data: data, setUser: dispatch }}>
          <div className="App">
            <RouterApp />
          </div >
      </authContext.Provider>
    );
    
}

export default App;