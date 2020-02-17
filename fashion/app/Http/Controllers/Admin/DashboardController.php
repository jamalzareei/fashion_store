<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    //
    public function index()
    {
        if(!auth()->check()){
            return redirect()->route('admin')->with('noty',[
                'title' => '',
                'message' => 'شما اجازه دسترسی به این بخش را ندارید2.',
                'status' => 'info',
                'data' => '',
            ]);
        }
        

        $data = [];
        return view('admin.pages-admin.dashboard', [
            'data'  => $data,
            'title' => 'داشبورد',
        ]);
        // return 'login';
        // return $data;
        
    }
}
