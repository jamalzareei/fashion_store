<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Login;
use App\Models\Role;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AuthController extends Controller
{

    public function register(Request $request)
    {
        // return response()->json([
        //     'status' => 'success',
        //     'message' => 'registered',
        //     'redirect' => 'confirm',
        //     'data' => ['id'=>1],
        // ], 200);
        // return $request->all();
        $request->validate([
            'username' => 'required|unique:users',
            'password' => 'required|min:3|confirmed',
        ]);
        $user = new User;
        $user->username = $request->username;
        if (is_numeric($request->username) && ctype_digit($request->username)) {
            $user->phone = "0098" . ltrim($request->username, "0");
        }
        if (filter_var($request->username, FILTER_VALIDATE_EMAIL)) {
        // if (checkEmail($request->username)) {
            $user->email = $request->username;
        }
        $user->password = bcrypt($request->password);
        $user->uuid = (string) Str::uuid();
        $user->code_confirm = rand(1001,9999);
        $user->save();

        $role_id = Role::where('slug', 'USER')->first()->id;
        $user->roles()->sync([$role_id]);

        return response()->json([
            'status' => 'success',
            'message' => 'registered',
            'redirect' => 'confirm',
            'data' => $user,
        ], 200);
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
