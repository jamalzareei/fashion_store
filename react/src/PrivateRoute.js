import React, {useContext} from "react";
import { Route, Redirect } from "react-router-dom";
import {authContext} from "./Contexts/AuthContext";
import SidebarPanel from "./Componetns/SidebarPanel";
import Menu from "./Componetns/Menu";
import FooterPanel from "./Componetns/FooterPanel";

function PrivateRoute({ component: Component, ...rest }) {
  // const { authTokens } = useAuth();
  const userContext = useContext(authContext)

  return (
    <>
    <div className="wrapper ">
                <SidebarPanel />
                <div className="main-panel">
                    <Menu />
                    <div className="content">
                        <div className="container-fluid">
                            
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
                        </div>
                        <FooterPanel />
                    </div>
                </div>
            </div>
    
    </>
  );
}

export default PrivateRoute;