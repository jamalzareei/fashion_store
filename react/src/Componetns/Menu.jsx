import React, { Component } from 'react';
import { Link, withRouter } from 'react-router-dom';
import { AuthConsumer } from '../Contexts/AuthContext';

class Menu extends Component {
    state = {
        sidebar: false,
        login: localStorage.getItem('login'),
        seller: localStorage.getItem('seller'),
    }

    render() {
        let patname = window.location.pathname;
        return (
            <AuthConsumer>
                {({ token, setToken }) => (
                    <nav className="navbar navbar-expand-lg navbar-color-on-scroll fixed-top navbar-transparent" color-on-scroll="100" id="sectionsNav">

                        <div class="container-fluid">
                            <div className="navbar-wrapper">
                                <button className="navbar-toggler " type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false"
                                    aria-label="Toggle navigation">
                                    <span className="sr-only">Toggle navigation</span>
                                    <span className="navbar-toggler-icon icon-bar"></span>
                                    <span className="navbar-toggler-icon icon-bar"></span>
                                    <span className="navbar-toggler-icon icon-bar"></span>
                                </button>
                                <Link className="dropdown-item" to="/">
                                    <i className="fas fa-home"></i>
                                </Link>
                            </div>
                            {token ?
                            
                            <ul class="nav nav-pills nav-pills-rose user-login">
                                <li className="nav-item">
                                    <a className="nav-link" to="#pablo">
                                        افزودن فروشگاه
                                        </a>
                                </li>
                                <li className="nav-item dropdown">
                                    <a className="nav-link" to="/tickets" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i className="material-icons">notifications</i>
                                        <span className="notification">۵</span>
                                    </a>
                                    <div className="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                        <a className="dropdown-item" to="#">محمدرضا به ایمیل شما پاسخ داد</a>
                                        <a className="dropdown-item" to="#">شما ۵ وظیفه جدید دارید</a>
                                        <a className="dropdown-item" to="#">از حالا شما با علیرضا دوست هستید</a>
                                        <a className="dropdown-item" to="#">اعلان دیگر</a>
                                        <a className="dropdown-item" to="#">اعلان دیگر</a>
                                    </div>
                                </li>
                                <li className="nav-item dropdown">
                                    <Link className="nav-link" to="/panel" id="userAccount" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i className="material-icons">person</i>
                                        {/* <span className="notification">۵</span> */}
                                    </Link>
                                    <div className="dropdown-menu dropdown-menu-right" aria-labelledby="userAccount">
                                        <Link className="dropdown-item" to="/panel/dashboard">پروفایل کاربری</Link>
                                        <Link className="dropdown-item" to="/panel/profile">اطلاعات حساب</Link>
                                        <Link className="dropdown-item" to="#">سفارشات</Link>
                                        <Link to="" className="nav-link" onClick={() => setToken(null)}>
                                            <i className="material-icons">exit</i> خروج
                                        </Link>

                                    </div>
                                </li>

                                <li className="nav-item dropdown">
                                    <Link className="nav-link" to="http://example.com" id="cart" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i className="material-icons">shop</i>
                                        <span className="notification">۵</span>
                                    </Link>
                                    <div className="dropdown-menu dropdown-menu-right" aria-labelledby="cart">
                                        <Link className="dropdown-item" to="#">....</Link>
                                    </div>
                                </li>
                            </ul>

                            :
                            <ul class="nav nav-pills nav-pills-rose">
                            <li class="nav-item">
                                <Link className="nav-link" to="/login">
                                    <i className="material-icons">cloud_download</i> 
                                    <span className="d-none d-sm-none d-md-block">ورود</span>
                                </Link>
                            </li>
                            <li className="nav-item">
                                <Link className="nav-link" to="/register">
                                    <i className="material-icons">cloud_download</i> 
                                    <span className="d-none d-sm-none d-md-block">ثبت نام</span>
                                </Link>
                            </li>
                            <li className="nav-item dropdown">
                                <Link className="nav-link" to="http://example.com" id="cart" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i className="material-icons">shop</i>
                                    <span className="notification">۵</span>
                                </Link>
                                <div className="dropdown-menu dropdown-menu-right" aria-labelledby="cart">
                                    <Link className="dropdown-item" to="#">....</Link>
                                </div>
                            </li>
                        </ul>
                            }   
                        </div>
                    </nav>
                )}
            </AuthConsumer>
        )
    }
}

export default withRouter(Menu);