<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\Role;
use Carbon\Carbon;

class UsersController extends Controller
{

    public function roles(Request $request)
    {
        # code...
        /*
        a:3:{i:0;a:2:{s:8:"usertype";s:1:"A";s:10:"membership";s:17:"Fulfillment staff";}i:1;a:2:{s:8:"usertype";s:1:"C";s:10:"membership";s:17:"مدیر سایت";}i:2;a:2:{s:8:"usertype";s:1:"P";s:10:"membership";s:23:"مدیر فروشگاه";}}

        */
        $data = Role::withCount('users')->get();

        // return $data;
        
        return view('admin.pages-admin.list-roles', [
            'data' => $data,
            'title' => 'سطح دسترسی',
        ]);
    }

    public function roleDelete(Request $request, $id)
    {
        $role = Role::where('id', $id)->delete();

        // return $user;
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

    public function roleAdd(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'code' => 'required|min:1|max:1',
            'slug' => 'required|string|unique:roles,slug',
            'description' => 'required|string',
        ]);

        $role = Role::create([
            'name' => $request->name,
            'code' => $request->code,
            'slug' => $request->slug,
            'description' => $request->description,
        ]);

        return back()->with('noty', [
            'title' => '',
            'message' => 'با موفقیت اضافه گردید.',
            'status' => 'success',
            'data' => '',
        ]);    
    }
    //
    public function users(Request $request,$role = null)
    {
        $title = ($request->title) ? $request->title : null;

        $users = User::whereNotNull('id')
            // ->select('login')
            ->when($role, function($qRole) use ($role){
                $qRole->where('role', $role);
            })
            ->when($title, function($query) use($title){ 
                $query->where(function($query_) use($title){
                    $query_->orWhere('username', 'like', "%$title%")
                    ->orWhere('phone', 'like', "%$title%")
                    ->orWhere('email', 'like', "%$title%")
                    ->orWhere('firstname', 'like', "%$title%")
                    ->orWhere('lastname', 'like', "%$title%"); 
                });
            })
            ->with('roles')
            // ->toSql();
            ->paginate(50);

            // return $users;


        return view('admin.pages-admin.list-users', [
            'users'         => $users,
            'title'         => 'لیست کاربران',
        ]);
    }

    public function usersUpdate(Request $request)
    {
        // return $request->all();

        foreach ($request->data as $key => $value) {
            # code...
            $active = isset($value['active']) ? 1 : 0;
            // echo $key;
            if(isset($value['check'])){
                // echo $value['usertype'].'<br>';
                // echo $value['role_id'].'<br>';
                // echo $active.'<br>';
                // return $key;
                User::where('login', $key)->update([
                    'usertype' => $value['usertype'],
                    'role' => $value['role_id'],
                    'active' => $active,
                ]);
            }
        }
        return redirect()->route('panel.adminer.users')->with('noty', [
            'title' => '',
            'message' => 'با موفقیت ویرایش گردید.',
            'status' => 'info',
            'data' => '',
        ]);
    }

    public function userUpdate(Request $request, $id)
    {
        # code...
        $user = User::where('id', $id)->first();

        $active = ($request->active) ? 1 : 0;
        // return $request->active;

        if($active){
            $user->email_verified_at =  Carbon::now()->toDateTimeString();
            $user->phone_verified_at =  Carbon::now()->toDateTimeString();
        }else{
            $user->email_verified_at =  null;
            $user->phone_verified_at =  null;
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
    
    public function userDelete(Request $request, $id)
    {
        $user = User::where('id', $id)->delete();

        // return $user;
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
}
