<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\UploadService;


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
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'day_birthdaye' => 'required_with_all:mounth_birthdaye,year_birthdaye|integer',
            'mounth_birthdaye' => 'required_with_all:day_birthdaye,year_birthdaye|integer',
            'year_birthdaye' => 'required_with_all:day_birthdaye,mounth_birthdaye|integer',
            // 'address' => 'required|string',
            // 'country' => 'required|integer',
            // 'state' => 'required|integer',
            // 'city' => 'required|integer',
            'about_me' => 'required|string',
            'file' => 'sometimes|image',
        ]);

        
        $user = User::find(Auth::user()->id);

        // if($request->file != 'undefined'){
        if($request->hasFile('file')) {

            $date = date('Y-m-d');
            $path = "uploads/users/$user->id/$date";
            $photos = [$request->file];
            $photos = UploadService::saveFile($path, $photos);

            // $user->image()->update([
            //     'active' => 0
            // ]);
            $user->image()->updateOrCreate(
                ['imageable_id' => $user->id, 'imageable_type' => 'App\User'],
                [
                    'path' => $photos,
                    'type' => '',
                    'active' => 1
                ]
            );
        }
        // return $photos;


        /*
        firstname: null
        lastname: null
        day_birthdaye: null
        mounth_birthdaye: null
        year_birthdaye: null
        address: null
        country: null
        state: null
        city: null
        about_me: null
        */

        if($user->phone == null || $user->phone == ''){
            $request->validate([
                'phone' => 'required|number',
            ]);
            $phone =  "+98" . ltrim($request->phone, "0");
            $user->phone = $phone;
        }
        
        if($user->email == null || $user->email == ''){
            $request->validate([
                'email' => 'required|string',
            ]);
            $user->email = $request->email;
        }
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->birth_day = $request->day_birthdaye;
        $user->birth_month = $request->mounth_birthdaye;
        $user->birth_year = $request->year_birthdaye;
        $user->birthday = $request->day_birthdaye.'/'.$request->mounth_birthdaye.'/'.$request->year_birthdaye;
        $user->about_me = $request->about_me;
        $user->specialty_me = $request->specialty_me;

        $user->save();

        return response()->json([
            'status' => 'success',
            'data' => $user,
            'message' => 'با موفقیت ذخیره گردید.'
        ]);
    }

    private function guard()
    {
        return Auth::guard();
    }
}
