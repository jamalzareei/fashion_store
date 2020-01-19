import React, {useContext} from "react";
import { Route, Redirect } from "react-router-dom";
import {authContext} from "./Contexts/AuthContext";

function PrivateRoute({ component: Component, ...rest }) {
  // const { authTokens } = useAuth();
  const userContext = useContext(authContext)

  return (
    <Route
      {...rest}
      render={props =>
        (userContext.data && userContext.data.token) ? (
          <Component {...props} />
        ) : (
          <Redirect to="/login" />
        )
      }
    />
  );
}

export default PrivateRoute;