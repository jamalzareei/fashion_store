import React from "react";

// set the defaults
const AuthContext = React.createContext({
  token: (localStorage.getItem("token") !== null) ? localStorage.getItem("token") : null,
  setToken: () => {}
});

const AuthProvider = AuthContext.Provider;
const AuthConsumer = AuthContext.Consumer;

export {AuthProvider, AuthConsumer};
export default AuthContext;
