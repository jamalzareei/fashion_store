import React, { Component } from 'react';
import { Link, withRouter } from 'react-router-dom';
import Axios from '../../../../Axios';
import { LoadingBtn, LoadingForm } from '../../../../Componetns/Loading';

class FormRegister extends Component {

    constructor(props) {
        super(props);

        this.state = {
            errors: {},
            statuses: {}
        };
    }

    handleSubmitRegister = (url) => async (event) => {

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
                if (response.data.redirect.parametr) {
                    this.props.history.push('/confirm/' + response.data.redirect.parametr);
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
            <div className="card card-signup m-0">
                {/* <LoadingForm /> */}
                    {this.state.statuses.loadForm}
                <form className="form" method="post" action="/auth/register" onSubmit={this.handleSubmitRegister('auth/register')}>
                    <p className="description text-center">
                        <i className="fas fa-signature"></i>
                    </p>
                    <div className="card-body mb-2">
                        <div className="mb-1">
                            <h3 className="text-center m-0">ثبت نام در سایت فشیون</h3>
                        </div>
                        {/* <div className="col-lg-12 col-sm-12">
                            <div className={`form-group bmd-form-group ${this.state.errors.username ? "has-danger" : "has-success"}`}>
                                <label htmlFor="username" className="bmd-label-floating">شماره تلفن</label>
                                <input type="text" className="form-control dir-ltr" id="username" name="username" />
                                <p className="text-right small text-log">{this.state.errors.username}</p>
                            </div>
                        </div> */}
                        <span class="bmd-form-group">
                            <div class={`form-group bmd-form-group input-group dir-ltr p-0 ${this.state.errors.username ? "has-danger" : "has-success"}`}>
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="material-icons">phone</i>
                                        {/* <img src={require('./../../../../Assets/flags/iran-flag.png')} alt=""/> */}
                                    </span>
                                </div>
                                <input type="text" className="form-control dir-ltr" id="username" name="username" placeholder="شماره تلفن همراه 09130000000" />
                            </div>
                                <p className="text-right text-danger m-0 feedback-error small text-log">{this.state.errors.username}</p>
                        </span>
                        <span class="bmd-form-group">
                            <div class={`form-group bmd-form-group input-group dir-ltr p-0 ${this.state.errors.password ? "has-danger" : "has-success"}`}>
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-key text-primary"></i>
                                    </span>
                                </div>
                                <input type="password" className="form-control dir-ltr" id="password" name="password" placeholder="رمز عبور" />
                            </div>
                                <p className="text-right text-danger m-0 feedback-error small text-log">{this.state.errors.password}</p>
                        </span>
                        <span class="bmd-form-group">
                            <div class={`form-group bmd-form-group input-group dir-ltr p-0 ${this.state.errors.password_confirmation ? "has-danger" : "has-success"}`}>
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-key text-primary"></i>
                                    </span>
                                </div>
                                <input type="password" className="form-control dir-ltr" id="password_confirmation" name="password_confirmation" placeholder="تکرار رمز عبور" />
                            </div>
                                <p className="text-right text-danger m-0 feedback-error small text-log">{this.state.errors.password_confirmation}</p>
                        </span>
                        
                    </div>
                    <div className="col mb-2">
                        <div className="row">
                            <div className="col text-right float-right">
                                <Link to="/login" className="btn btn-rose btn-link btn-wd btn-lg">
                                    قبلا ثبت نام کرده اید؟
                                </Link>
                            </div>
                            <div className="col text-left float-right">
                                <button href="#pablo" className="btn btn-primary btn-wd btn-round">
                                    ثبت نام
                                </button>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        )
    }
}

export default withRouter(FormRegister);