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
            'name.required' => 'T??n b???t bu???c nh???p',
            'name.string' => 'T??n ph???i l?? chu???i',
            'name.max' => 'T??n kh??ng v?????t qu?? :max k?? t???',
            'image.mimes' => '???nh ?????i di???n ch??? cho ph??p ?????nh d???ng :values',
            'image.max' => '???nh ?????i di???n kh??ng v?????t qu?? :max KB',
            'email.required' => 'Email b???t bu???c nh???p',
            'email.max' => 'Email kh??ng v?????t qu?? :max k?? t???',
            'email.string' => 'Email ph???i l?? chu???i',
            'email.email' => 'Email ph???i l?? ?????nh d???ng email',
            'email.unique' => 'Email ???? ???????c ????ng k?? t??i kho???n',
            'phone.required' => 'S??? ??i???n tho???i b???t bu???c nh???p',
            'phone.string' => 'S??? ??i???n tho???i ph???i l?? chu???i',
            'phone.max' => 'S??? ??i???n tho???i kh??ng v?????t qu?? :max k?? t???',
            'phone.unique' => 'S??? ??i???n tho???i ???? t???n t???i',
            'password.required' => 'M???t kh???u b???t bu???c nh???p',
            'password.min' => 'M???t kh???u t???i thi???u :min k?? t???',
            'password.confirmed' => 'M???t kh???u x??c nh???n kh??ng ????ng'
        ];
    }
}
