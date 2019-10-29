import React, { Component } from 'react';

class Application extends Component {
    render() {

        // const imageUrl = require(`./../../../Assets/img/app.jpg`);
        const imageUrl = require(`./../../../Assets/img/iphone2.png`);
        return (
            <div className="features-4">
                <div className="row">
                    <div className="col-lg-3 col-md-12 ml-auto">
                        <div className="info info-horizontal">
                            <div className="icon icon-info">
                                <i className="material-icons">code</i>
                            </div>
                            <div className="description">
                                <h4 className="info-title">For Developers</h4>
                                <p>The moment you use Material Kit, you know you’ve never felt anything like it. With a single use, this powerfull UI Kit lets you do more than ever before. </p>
                            </div>
                        </div>
                        <div className="info info-horizontal">
                            <div className="icon icon-danger">
                                <i className="material-icons">format_paint</i>
                            </div>
                            <div className="description">
                                <h4 className="info-title">For Designers</h4>
                                <p>Divide details about your product or agency work into parts. Write a few lines about each one. A paragraph describing a feature will be enough.</p>
                            </div>
                        </div>
                    </div>
                    <div className="col-lg-4 col-md-12">
                        <div className="phone-container">
                            <img src={imageUrl} width="100%" alt="..." />
                        </div>
                    </div>
                    <div className="col-lg-3 col-md-12 mr-auto">
                        <div className="info info-horizontal">
                            <div className="icon icon-primary">
                                <i className="material-icons">dashboard</i>
                            </div>
                            <div className="description">
                                <h4 className="info-title">Bootstrap Grid</h4>
                                <p>Divide details about your product or agency work into parts. Write a few lines about each one. A paragraph describing a feature will be enough.</p>
                            </div>
                        </div>
                        <div className="info info-horizontal">
                            <div className="icon icon-success">
                                <i className="material-icons">view_carousel</i>
                            </div>
                            <div className="description">
                                <h4 className="info-title">Example Pages Included</h4>
                                <p>Divide details about your product or agency work into parts. Write a few lines about each one. A paragraph describing a feature will be enough.</p>
                            </div>
                        </div>
                    </div>
                </div>
                {/* <div className="team-5 section-image" style={{ backgroundImage: `url(${imageUrl})` }}>
                    <div className="container">
                        <div className="row">
                            <div className="col-md-6">
                                <div className="card card-profile card-plain">
                                    <div className="row">
                                        <div className="col-md-5">
                                            <div className="card-header card-header-image">
                                                <a href="#pablo">
                                                    <img className="img" src="../assets/img/kit/pro/faces/card-profile1-square.jpg" alt="" />
                                                </a>
                                                <div className="ripple-container"></div>
                                            </div>
                                        </div>
                                        <div className="col-md-7">
                                            <div className="card-body">
                                                <h4 className="card-title">Alec Thompson</h4>
                                                <h6 className="card-category text-muted">Author of the Month</h6>
                                                <p className="card-description">
                                                    Don't be scared of the truth because we need to restart the human foundation in truth...
                                        </p>
                                            </div>
                                            <div className="card-footer">
                                                <a href="#pablo" className="btn btn-just-icon btn-link btn-white">
                                                    <i className="fa fa-twitter"></i>
                                                </a>
                                                <a href="#pablo" className="btn btn-just-icon btn-link btn-white">
                                                    <i className="fa fa-facebook-square"></i>
                                                </a>
                                                <a href="#pablo" className="btn btn-just-icon btn-link btn-white">
                                                    <i className="fa fa-google"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div className="col-md-6">
                                <div className="card card-profile card-plain">
                                    <div className="row">
                                        <div className="col-md-5">
                                            <div className="card-header card-header-image">
                                                <a href="#pablo">
                                                    <img className="img" src="../assets/img/kit/pro/faces/card-profile4-square.jpg" alt="" />
                                                </a>
                                            </div>
                                        </div>
                                        <div className="col-md-7">
                                            <div className="card-body">
                                                <h4 className="card-title">Kendall Andrew</h4>
                                                <h6 className="card-category text-muted">Author of the Week</h6>
                                                <p className="card-description">
                                                    Don't be scared of the truth because we need to restart the human foundation in truth...
                                        </p>
                                            </div>
                                            <div className="card-footer">
                                                <a href="#pablo" className="btn btn-just-icon btn-link btn-white">
                                                    <i className="fa fa-linkedin"></i>
                                                </a>
                                                <a href="#pablo" className="btn btn-just-icon btn-link btn-white">
                                                    <i className="fa fa-facebook-square"></i>
                                                </a>
                                                <a href="#pablo" className="btn btn-just-icon btn-link btn-white">
                                                    <i className="fa fa-dribbble"></i>
                                                </a>
                                                <a href="#pablo" className="btn btn-just-icon btn-link btn-white">
                                                    <i className="fa fa-google"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> */}
            </div>
        );
    }
}

export default Application;