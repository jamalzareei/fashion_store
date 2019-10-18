import React, { Component } from 'react';
import { Link, withRouter } from 'react-router-dom';
import Axios from '../../../Axios';
import { LoadingBtn, LoadingForm } from '../../../Componetns/Loading';


class FormConfirm extends Component {

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
                if(response.data.redirect){
                    this.props.history.push('/login');
                }else{
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

        let uuid = this.props.match.params.uuid;
        return (
            <div className="card card-signup m-0 mt-5">
            {/* <LoadingForm /> */}
                {this.state.statuses.loadForm}
                <form className="form" method="post" action="auth/confirm" onSubmit={this.handleSubmitRegister('auth/confirm')}>
                    <p className="description text-center">
                        <i className="fas fa-signature"></i>
                    </p>
                    <input type="hidden" className="form-control dir-ltr" id="uuid" name="uuid" value={uuid} />
                    <div className="card-body mb-2">
                        <div className="mb-1">
                            <h3 className="text-center m-0">تایید حساب کاربری</h3>
                        </div>
                        <div className="col-lg-12 col-sm-12"> 
                            <div className={`form-group bmd-form-group ${this.state.errors.code_confirm ? "has-danger" : "has-success"}`}>
                                <label htmlFor="code_confirm" className="bmd-label-floating">کد تاییدیه</label>
                                <input type="text" className="form-control dir-ltr" id="code_confirm" name="code_confirm" />
                                {this.state.statuses.iconcode_confirm}
                                <p className="text-right small text-log">{this.state.errors.code_confirm}</p>
                            </div>
                        </div>
                    </div>
                    <div className="col mb-2">
                        <div className="row">
                            <div className="col text-left float-right">
                                <button type="submit" className="btn btn-primary btn-wd btn-round">
                                    تایید حساب کاربری 
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

export default withRouter(FormConfirm);