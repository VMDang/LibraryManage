<?php

namespace App\Http\Controllers;

use BaseHelper;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

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

        // User cannot see the account being locked
        $checkLocked = Gate::check('Locked', $user);
        $isUser = Gate::check('isUser');
        if ($checkLocked && $isUser) {
            abort(404, 'Tài khoản không tồn tại');
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

        if (($checkUser->email == $request->email) && Gate::check('ALL_ACC')){
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

            $user->save();
        }

            BaseHelper::ajaxResponse(config('app.messageSaveSuccess'),true, $user);
        }catch (\Exception $exception){
            print_r($exception);
            BaseHelper::ajaxResponse(config('app.messageSaveError'), false);
        }
    }


    /**
     * Recover Account User if account locked (status = 0)
     *
     * @param Request $request
     * @return void
     */
    public function recoverAccountAjax(Request $request) {
        $this->checkRequestAjax($request);

        try {
            if (Gate::any(['isAdmin', 'isMod']) && Gate::check('DEL_OTHER_ACC')) {
                $user = User::find($request->id);
                $user->status = 1;
                $user->deleted_by = Auth::id();
                $user->save();

                return BaseHelper::ajaxResponse('Mở khóa tài khoản thành công', true);
            }else
                return BaseHelper::ajaxResponse('Bạn không có quyền thực hiện hành động này', false);
        }catch (\Exception $e) {
            BaseHelper::ajaxResponse(config('app.messageSaveError'), false);
        }
    }

    /**
     * Lock Account User if account locked (status = 1)
     *
     * @param Request $request
     * @return void
     */
    public function lockAccountAjax(Request $request) {
        $this->checkRequestAjax($request);

        try {
            if (Gate::any(['isAdmin', 'isMod']) && Gate::check('DEL_OTHER_ACC')) {
                $user = User::find($request->id);
                $user->status = 0;
                $user->deleted_by = Auth::id();
                $user->save();

                if ($user->id == Auth::id()){
                    return Auth::logout();
                }else
                    return BaseHelper::ajaxResponse('Khóa tài khoản thành công', true);
            }else
                return BaseHelper::ajaxResponse('Bạn không có quyền thực hiện hành động này', false);
        }catch (\Exception $e) {
            BaseHelper::ajaxResponse(config('app.messageSaveError'), false);
        }
    }

    /**
     * Soft delete Account user after account locked (status = 0)
     *
     * @param Request $request
     * @return void
     */
    public function deleteAccountAjax(Request $request) {
        $this->checkRequestAjax($request);

        try {
            if (Gate::any(['isAdmin', 'isMod']) && Gate::check('DEL_OTHER_ACC') && Gate::check('Locked', User::find($request->id))) {
                $user = User::find($request->id);
                $user->deleted_by = Auth::id();
                $user->delete();
                $user->save();

                return BaseHelper::ajaxResponse('Xóa tài khoản thành công' ,true);
            }else
                return BaseHelper::ajaxResponse('Bạn không có quyền thực hiện hành động này', false);
        }catch (\Exception $e) {
            BaseHelper::ajaxResponse(config('app.messageSaveError'), false);
        }
    }


    /**
     * Change role account is Admin, Mod or User
     *
     * @param Request $request
     * @return void
     */
    public function updateRoleAjax(Request $request) {
        $this->checkRequestAjax($request);

        try {
            if (Gate::check('isAdmin') && Gate::check('UPDATE_OTHER_ACC')) {
                $user = User::find($request->id);
                $user->role_id = $request->role_id;
                $user->updated_role_by = Auth::id();
                $user->save();

                return BaseHelper::ajaxResponse('Cập nhật vai trò thành công', true);
            }else
                return BaseHelper::ajaxResponse('Bạn không có quyền thực hiện hành động này', false);

        }catch (\Exception $e){
            BaseHelper::ajaxResponse(config('app.messageSaveError'), false);
        }
    }


    /**
     * Show and filter all users in system
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\View\View
     */
    public function list(Request $request) {
        $filters = $request->all();

        if ($request->isMethod('POST')) {
            $query = User::query()->where('role_id', '=', 3);

            foreach ($filters as $key => $value) {
                if ($value != '' && $value != NULL) {
                    switch ($key) {
                        case 'name':
                            $query->where('name', 'LIKE', '%' . $value . '%');
                            break;
                        case 'phone':
                            $query->where('phone', 'LIKE', '%' . $value . '%');
                            break;
                        case 'email':
                            $query->where('email', 'LIKE', '%' . $value . '%');
                            break;
                        case 'gender':
                            $query->where('gender', '=', $value);
                            break;
                        case 'yearOfBirth':
                            $query->where('birthday', 'LIKE', $value . '%');
                            break;
                        default:
                            break;
                    }
                }
            }
            $users = $query->get(['id', 'name', 'role_id', 'gender', 'birthday', 'email', 'phone', 'address', 'status']);

        } else {
            $users = User::where('role_id', '=', 3)
                ->get(['id', 'name', 'role_id', 'gender', 'birthday', 'email', 'phone', 'address', 'status']);
        }

        $usersTrashed = User::onlyTrashed()
                        ->get(['id', 'name', 'role_id', 'gender', 'birthday', 'email', 'phone', 'deleted_by', 'deleted_at']);

        $admins = User::where('role_id', '=', 1)
                    ->get(['id', 'name', 'role_id', 'gender', 'birthday', 'email', 'phone', 'address', 'status']);

        $mods = User::where('role_id', '=', 2)
            ->get(['id', 'name', 'role_id', 'gender', 'birthday', 'email', 'phone', 'address', 'status']);

        return view('users.list', compact('users', 'usersTrashed', 'admins', 'mods', 'filters'));
    }
}
