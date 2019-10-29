import React, { Component } from 'react';
import Photomain from './Sections/Photomain';
import Footer from '../../Componetns/Footer';
import Info from './Sections/Info';
import Vip1 from './Sections/Vip1';

import ProductsNew from './Sections/ProductsNew';
import Vip from './Sections/Vip';
import SellerSpesial from './Sections/SellerSpesial';
import ProductSell from './Sections/ProductSell';
import Application from './Sections/Application';
import SellerWin from './Sections/SellerWin';
import Vip2 from './Sections/Vip2';


class Main extends Component {
    componentDidMount() {
        window.scroll(0, 0);
    }

    render() {
        return (
                <div className="transition-item detail-page">
                    <Photomain />
                    <div className="main main-raised ">
                        <hr className="my-1" />
                        <Info />
                        <hr className="my-1" />
                        <Vip1 />
                        
                        <hr className="my-5" />
                        <h1 className="title">فروشندگان ویژه</h1>
                        <SellerSpesial />
                        <hr className="my-5" />
                        <h1 className="title">VIP</h1>
                        <Vip />
                        <hr className="my-5" />
                        <h1 className="title">محصولات جدید</h1>
                        <ProductsNew />
                        <hr className="my-5" />
                        <h1 className="title">VIP 1</h1>
                        <Vip1 />
                        <hr className="my-5" />
                        <Application />
                        <hr className="my-5" />
                        <h1 className="title">فروشنگان برتر این ماه</h1>
                        <SellerWin />
                        <hr className="my-5" />
                        <h1 className="title">پرفروش ترین محصولات</h1>
                        <ProductSell />
                        <hr className="my-5" />
                        <h1 className="title">VIP 2</h1>
                        <Vip2 />
                        <hr className="my-5" />

                    </div>
                    <Footer />
                </div >
            
        );
    }
}

export default Main;