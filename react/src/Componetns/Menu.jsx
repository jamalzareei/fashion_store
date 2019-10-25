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
                            <div className="collapse navbar-collapse show">
                                <ul className="navbar-nav mr-auto">
                                    <li className="dropdown nav-item">
                                        <Link to="#" className="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="true">
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
                                    {token ?
                                        <li className="nav-item">
                                            <a href="javascript:void(0)" className="nav-link" onClick={() => setToken(null)}>
                                                <i className="material-icons">cloud_download</i> logout
                                            </a>
                                        </li>
                                        :
                                        <span>
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
                                        </span>
                                    }

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