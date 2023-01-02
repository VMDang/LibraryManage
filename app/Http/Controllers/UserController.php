<?php

namespace App\Http\Controllers;

use BaseHelper;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{

    /**
     * Show page profile user.
     * If the user has been deleted then only visible to Admin and Mod
     *
     * @param $id
     * @return \Illuminate\View\View
     */
    public function profile($id = null) {
        $user = User::find($id);

        if (empty($user)){
            $user = Auth::user();
        }

        return view('users.profile', compact('user'));
    }

    /**
     * Update info account is valid
     *
     * @param Request $request
     * @return void
     */
    public function updateUserAjax(Request $request) {
        $this->checkRequestAjax($request);

        try {
        $checkUser = Auth::user();
        if (($checkUser->id == $request->id) && ($checkUser->email == $request->email)){
            $user = User::find($checkUser->id);

            $user->name = $request->name;
            $user->birthday = $this->changeFormatDateInput($request->birthday);
            if ($request->gender != $user->gender &&     //if gender change and avatar is image default
                (($user->image == config('app.avatarDefaultMale')) || ($user->image == config('app.avatarDefaultFemale')) )){
                if ($request->gender == 1) {
                    $user->image  = config('app.avatarDefaultMale');
                }else {
                    $user->image  = config('app.avatarDefaultFemale');
                }
            }
            $user->gender = $request->gender;
            $user->phone = $request->phone;
            $user->address = $request->address;
            $user->updated_at = Carbon::now();
            $user->save();
        }
            BaseHelper::ajaxResponse(config('app.messageSaveSuccess'),true, $user);
        }catch (\Exception $exception){
            print_r($exception);
            die();
            BaseHelper::ajaxResponse(config('app.messageSaveError'), false);
        }
    }
}
