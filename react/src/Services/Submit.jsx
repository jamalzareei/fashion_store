// import React from 'react';
import Axios from '../Axios';


const AxiosSubmit = (method, url, data, redirect = null)=>{
    let obj = {
        response: {},
        errors: {},
        message: '',
        status: '',
        complete: false
    }

    Axios({
        method: method,
        url: url,// 
        data: data
    })
        .then(response => {
            obj = {
                response: response,
                errors: {},
                message: '',
                status: '',
                complete: true
            }
            if(redirect){
                if (response.data.redirect.parametr) {
                    redirect += '/' + response.data.redirect.parametr;
                }
                // this.props.history.push(redirect);
            }
            return obj;
            
        }, (errors) => {
            obj = {
                response: {},
                errors: errors,
                message: '',
                status: '',
                complete: true
            }

            return obj;
        })
        .catch(function (errors) {
            obj = {
                response: {},
                errors: errors,
                message: '',
                status: '',
                complete: true
            }
            return obj;
        });

    // return obj;
}


export {AxiosSubmit};