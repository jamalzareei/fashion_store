<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Seller;
use App\Models\Sosial;
use App\Models\Image;
use App\User;
use Carbon\Carbon;
use App\Services\UploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SellersController extends Controller
{
    //
    public function sellers(Request $request, $title = null)
    {
        # code...
        if (!$title) {
            $title = $request->title;
        }
        $sellers = Seller::with('user')
            // ->whereHas('user', function ($qUser) use ($title) {
            //     $qUser->orWhere('username', 'like', "%$title%")
            //         ->orWhere('phone', 'like', "%$title%")
            //         ->orWhere('lastname', 'like', "%$title%")
            //         ->orWhere('firstname', 'like', "%$title%");
            // })
            ->orWhere('name', 'like', "%$title%")
            ->orWhere('manager', 'like', "%$title%")
            ->orWhere('slug', 'like', "%$title%")
            ->orderBy('tell_verified_at')
            ->orderBy('active_verified_at')
            ->paginate(50);

        // return $sellers;

        return view('admin.pages-admin.list-sellers', [
            'sellers' => $sellers,
            'title' => 'لیست فروشندگان',
        ]);
    }

    public function sellerUpdate(Request $request, $id)
    {
        # code...
        $user = Seller::where('id', $id)->first();

        $active = ($request->active) ? 1 : 0;

        if ($active) {
            $user->active_verified_at = Carbon::now()->toDateTimeString();
        } else {
            $user->active_verified_at = null;
        }

        $user->save();

        if (request()->ajax) {
            return [
                'title' => '',
                'message' => 'با موفقیت اپدیت گردید.',
                'status' => 'success',
                'data' => '',
            ];
        } else {
            return redirect()->route('panel.adminer.users')->with('noty', [
                'title' => '',
                'message' => 'با موفقیت اپدیت گردید.',
                'status' => 'success',
                'data' => '',
            ]);
        }
    }

    public function sellerUpdateTell(Request $request, $id)
    {
        # code...
        $user = Seller::where('id', $id)->first();

        $active = ($request->active) ? 1 : 0;

        if ($active) {
            $user->tell_verified_at = Carbon::now()->toDateTimeString();
        } else {
            $user->tell_verified_at = null;
        }

        $user->save();

        if (request()->ajax) {
            return [
                'title' => '',
                'message' => 'با موفقیت اپدیت گردید.',
                'status' => 'success',
                'data' => '',
            ];
        } else {
            return redirect()->route('panel.adminer.users')->with('noty', [
                'title' => '',
                'message' => 'با موفقیت اپدیت گردید.',
                'status' => 'success',
                'data' => '',
            ]);
        }
    }

    public function addSeller(Request $request)
    {
        # code...
        return view('admin.pages-admin.add-seller', [
            // 'categories' => $categories,
            // 'code' => auth()->user()->id . '-' . $code,
            'title' => 'اضافه کردن فروشنده',
        ]);
    }

    public function addSellerPost(Request $request)
    {
        # code...
        // return $request->all();
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:sellers,slug',
            'manager' => 'required',
            'username' => 'required|exists:users,username',
            'meta_keywords' => 'required',
            'meta_description' => 'required',
            // 'imageUrl' => 'required',
        ]);

        if ($request->imageUrl != 'undefined') {
            $request->validate([
                'imageUrl' => 'sometimes|image|max:300|mimes:jpeg,jpg,png',
            ]);
        }

        $user = User::where('username', $request->username)->first();

        $seller = Seller::create([
            'name' => $request->name, 
            'slug' => $request->slug, 
            'user_id' => $user->id, 
            'manager' => $request->manager, 
            'meta_keywords' => $request->meta_keywords, 
            'meta_description' => $request->meta_description, 
            'phones' => '', 
            'country_id' => '0', 
            'state_id' => '0', 
            'city_id' => '0', 
            'address' => '', 
            'about' => '', 
            'shipping_cost' => '0', 
            'time_transfor' => '0',
        ]);


        if ($request->imageUrl != 'undefined') {
            $date = date('Y-m-d');
            $path = "uploads/sellers/$seller->id/$date";
            $photos = [$request->imageUrl];
            $photos = UploadService::saveFile($path, $photos);
            $image = Image::where('imageable_id', $seller->id)
                ->where('imageable_type', 'App\Models\Seller')
                // ->where('type', 'MAIN')
                ->where('default_use', 'MAIN')
                ->first();
            if($image){
                UploadService::destroyFile($image->path);
                $image = Image::where('imageable_id', $seller->id)
                ->where('imageable_type', 'App\Models\Seller')
                // ->where('type', 'MAIN')
                ->where('default_use', 'MAIN')
                ->delete();
            }
            $image = Image::updateOrCreate(
                [
                    'imageable_id' => $seller->id,
                    'type' => 'MAIN', 
                    // 'default_use' => 'MAIN',
                    'imageable_type' => 'App\Models\Seller', 
                ],
                [
                    'path' => $photos, 
                    'imageable_id' => $seller->id, 
                    'active' => '1', 
                ]
            );
        }
        
        return [
            'title' => '',
            'message' => 'با موفقیت ویرایش گردید.',
            'status' => 'success',
            'data' => '',
            'redirectEdit' => route('panel.admin.seller.edit', ['slug' => $seller->slug]),
            'redirectList' => route('panel.admin.sellers'),
            // 'redirectAuto' => $redirectAuto,
        ];
    }

    public function editSeller(Request $request, $slug)
    {
        # code...
        $seller = Seller::where('slug', $slug)
            ->with('image')
            ->with('sosialSeller')
            ->with('user')
            ->with('country')
            ->with('city')
            ->with('state')
            ->first();

        // return $seller->sosialSeller->where('sosial_id', 1)->first();
        $sosials = Sosial::all();
        return view('admin.pages-admin.edit-seller', [
            'seller' => $seller,
            'sosials' => $sosials,
            'countries' => $this->changeLocation($request, 'country'),
            'title' => 'ویرایش فروشنده | '. $seller->name,
        ]);
    }

    public function changeLocation( Request $request, $type)
    {
        $dataList = [];
        $data = '';
        if($type == 'country'){
            $dataList = DB::table('countries')->get();
            $data = '<option > -- انتخاب کشور --</option>';
            foreach ($dataList as $list){
                $data .= '<option value="'. $list->id .'">'. $list->phonecode .' | '. $list->name .' ('. $list->code .')</option>';
            }
            return $data;
        }
        if($type == 'state'){
            $dataList = DB::table('states')->where('country_id', $request->id)->get();
            $data = '<option > -- انتخاب استان --</option>';
        }
        if($type == 'city'){
            $dataList = DB::table('cities')->where('state_id', $request->id)->get();
            $data = '<option > -- انتخاب شهر --</option>';
        }

        foreach ($dataList as $list){
            $data .= '<option value="'.$list->id.'">'.$list->name.'</option>';
        }
        
        return $data;
    }

    public function editSellerStep1(Request $request)
    {
        # code...
        $request->validate([
            'id' => 'required|exists:sellers,id',
            'name' => 'required',
            'name' => 'required',
            'manager' => 'required',
            'username' => 'required|exists:users,username',
            // 'meta_keywords' => 'required',
            // 'meta_description' => 'required',
            // 'imageUrl' => 'required',
        ]);

        if ($request->imageUrl != 'undefined') {
            $request->validate([
                'imageUrl' => 'sometimes|image|max:300|mimes:jpeg,jpg,png',
            ]);
        }

        $slugCheck = Seller::where('id', '!=', $request->id)->where('slug', $request->slug)->first();
        if($slugCheck){
            return response()->json([
                'status' => 'error',
                'errors' => ['slug' => 'این نام اختصاصی قبلا استفاده شده است.'],
            ], 422);
        }

        $user = User::where('username', $request->username)->first();

        $seller = Seller::where('id', $request->id)->update([
            'name' => $request->name, 
            'slug' => $request->slug, 
            // 'user_id' => $user->id, 
            'manager' => $request->manager, 
        ]);


        if ($request->imageUrl != 'undefined') {
            $date = date('Y-m-d');
            $path = "uploads/sellers/$request->id/$date";
            $photos = [$request->imageUrl];
            $photos = UploadService::saveFile($path, $photos);
            $image = Image::where('imageable_id', $request->id)
                ->where('imageable_type', 'App\Models\Seller')
                // ->where('type', 'MAIN')
                ->where('default_use', 'MAIN')
                ->first();
            if($image){
                UploadService::destroyFile($image->path);
                $image = Image::where('imageable_id', $request->id)
                ->where('imageable_type', 'App\Models\Seller')
                // ->where('type', 'MAIN')
                ->where('default_use', 'MAIN')
                ->delete();
            }
            $image = Image::updateOrCreate(
                [
                    'imageable_id' => $request->id,
                    'type' => 'MAIN', 
                    // 'default_use' => 'MAIN',
                    'imageable_type' => 'App\Models\Seller', 
                ],
                [
                    'path' => $photos, 
                    'imageable_id' => $request->id, 
                    'active' => '1', 
                ]
            );
        }
        
        return [
            'title' => '',
            'message' => 'با موفقیت ویرایش گردید.',
            'status' => 'success',
            'data' => '',
            'redirectEdit' => '',//route('panel.admin.seller.edit', ['slug' => $seller->slug]),
            'redirectList' => '',//route('panel.admin.sellers'),
            // 'redirectAuto' => $redirectAuto,
        ];
    }

    public function editSellerStep3(Request $request)
    {
        # code...
        // return $request->all();
        $request->validate([
            'id' => 'required|exists:sellers,id',
            'phones' => 'required',
            'country_id' => 'required|exists:countries,id',
            'state_id' => 'required|exists:states,id',
            'city_id' => 'required|exists:cities,id',
            'address' => 'required',
        ]);

        $seller = Seller::where('id', $request->id)->update([
            'phones' => $request->phones, 
            'country_id' => $request->country_id, 
            'state_id' => $request->state_id, 
            'city_id' => $request->city_id, 
            'address' => $request->address, 
        ]);
        
        return [
            'title' => '',
            'message' => 'با موفقیت ویرایش گردید.',
            'status' => 'success',
            'data' => '',
            'redirectEdit' => '',//route('panel.admin.seller.edit', ['slug' => $seller->slug]),
            'redirectList' => '',//route('panel.admin.sellers'),
            // 'redirectAuto' => $redirectAuto,
        ];
    }

    public function editSellerStep4(Request $request)
    {
        # code...
        // return $request->all();
        $request->validate([
            'id' => 'required|exists:sellers,id',
        ]);

        foreach ($request->sosials as $key => $sosial) {
            # code...
            // echo $key.'<br>';
            $sellerSosial = DB::table('seller_sosial')->where('sosial_id', $key)->where('seller_id', $request->id)->first();
            if($sellerSosial){
                DB::table('seller_sosial')->where('sosial_id', $key)->where('seller_id', $request->id)->update([
                    'link' => $sosial
                ]);
            }else{
                DB::table('seller_sosial')->insert([
                    'sosial_id'=> $key,
                    'seller_id'=> $request->id,
                    'link' => $sosial,
                ]);
            }
        }
        return [
            'title' => '',
            'message' => 'با موفقیت ویرایش گردید.',
            'status' => 'success',
            'data' => '',
            'redirectEdit' => '',//route('panel.admin.seller.edit', ['slug' => $seller->slug]),
            'redirectList' => '',//route('panel.admin.sellers'),
            // 'redirectAuto' => $redirectAuto,
        ];
    }

    public function editSellerStep5(Request $request)
    {
        # code...
        $request->validate([
            'id' => 'required|exists:sellers,id',
            'about' => 'required',
            'meta_keywords' => 'required',
            'meta_description' => 'required',
        ]);

        $seller = Seller::where('id', $request->id)->update([
            'about' => $request->about, 
            'meta_keywords' => $request->meta_keywords, 
            'meta_description' => $request->meta_description,
        ]);
        
        return [
            'title' => '',
            'message' => 'با موفقیت ویرایش گردید.',
            'status' => 'success',
            'data' => '',
            'redirectEdit' => '',//route('panel.admin.seller.edit', ['slug' => $seller->slug]),
            'redirectList' => '',//route('panel.admin.sellers'),
            // 'redirectAuto' => $redirectAuto,
        ];
    }

    
    public function editSellerStep6(Request $request)
    {
        # code...
        return $request->all();
        $request->validate([
            'id' => 'required|exists:sellers,id',
            // ajax: "ajax"
            // time_transfor: "1"
            // sell_in_person: "حضوری"
            // sell_online: "انلاین و ارسال پستی"
            // shipping_cost: "10100"
            // pay_in_person: "1"
            // pay_cart: "1"
            // pay_online: "1"
        ]);

        $seller = Seller::where('id', $request->id)->update([
            'time_transfor' => $request->time_transfor, 
            'shipping_cost' => $request->shipping_cost, 
            'sell_online' => ($request->sell_online) ? '1' : '0',
            'sell_in_person' => ($request->sell_in_person) ? '1' : '0',
            'pay_in_person' => ($request->pay_in_person) ? '1' : '0',
            'pay_cart' => ($request->pay_cart) ? '1' : '0',
            'pay_online' => ($request->pay_online) ? '1' : '0',
        ]);
        
        return [
            'title' => '',
            'message' => 'با موفقیت ویرایش گردید.',
            'status' => 'success',
            'data' => '',
            'redirectEdit' => '',//route('panel.admin.seller.edit', ['slug' => $seller->slug]),
            'redirectList' => '',//route('panel.admin.sellers'),
            // 'redirectAuto' => $redirectAuto,
        ];
    }
}
