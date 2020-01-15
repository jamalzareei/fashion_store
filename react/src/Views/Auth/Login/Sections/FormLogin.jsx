import React, { useContext, useReducer, useState } from 'react';
import { Link, withRouter } from 'react-router-dom';
import Axios from '../../../../Axios';
import { LoadingBtn, LoadingForm, RequestCodeLink } from '../../../../Componetns/Loading';
import AuthContext from './../../../../Contexts/AuthContext';


function Login() {

    const context = useContext(AuthContext)

    const [statuses, setStatuses] = useState({})
    const [errors, setErrors] = useState({})
    const [user, setUser] = useState({})
    const tokenExist = (localStorage.getItem("token") !== null) ? localStorage.getItem("token") : null
    const [token, setToken] = useState(tokenExist)
    const [requestCode, setRequestCode] = useState(null)
    

    const handleSubmitLogin = (url) =>  async (event) => {
        event.preventDefault();
        setStatuses({loadForm: <LoadingForm />})
        await Axios({
            method: event.target.method,
            url: url,// 
            data: new FormData(event.target)
        })
            .then(response => {
                setErrors({})
                setStatuses({})
                let appState = { isLoggedIn: true, user: response.data.data, timestamp: new Date().toString() };
                localStorage.setItem("token", response.data.token);
                localStorage.setItem("user", response.data.data);

                setStatuses(response.data.data)
                setToken(response.data.token)

            }, (errors) => {
                console.log(errors.response);
                let requestCode = '';
                if (errors.response.status === 405) {
                    requestCode = <RequestCodeLink />;
                }
                if (errors.response.data.errors) {
                    setErrors(errors.response.data.errors)
                    setRequestCode(requestCode)
                }
                
                setStatuses({})
            })
            .catch(function (error) {
                console.log(error);
                setStatuses({})
            });
    }


  return (
            <>
        <div className="card card-signup m-0 mt-4">
            {statuses.loadForm}

            <form className="form" method="post" action="/auth/login" onSubmit={handleSubmitLogin('auth/login')}>
                <p className="description text-center">
                    <i className="fas fa-signature"></i>
                </p>
                <div className="card-body mb-2">
                    <div className="mb-1">
                        <h3 className="text-center m-0">ورود به حساب کاربری</h3>
                    </div>
                    <div className="col-lg-12 col-sm-12">
                        <div className={`form-group bmd-form-group ${errors.username ? "has-danger" : "has-success"}`}>
                            <label htmlFor="username" className="bmd-label-floating">شماره تلفن</label>
                            <input type="text" className="form-control dir-ltr" id="username" name="username" />
                            <p className="text-right small text-log">{errors.username} {requestCode}</p>
                        </div>
                    </div>
                    <div className="col-lg-12 col-sm-12">
                        <div className={`form-group bmd-form-group ${errors.password ? "has-danger" : "has-success"}`}>
                            <label htmlFor="password" className="bmd-label-floating">رمز عبور</label>
                            <input type="password" className="form-control dir-ltr" id="password" name="password" />
                            <p className="text-right small text-log">{errors.password}</p>
                        </div>
                        <Link to="/password/create" className=" btn-link btn-wd">
                            فراموشی رمز عبور
                            </Link>
                    </div>

                </div>
                <div className="col mb-2">
                    <div className="row">
                        <div className="col text-left float-right">
                            <button type="submit" className="btn btn-primary btn-wd btn-round">
                                ورود به حساب کاربری
                                </button>
                        </div>
                        <div className="col text-right float-right">
                            <Link to="/register" className="btn btn-rose btn-link btn-wd btn-lg">
                                حساب کاربری ندارید؟
                                </Link>
                        </div>
                    </div>
                </div>

            </form>
        </div>

    </>
    );

    }

export default Login;