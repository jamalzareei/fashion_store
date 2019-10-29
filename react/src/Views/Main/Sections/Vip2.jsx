import React, { Component } from 'react';
import OwlCarousel from 'react-owl-carousel';
import 'owl.carousel/dist/assets/owl.carousel.css';
import 'owl.carousel/dist/assets/owl.theme.default.css';

class Vip2 extends Component {
    constructor(props) {
        super(props);
        this.state = {
            vips: [1,2,3,4,5,6,7],
        }
    }
    render() {
        
        const imageUrl = require(`./../../../Assets/img/vip1.jpg`);
       

        return (
            <OwlCarousel
                className="owl-theme"
                loop
                margin={10}
                items={3}
                nav
            >
            {this.state.vips.map((vip, index)=>
                <div className="col-md-12" key={index}>
                    <div className="card card-profile card-plain">
                        <div className="card-header card-header-image">
                            <a href="#pablo">
                                <img className="img" src={imageUrl} alt="" />
                            </a>
                            <div className="colored-shadow" style={{backgroundImage: `url(${imageUrl})`, opacity: '1'}}></div></div>
                        <div className="card-body ">
                            <h4 className="card-title">Alec Thompson</h4>
                            <h6 className="card-category text-muted">Managing Partner</h6>
                        </div>
                        <div className="card-footer justify-content-center">
                            <a href="#pablo" className="btn btn-just-icon btn-twitter btn-round"><i className="fa fa-twitter"></i></a>
                            <a href="#pablo" className="btn btn-just-icon btn-facebook btn-round"><i className="fa fa-facebook-square"></i></a>
                            <a href="#pablo" className="btn btn-just-icon btn-dribbble btn-round"><i className="fa fa-dribbble"></i></a>
                        </div>
                    </div>
                </div>
                
            )}
            </OwlCarousel>
        );
    }
}

export default Vip2;