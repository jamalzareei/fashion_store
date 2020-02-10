import React, { useState, useContext, useEffect } from 'react'
import { Redirect } from 'react-router-dom'
import { authContext } from '../../../Contexts/AuthContext'
import Axios from '../../../Axios'
import useRequestApi from '../../../Services/RequestApi'
import Crop from '../../../Componetns/Crop'


function Profile() {
    const userContext = useContext(authContext)

    const [user, setUser] = useState({})
    const [statuses, setStatuses] = useState({})
    const [errors, setErrors] = useState({})
    const [cropResult, setCropResult] = useState({})

    useEffect(() => {
        // alert(userContext.data.token)
        Axios.get(`auth/profile?token=` + userContext.data.token, {
            headers: {
                'Authorization': "bearer " + userContext.data.token,
                // token,
            },
        }).then(res => {
            // console.log(res)
            setUser(res.data.data)
        })
    }, []);


    const handleChange = (event) => {
        user[event.target.name] = event.target.value;
        setUser(user)
    }

    const handleSubmit = (url) => async (event) => {
        event.preventDefault();

            await Axios({
                method: 'post',
                url: 'auth/profile?token=' + userContext.data.token,// 
                data: new FormData(event.target),
                headers: {
                    'Authorization': "bearer " + userContext.data.token,
                    // token,
                },
            })
                .then(response => {
                    
                    console.log(response)
                    setUser(response.data.data)
                    setErrors({})
                    // setData({ data: response, errors: null, errorsServer: null })
                }, (errors) => {
                    console.log(errors.response);
                    let requestCode = '';
                    if (errors.response.data.errors) {
                        setErrors(errors.response.data.errors)
                    }
                    // setData({ data: null, errors: errors.response.data.errors, errorsServer: null })
                })
                .catch(function (error) {
                    // setData({ data: null, errors: null, errorsServer: error })
                });
        // }
    }

    const cropImage = (cropResult) => { setCropResult(cropResult)}


    return (
        <>
            {/* {console.log(user)} */}
            <div className="row">
                <div className="col-md-8">
                    <div className="card">
                        <div className="card-header card-header-primary">
                            <h4 className="card-title">ویرایش اطلاعات </h4>
                            <p className="card-category">پروفایل خود را تکمیل نمایید</p>
                        </div>
                        <div className="card-body" dir="rtl">
                            {statuses.loadForm}
                            <form className="form" method="post" action="/auth/profile" onSubmit={handleSubmit('auth/profile')} encType="multipart/form-data">
                                <div className="row">
                                    <div className="col-md-12">
                                        <Crop  updateSrc={cropImage} height="300" width="300" cropBoxResizable={false} />
                                        {/* {cropResult &&
                                        <img src={cropResult} />
                                        } */}
                                        
                                        <input type="hidden" name="file" value={cropResult} />
                                        {/* <img src="http://style.anu.edu.au/_anu/4/images/placeholders/person_8x10.png" alt="..." /> */}
                                        
                                        <div className="fileinput-preview fileinput-exists thumbnail img-raised"></div>
                                    </div>
                                    <div className="col-md-12">
                                        <div className="row">

                                            <div className="col-md-6">
                                                <div className={`form-group bmd-form-group ${errors.firstname ? "has-danger" : "has-success"}`}>
                                                    <label htmlFor="firstname" className="bmd-label-floating">نام</label>
                                                    <input type="text" className="form-control" id="firstname" name="firstname" defaultValue={user.firstname || ''} onKeyUp={handleChange} />
                                                    <p className="text-right small text-log">{errors.firstname || ''}</p>
                                                </div>
                                            </div>
                                            <div className="col-md-6">
                                                <div className={`form-group bmd-form-group ${errors.lastname ? "has-danger" : "has-success"}`}>
                                                    <label htmlFor="lastname" className="bmd-label-floating">نام خانوادگی</label>
                                                    <input type="text" className="form-control" id="lastname" name="lastname" defaultValue={user.lastname || ''} onKeyUp={handleChange} />
                                                    <p className="text-right small text-log">{errors.lastname || ''}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div className="col-md-12">
                                            <div className="row">
                                                <div className="col-md-3">
                                                    <label>تاریخ تولد</label>
                                                </div>
                                                <div className="col-md-3">
                                                    <div className={`form-group bmd-form-group ${errors.day_birthdaye ? "has-danger" : "has-success"}`}>
                                                        <label htmlFor="day_birthdaye" className="bmd-label-floating">روز</label>
                                                        <input type="text" className="form-control" id="day_birthdaye" name="day_birthdaye" defaultValue={user.birth_day || ''} onKeyUp={handleChange} />
                                                        <p className="text-right small text-log">{errors.day_birthdaye || ''}</p>
                                                    </div>
                                                </div>
                                                <div className="col-md-3">
                                                    <div className={`form-group bmd-form-group ${errors.mounth_birthdaye ? "has-danger" : "has-success"}`}>
                                                        <label htmlFor="mounth_birthdaye" className="bmd-label-floating">ماه</label>
                                                        <input type="text" className="form-control" id="mounth_birthdaye" name="mounth_birthdaye" defaultValue={user.birth_month || ''} onKeyUp={handleChange} />
                                                        <p className="text-right small text-log">{errors.mounth_birthdaye || ''}</p>
                                                    </div>
                                                </div>
                                                <div className="col-md-3">
                                                    <div className={`form-group bmd-form-group ${errors.year_birthdaye ? "has-danger" : "has-success"}`}>
                                                        <label htmlFor="year_birthdaye" className="bmd-label-floating">سال</label>
                                                        <input type="text" className="form-control" id="year_birthdaye" name="year_birthdaye" defaultValue={user.birth_year || ''} onKeyUp={handleChange} />
                                                        <p className="text-right small text-log">{errors.year_birthdaye || ''}</p>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div className="row">
                                    <div className="col-md-12">
                                        <div className="form-group">
                                            <div className={`form-group bmd-form-group ${errors.about_me ? "has-danger" : "has-success"}`}>
                                                <label htmlFor="about_me" className="bmd-label-floating">درباره من</label>
                                                <textarea className="form-control" rows="5" id="about_me" name="about_me" defaultValue={user.about_me || ''} onKeyUp={handleChange}>{user.about_me}</textarea>
                                                <p className="text-right small text-log">{errors.about_me || ''}</p>
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
                            <h6 className="card-category text-gray">{user.phone || ''}</h6>
                            <h6 className="card-category text-gray">{user.email || ''}</h6>
                            <h4 className="card-title">{user.firstname || ''} {user.lastname || ''}</h4>
                            <h6 className="card-category text-gray">{user.birth_year}/{user.birth_month}/{user.birth_day}</h6>
                            <p className="card-description">
                                {user.about_me || ''}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </>
    )

}

export default Profile