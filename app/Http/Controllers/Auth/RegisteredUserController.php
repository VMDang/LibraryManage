<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'image' => ['mimes:png,jpg,jpeg,svg,heic', 'max:5120'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required','min:8', 'confirmed', Rules\Password::defaults()],
        ], $this->message());

        $ava = $request->file('image');

        if ($request->hasFile('image')){
            $ava->storeAs(
                'public/avatars', $ava->getClientOriginalName()
            );
            $path = Storage::url('avatars/' . $ava->getClientOriginalName());
        }else {
            if ($request->input('gender') == 1){
                $path = config('app.avatarDefaultMale');

            }else{
                $path = config('app.avatarDefaultFemale');
            }
        }

        $user = User::create([
            'role_id' => 3,
            'name' => $request->name,
            'image' => $path,
            'gender' => $request->gender,
            'birthday' => $request->birthday,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }

    /**
     * Display validate massage with rules register
    */
    private function message(){
        return [
            'name.required' => 'Tên bắt buộc nhập',
            'name.string' => 'Tên phải là chuỗi',
            'name.max' => 'Tên không vượt quá :max kí tự',
            'image.mimes' => 'Ảnh đại diện chỉ cho phép định dạng :values',
            'image.max' => 'Ảnh đại diện không vượt quá :max KB',
            'email.required' => 'Email bắt buộc nhập',
            'email.max' => 'Email không vượt quá :max kí tự',
            'email.string' => 'Email phải là chuỗi',
            'email.email' => 'Email phải là định dạng email',
            'email.unique' => 'Email đã được đăng ký tài khoản',
            'phone.required' => 'Số điện thoại bắt buộc nhập',
            'phone.string' => 'Số điện thoại phải là chuỗi',
            'phone.max' => 'Số điện thoại không vượt quá :max kí tự',
            'phone.unique' => 'Số điện thoại đã tồn tại',
            'password.required' => 'Mật khẩu bắt buộc nhập',
            'password.min' => 'Mật khẩu tối thiểu :min kí tự',
            'password.confirmed' => 'Mật khẩu xác nhận không đúng'
        ];
    }
}
