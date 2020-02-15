<?php

namespace App\Http\Controllers\PanelAdmin;

use App\Http\Controllers\Controller;
use App\User;
use App\Models\Product;
use App\Models\Order;
use App\Models\Merchant;
use App\Models\ProductReview;
use App\Models\DecorReview;
use App\Models\Manufactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //
    public function index()
    {

        $date = [];

        $data['usersCount'] = User::count();
        $data['productsCount'] = Product::count();
        $data['suppliersCount'] = Manufactory::count();
        $data['merchantsCount'] = Merchant::count();
        $data['reviewsPoductsCount'] = ProductReview::count();
        $data['reviesDecorsCount'] = DecorReview::count();
        $data['ordersEGCount'] = Order::orWhere('status', 'E')->orWhere('status', 'G')->count();
        $data['ordersQCount'] = Order::where('status', 'Q')->count();
        $data['ordersCount'] = Order::count();

        $data['ordersSubtotal'] = Order::orWhere(function($query){
            $query->orWhere('status', 'Q')->orWhere('status', 'R')->orWhere('status', 'S')->orWhere('status', 'T')->orWhere('status', 'U')
            ->orWhere('status', 'V')->orWhere('status', 'W')->orWhere('status', 'P')->orWhere('status', 'C');
        })->sum('subtotal');

        $data['usersConfirm'] = User::where('active', 0)->select('login')->paginate(7);
        $data['reviewsPoductsActive'] = ProductReview::orWhere('active', 0)->orWhereNull('active')->with(['product' => function($query){ $query->select('slug','productid'); }])->paginate(7);
        $data['reviesDecorsActive'] = DecorReview::where('active', 0)->orWhereNull('active')->with(['decor' => function($query){ $query->select('slug','id'); }])->paginate(7);
        $data['ordersEG'] = Order::orWhere('status', 'E')->latest('orderid')->orWhere('status', 'G')->paginate(7);
        $data['ordersQ'] = Order::where('status', 'Q')->latest('orderid')->paginate(7);

        // return $data;
        return view('admin.pages-admin.dashboard', [
            'data'  => $data,
            'title' => 'داشبورد',
        ]);
    }

    public function selectFactory(Type $var = null)
    {
        $factories = Manufactory::where('manufacturerid', '>', 0) //avail: "Y",
            ->select('manufacturer', 'manufacturerid', 'user_login')
        // ->leftJoin('kimiagar_customers', 'kimiagar_customers.login', '=', 'kimiagar_manufacturers.user_login')
            ->with(['user' => function ($query) {
                $query->select('login');
            }])
        // ->latest('manufacturerid')
            ->get();

        return view('admin.pages-admin.dashboard', [
            'data' => $data,
            'title' => 'داشبورد',
        ]);
    }

    public function loginFactory(Request $request)
    {
        $login = '00' . ltrim($request->factory, '00');
        $user = User::where('login', $login)->first();
        if (!$user) {
            return back()->with('noty', [
                'title' => 'انتخاب کارخانه',
                'message' => 'کارخانه به کاربری وصل نشده است',
                'status' => 'error',
                'data' => '',
            ]);
        }
        Auth::login($user);
        return redirect()->route('panel');
    }
}
