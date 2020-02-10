import React, { useState, useEffect } from 'react';
import Axios from './../Axios';

export default function useRequestApi(method, url, dataForm) {
    const [data, setData] = useState({ data: null, errors: null, errorsServer: null });


    async function fnRequestApi(method, url, dataForm) {
        await Axios({
            method: method,
            url: url,// 
            data: dataForm
        })
            .then(response => {
                setData({ data: response, errors: null, errorsServer: null })
            }, (errors) => {
                setData({ data: null, errors: errors.response.data.errors, errorsServer: null })
            })
            .catch(function (error) {
                setData({ data: null, errors: null, errorsServer: error })
            });
    }

    useEffect(() => {
        fnRequestApi(method, url, dataForm);
    }, []);

    return data;
}
