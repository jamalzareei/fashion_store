import React, { Component } from 'react';

class Vip extends Component {
    render() {

        const imageUrl = require(`./../../../Assets/img/vip.jpg`);
        return (
            <div>
                <div className=" ">
                    <div className="team-5 section-image" style={{ backgroundImage: `url(${imageUrl})` }}>
                        <div className="card-body">
                            <h6 className="card-category text-info">Marketing</h6>
                            <h3 className="card-title">0 to 100.000 Customers in 6 months</h3>
                            <p className="card-description">
                                Don't be scared of the truth because we need to restart the human foundation in truth And I love you like Kanye loves Kanye I love Rick Owens’ bed design but the back is...
                                </p>
                            <a href="#pablo" className="btn btn-warning btn-round">
                                <i className="material-icons">subject</i> Read Case Study
                                </a>
                            <a href="#pablo" className="btn btn-white btn-just-icon btn-link" title="" rel="tooltip" data-original-title="Save to Pocket">
                                <i className="fa fa-get-pocket"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}

export default Vip;