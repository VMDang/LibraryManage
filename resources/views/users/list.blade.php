@extends("layouts.footer")
@section('title-page')
    <title> List User | Library Manage</title>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('themes/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

    <style>
        .dark-mode input:-webkit-autofill,
        .dark-mode input:-webkit-autofill:hover,
        .dark-mode input:-webkit-autofill:focus,
        .dark-mode input:-webkit-autofill:active{
            -webkit-box-shadow: 0 0 0 30px #343A40 inset !important;
        }
    </style>
@endsection

@section('script')
    <script src="{{asset('themes/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('themes/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{asset('themes/plugins/jszip/jszip.min.js')}}"></script>
    <script src="{{asset('themes/plugins/pdfmake/pdfmake.min.js')}}"></script>
    <script src="{{asset('themes/plugins/pdfmake/vfs_fonts.js')}}"></script>
    <script src="{{asset('themes/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('themes/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('themes/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>

    <script src="{{asset('js/user/list.js')}}" defer></script>
@endsection

@section('content')
    <?php $years = range(strftime("%Y", time()), 1930); ?>

        <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Danh sách người dùng</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Danh sách người dùng</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <section class="content-section">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card-header">
                            <h3 class="card-title">Tìm kiếm người dùng</h3>
                        </div>
                        <form action="" method="post" id="formFilterUser">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" style="text-align: right">Họ
                                                tên:</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" name="name" id="name"
                                                       value="{{ isset($filters['name']) ? $filters['name'] : '' }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group row">
                                            <label class="col-sm-5 col-form-label" style="text-align: right">Số điện
                                                thoại:</label>
                                            <div class="col-sm-7">
                                                <input class="form-control" name="phone" id="phone"
                                                       value="{{ isset($filters['phone']) ? $filters['phone'] : '' }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label"
                                                   style="text-align: right">Email:</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" name="email" id="email"
                                                       value="{{ isset($filters['email']) ? $filters['email'] : '' }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label" style="text-align: right">Giới
                                                tính:</label>
                                            <div class="col-sm-7">
                                                <select class="form-control" name="gender" id="gender">
                                                    <option
                                                        value="" {{ (isset($filters['gender']) && '' == $filters['gender']) ? 'selected' : ''}}>
                                                        Chọn giới tính
                                                    </option>
                                                    <option
                                                        value="1" {{ (isset($filters['gender']) && '' == $filters['gender']) ? 'selected' : ''}}>
                                                        Nam
                                                    </option>
                                                    <option
                                                        value="0" {{ (isset($filters['gender']) && '' == $filters['gender']) ? 'selected' : ''}}>
                                                        Nữ
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group row">
                                            <label class="col-sm-5 col-form-label" style="text-align: right">Năm
                                                sinh:</label>
                                            <div class="col-sm-7">
                                                <select class="form-control" name="yearOfBirth" id="yearOfBirth">
                                                    <option
                                                        value="" {{ (isset($filters['yearOfBirth']) && '' == $filters['yearOfBirth']) ? 'selected' : ''}}>
                                                        Chọn năm sinh
                                                    </option>
                                                    @foreach($years as $year)
                                                        <option
                                                            value="{{$year}}" {{(isset($filters['yearOfBirth']) && $year == $filters['yearOfBirth']) ? 'selected' : ''}}>{{$year}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                    <div class="form-group row">
                                        <label class="col-lg-1"></label>
                                        <div class="col-sm-2">
                                            <button type="submit" class="btn btn-primary" id="btnFilter"><i class="fa fa-search mr-1"></i>Tìm kiếm</button>
                                        </div>
                                        <div class="col-sm-2">
                                            <button type="button" class="btn btn-default" id="btnReset"><i class="fa fa-undo mr-1"></i>Đặt lại</button>
                                        </div>
                                    </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header p-0 pt-1">
                                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill"
                                           href="#tab-all-users-not-delete" role="tab"
                                           aria-controls="custom-tabs-one-home" aria-selected="true">Tất cả người
                                            dùng</a>
                                    </li>
                                    @cannot('isUser')
                                        <li class="nav-item">
                                            <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill"
                                               href="#tab-all-users-deleted" role="tab"
                                               aria-controls="custom-tabs-one-profile" aria-selected="false">Soft
                                                Deleted</a>
                                        </li>
                                    @endcannot
                                    <li class="nav-item">
                                        <a class="nav-link" id="custom-tabs-one-messages-tab" data-toggle="pill"
                                           href="#tab-all-admin" role="tab" aria-controls="custom-tabs-one-messages"
                                           aria-selected="false">Admin</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="custom-tabs-one-settings-tab" data-toggle="pill"
                                           href="#tab-all-mod" role="tab" aria-controls="custom-tabs-one-settings"
                                           aria-selected="false">Moderator</a>
                                    </li>
                                </ul>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="tab-content" id="custom-tabs-one-tabContent">
                                    <div class="tab-pane fade show active" id="tab-all-users-not-delete" role="tabpanel"
                                         aria-labelledby="custom-tabs-one-home-tab">
                                        <table id="tableListUsers" class="table table-bordered table-striped">
                                            <thead>
                                            <tr>
                                                <th style="width: 3%">#</th>
                                                <th style="width: 17%">Họ và Tên</th>
                                                <th style="width: 10%">Giới tính</th>
                                                <th style="width: 10%">Ngày sinh</th>
                                                <th style="width: 20%">Email</th>
                                                <th style="width: 13%">Điện thoại</th>
                                                <th style="width: 12%">Trạng thái</th>
                                                <th style="width: 15%">Hành động</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($users as $index => $user)
                                                <tr>
                                                    <td>{{++$index}}</td>
                                                    <td>{{$user->name}}</td>
                                                    <td>{{$user->gender ? 'Nam' : 'Nữ'}}</td>
                                                    <td>{{date('d/m/Y', strtotime($user->birthday))}}</td>
                                                    <td>{{$user->email}}</td>
                                                    <td>{{$user->phone}}</td>
                                                    <td><?php echo $user->status ? '<span style="color:green;">Bình thường</span>' : '<span style="color:red;">Đã khóa</span>' ?></td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <button type="button" class="btn btn-default"><a
                                                                    href="{{route('user.profile', [$user->id, $user->name])}}">Xem
                                                                    chi tiết</a></button>
                                                            @cannot('isUser')
                                                                <button type="button"
                                                                        class="btn btn-default dropdown-toggle dropdown-hover dropdown-icon"
                                                                        data-toggle="dropdown">
                                                                </button>
                                                                <div class="dropdown-menu" role="menu">
                                                                    @canany(['UPDATE_OTHER_ACC', 'isAdmin'])
                                                                        <a class="dropdown-item change-role-account"
                                                                           data-id="{{$user->id}}" data-action="1"
                                                                           href="#">Đặt là quản
                                                                            trị viên</a>
                                                                        <a class="dropdown-item change-role-account"
                                                                           data-id="{{$user->id}}" data-action="2"
                                                                           href="#">Đặt là người
                                                                            kiểm duyệt</a>
                                                                        <div class="dropdown-divider"></div>
                                                                    @endcanany
                                                                    @can('DEL_OTHER_ACC')
                                                                        @if(\Illuminate\Support\Facades\Gate::check('Locked', $user))
                                                                            <a class="dropdown-item recoverAccount"
                                                                               data-id="{{$user->id}}" href="#">Khôi
                                                                                phục tài
                                                                                khoản</a>
                                                                            <a class="dropdown-item deleteAccount"
                                                                               data-id="{{$user->id}}" href="#">Xóa tài
                                                                                khoản</a>
                                                                        @else
                                                                            <a class="dropdown-item lockAccount"
                                                                               data-id="{{$user->id}}" href="#">Khóa tài
                                                                                khoản</a>
                                                                        @endif
                                                                    @endcan
                                                                </div>
                                                            @endcanany
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <th style="width: 3%">#</th>
                                                <th style="width: 17%">Họ và Tên</th>
                                                <th style="width: 10%">Giới tính</th>
                                                <th style="width: 10%">Ngày sinh</th>
                                                <th style="width: 20%">Email</th>
                                                <th style="width: 13%">Điện thoại</th>
                                                <th style="width: 12%">Trạng thái</th>
                                                <th style="width: 15%">Hành động</th>
                                            </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                    @cannot('isUser')
                                        <div class="tab-pane fade" id="tab-all-users-deleted" role="tabpanel"
                                             aria-labelledby="custom-tabs-one-profile-tab">
                                            <table id="tableListUsersSoftDeleted"
                                                   class="table table-bordered table-striped">
                                                <thead>
                                                <tr>
                                                    <th style="width: 3%">#</th>
                                                    <th style="width: 17%">Họ và Tên</th>
                                                    <th style="width: 10%">Giới tính</th>
                                                    <th style="width: 10%">Ngày sinh</th>
                                                    <th style="width: 20%">Email</th>
                                                    <th style="width: 12%">Điện thoại</th>
                                                    <th style="width: 13%">Người xóa</th>
                                                    <th style="width: 15%">Thời gian xóa</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($usersTrashed as $index => $user)
                                                    <tr>
                                                        <td>{{++$index}}</td>
                                                        <td>{{$user->name}}</td>
                                                        <td>{{$user->gender ? 'Nam' : 'Nữ'}}</td>
                                                        <td>{{date('d/m/Y', strtotime($user->birthday))}}</td>
                                                        <td>{{$user->email}}</td>
                                                        <td>{{$user->phone}}</td>
                                                        <td>{{\App\Models\User::find($user->deleted_by)->name}}</td>
                                                        <td>{{date('H:i:s d/m/Y', strtotime($user->deleted_at))}}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <th style="width: 3%">#</th>
                                                    <th style="width: 17%">Họ và Tên</th>
                                                    <th style="width: 10%">Giới tính</th>
                                                    <th style="width: 10%">Ngày sinh</th>
                                                    <th style="width: 20%">Email</th>
                                                    <th style="width: 12%">Điện thoại</th>
                                                    <th style="width: 13%">Người xóa</th>
                                                    <th style="width: 15%">Thời gian xóa</th>
                                                </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    @endcannot
                                    <div class="tab-pane fade" id="tab-all-admin" role="tabpanel"
                                         aria-labelledby="custom-tabs-one-messages-tab">
                                        <table id="tableListAdmins" class="table table-bordered table-striped">
                                            <thead>
                                            <tr>
                                                <th style="width: 3%">#</th>
                                                <th style="width: 17%">Họ và Tên</th>
                                                <th style="width: 10%">Giới tính</th>
                                                <th style="width: 10%">Ngày sinh</th>
                                                <th style="width: 20%">Email</th>
                                                <th style="width: 13%">Điện thoại</th>
                                                <th style="width: 12%">Trạng thái</th>
                                                <th style="width: 15%">Hành động</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($admins as $index => $user)
                                                <tr>
                                                    <td>{{++$index}}</td>
                                                    <td>{{$user->name}}</td>
                                                    <td>{{$user->gender ? 'Nam' : 'Nữ'}}</td>
                                                    <td>{{date('d/m/Y', strtotime($user->birthday))}}</td>
                                                    <td>{{$user->email}}</td>
                                                    <td>{{$user->phone}}</td>
                                                    <td><?php echo $user->status ? '<span style="color:green;">Bình thường</span>' : '<span style="color:red;">Đã khóa</span>' ?></td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <button type="button" class="btn btn-default"><a
                                                                    href="{{route('user.profile', [$user->id, $user->name])}}">Xem
                                                                    chi tiết</a></button>
                                                            @unless(\Illuminate\Support\Facades\Gate::any(['isUser', 'isMod']))
                                                                <button type="button"
                                                                        class="btn btn-default dropdown-toggle dropdown-hover dropdown-icon"
                                                                        data-toggle="dropdown">
                                                                </button>
                                                                <div class="dropdown-menu" role="menu">
                                                                    @canany(['UPDATE_OTHER_ACC', 'isAdmin'])
                                                                        <a class="dropdown-item change-role-account"
                                                                           data-id="{{$user->id}}" data-action="2"
                                                                           href="#">Đặt là người
                                                                            kiểm duyệt</a>
                                                                        <a class="dropdown-item change-role-account"
                                                                           data-id="{{$user->id}}" data-action="3"
                                                                           href="#">Đặt là người
                                                                            dùng</a>
                                                                        <div class="dropdown-divider"></div>
                                                                    @endcanany
                                                                    @if(\Illuminate\Support\Facades\Gate::check('Locked', $user))
                                                                        <a class="dropdown-item recoverAccount"
                                                                           data-id="{{$user->id}}" href="#">Khôi phục
                                                                            tài
                                                                            khoản</a>
                                                                        <a class="dropdown-item deleteAccount"
                                                                           data-id="{{$user->id}}" href="#">Xóa tài
                                                                            khoản</a>
                                                                    @else
                                                                        <a class="dropdown-item lockAccount"
                                                                           data-id="{{$user->id}}" href="#">Khóa tài
                                                                            khoản</a>
                                                                    @endif
                                                                </div>
                                                            @endunless
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <th style="width: 3%">#</th>
                                                <th style="width: 17%">Họ và Tên</th>
                                                <th style="width: 10%">Giới tính</th>
                                                <th style="width: 10%">Ngày sinh</th>
                                                <th style="width: 20%">Email</th>
                                                <th style="width: 13%">Điện thoại</th>
                                                <th style="width: 12%">Trạng thái</th>
                                                <th style="width: 15%">Hành động</th>
                                            </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                    <div class="tab-pane fade" id="tab-all-mod" role="tabpanel"
                                         aria-labelledby="custom-tabs-one-settings-tab">
                                        <table id="tableListMods" class="table table-bordered table-striped">
                                            <thead>
                                            <tr>
                                                <th style="width: 3%">#</th>
                                                <th style="width: 17%">Họ và Tên</th>
                                                <th style="width: 10%">Giới tính</th>
                                                <th style="width: 10%">Ngày sinh</th>
                                                <th style="width: 20%">Email</th>
                                                <th style="width: 13%">Điện thoại</th>
                                                <th style="width: 12%">Trạng thái</th>
                                                <th style="width: 15%">Hành động</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($mods as $index => $user)
                                                <tr>
                                                    <td>{{++$index}}</td>
                                                    <td>{{$user->name}}</td>
                                                    <td>{{$user->gender ? 'Nam' : 'Nữ'}}</td>
                                                    <td>{{date('d/m/Y', strtotime($user->birthday))}}</td>
                                                    <td>{{$user->email}}</td>
                                                    <td>{{$user->phone}}</td>
                                                    <td><?php echo $user->status ? '<span style="color:green;">Bình thường</span>' : '<span style="color:red;">Đã khóa</span>' ?></td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <button type="button" class="btn btn-default"><a
                                                                    href="{{route('user.profile', [$user->id, $user->name])}}">Xem
                                                                    chi tiết</a></button>
                                                            @unless(\Illuminate\Support\Facades\Gate::any(['isUser', 'isMod']))
                                                                <button type="button"
                                                                        class="btn btn-default dropdown-toggle dropdown-hover dropdown-icon"
                                                                        data-toggle="dropdown">
                                                                </button>
                                                                <div class="dropdown-menu" role="menu">
                                                                    @canany(['UPDATE_OTHER_ACC', 'isAdmin'])
                                                                        <a class="dropdown-item change-role-account"
                                                                           data-id="{{$user->id}}" data-action="1"
                                                                           href="#">Đặt là quản
                                                                            trị viên</a>
                                                                        <a class="dropdown-item change-role-account"
                                                                           data-id="{{$user->id}}" data-action="3"
                                                                           href="#">Đặt là người
                                                                            dùng</a>
                                                                        <div class="dropdown-divider"></div>
                                                                    @endcanany
                                                                    @if(\Illuminate\Support\Facades\Gate::check('Locked', $user))
                                                                        <a class="dropdown-item recoverAccount"
                                                                           data-id="{{$user->id}}" href="#">Khôi phục
                                                                            tài
                                                                            khoản</a>
                                                                        <a class="dropdown-item deleteAccount"
                                                                           data-id="{{$user->id}}" href="#">Xóa tài
                                                                            khoản</a>
                                                                    @else
                                                                        <a class="dropdown-item lockAccount"
                                                                           data-id="{{$user->id}}" href="#">Khóa tài
                                                                            khoản</a>
                                                                    @endif
                                                                </div>
                                                            @endunless
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <th style="width: 3%">#</th>
                                                <th style="width: 17%">Họ và Tên</th>
                                                <th style="width: 10%">Giới tính</th>
                                                <th style="width: 10%">Ngày sinh</th>
                                                <th style="width: 20%">Email</th>
                                                <th style="width: 13%">Điện thoại</th>
                                                <th style="width: 12%">Trạng thái</th>
                                                <th style="width: 15%">Hành động</th>
                                            </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
