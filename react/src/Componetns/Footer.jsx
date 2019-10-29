import React, { Component } from 'react';

class Footer extends Component {
    render() {
        return (
            <footer className="footer footer-white footer-big">
                <div className="container">
                    <div className="content">
                        <div className="row">
                            <div className="col-md-2">
                                <h5>About Us</h5>
                                <ul className="links-vertical">
                                    <li>
                                        <a href="#pablo">
                                            Blog
                                                </a>
                                    </li>
                                    <li>
                                        <a href="#pablo">
                                            About Us
                                                </a>
                                    </li>
                                    <li>
                                        <a href="#pablo">
                                            Presentation
                                                </a>
                                    </li>
                                    <li>
                                        <a href="#pablo">
                                            Contact Us
                                                </a>
                                    </li>
                                </ul>
                            </div>
                            <div className="col-md-2">
                                <h5>Market</h5>
                                <ul className="links-vertical">
                                    <li>
                                        <a href="#pablo">
                                            Sales FAQ
                                                </a>
                                    </li>
                                    <li>
                                        <a href="#pablo">
                                            How to Register
                                                </a>
                                    </li>
                                    <li>
                                        <a href="#pablo">
                                            Sell Goods
                                                </a>
                                    </li>
                                    <li>
                                        <a href="#pablo">
                                            Receive Payment
                                                </a>
                                    </li>
                                    <li>
                                        <a href="#pablo">
                                            Transactions Issues
                                                </a>
                                    </li>
                                    <li>
                                        <a href="#pablo">
                                            Affiliates Program
                                                </a>
                                    </li>
                                </ul>
                            </div>
                            <div className="col-md-4">
                                <h5>Social Feed</h5>
                                <div className="social-feed">
                                    <div className="feed-line">
                                        <i className="fa fa-twitter"></i>
                                        <p>How to handle ethical disagreements with your clients.</p>
                                    </div>
                                    <div className="feed-line">
                                        <i className="fa fa-twitter"></i>
                                        <p>The tangible benefits of designing at 1x pixel density.</p>
                                    </div>
                                    <div className="feed-line">
                                        <i className="fa fa-facebook-square"></i>
                                        <p>A collection of 25 stunning sites that you can use for inspiration.</p>
                                    </div>
                                </div>
                            </div>
                            <div className="col-md-4">
                                <h5>Follow Us</h5>
                                <ul className="social-buttons">
                                    <li>
                                        <a href="#pablo" className="btn btn-just-icon btn-link btn-twitter">
                                            <i className="fa fa-twitter"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#pablo" className="btn btn-just-icon btn-link btn-facebook">
                                            <i className="fa fa-facebook-square"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#pablo" className="btn btn-just-icon btn-link btn-dribbble">
                                            <i className="fa fa-dribbble"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#pablo" className="btn btn-just-icon btn-link btn-google">
                                            <i className="fa fa-google-plus"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#pablo" className="btn btn-just-icon btn-link btn-instagram">
                                            <i className="fa fa-instagram"></i>
                                        </a>
                                    </li>
                                </ul>
                                <h5>Numbers Don't Lie</h5>
                                <h4>14.521
                                            <small>Freelancers</small>
                                </h4>
                                <h4>1.423.183
                                            <small>Transactions</small>
                                </h4>
                            </div>
                        </div>
                    </div>
                    <hr />
                    <div className="copyright pull-center">
                        Copyright ©
                                <script>
                            document.write(new Date().getFullYear())
                                </script>2018 Creative Tim All Rights Reserved.
                            </div>
                </div>
            </footer>
        );
    }
}

export default Footer;