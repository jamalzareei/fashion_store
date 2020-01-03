import React, { Component } from 'react';
import { Link, withRouter } from 'react-router-dom';
import Axios from '../../../../Axios';
import { LoadingBtn, LoadingForm, RequestCodeLink } from '../../../../Componetns/Loading';
import { AuthConsumer } from '../../../../Contexts/AuthContext';

class FormLogin extends Component {

    constructor(props) {
        super(props);

        this.state = {
            errors: {},
            statuses: {},
            requestCode: null,
            user: {},
            token : (localStorage.getItem("token_") !== null) ? localStorage.getItem("token_") : null
        };
    }

    handleSubmitLogin = (url) => async (event) => {

        event.preventDefault();

        this.setState({
            statuses: {
                loadBtn: <LoadingBtn />,
                loadForm: <LoadingForm />
            }
        });

        await Axios({
            method: event.target.method,
            url: url,// 
            data: new FormData(event.target)
        })
            .then(response => {
                console.log(response);
                this.setState({
                    errors: {},
                    statuses: {},
                });
                let appState = {
                    isLoggedIn: true,
                    user: response.data.data,
                    timestamp: new Date().toString()
                };
                localStorage.setItem("token_", response.data.token);
                localStorage.setItem("user", response.data.data);
                this.setState({
                    isLoggedIn: appState.isLoggedIn,
                    user: appState.user,
                    token: response.data.token
                });
                // if (response.data.redirect) {
                //     this.props.history.push('/');
                // } else {
                //     console.log('');
                // }
            }, (errors) => {
                console.log(errors.response);
                let requestCode = '';
                if (errors.response.status === 405) {
                    requestCode = <RequestCodeLink />;
                }
                if (errors.response.data.errors) {
                    this.setState({
                        errors: errors.response.data.errors,
                        requestCode: requestCode
                    })
                }
                this.setState({
                    statuses: {},
                })
            })
            .catch(function (error) {
                console.log(error);
            });
    }

    render() {
        if(this.state.token){
            return (
                <AuthConsumer>
                {({ token, setToken }) => (
                    <div>
                        {setToken(this.state.token)}
                        {this.props.history.push('/')}
                    </div>
                )}
            </AuthConsumer>
            );
        }
        return (
                    <div className="card card-signup m-0 mt-4">
                        {/* <LoadingForm /> */}
                        
                            {this.state.statuses.loadForm}
                        
                        <form className="form" method="post" action="/auth/login" onSubmit={this.handleSubmitLogin('auth/login')}>
                            <p className="description text-center">
                                <i className="fas fa-signature"></i>
                            </p>
                            <div className="card-body mb-2">
                                <div className="mb-1">
                                    <h3 className="text-center m-0">ورود به حساب کاربری</h3>
                                </div>
                                <div className="col-lg-12 col-sm-12">
                                    <div className={`form-group bmd-form-group ${this.state.errors.username ? "has-danger" : "has-success"}`}>
                                        <label htmlFor="username" className="bmd-label-floating">شماره تلفن</label>
                                        <input type="text" className="form-control dir-ltr" id="username" name="username" />
                                        <p className="text-right small text-log">{this.state.errors.username} {this.state.requestCode}</p>
                                    </div>
                                </div>
                                <div className="col-lg-12 col-sm-12">
                                    <div className={`form-group bmd-form-group ${this.state.errors.password ? "has-danger" : "has-success"}`}>
                                        <label htmlFor="password" className="bmd-label-floating">رمز عبور</label>
                                        <input type="password" className="form-control dir-ltr" id="password" name="password" />
                                        <p className="text-right small text-log">{this.state.errors.password}</p>
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

        )
    }
}

export default withRouter(FormLogin);