<?php

namespace App\Http\Controllers\PanelAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\Config;

class UsersController extends Controller
{

    public function roles(Request $request)
    {
        # code...
        /*
        a:3:{i:0;a:2:{s:8:"usertype";s:1:"A";s:10:"membership";s:17:"Fulfillment staff";}i:1;a:2:{s:8:"usertype";s:1:"C";s:10:"membership";s:17:"مدیر سایت";}i:2;a:2:{s:8:"usertype";s:1:"P";s:10:"membership";s:23:"مدیر فروشگاه";}}

        */
        $roles = Config::where('name','membership_levels')->first();
        $data = unserialize($roles->value);

        foreach ($data as $key => $role) {
            # code...
            $data[$key]['role_id'] = $role_id = isset($role['role_id']) ? $role['role_id'] : 0;
            $usertype = isset($role['usertype']) ? $role['usertype'] : '';
            $data[$key]['count_users'] = User::where([['role', $role_id],['usertype', $usertype]])->count();
        }

        // return $data;
        
        return view('admin.pages-admin.list-roles', [
            'data' => $data,
            'title' => 'سطح دسترسی',
        ]);
    }

    public function roleDelete(Request $request, $key)
    {
        $roles = Config::where('name','membership_levels')->first();
        $data = unserialize($roles->value);

        // return $data;

        unset($data[$key]);

        Config::where('name','membership_levels')->update([
            'value' => (serialize($data))
        ]);

        if (request()->ajax) {
            return [
                'title' => '',
                'message' => 'با موفقیت حذف گردید. 3',
                'status' => 'info',
                'data' => '',
            ];
        } else {
            return redirect()->back()->with('noty', [
                'title' => '',
                'message' => 'با موفقیت حذف گردید.',
                'status' => 'info',
                'data' => '',
            ]);
        }      

    }

    public function addRole(Request $request)
    {
        $request->validate([
            'usertype' => 'required|min:1|max:1',
            'role_id' => 'required|numeric',
            'membership' => 'required|string',
        ]);

        $roles = Config::where('name','membership_levels')->first();
        $data = unserialize($roles->value);

        
        foreach ($data as $key => $role) {
            # code...
            $data[$key]['role_id'] = $role_id = isset($role['role_id']) ? $role['role_id'] : 0;
            $usertype = isset($role['usertype']) ? $role['usertype'] : '';
            $data[$key]['count_users'] = User::where([['role', $role_id],['usertype', $usertype]])->count();
        }

        $role = [
            'usertype' => $request->usertype,
            'membership' => $request->membership,
            'role_id' => $request->role_id,
        ];

        $data[] = $role;


        // $data = (serialize($data));
        // $data = unserialize($data);
        // return $data;
        // array_push($data, $role);

        Config::where('name','membership_levels')->update([
            'value' => (serialize($data))
        ]);

        return back();    
    }
    //
    public function users(Request $request,$role = null)
    {
        $title = ($request->title) ? $request->title : null;

        $users = User::whereNotNull('login')->where('login','!=','0')
            // ->select('login')
            ->when($role, function($qRole) use ($role){
                $qRole->where('role', $role);
            })
            ->when($title, function($query) use($title){ 
                $query->where(function($query_) use($title){
                    $query_->orWhere('login', 'like', "%$title%")
                    ->orWhere('phone', 'like', "%$title%")
                    ->orWhere('email', 'like', "%$title%")
                    ->orWhere('firstname', 'like', "%$title%")
                    ->orWhere('lastname', 'like', "%$title%"); 
                });
            })
            // ->toSql();
            ->paginate(50);

            // return $users;

        $roles = Config::where('name','membership_levels')->first();
        $date = unserialize($roles->value);

        $membership = collect($date);

        return view('admin.pages-admin.list-users', [
            'users'         => $users,
            'membership'    => $membership,
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
    
    public function userDelete(Request $request, $login)
    {
        $login = '00'.ltrim($login,'00');
        $user = User::where('login', $login)->delete();

        // return $user;
        if (request()->ajax) {
            return [
                'title' => '',
                'message' => 'با موفقیت حذف گردید.1',
                'status' => 'info',
                'data' => '',
            ];
        } else {
            return redirect()->route('panel.adminer.users')->with('noty', [
                'title' => '',
                'message' => 'با موفقیت حذف گردید.2',
                'status' => 'info',
                'data' => '',
            ]);
        }
    }
}
