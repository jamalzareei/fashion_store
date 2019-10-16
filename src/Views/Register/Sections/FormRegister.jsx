import React, { Component } from 'react';
import { Link } from 'react-router-dom';
import Axios from '../../../Axios';
import { LoadingBtn, LoadingForm, iconStatusDone, iconStatusClear } from '../../../Componetns/Loading';

export default class FormRegister extends Component {

    constructor(props) {
        super(props);

        this.state = {
            username: '',
            password: '',
            subscribe: 0,
            errors: {},
            statuses: {}
            // submited: <DefaultWait />,
        };
    }

    changeHandle(event) {
        // console.log(e.target.value);
        this.setState({
            [event.target.name]: event.target.value,
        });
    }

    handleSubmitRegister = async event => {


        event.preventDefault();

        this.setState({
            statuses: {
                loadBtn: <LoadingBtn />,
                loadForm: <LoadingForm />
            }
        })
        // console.log(new FormData(event.target));
        await Axios.post(`auth/register`, new FormData(event.target))
            .then(response => {
                console.log(response);
                this.setState({
                    errors: {},
                    statuses: {},
                    // submited: <Success />,
                })
                // try {
                //     this.props.history.push('/active/user/' + response.data.data.uuid);
                // } catch (e) {
                //     // console.log(e.message);
                // }
            }, (errors) => {
                console.log(errors);
                if (errors.response.data.errors) {
                    this.setState({
                        errors: errors.response.data.errors,
                        // submited: <Again />,
                        statuses: {
                            classUsername: 'danger',//(errors.response.data.errors.username) ? 'danger' : 'success',
                            classPassword: 'danger',//(errors.response.data.errors.password) ? 'danger' : 'success'
                        },
                    })
                }
                this.setState({
                    statuses: {},
                    // submited: <Success />,
                })
                // console.log(this.state.errors);
            })
            .catch(function (error) {
                // console.log(error.response.data);
                console.log(error);
            });
    }
    render() {
        return (
            <div className="card card-signup m-0">
            {/* <LoadingForm /> */}
                    {this.state.statuses.loadForm}
                <form className="form" method="" action="" onSubmit={this.handleSubmitRegister.bind(this)}>
                    <p className="description text-center">
                        <i className="fas fa-signature"></i>
                    </p>
                    <div className="card-body mb-2">
                        <div className="mb-1">
                            <h3 className="text-center m-0">ثبت نام در سایت فشیون</h3>
                        </div>
                        <div className="col-lg-12 col-sm-12"> 
                            <div className={`form-group bmd-form-group ${this.state.errors.username ? "has-danger" : "has-success"}`}>
                                <label htmlFor="username" className="bmd-label-floating">شماره تلفن</label>
                                <input type="text" className="form-control" id="username" />
                                {this.state.statuses.iconUsername}
                                <p className="text-right small text-log">{this.state.errors.username}-{this.state.statuses.classUsername}</p>
                            </div>
                        </div>
                        <div className="col-lg-12 col-sm-12">
                            <div className={`form-group bmd-form-group ${this.state.errors.password ? "has-danger" : "has-success"}`}>
                                <label htmlFor="password" className="bmd-label-floating">رمز عبور</label>
                                <input type="password" className="form-control" id="password" />
                                {this.state.statuses.iconPassword}
                                <p className="text-right small text-log">{this.state.errors.password}</p>
                            </div>
                        </div>

                        <div className="form-check rtl">
                            <label className="form-check-label">
                                دریافت خبرنامه
                    <input className="form-check-input" type="checkbox" value="1" name="subscribe" onChange={this.changeHandle.bind(this)} />
                                <span className="form-check-sign">
                                    <span className="check"></span>
                                </span>
                            </label>
                        </div>
                    </div>
                    <div className="col mb-2">
                        <div className="row">
                            <div className="col text-left float-right">
                                <button href="#pablo" className="btn btn-primary btn-wd btn-round">
                                    ثبت نام 
                                </button>
                            </div>
                            <div className="col text-right float-right">
                                <Link to="/login" className="btn btn-rose btn-link btn-wd btn-lg">
                                    قبلا ثبت نام کرده اید؟
                                </Link>
                            </div>
                        </div>
                    </div>
                    
                </form>
            </div>
        )
    }
}
