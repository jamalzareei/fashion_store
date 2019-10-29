import React, { Component } from 'react';

class Error404 extends Component {
    componentDidMount() {
        window.scroll(0, 0);
    }
    render() {
        //C:\laragon\www\react\src\Assets\img\404.png
        const imageUrl = require(`./../../Assets/img/404.png`);
        return (
                <div className="transition-item detail-page" style={{ margin: '100px auto',textAlign: 'center' }}>
                    {/* <Header />
                    <LoadBefore /> */}
                    <img src={imageUrl} style={{ 'maxHeight': '500px','maxWidth': '100%' }} alt="error page" />
                </div>
        );
    }
}

export default Error404;