import React, { Component } from 'react';

import OwlCarousel from 'react-owl-carousel';
import 'owl.carousel/dist/assets/owl.carousel.css';
import 'owl.carousel/dist/assets/owl.theme.default.css';

class ProductSell extends Component {
    constructor(props) {
        super(props);
        this.state = {
            products: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14],
        }
    }


    render() {
        const imageUrl = require(`./../../../Assets/img/product.jpg`);
        const sellerUrl = require(`./../../../Assets/img/faces/avatar.jpg`);

        return (
            <div>

            <OwlCarousel
                className="owl-theme"
                loop
                margin={10}
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

                {this.state.products.map((seller, index) =>
                        <div className="card card-product card-plain no-shadow" key={index} data-colored-shadow="false">
                            <div className="card-header card-header-image">
                                <img src={imageUrl} alt="..." />
                                <div className="card-title header-filter px-2 rtl">
                                    <div className="card-stats ">
                                        <div className="author">
                                            <div className="media">
                                                <a href="#test" className="float-left">
                                                    <div className="avatar">
                                                        <img className="media-object" alt="64x64" src={sellerUrl} />
                                                    </div>
                                                </a>
                                                
                                                <div className="media-body">
                                                    <small>· 2 Days Ago</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div className="card-body">
                                <a href="/">
                                    <h6 className="card-title">Polo Ralph Lauren</h6>
                                </a>
                            </div>
                            <div className="card-footer justify-content-between">
                                <div className="price-container">
                                    <span className="price"> € 800</span>
                                </div>
                                <button className="btn btn-rose btn-link btn-fab btn-fab-mini btn-round pull-right" rel="tooltip" title="" data-placement="left" data-original-title="Remove from wishlist">
                                    <i className="material-icons">favorite</i>
                                </button>
                            </div>
                        </div>
                    
                )}
                </OwlCarousel>
            </div>
        );
    }
}

export default ProductSell;