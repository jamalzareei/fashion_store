<?php

namespace App\Http\Controllers\PanelAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DiscountCoupon;
use App\Models\Category;
use App\Models\Product;

class DiscountController extends Controller
{
    //
    public function discounts(Request $request)
    {
        $coupon = ($request->coupon) ? $request->coupon : null;
        $discounts = DiscountCoupon::orderby('expire')->when($coupon, function($query) use($coupon){ $query->where('coupon', $coupon); })->with(['product','category'])->get();

        // return $discounts;
        $categories = Category::where('avail', 'Y')->where('is_menu', 'Y')->get();

        
        return view('admin.pages-admin.list-discounts', [
            'discounts'    => $discounts,
            'categories'    => $categories,
            'title'        => 'کد های تخفیف',
        ]);
    }

    public function discountAdd(Request $request)
    {
        // return $request->all();
        $request->validate([
            'coupon'        => 'required|unique:kimiagar_discount_coupons,coupon',
            'expire'        => 'required',
            'times'         => 'required',
            'discount'      => 'required',
            'categoryid'    => 'nullable|exists:kimiagar_categories,categoryid',
            'productcode'   => 'nullable|exists:kimiagar_products,productcode',
            // 'status'        => 'required',
        ]);

        $date = explode('/', $request->expire);
        $day = $this->faTOen($date["2"]);
        $mounth = $this->faTOen($date["1"]);
        $year = $this->faTOen($date["0"]);
        // return $day;
        $dateEnglish = \Verta::getGregorian($year,$mounth,$day);

        $timestamp = strtotime("$dateEnglish[2]-$dateEnglish[1]-$dateEnglish[0]");
        // return $timestamp;


        $status = isset($request->status) ? 'Y' : 'N';
        // return $status;

        $product = Product::where('productcode', $request->productcode)->first();


        DiscountCoupon::create([
            'coupon' => $request->coupon, 
            'discount' => $request->discount, 
            'coupon_type' => $request->coupon_type, 
            'productid' => ($product) ? $product->productid : 0, 
            'categoryid' => ($request->categoryid) ? $request->categoryid : 0, 
            'minimum' => ($request->minimum) ? $request->minimum : 0, 
            'times' => ($request->times) ? $request->times : 0, 
            'times_used' => 0, 
            'expire' => $timestamp, 
            'status' => $status, 
            'provider' => auth()->user()->login, 
            'recursive' => 'Y'
        ]);

        return redirect()->back()->with('noty', [
            'title' => '',
            'message' => 'با موفقیت اضافه گردید.',
            'status' => 'success',
            'data' => '',
        ]);
    }

    public function discountsUpdate(Request $request)
    {
        // return $request->all();
        # code...
        foreach ($request->data as $key => $value) {
            # code...
            // echo $key;
            // if(isset($value['check'])){
                $status = isset($value['status']) ? 'Y' : 'N';
                $date = explode('/', $value['expire']);
                $day = $this->faTOen($date["2"]);
                $mounth = $this->faTOen($date["1"]);
                $year = $this->faTOen($date["0"]);
                // return $day;
                $dateEnglish = \Verta::getGregorian($year,$mounth,$day);

                $timestamp = strtotime("$dateEnglish[2]-$dateEnglish[1]-$dateEnglish[0]");

                DiscountCoupon::where('coupon', $key)->update([
                    'discount' => $value['discount'],  
                    'status' => $status, 
                    'coupon_type' => $value['coupon_type'], 
                    'expire' => $timestamp,
                    'times' => ($value['times']) ? $value['times'] : 0, 
                    'provider' => auth()->user()->login, 
                ]);
            // }
        }
        return redirect()->back()->with('noty', [
            'title' => '',
            'message' => 'با موفقیت ویرایش گردید.',
            'status' => 'success',
            'data' => '',
        ]);
    }

    public function discountDelete(Request $request, $couponCode)
    {
        # code...
        $coupon = DiscountCoupon::where('coupon', $couponCode)->first();

        // return $coupon;
        if(!$coupon){
            if (request()->ajax) {
                return [
                    'title' => '',
                    'message' => 'کد تخفیف  وجود ندارد',
                    'status' => 'error',
                    'data' => '',
                ];
            } else {
                return redirect()->route('panel.adminer.users')->with('noty', [
                    'title' => '',
                    'message' => 'کد تخفیف  وجود ندارد',
                    'status' => 'error',
                    'data' => '',
                ]);
            }
        }

        $coupon = DiscountCoupon::where('coupon', $couponCode)->delete();

        if (request()->ajax) {
            return [
                'title' => '',
                'message' => 'با موفقیت حذف گردید.',
                'status' => 'info',
                'data' => '',
            ];
        } else {
            return redirect()->route('panel.adminer.users')->with('noty', [
                'title' => '',
                'message' => 'با موفقیت حذف گردید.',
                'status' => 'info',
                'data' => '',
            ]);
        }
    }

    public function faTOen($string) {
        return strtr($string, array('۰'=>'0', '۱'=>'1', '۲'=>'2', '۳'=>'3', '۴'=>'4', '۵'=>'5', '۶'=>'6', '۷'=>'7', '۸'=>'8', '۹'=>'9', '٠'=>'0', '١'=>'1', '٢'=>'2', '٣'=>'3', '٤'=>'4', '٥'=>'5', '٦'=>'6', '٧'=>'7', '٨'=>'8', '٩'=>'9'));
    }
}
