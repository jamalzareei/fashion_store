import React from "react";

// set the defaults
const AuthContext = React.createContext({
  token: (localStorage.getItem("token_") !== null) ? localStorage.getItem("token_") : null,
  setToken: () => {}
});

const AuthProvider = AuthContext.Provider;
const AuthConsumer = AuthContext.Consumer;

export {AuthProvider, AuthConsumer};
export default AuthContext;
