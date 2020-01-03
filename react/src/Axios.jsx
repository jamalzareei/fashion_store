import axios from 'axios';
import { urlBase } from './Helper';

let token = (localStorage.getItem("token_") !== null) ? localStorage.getItem("token_") : null;


export default axios.create({
    baseURL: urlBase+`/api/v1/`,

    headers: {
        'Accept': 'application/json',
        'content-type': 'application/json',
        // 'Content-Type': 'application/x-www-form-urlencoded',
        'X-Requested-With': 'XMLHttpRequest',
        'Authorization': "Bearer " + token,
        // token,
    },
    responseType: 'json',
});
