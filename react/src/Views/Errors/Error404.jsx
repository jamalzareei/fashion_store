import React, { Component } from 'react';

class Error404 extends Component {
    componentDidMount() {
        window.scroll(0, 0);
    }
    render() {
        return (
                <div className="transition-item detail-page" style={{ marginTop: '100px' }}>
                    {/* <Header />
                    <LoadBefore /> */}
                    <h1>not Found</h1>
                </div>
        );
    }
}

export default Error404;