<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Login;
use App\Models\Role;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function register(Request $request)
    {
        // $v = Validator::make($request->all(), [
        //     'username' => 'required|unique:users',
        //     'password' => 'required|min:3|confirmed',
        //     // 'role_id' => 'required'
        // ]);
        // if ($v->fails()) {
        //     return response()->json([
        //         'status' => 'error',
        //         'errors' => $v->errors(),
        //     ], 422);
        // }
        $request->validate([
            'username' => 'required|unique:users',
            'password' => 'required|min:3|confirmed',
        ]);
        $user = new User;
        $user->username = $request->username;
        if (is_numeric($request->username) && ctype_digit($request->username)) {
            $user->phone = "0098" . ltrim($request->username, "0");
        }
        if (checkEmail($request->username)) {
            $user->email = $request->username;
        }
        $user->password = bcrypt($request->password);
        $user->save();

        $data = [];

        $data->role_id = ($request->role_id) ? $request->role_id : Role::where('slug', 'user')->first()->id;
        $user->roles()->sync([$data->role_id]);

        return response()->json(['status' => 'success'], 200);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');
        $credentials = [
            'username' => (is_numeric($request->username)) ? '0098' . $request->username : $request->username,
            'password' => $request->password,
        ];
        if ($token = $this->guard()->attempt($credentials)) {
            Login::create([
                'login_at' => Carbon::now()->toDateTimeString(),
                'ip' => $request->getClientIp(),
                'user_agent' => request()->header('User-Agent'),
                // 'latitute' => '',
                // 'longitute' => '',
                'login_on' => 1,
            ]);
            return response()->json(['status' => 'success'], 200)->header('Authorization', $token);
        }
        return response()->json(['error' => 'login_error'], 401);
    }

    public function logout()
    {
        $this->guard()->logout();
        return response()->json([
            'status' => 'success',
            'msg' => 'Logged out Successfully.',
        ], 200);
    }

    public function user(Request $request)
    {
        $user = User::find(Auth::user()->id);
        return response()->json([
            'status' => 'success',
            'data' => $user,
        ]);
    }

    public function refresh()
    {
        if ($token = $this->guard()->refresh()) {
            return response()
                ->json(['status' => 'successs'], 200)
                ->header('Authorization', $token);
        }
        return response()->json(['error' => 'refresh_token_error'], 401);
    }

    private function guard()
    {
        return Auth::guard();
    }
}
