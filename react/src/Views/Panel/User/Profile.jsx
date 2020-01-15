import React, { Component } from 'react'
import { Redirect } from 'react-router-dom'

import MenuPanel from '../../../Componetns/MenuPanel';
import FooterPanel from '../../../Componetns/FooterPanel';
import SidebarPanel from '../../../Componetns/SidebarPanel';
import Axios from '../../../Axios';
import { LoadingBtn, LoadingForm } from '../../../Componetns/Loading';
import Menu from '../../../Componetns/Menu';

export default class Dashboard extends Component {

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

    componentDidMount (){

        Axios.get(`auth/user?token=`+this.state.token, {
            headers: {
                'Authorization': "bearer " + this.state.token,
                // token,
            },
        })
        .then(res => {
            if(res.data.error){
                localStorage.removeItem('token_');
                this.setState({
                    token: null
                })
            }
            this.setState({
                user: res.data.data
            })
            // this.setState({ token });
            // localStorage.removeItem('token_');
        })
    }

    handleChange = (event) => {
        let user = this.state.user;
        user[event.target.name] = event.target.value;
        this.setState({
            user: user
        });
    }

    handleSubmit = (url) => async (event) => {

        event.preventDefault();

        this.setState({
            statuses: {
                loadBtn: <LoadingBtn />,
                loadForm: <LoadingForm />
            }
        });

        // const data = new FormData(event.target);
        // const image = event.target.files[0];
        // data.append('file', image);

        await Axios({
            method: event.target.method,
            url: url+`?token=`+this.state.token,// 
            data: new FormData(event.target),
        })
            .then(response => {
                console.log(response);
                this.setState({
                    errors: {},
                    statuses: {},
                });
                
            }, (errors) => {
                console.log(errors);
                if (errors.response.data.errors) {
                    this.setState({
                        errors: errors.response.data.errors,
                        statuses: {},
                    })
                }
            })
            .catch(function (error) {
                console.log(error);
            });
    }

    render() {
        if(!this.state.token){
            return (<Redirect to="/login" />)
        }
        return (
            <div className="wrapper ">
                <SidebarPanel />
                <div className="main-panel">
                    <Menu />
                    <div className="content">
                        <div className="container-fluid">
                            <div className="row">
                                <div className="col-md-8">
                                    <div className="card">
                                        <div className="card-header card-header-primary">
                                            <h4 className="card-title">ویرایش اطلاعات </h4>
                                            <p className="card-category">پروفایل خود را تکمیل نمایید</p>
                                        </div>
                                        <div className="card-body" dir="rtl">
                                                {this.state.statuses.loadForm}
                                            <form className="form" method="post" action="/auth/profile" onSubmit={this.handleSubmit('auth/profile')}  encType="multipart/form-data">
                                                <div className="row">
                                                    <div className="col-md-5">
                                                        <div className="fileinput fileinput-new text-center" data-provides="fileinput">
                                                            <div className="fileinput-new thumbnail img-raised">
                                                                <img src="http://style.anu.edu.au/_anu/4/images/placeholders/person_8x10.png" alt="..." />
                                                            </div>
                                                            <div className="fileinput-preview fileinput-exists thumbnail img-raised"></div>
                                                            <div>
                                                                <span className="btn btn-raised btn-round btn-default btn-file">
                                                                    <span className="fileinput-new">انتخاب عکس</span>
                                                                    <span className="fileinput-exists">تغییر عکس</span>
                                                                    <input type="file" name="file" />
                                                                </span>
                                                                <a href="#pablo" className="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i className="fa fa-times"></i> Remove</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div className="col-md-7">
                                                        <div className="col-md-12">
                                                            <div className={`form-group bmd-form-group ${this.state.errors.email ? "has-danger" : "has-success"}`}>
                                                                <label htmlFor="email" className="bmd-label-floating">ایمیل</label>
                                                                <input type="text" className="form-control" id="email" name="email" defaultValue={this.state.user.email || ''} onKeyUp={this.handleChange} />
                                                                <p className="text-right small text-log">{this.state.errors.email || ''}</p>
                                                            </div>
                                                        </div>
                                                        <div className="col-md-12">
                                                            <div className={`form-group bmd-form-group ${this.state.errors.phone ? "has-danger" : "has-success"}`}>
                                                                <label htmlFor="phone" className="bmd-label-floating">شماره تلفن</label>
                                                                <input type="text" className="form-control" id="phone" name="phone" defaultValue={this.state.user.phone || ''} onKeyUp={this.handleChange} />
                                                                <p className="text-right small text-log">{this.state.errors.phone || ''}</p>
                                                            </div>
                                                        </div>
                                                        <div className="col-md-12">
                                                            <div className={`form-group bmd-form-group ${this.state.errors.firstname ? "has-danger" : "has-success"}`}>
                                                                <label htmlFor="firstname" className="bmd-label-floating">نام</label>
                                                                <input type="text" className="form-control" id="firstname" name="firstname" defaultValue={this.state.user.firstname || ''} onKeyUp={this.handleChange} />
                                                                <p className="text-right small text-log">{this.state.errors.firstname || ''}</p>
                                                            </div>
                                                        </div>
                                                        <div className="col-md-12">
                                                            <div className={`form-group bmd-form-group ${this.state.errors.lastname ? "has-danger" : "has-success"}`}>
                                                                <label htmlFor="lastname" className="bmd-label-floating">نام خانوادگی</label>
                                                                <input type="text" className="form-control" id="lastname" name="lastname" defaultValue={this.state.user.lastname || ''} onKeyUp={this.handleChange} />
                                                                <p className="text-right small text-log">{this.state.errors.lastname || ''}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                                <div className="row">
                                                    <div className="col-md-3">
                                                        <label>تاریخ تولد</label>
                                                    </div>
                                                    <div className="col-md-3">
                                                        <div className={`form-group bmd-form-group ${this.state.errors.day_birthdaye ? "has-danger" : "has-success"}`}>
                                                            <label htmlFor="day_birthdaye" className="bmd-label-floating">روز</label>
                                                            <input type="text" className="form-control" id="day_birthdaye" name="day_birthdaye" defaultValue={this.state.user.birth_day || ''} onKeyUp={this.handleChange} />
                                                            <p className="text-right small text-log">{this.state.errors.day_birthdaye || ''}</p>
                                                        </div>
                                                    </div>
                                                    <div className="col-md-3">
                                                        <div className={`form-group bmd-form-group ${this.state.errors.mounth_birthdaye ? "has-danger" : "has-success"}`}>
                                                            <label htmlFor="mounth_birthdaye" className="bmd-label-floating">ماه</label>
                                                            <input type="text" className="form-control" id="mounth_birthdaye" name="mounth_birthdaye" defaultValue={this.state.user.birth_month || ''} onKeyUp={this.handleChange} />
                                                            <p className="text-right small text-log">{this.state.errors.mounth_birthdaye || ''}</p>
                                                        </div>
                                                    </div>
                                                    <div className="col-md-3">
                                                        <div className={`form-group bmd-form-group ${this.state.errors.year_birthdaye ? "has-danger" : "has-success"}`}>
                                                            <label htmlFor="year_birthdaye" className="bmd-label-floating">سال</label>
                                                            <input type="text" className="form-control" id="year_birthdaye" name="year_birthdaye" defaultValue={this.state.user.birth_year || ''} onKeyUp={this.handleChange} />
                                                            <p className="text-right small text-log">{this.state.errors.year_birthdaye || ''}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div className="row">
                                                    <div className="col-md-12">
                                                        <div className="form-group">
                                                            <div className={`form-group bmd-form-group ${this.state.errors.about_me ? "has-danger" : "has-success"}`}>
                                                                <label htmlFor="about_me" className="bmd-label-floating">درباره من</label>
                                                                <textarea className="form-control" rows="5" id="about_me" name="about_me" defaultValue={this.state.user.about_me || ''} onKeyUp={this.handleChange}>{this.state.user.about_me}</textarea>
                                                                <p className="text-right small text-log">{this.state.errors.about_me || ''}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="submit" className="btn btn-primary pull-right">ویرایش اطلاعات</button>
                                                <div className="clearfix"></div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div className="col-md-4">
                                    <div className="card card-profile">
                                        <div className="card-avatar">
                                            <a href="#pablo">
                                                <img className="img" alt="" src="../assets/img/faces/marc.jpg" />
                                            </a>
                                        </div>
                                        <div className="card-body">
                                            <h6 className="card-category text-gray">{this.state.user.phone || ''}</h6>
                                            <h6 className="card-category text-gray">{this.state.user.email || ''}</h6>
                                            <h4 className="card-title">{this.state.user.firstname || ''} {this.state.user.lastname || ''}</h4>
                                            <h6 className="card-category text-gray">{this.state.user.birth_year}/{this.state.user.birth_month}/{this.state.user.birth_day}</h6>
                                            <p className="card-description">
                                            {this.state.user.about_me || ''}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <FooterPanel />
                    </div>
                </div>
            </div>
        )
    }
}