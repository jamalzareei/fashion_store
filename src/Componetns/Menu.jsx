import React, { Component } from 'react';
import { Link, withRouter } from 'react-router-dom';

class Menu extends Component {
    state = {
        sidebar: false,
        login: localStorage.getItem('login'),
        seller: localStorage.getItem('seller'),
    }

    render() {
        return (
            <nav className="navbar navbar-color-on-scroll fixed-top navbar-expand-lg navbar-transparent" color-on-scroll="100" id="sectionsNav">
                <div className="container">
                    <div className="navbar-translate">
                        <Link className="navbar-brand" data-toggle="dropdown" to="/">
                            فشیون <div className="ripple-container"></div></Link>
                        <button className="navbar-toggler" type="button" data-toggle="collapse" aria-expanded="false" aria-label="Toggle navigation">
                            <span className="sr-only">Toggle navigation</span>
                            <span className="navbar-toggler-icon"></span>
                            <span className="navbar-toggler-icon"></span>
                            <span className="navbar-toggler-icon"></span>
                        </button>
                    </div>
                    <div className="collapse navbar-collapse">
                        <ul className="navbar-nav mr-auto">
                            <li className="dropdown nav-item">
                                <Link to="#"  className="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="true">
                                    <i className="material-icons">apps</i> Components
                                </Link>
                                <div className="dropdown-menu dropdown-with-icons">
                                    <Link className="dropdown-item" to="/">
                                        <i className="material-icons">layers</i> All Components
                                    </Link>
                                    <Link className="dropdown-item" to="/">
                                        <i className="material-icons">content_paste</i> Documentation
                                    </Link>
                                </div>
                            </li>
                            <li className="nav-item">
                                <Link className="nav-link" to="/">
                                    <i className="material-icons">cloud_download</i> خانه
                                </Link>
                            </li>
                            
                            <li className="nav-item">
                                <Link className="nav-link" to="/register">
                                    <i className="material-icons">cloud_download</i> ثبت نام
                                </Link>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            // <nav className="navbar navbar-expand-lg  navbar-transparent navbar-color-on-scroll fixed-top rtl" color-on-scroll="30" id="sectionsNav">
            //     <div className="container">
            //         <div className="navbar-translate">
            //             <button className="navbar-toggler" type="button" data-toggle="drawer" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            //                 <span className="sr-only">Toggle drawer</span>
            //                 <span className="navbar-toggler-icon"></span>
            //                 <span className="navbar-toggler-icon"></span>
            //                 <span className="navbar-toggler-icon"></span>
            //             </button>
            //         </div>
            //         <div className="collapse navbar-collapse show" id="navbarText">

            //             <ul className="navbar-nav mr-auto">

            //                 <Link className="nav-link text-right" to="/">
            //                     <h3>FASHION</h3>
            //                     <span className="sr-only">
            //                         (current)
            //                     </span>
            //                 </Link>




            //                 <Link className="nav-link text-right" to="/register"><strong>ثبت نام</strong></Link>



            //             </ul>
            //             <ul className="navbar-nav ml-auto">
            //                 <Link className="nav-link text-right" to="/">
            //                     <h3>FASHION</h3>
            //                     <span className="sr-only">
            //                         (current)
            //                     </span>
            //                 </Link>
            //                 <Link className="nav-link text-right" to="/products"><strong>محصولات</strong></Link>

            //             </ul>
            //         </div>
            //     </div>
            // </nav>
        )
    }
}

export default withRouter(Menu);