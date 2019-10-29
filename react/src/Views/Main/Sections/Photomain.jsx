import React, { Component } from 'react';
// import $ from 'jquery';
// import "./../../../Assets/js/plugins/bootstrap-selectpicker.js";
// $('.selectpicker').selectpicker('show');

// React.Bootstrap.Select = require('react-bootstrap-select');

class Photomain extends Component {

    componentWillMount() {
        // document.getElementsByClassName('selectpicker').selectpicker('show');
        // $('.selectpicker').selectpicker('show');
    }
    render() {
        // backgroundImage: "url(assets/img/bg.jpg)";
        const imageUrl = require(`./../../../Assets/img/bg.jpg`);
        return (
            <div>
                <div className="page-header header-filter clear-filter" data-parallax="true" style={{ backgroundImage: `url(${imageUrl})`,height: '85vh' }}>
                    <div className="container">
                        <div className="col">
                            <h1>بوتیک ایران</h1>
                            <p className="dir">
                                انتخاب از بین 15001 کالا از 502 فروشنده
                            </p>
                            <div className="row">
                                <div className="col-md-10 ml-auto mr-auto">
                                    <div className="card card-raised card-form-horizontal">
                                        <div className="card-body rtl">
                                            <form method="" action="">
                                                <div className="row">
                                                    <div className="col-lg-2 col-md-4 ">
                                                        {/* <button type="button" className="btn btn-primary btn-block">جستجو</button> */}
                                                        <a className="btn btn-block">
                                                            جستجو
                                                        </a>
                                                    </div>
                                                    <div className="col-lg-8 col-md-4 mt-1">
                                                        <span className="bmd-form-group">
                                                            <div className="input-group">
                                                                <input type="text" name="search" placeholder="جستجوی محصول= کت، شلوار، مانتو، تونیک ..." className="form-control" />
                                                                <div className="input-group-prepend">
                                                                </div>
                                                            </div>
                                                        </span>
                                                    </div>
                                                    <div className="col-lg-2 col-md-4 ">
                                                        <button className="btn btn-block  btn-primary">
                                                            <span> شروع کنید   </span>
                                                            <i className="fa fa-search"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>

            </div>
        );
    }
}

export default Photomain;