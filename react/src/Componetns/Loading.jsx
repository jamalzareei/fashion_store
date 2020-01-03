import React from 'react';

const LoadingBtn = () => (
    <div className="loader">...</div>
);

const LoadingForm = () => (
    <div className="progress m-0">
        <div className="progress-bar progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style={{ width:'100%' }}></div>
    </div>
);

const Success = () => (
    <i className="fas fa-check float-right ml-1"></i>
);


const Error = () => (
    <i className="fas fa-times float-right ml-1"></i>
);

const Again = () => (
    <i className="fas fa-redo float-right ml-1"></i>
);

const DefaultWait = () => (
    <i className="fas fa-paper-plane float-right ml-1"></i>
);

const iconStatusDone = () => (
    <span className="form-control-feedback">
        <i className="material-icons">done</i>
    </span>
);

const iconStatusClear = () => (
    <span className="form-control-feedback">
        <i className="material-icons">clear</i>
    </span>
);

const RequestCodeLink = () => (
    <a href="/request-code" className=" btn-link btn-wd">
        درخواست کد فعال سازی
    </a>
);


export { 
    Success, 
    LoadingBtn, 
    Error, 
    Again, 
    DefaultWait, 
    LoadingForm, 
    iconStatusDone, 
    iconStatusClear, 
    RequestCodeLink 
};