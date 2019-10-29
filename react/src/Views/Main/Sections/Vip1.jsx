import React, { Component } from 'react';
import OwlCarousel from 'react-owl-carousel';
import 'owl.carousel/dist/assets/owl.carousel.css';
import 'owl.carousel/dist/assets/owl.theme.default.css';

class Vip1 extends Component {
    constructor(props) {
        super(props);
        this.state = {
            vips: [1, 2, 3, 4],
        }
    }


    render() {
        const imageUrl = require(`./../../../Assets/img/vip1.jpg`);

        return (
            <OwlCarousel
                className="owl-theme"
                loop
                margin={10}
                items={2}
                nav
            >
                {this.state.vips.map((vip, index) =>
                    <div className="card card-background" key={index} style={{ backgroundImage: `url(${imageUrl})` }}>
                        <div className="card-body">
                            <h6 className="card-category text-info">Productivy Apps</h6>
                            <a href="#pablo">
                                <h3 className="card-title">The Best Productivity Apps on Market</h3>
                            </a>
                            <p className="card-description">
                                Don't be scared of the truth because we need to restart the human foundation in truth And I love you like Kanye loves Kanye I love Rick Owens’ bed design but the back is...
                            </p>
                            <a href="#pablo" className="btn btn-white btn-link">
                                <i className="material-icons">subject</i> Read Article
                            </a>
                            <a href="#pablo" className="btn btn-white btn-link">
                                <i className="material-icons">watch_later</i> Watch Later
                            </a>
                        </div>
                    </div>
                    
                )}
            </OwlCarousel>
        );
    }
}

export default Vip1;