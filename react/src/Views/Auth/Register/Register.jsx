import React, { Component } from 'react';
import FormRegister from './Sections/FormRegister';

// let style= "background-image: url('../assets/img/bg7.jpg'); background-size: cover; background-position: top center;";
export default class Register extends Component {

    // const imageUrl = require(`./../../Assets/img/login.jpg`);
    render() {
        let ImageUrl = require('../../../Assets/img/bg/9.jpg');
        return (
            <div className="login-page">
                {/* <Header /> */}

                <div className="page-header header-filter" style={{ backgroundImage: `url(${ImageUrl})`, backgroundSize: '14%', backgroundPosition: 'top center' }}>
                    <div className="container" >
                        <div className="row">
                            <div className="col-md-6 col-sm-8 ml-auto mr-auto">
                                <FormRegister />
                            </div>
                        </div>
                    </div>
                    <footer className="footer">
                        <div className="container">
                            <nav className="float-right">
                                <ul>
                                    <li>
                                        <a href="#creative">
                                            Creative Tim
                            </a>
                                    </li>
                                    <li>
                                        <a href="#creative">
                                            About Us
                            </a>
                                    </li>
                                    <li>
                                        <a href="#creative">
                                            Blog
                            </a>
                                    </li>
                                    <li>
                                        <a href="#creative">
                                            Licenses
                            </a>
                                    </li>
                                </ul>
                            </nav>
                            <div className="copyright float-left">
                                ©
                    <script>
                                    document.write(new Date().getFullYear())
                    </script>2018, made with <i className="fa fa-heart heart">
                                </i> by
                    <a href="https://www.creative-tim.com">Creative Tim</a>
                            </div>
                        </div>
                    </footer>
                </div>

            </div>
        )
    }
}
