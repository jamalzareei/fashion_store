import React, { Component } from 'react';
import { Link, withRouter } from 'react-router-dom';
import Axios from '../../../../Axios';
import { LoadingBtn, LoadingForm } from '../../../../Componetns/Loading';


class FormRequestCode extends Component {

    constructor(props) {
        super(props);

        this.state = {
            errors: {},
            statuses: {},
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

        let username = (this.props.match.params) ? this.props.match.params.username : '';
        return (
            <div className="card card-signup m-0 mt-5">
                <div className="progress m-0">
                    {this.state.statuses.loadForm}
                </div>
                <form className="form" method="post" action="auth/request-code" onSubmit={this.handleSubmitRegister('auth/request-code')}>
                    <p className="description text-center">
                        <i className="fas fa-signature"></i>
                    </p>
                    <div className="card-body mb-2">
                        <div className="mb-1">
                            <h3 className="text-center m-0">درخواست کد فعال سازی</h3>
                        </div>
                        <div className="col-lg-12 col-sm-12">
                            <div className={`form-group bmd-form-group ${this.state.errors.username ? "has-danger" : "has-success"}`}>
                                <label htmlFor="username" className="bmd-label-floating">شماره تلفن</label>
                                <input type="text" className="form-control dir-ltr" id="username" name="username" value={username} />
                                {this.state.statuses.iconUsername}
                                <p className="text-right small text-log">{this.state.errors.username}</p>
                            </div>
                        </div>
                    </div>
                    <div className="col mb-2">
                        <div className="row">
                            <div className="col text-left float-right">
                                <button type="submit" className="btn btn-primary btn-wd btn-round">
                                    ارسال کد فعال سازی
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

export default withRouter(FormRequestCode);