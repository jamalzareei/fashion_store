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
        return (
            <AuthConsumer>
                {({ token, setToken }) => (
                    <nav className="navbar navbar-color-on-scroll fixed-top navbar-expand-lg navbar-transparent" color-on-scroll="100" id="sectionsNav">
                        <div className="container">
                            <div className="collapse navbar-collapse show">
                                {token ?
                                    <ul className="navbar-nav mr-auto">
                                        <li className="dropdown nav-item">
                                            <Link to="#" className="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="true">
                                                <i className="material-icons">apps</i> پنل کاربری
                                            </Link>
                                            <div className="dropdown-menu dropdown-with-icons">
                                                <Link className="dropdown-item" to="/panel/dashboard">
                                                    <i className="material-icons">layers</i> داشبورد
                                                </Link>
                                                <Link className="dropdown-item" to="/panel/dashboard">
                                                    <i className="material-icons">content_paste</i> اطلاعات کاربری
                                                </Link>
                                            </div>
                                        </li>
                                    
                                        <li className="nav-item">
                                            <Link to="" className="nav-link" onClick={() => setToken(null)}>
                                                <i className="material-icons">cloud_download</i> خروج
                                            </Link>
                                        </li>

                                    </ul>
                                :
                                    <ul className="navbar-nav mr-auto">
                                                                        
                                        <li className="nav-item">
                                            <Link className="nav-link" to="/register">
                                                <i className="material-icons">cloud_download</i> ثبت نام
                                            </Link>
                                        </li>
                                        <li className="nav-item">
                                            <Link className="nav-link" to="/login">
                                                <i className="material-icons">cloud_download</i> ورود
                                            </Link>
                                        </li>
                                    </ul>
                                }
                                
                            </div>
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
                        </div>
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
                            {/* <div className="collapse navbar-collapse justify-content-end"> */}
                                <form className="navbar-form">
                                    <div className="input-group no-border">
                                        <input type="text" className="form-control" placeholder="جستجو..." />
                                        <button type="submit" className="btn btn-white btn-round btn-just-icon">
                                            <i className="material-icons">search</i>
                                            <div className="ripple-container"></div>
                                        </button>
                                    </div>
                                </form>
                                <ul className="navbar-nav">
                                    <li className="nav-item">
                                        <a className="nav-link" href="#pablo">
                                            <i className="material-icons">dashboard</i>
                                            <p className="d-lg-none d-md-block">
                                                آمارها
                                            </p>
                                        </a>
                                    </li>
                                    <li className="nav-item dropdown">
                                        <a className="nav-link" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i className="material-icons">notifications</i>
                                            <span className="notification">۵</span>
                                            <p className="d-lg-none d-md-block">
                                                اعلان‌ها
                                            </p>
                                        </a>
                                        <div className="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                            <a className="dropdown-item" href="#">محمدرضا به ایمیل شما پاسخ داد</a>
                                            <a className="dropdown-item" href="#">شما ۵ وظیفه جدید دارید</a>
                                            <a className="dropdown-item" href="#">از حالا شما با علیرضا دوست هستید</a>
                                            <a className="dropdown-item" href="#">اعلان دیگر</a>
                                            <a className="dropdown-item" href="#">اعلان دیگر</a>
                                        </div>
                                    </li>
                                    <li className="nav-item">
                                        <a className="nav-link" href="#pablo">
                                            <i className="material-icons">person</i>
                                            <p className="d-lg-none d-md-block">
                                                حساب کاربری
                                            </p>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </nav>

                )}
            </AuthConsumer>
        )
    }
}

export default withRouter(Menu);