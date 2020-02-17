<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthenticatinController extends Controller
{
    //
    public function index(Request $request)
    {
        # code...
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'code_country' => 'required',
            'password' => 'required',
        ]);
        $username = ltrim($request->username, '0');
        if (is_numeric($request->username)){
            $username = ltrim($request->username, '0');
        }else{
            $username = ltrim($request->username, '0');
        }
        
        $credentials = array(
            'code_country'  => $request->code_country ,
            'username'      => $username,
            'password'      => $request->password
        );

        // $credentials = $request->only('username', 'password');
        // return $credentials;
        if (auth()->attempt($credentials)) {
            // if(auth()->check()){
            //     return 'ok';
            // }
            // Authentication passed...
            return redirect()->route('admin.dashboard');//('admin/dashboard');
        }
        return back()->with('noty',[
            'title' => '',
            'message' => 'نام کاربری یا رمز عبور اشتباه میباشد.',
            'status' => 'info',
            'data' => '',
        ]);
    }

}
