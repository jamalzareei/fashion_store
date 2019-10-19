import React, { Component } from 'react';
import { Link, withRouter } from 'react-router-dom';
import Axios from '../../../../Axios';
import { LoadingBtn, LoadingForm } from '../../../../Componetns/Loading';

class PasswordReset extends Component {

    constructor(props) {
        super(props);

        this.state = {
            errors: {},
            statuses: {},
            data: {}
        };
    }

    componentDidMount(){
        let token = this.props.match.params.token;
        Axios({
            method: 'get',
            url: 'auth/password/find/'+token,// 
            data: ''
        })
            .then(response => {
                console.log(response.data);
                this.setState({
                    data: response.data
                })
            }, (errors) => {
                console.log(errors.response.data.status);
                if (errors) {
                    this.props.history.push('/password/create');
                } else {
                    console.log('');
                }
            })
            .catch(function (error) {
                console.log(error);
            });
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
                this.setState({
                    errors: {},
                    statuses: {},
                });
                let appState = {
                    isLoggedIn: true,
                    user: response.data.data.user,
                    timestamp: new Date().toString()
                  };
                localStorage["appState"] = JSON.stringify(appState);
                this.setState({
                    isLoggedIn: appState.isLoggedIn,
                    user: appState.user
                });
                if (response.data.redirect) {
                    this.props.history.push('/');
                } else {
                    console.log('');
                }
            }, (errors) => {
                console.log(errors);
                if (errors.response.data.errors) {
                    this.setState({
                        errors: errors.response.data.errors,
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
        
        let tokenInput = this.state.data.token;
        let usernameInput = this.state.data.username;
        return (
            <div className="card card-signup m-0 mt-4">
                {/* <LoadingForm /> */}
                <div className="progress m-0">
                    {this.state.statuses.loadForm}
                </div>
                <form className="form" method="post" action="/auth/password/reset" onSubmit={this.handleSubmitLogin('auth/password/reset')}>
                    <input type="hidden" className="form-control dir-ltr" name="token" value={tokenInput} />
                    <p className="description text-center">
                        <i className="fas fa-signature"></i>
                    </p>
                    <div className="card-body mb-2">
                        <div className="mb-1">
                            <h3 className="text-center m-0">تغییر رمز عبور</h3>
                        </div>
                        <div className="col-lg-12 col-sm-12">
                            <div className={`form-group bmd-form-group ${this.state.errors.username ? "has-danger" : "has-success"}`}>
                                <label htmlFor="username" className="bmd-label-floating">شماره تلفن</label>
                                <input type="text" readOnly className="form-control dir-ltr" id="username" name="username" value={usernameInput} />
                                <p className="text-right small text-log">{this.state.errors.username}</p>
                            </div>
                        </div>
                        <div className="col-lg-12 col-sm-12">
                            <div className={`form-group bmd-form-group ${this.state.errors.password ? "has-danger" : "has-success"}`}>
                                <label htmlFor="password" className="bmd-label-floating">رمز عبور</label>
                                <input type="password" className="form-control dir-ltr" id="password" name="password" />
                                <p className="text-right small text-log">{this.state.errors.password}</p>
                            </div>
                        </div>
                        <div className="col-lg-12 col-sm-12">
                            <div className={`form-group bmd-form-group ${this.state.errors.password_confirmation ? "has-danger" : "has-success"}`}>
                                <label htmlFor="password_confirmation" className="bmd-label-floating">رمز عبور</label>
                                <input type="password" className="form-control dir-ltr" id="password_confirmation" name="password_confirmation" />
                                <p className="text-right small text-log">{this.state.errors.password_confirmation}</p>
                            </div>
                        </div>

                    </div>
                    <div className="col mb-2">
                        <div className="row">
                            <div className="col text-left float-right">
                                <button type="submit" className="btn btn-primary btn-wd btn-round">
                                    تغییر رمز عبور
                                </button>
                            </div>
                            <div className="col text-right float-right">
                                <Link to="/login" className="btn btn-rose btn-link btn-wd btn-lg">
                                    ورود به حساب کاربری
                                </Link>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        )
    }
}

export default withRouter(PasswordReset);