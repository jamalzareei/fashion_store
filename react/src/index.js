import React from 'react';
import ReactDOM from 'react-dom';
// import '../material-kit-react';
import "./Assets/css/material-kit.css?v=2.1.1";
import "./Assets/fontawesome/css/all.css"
// import App from './App';
import * as serviceWorker from './serviceWorker';

import App from './App';

ReactDOM.render(<App />, document.getElementById('root'));

// If you want your app to work offline and load faster, you can change
// unregister() to register() below. Note this comes with some pitfalls.
// Learn more about service workers: https://bit.ly/CRA-PWA
serviceWorker.unregister();
