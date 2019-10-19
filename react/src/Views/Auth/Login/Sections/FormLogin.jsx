import React, { Component } from 'react';
import { Link, withRouter } from 'react-router-dom';
import Axios from '../../../../Axios';
import { LoadingBtn, LoadingForm } from '../../../../Componetns/Loading';

class FormLogin extends Component {

    constructor(props) {
        super(props);

        this.state = {
            errors: {},
            statuses: {}
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
        return (
            <div className="card card-signup m-0 mt-4">
                {/* <LoadingForm /> */}
                <div className="progress m-0">
                    {this.state.statuses.loadForm}
                </div>
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
                                <p className="text-right small text-log">{this.state.errors.username}</p>
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