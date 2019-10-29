<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function getUser(Request $request)
    {
        $user = User::find(Auth::user()->id);
        return response()->json([
            'status' => 'success',
            'data' => $user,
        ],201);
    }

    public function updateUser(Request $request)
    {
        $request->validate([
            
        ]);

        $user = User::find(Auth::user()->id);
    }

    private function guard()
    {
        return Auth::guard();
    }
}
