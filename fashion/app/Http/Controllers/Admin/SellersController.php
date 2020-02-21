<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Seller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SellersController extends Controller
{
    //
    public function sellers(Request $request)
    {
        # code...
        $sellers = Seller::with('user')
            ->whereHas('user', function ($qUser) use ($request) {
                $qUser->orWhere('username', 'like', "%$request->title%")
                    ->orWhere('phone', 'like', "%$request->title%")
                    ->orWhere('lastname', 'like', "%$request->title%")
                    ->orWhere('firstname', 'like', "%$request->title%");
            })
            ->orWhere('name', 'like', "%$request->title%")
            ->orWhere('manager', 'like', "%$request->title%")
            ->orWhere('slug', 'like', "%$request->title%")
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
}
