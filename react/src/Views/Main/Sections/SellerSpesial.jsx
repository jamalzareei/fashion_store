import React, { Component } from 'react';
import OwlCarousel from 'react-owl-carousel';
import 'owl.carousel/dist/assets/owl.carousel.css';
import 'owl.carousel/dist/assets/owl.theme.default.css';

class SellerSpesial extends Component {
    constructor(props) {
        super(props);
        this.state = {
            sellers: [1, 2, 3, 4, 5, 6, 7, 8, 9],
        }
    }
    render() {
        const imageUrl = require(`./../../../Assets/img/vip.jpg`);
        
        return (
            <OwlCarousel
                className="owl-theme"
                loop
                margin={20}
                items={6}
                responsive={{
                    0: {
                        items: 1,
                    },
                    450: {
                        items: 2,
                    },
                    600: {
                        items: 4,
                    },
                    1000: {
                        items: 6,
                    },
                }}
         
                nav
            >
                {this.state.sellers.map((seller, index) =>
                    <div className="card card-profile card-plain" key={index}>

                        <div className="">
                            <a href="#pablo">
                                <img className="img rounded-circle img-raised" height="180" width="150" src={imageUrl}  alt="" />
                            </a>
                        </div>
                        <div className="card-body ">
                            <h4 className="card-title">Alec Thompson</h4>
                        </div>
                    </div>
                )}
            </OwlCarousel>
        );
    }
}

export default SellerSpesial;