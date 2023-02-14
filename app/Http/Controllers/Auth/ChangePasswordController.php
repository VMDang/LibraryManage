<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\SessionGuard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class ChangePasswordController extends Controller
{

    /**
     * Show the change password view.
     *
     * @return \Illuminate\View\View
     */
    public function show(Request $request)
    {
        $user = Auth::user();

        $user_name = $user->name;
        $user_email = $user->email;

        return view('auth.change-password', compact('user_name', 'user_email'));
    }

    /**
     * Change the user's password.
     *
     * @param Request $request
     * @return mixed
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $message = [
            'password.required' => 'Mật khẩu bắt buộc nhập',
            'password.min' => 'Mật khẩu tối thiểu :min kí tự',
            'password.confirmed' => 'Mật khẩu xác nhận không đúng'
        ];

        $request->validate([
            'password' => ['required', 'min:8', 'confirmed', Rules\Password::defaults()],
        ], $message);

        $checkUser = Auth::user();

        if ($checkUser->email == $request->email) {

            $user = User::find($checkUser->id);
            $user->password = Hash::make($request->password);
            $user->updated_at = Carbon::now();
            $user->save();

//            if (isset($request->logoutOtherDevice)){          //Bug sau hàm save() Model User chưa cập nhật ngay MK mới
//                Auth::logoutOtherDevices($request->password); //Attribute $password trong SessionGuard/reHashUserPassword vẫn lấy MK cũ (hashed)
//            }
        }
        return redirect()->route('home');
    }
}
