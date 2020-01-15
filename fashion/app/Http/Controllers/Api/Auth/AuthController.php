<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Login;
use App\Models\Role;
use App\Services\kavenegarService;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AuthController extends Controller
{

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users',
            'password' => 'required|min:3|confirmed',
        ]);
        $username =  "+98" . ltrim($request->username, "0");
        if(User::where('username', $username)->first()){
            return response()->json([
                'status' => 'error',
                'errors' => ['username' => 'شماره تلقن قبلا ثبت شده است.'],
            ], 422);
        }
        $user = new User;
        $user->username = $username;
        $user->password = bcrypt($request->password);
        $user->code_country = '+98';
        $user->uuid = (string) Str::uuid();
        $code_confirm = rand(1001,9999);
        $user->code_confirm = $code_confirm;
        
        if (is_numeric($request->username) && ctype_digit($request->username)) {
            $user->phone =$username;
            kavenegarService::send($username,$code_confirm);
        }elseif (filter_var($username, FILTER_VALIDATE_EMAIL)) {
            $user->email = $username;
        }
        $user->save();

        

        $role = Role::where('slug', 'USER')->first();
        if(!$role){
            $role = new Role;
            $role->slug = 'USER';
            $role->name = 'user';
            $role->save();
            $role = Role::where('slug', 'USER')->first();

        }
        $role_id = $role->id;
        $user->roles()->sync([$role_id]);

        return response()->json([
            'status' => 'success',
            'message' => 'registered',
            'redirect' => [
                'page' => 'confirm',
                'parametr' => $user->uuid,
            ],
            'data' => $user,
        ], 200);
    }

    public function confirm(Request $request)
    {
        // return $request->all();
        $request->validate([
            // 'uuid' => 'required|exists:users,uuid',
            'code_confirm' => 'required|min:4',
        ]);

        $user = User::where('uuid', $request->uuid)->where('code_confirm', $request->code_confirm)->first();

        if(!$user){
            return response()->json([
                'status' => 'error',
                'errors' => ['code_confirm' => 'کد وارد شده اشتباه است.'],
            ], 422);
        }
        $user->phone_verified_at = Carbon::now()->toDateTimeString();
        $user->code_confirm = '';
        $user->save();

        return response()->json([
            'status' => 'success',
            'message' => 'confirmed',
            'redirect' => [
                'page' => 'login',
                'parametr' => '',
            ],
            'data' => $user,
        ], 200);
    }

    public function requestCode(Request $request){
        // $request->validate([
        //     'username' => 'required|exists:users'
        // ]);
        $username = (is_numeric($request->username)) ? '+98' . ltrim($request->username, "0") : $request->username;
        $user = User::where('username', $username)->first();

        if(!$user){
            return response()->json([
                'status' => 'error',
                'errors' => ['username' => 'کاربر مورد نظر وجود ندارد.'],
            ], 422);
        }

        $code_confirm = rand(1001,9999);
        $user->code_confirm = $code_confirm;

        if((is_numeric($request->username))){
            kavenegarService::send($username,$code_confirm);
        }else{

        }
        // send sms code confirm

        $user->save();

        return response()->json([
            'status' => 'success',
            'message' => 'send confirm code',
            'redirect' => [
                'page' => 'confirm',
                'parametr' => $user->uuid,
            ],
            'data' => $user,
        ], 200);
    }


    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');
        $credentials = [
            'username' => (is_numeric($request->username)) ? '+98' . ltrim($request->username, "0") : $request->username,
            'password' => $request->password,
        ];
        $user = User::where('username', $credentials['username'])->first();
        if(!$user){
            return response()->json([
                'status' => 'error',
                'errors' => ['username' => 'کاربر مورد نظر وجود ندارد.'],
            ], 422);
        }

        if($user->email_verified_at == null && $user->phone_verified_at == null){
            return response()->json([
                'status' => 'error',
                'errors' => ['username' => 'حساب کاربری شما فعال نشده است.'],
            ], 405);
        }

        if ($token = $this->guard()->attempt($credentials)) {
            $user = Auth::guard()->user();
            
            Login::create([
                'user_id' => $user->id,
                'login_at' => Carbon::now()->toDateTimeString(),
                'ip' => $request->getClientIp(),
                'user_agent' => request()->header('User-Agent'),
                // 'latitute' => '',
                // 'longitute' => '',
                'login_on' => 1,
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'logined',
                'redirect' => [
                    'page' => 'home',
                    'parametr' => '',
                ],
                'data' => $user,
                'token' => $token
            ], 200)->header('Authorization', $token);
        }
        return response()->json([
            'status' => 'error',
            'errors' => ['username' => 'شماره با رمز مطابقت ندارد.'],
        ], 422);
        return response()->json(['error' => 'login_error'], 401);
    }

    public function logout()
    {
        Login::where('user_id' , Auth::user()->id)->update([
            'login_on' => 0,
        ]);
        $this->guard()->logout();
        return response()->json([
            'status' => 'success',
            'msg' => 'Logged out Successfully.',
        ], 200);
    }

    public function user(Request $request)
    {
        $user = User::find(Auth::user()->id);
        // return $user;
        $login = Login::where('user_id',$user->id)->where('ip', $request->getClientIp())->first();
        if(!$user || !$login || !$login->login_on){
            $this->guard()->logout();
            return response()->json([
                'status' => 'error',
                'data' => '',
            ]);
        }
        return response()->json([
            'status' => 'success',
            'data' => $user,
        ]);
    }

    public function refresh()
    {
        if ($token = $this->guard()->refresh()) {
            return response()
                ->json(['status' => 'successs', 'token' => $token], 200)
                ->header('Authorization', $token);
        }
        return response()->json(['error' => 'refresh_token_error'], 401);
    }

    private function guard()
    {
        return Auth::guard();
    }
}
