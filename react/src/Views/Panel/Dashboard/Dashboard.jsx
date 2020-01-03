import React, { Component } from 'react'

import "../../../Assets/dashboard/css/material-dashboard.css?v=2.1.0"; 
import "../../../Assets/dashboard/css/material-dashboard-rtl.css?v=1.1";

import MenuPanel from '../../../Componetns/MenuPanel';
import FooterPanel from '../../../Componetns/FooterPanel';
import SidebarPanel from '../../../Componetns/SidebarPanel';

export default class Dashboard extends Component {
    render() {
        return (
            <div className="wrapper ">
                <SidebarPanel />
                <div className="main-panel">
                    <MenuPanel />
                    <div className="content">
                        <div className="container-fluid">
                            
                        </div>
                        <FooterPanel />
                    </div>
                </div>
            </div>
        )
    }
}
