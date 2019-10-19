<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\PasswordReset;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Notifications\PasswordResetRequest;
use App\Notifications\PasswordResetSuccess;
use App\User;
use Illuminate\Support\Str;

class PasswordResetController extends Controller
{
    /**
     * Create token password reset
     *
     * @param  [string] username
     * @return [string] message
     */
    public function create(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
        ]);
        $username = (is_numeric($request->username)) ? '0098' . ltrim($request->username, "0") : $request->username;
        $user = User::where('username', $username)->first();
        if (!$user)
            return response()->json([
                'status' => 'error',
                'errors' => ['username' => 'شناسه کاربری وجود ندارد.'],
            ], 422);
        $passwordReset = PasswordReset::updateOrCreate(
            ['username' => $user->username],
            [
                'username' => $user->username,
                'token' => Str::uuid(),
                'password' => ''
             ]
        );
        // if ($user && $passwordReset)
        //     $user->notify(
        //         new PasswordResetRequest($passwordReset->token)
        //     );

        return response()->json([
            'status' => 'success',
            'message' => 'لینک فعال سازی ارسال گردید.',
            'redirect' => [
                'page' => '',
                'parametr' => '',
            ],
            'data' => $user,
        ], 201);
    }
    /**
     * Find token password reset
     *
     * @param  [string] $token
     * @return [string] message
     * @return [json] passwordReset object
     */
    public function find($token)
    {
        $passwordReset = PasswordReset::where('token', $token)
            ->first();
        if (!$passwordReset)
            return response()->json([
                'status' => 'error',
                'message' => 'لینک فعال سازی وجود ندارد دوباره درخواست دهید.',
                'redirect' => [
                    'page' => 'create',
                    'parametr' => '',
                ],
                'data' => '',
            ], 404);
        if (Carbon::parse($passwordReset->updated_at)->addMinutes(720)->isPast()) {
            $passwordReset->delete();
            return response()->json([
                'status' => 'error',
                'message' => 'لینک فعال سازی منقضی گردیده است.',
                'redirect' => [
                    'page' => 'reset',
                    'parametr' => '',
                ],
                'data' => '',
            ], 404);
        }
        return response()->json($passwordReset);
    }
     /**
     * Reset password
     *
     * @param  [string] username
     * @param  [string] password
     * @param  [string] password_confirmation
     * @param  [string] token
     * @return [string] message
     * @return [json] user object
     */
    public function reset(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string|confirmed',
            'token' => 'required|string'
        ]);
        $passwordReset = PasswordReset::where([
            ['token', $request->token],
            ['username', $request->username]
        ])->first();
        if (!$passwordReset)
            return response()->json([
                'status' => 'error',
                'message' => 'لینک فعال سازی وجود ندارد دوباره درخواست دهید.',
                'redirect' => [
                    'page' => 'create',
                    'parametr' => '',
                ],
                'data' => '',
            ], 404);
        $user = User::where('username', $passwordReset->username)->first();
        if (!$user)
            return response()->json([
                'status' => 'error',
                'message' => 'کاربر گرامی شماره شما ثبت نشده است.',
                'redirect' => [
                    'page' => 'register',
                    'parametr' => '',
                ],
                'data' => '',
            ], 404);
        $user->password = bcrypt($request->password);
        $user->save();
        $passwordReset = PasswordReset::where([
            ['token', $request->token],
            ['username', $request->username]
        ])->delete();
        // $user->notify(new PasswordResetSuccess($passwordReset));
        return response()->json([
            'status' => 'success',
            'message' => 'اکنون می توانید وارد حساب کاربری خود شوید.',
            'redirect' => [
                'page' => 'login',
                'parametr' => '',
            ],
            'data' => $user,
        ], 200);
    }
}