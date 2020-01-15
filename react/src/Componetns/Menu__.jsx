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
                    <nav className="navbar navbar-expand-lg navbar-transparent navbar-color-on-scroll fixed-top" color-on-scroll="100" id="sectionsNav">

                        <div className="container-fluid">

                            <div className="navbar-wrapper">
                                <Link className="dropdown-item" to="/">
                                    <i className="fas fa-home"></i> داشبورد
                                </Link>
                            </div>
                            <button className="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false"
                                aria-label="Toggle navigation">
                                <span className="sr-only">Toggle navigation</span>
                                <span className="navbar-toggler-icon icon-bar"></span>
                                <span className="navbar-toggler-icon icon-bar"></span>
                                <span className="navbar-toggler-icon icon-bar"></span>
                            </button>
                            <div className="collapse navbar-collapse  justify-content-end show">
                                
                                {token ?

                                    <ul className="navbar-nav">
                                        <li className="nav-item">
                                            <a className="nav-link" to="#pablo">
                                                افزودن فروشگاه
                                                </a>
                                        </li>
                                        <li className="nav-item dropdown">
                                            <a className="nav-link" to="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i className="material-icons">notifications</i>
                                                <span className="notification">۵</span>
                                                <p className="d-lg-none d-md-block">
                                                    اعلان‌ها
                                                    </p>
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
                                                <p className="d-lg-none d-md-block">
                                                    حساب کاربری
                                                    </p>
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
                                                <p className="d-lg-none d-md-block">
                                                    سبد خرید
                                                    </p>
                                            </Link>
                                            <div className="dropdown-menu dropdown-menu-right" aria-labelledby="cart">
                                                <Link className="dropdown-item" to="#">....</Link>
                                            </div>
                                        </li>
                                    </ul>

                                    :

                                    <ul className="navbar-nav">
                                        <li className="nav-item dropdown">
                                            <Link className="nav-link" to="/login">
                                                <i className="material-icons">cloud_download</i> ورود
                                            </Link>
                                        </li>
                                        <li className="nav-item">
                                            <Link className="nav-link" to="/register">
                                                <i className="material-icons">cloud_download</i> ثبت نام
                                            </Link>
                                        </li>
                                        <li className="nav-item dropdown">
                                            <Link className="nav-link" to="http://example.com" id="cart" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i className="material-icons">shop</i>
                                                <span className="notification">۵</span>
                                                <p className="d-lg-none d-md-block">
                                                    سبد خرید
                                                </p>
                                            </Link>
                                            <div className="dropdown-menu dropdown-menu-right" aria-labelledby="cart">
                                                <Link className="dropdown-item" to="#">....</Link>
                                            </div>
                                        </li>
                                    </ul>
                                }
                            </div>
                        </div>
                    </nav>

                )}
            </AuthConsumer>
        )
    }
}

export default withRouter(Menu);