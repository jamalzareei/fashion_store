<?php

namespace App\Http\Controllers\PanelAdmin;

use App\Http\Controllers\Controller;
use App\Models\ExtraFieldValue;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Price;
use App\User;
use App\Models\Product;
use App\Services\kavenegarService;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    //
    public function ordersEG(Request $request)
    {
        $orders = Order::select('kimiagar_orders.orderid', 'kimiagar_orders.date', 'kimiagar_orders.login', 'kimiagar_orders.status', 'kimiagar_orders.subtotal', 'kimiagar_orders.tax')
            ->whereNotNull('kimiagar_orders.login')
            ->where(function ($queryWhere) {
                $queryWhere->orWhere('kimiagar_orders.status', 'E')->orWhere('kimiagar_orders.status', 'G');
            })
            ->with('user')
        // ->leftJoin('kimiagar_customers', 'kimiagar_customers.login', '=', 'kimiagar_orders.login')
        // ->whereNotNull('kimiagar_customers.login')
            ->whereHas('orderdetails')
            ->withCount('orderdetails')
            ->has('orderdetails', '>=', 1)
            ->latest('orderid')
            ->paginate(50);

        return view('admin.pages-admin.list-orders', [
            'orders' => $orders,
            'routeEdit' => 'panel.adminer.order.e.g.edit',
            'title' => 'لیست سفارشات در انتظار موجودی',
        ]);
    }

    public function orderEGEdit(Request $request, $orderid)
    {
        $order = Order::select('*') //select('kimiagar_orders.orderid','kimiagar_orders.date','kimiagar_orders.login','kimiagar_orders.subtotal','kimiagar_orders.tax','kimiagar_orders.s_address_id')
            ->where('orderid', $orderid)
            ->whereNotNull('kimiagar_orders.login')
            ->where(function ($queryWhere) {
                $queryWhere->orWhere('kimiagar_orders.status', 'E')->orWhere('kimiagar_orders.status', 'G');
            })
            ->with('user')
            ->with('address')
        // ->leftJoin('kimiagar_customers', 'kimiagar_customers.login', '=', 'kimiagar_orders.login')
        // ->whereNotNull('kimiagar_customers.login')
            ->whereHas('orderdetails')
            ->with(['orderdetails' => function ($queryDetails) {
                $queryDetails->select('kimiagar_order_details.*', 'kimiagar_products.product', 'kimiagar_products.slug')
                    ->leftJoin('kimiagar_products', 'kimiagar_products.productid', '=', 'kimiagar_order_details.productid');

            }])
            ->first();

        if (!$order) {
            return back()->with('noty', [
                'title' => '',
                'message' => 'سفارش وجود ندارد',
                'status' => 'error',
                'data' => '',
            ]);
        }

        // return $order;
        //edit-order-e-g.blade.php
        return view('admin.pages-admin.edit-order-e-g', [
            'order' => $order,
            'title' => "تایید سفارش $order->orderid",
        ]);
    }

    public function orderEGUpdate(Request $request, $orderid)
    {
        // return $request->all();

        foreach ($request->productcode as $key => $productcode) {
            # code...
            $product = Product::where('productcode', $productcode)
                ->with(['prices' => function ($query) {
                    $query->orderBy('priceid', 'desc')->first();
                }])
                ->first();

            if (!$product) {
                return [
                    'title' => '',
                    'message' => "محصولی با کد $productcode وجود ندارد",
                    'status' => 'error',
                    'data' => '',
                    'redirectEdit' => route('panel.adminer.order.e.g.edit', ['orderid' => $orderid]),
                    'redirectList' => route('panel.adminer.orders.e.g'),
                ];
            }

            $sizeQ = ExtraFieldValue::where([['fieldid', '9'], ['productid', $product->productid]])->first();


            if ($sizeQ) {
                $size = $sizeQ->value;
            }else{
                $size = 1;
            }

            $details_support = $request->details_support[$key];

            if ($product['productid'] && $product->prices[0]) {

                OrderDetail::where('itemid', $key)->update([
                    'productid' => $product->productid,
                    'price' => $product->prices[0]->price,
                    'priceid' => $product->prices[0]->priceid,
                    'size' => $size,
                    'productcode' => $product->productcode,
                    'details_support' => $details_support,
                ]);
            } else {
                return [
                    'title' => '',
                    'message' => "برای محصول با کد $product->productcode قیمت تعریف نشده است",
                    'status' => 'error',
                    'data' => '',
                    'redirectEdit' => route('panel.adminer.order.e.g.edit', ['orderid' => $orderid]),
                    'redirectList' => route('panel.adminer.orders.e.g'),
                ];
            }
            $date = time();
            Order::where('orderid', $orderid)->update([
                "status" => 'G',
                "date_delivery" => $request->date_delivery,
                "date" => $date,
            ]);

        }

        $this->updateOrder($orderid);

        $order = Order::where('orderid', $orderid)->first();

        $phoneQ = User::where('login', $order->login)->first();

        if($phoneQ){
            $phone = $phoneQ->phone;
            $message = "سرام پخش
            کد سفارش: $orderid
            برای تکمیل مراحل خرید خود همراه ما باشید.
            سفارش شما بعد از انجام تغییراتی در قیمت و یا تعداد کالا آماده پرداخت می باشد و تا 24 ساعت آینده از بخش حساب کاربری خود در سایت سفارش خود را پرداخت نمایید
            برای هماهنگی بیشتر می توانید با پشتیبانی آنلاین سرام پخش ارتباط بگیرید
            035-38276760.";
            // smsSend($phone, $message);
            // sms_send_admn($phone, $message);
            kavenegarService::send($phone, $message);
        }

        return [
            'title' => '',
            'message' => "با موفقیت ثبت گردید",
            'status' => 'success',
            'data' => '',
            'redirectEdit' => route('panel.adminer.order.e.g.edit', ['orderid' => $orderid]),
            'redirectList' => route('panel.adminer.orders.e.g'),
        ];
    }

    public function updateOrder($order_id)
    {
        // $orderDetails = func_query("SELECT od.amount,od.size,od.details_support, od.price, pri.discount, pri.productid FROM `kimiagar_order_details` as od LEFT JOIN `kimiagar_pricing` as pri on pri.priceid=od.priceid  WHERE orderid='$order_id'");

        $orderDetails = OrderDetail::where('orderid', $order_id)
            // ->select('kimiagar_order_details.amount', 'kimiagar_order_details.size', 'kimiagar_order_details.details_support', 'kimiagar_order_details.price', 'kimiagar_pricing.discount', 'kimiagar_pricing.productid')
            ->leftJoin('kimiagar_pricing', 'kimiagar_pricing.priceid', '=', 'kimiagar_order_details.priceid')->get();
        // var_dump($orderDetails );die();
        if ($orderDetails) {
            $total = 0;
            $subtotal = 0;
            // echo $value['details_support'].'<br>';
            foreach ($orderDetails as $key => $value) {
                if ($value['details_support'] != 'محصول موجود نیست') {
                    
                    $price = $value['price'];
                    $amount = ($value['amount']) ? $value['amount'] : 1;
                    $size = ($value['size']) ? str_replace('/','.',$value['size']) : 1;

// echo ($price).'<br>';
// echo ($amount).'<br>';
// echo ($size).'<br>';
                    $price_pro = $price * $amount * $size;
                    $total += $price_pro;
                    $subtotal += $price_pro;// * (100 - $value['discount']) / 100;

                    // echo $value['price'] .'*'. $value['amount'] .'*'. $value['size'].'<br>';
                }
            }
                    // return $subtotal;
            $tax = ($subtotal * 9) / 100;
            // var_dump($subtotal);die();
            Order::where('orderid', $order_id)->update([
                "total" => $total,
                "subtotal" => $subtotal,
                "tax" => $tax,
            ]);
            // var_dump($subtotal);die();
        }
    }

    public function orderDelete(Request $request, $orderid)
    {
        $order = Order::where('orderid', $orderid)->delete();
        $orderDetails = OrderDetail::where('orderid', $orderid)->delete();

        if (request()->ajax) {
            return [
                'title' => '',
                'message' => 'با موفقیت حذف گردید.',
                'status' => 'info',
                'data' => '',
            ];
        } else {
            return redirect()->route('list.product.supplier')->with('noty', [
                'title' => '',
                'message' => 'با موفقیت حذف گردید.',
                'status' => 'info',
                'data' => '',
            ]);
        }
    }

    public function orders(Request $request, $status = null)
    {
        $orders = Order::select('kimiagar_orders.orderid', 'kimiagar_orders.date', 'kimiagar_orders.login', 'kimiagar_orders.status', 'kimiagar_orders.subtotal', 'kimiagar_orders.tax')
            ->whereNotNull('kimiagar_orders.login')
            ->when($status, function($qStatus) use ($status){
                $qStatus->where('kimiagar_orders.status', $status);
            })
            ->when(!$status, function($qStatus){
                $qStatus->where(function ($queryWhere) {
                    $queryWhere
                    ->where('kimiagar_orders.status', '!=', 'A')
                    ->where('kimiagar_orders.status', '!=', 'E')
                    ->where('kimiagar_orders.status', '!=', 'H')
                    ->where('kimiagar_orders.status', '!=', 'G');
                });
            })
            
            ->with('user')
        // ->leftJoin('kimiagar_customers', 'kimiagar_customers.login', '=', 'kimiagar_orders.login')
        // ->whereNotNull('kimiagar_customers.login')
            ->whereHas('orderdetails')
            ->withCount('orderdetails')
            ->has('orderdetails', '>=', 1)
            ->latest('orderid')
            ->paginate(50);

            // return $orders;
        return view('admin.pages-admin.list-orders', [
            'orders' => $orders,
            'routeEdit' => 'panel.adminer.order.edit',
            'title' => 'سفارشات تایید نهایی شده',
        ]);
    }

    public function orderEdit(Request $request, $orderid)
    {
        $order = Order::select('*') //select('kimiagar_orders.orderid','kimiagar_orders.date','kimiagar_orders.login','kimiagar_orders.subtotal','kimiagar_orders.tax','kimiagar_orders.s_address_id')
            ->where('orderid', $orderid)
            ->whereNotNull('kimiagar_orders.login')
            ->where(function ($queryWhere) {
                $queryWhere
                ->where('kimiagar_orders.status', '!=', 'A')
                ->where('kimiagar_orders.status', '!=', 'E')
                ->where('kimiagar_orders.status', '!=', 'H')
                ->where('kimiagar_orders.status', '!=', 'G');
            })
            ->with('user')
            ->with('address')
        // ->leftJoin('kimiagar_customers', 'kimiagar_customers.login', '=', 'kimiagar_orders.login')
        // ->whereNotNull('kimiagar_customers.login')
            ->whereHas('orderdetails')
            ->with(['orderdetails' => function ($queryDetails) {
                $queryDetails->select('kimiagar_order_details.*', 'kimiagar_products.product', 'kimiagar_products.slug')
                    ->leftJoin('kimiagar_products', 'kimiagar_products.productid', '=', 'kimiagar_order_details.productid');

            }])
            ->first();

            // return $order;
        if (!$order) {
            return back()->with('noty', [
                'title' => '',
                'message' => 'سفارش وجود ندارد',
                'status' => 'error',
                'data' => '',
            ]);
        }

        // return $order;
        //edit-order-e-g.blade.php
        return view('admin.pages-admin.edit-order', [
            'order' => $order,
            'title' => "سفارش $order->orderid",
        ]);
    }

    public function orderUpdate(Request $request, $orderid)
    {
        # code...
        Order::where('orderid', $orderid)->update([
            "status" => $request->status
        ]);

        return [
            'title' => '',
            'message' => "با موفقیت ثبت گردید",
            'status' => 'success',
            'data' => '',
            'redirectEdit' => route('panel.adminer.order.edit', ['orderid' => $orderid]),
            'redirectList' => route('panel.adminer.orders'),
        ];
        if(request()->ajax){
        }else{
            return redirect()->route('panel.adminer.order.edit',['orderid', $orderid])->with('noty', [
                'title' => '',
                'message' => "با موفقیت ثبت گردید",
                'status' => 'success',
            ]);
        }

        
    }
}
