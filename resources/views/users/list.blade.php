@extends("layouts.footer")

@section('title-page')
    <title> List User | Library Manage</title>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('themes/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
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

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header p-0 pt-1">
                                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#tab-all-users-not-delete" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Tất cả người dùng</a>
                                    </li>
                                    @cannot('isUser')
                                        <li class="nav-item">
                                            <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#tab-all-users-deleted" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Soft Deleted</a>
                                        </li>
                                    @endcannot
                                    <li class="nav-item">
                                        <a class="nav-link" id="custom-tabs-one-messages-tab" data-toggle="pill" href="#tab-all-admin" role="tab" aria-controls="custom-tabs-one-messages" aria-selected="false">Admin</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="custom-tabs-one-settings-tab" data-toggle="pill" href="#tab-all-mod" role="tab" aria-controls="custom-tabs-one-settings" aria-selected="false">Moderator</a>
                                    </li>
                                </ul>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="tab-content" id="custom-tabs-one-tabContent">
                                    <div class="tab-pane fade show active" id="tab-all-users-not-delete" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
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
                                                            <button type="button" class="btn btn-default"><a href="{{route('user.profile', [$user->id, $user->name])}}">Xem chi tiết</a> </button>
                                                            <button type="button" class="btn btn-default dropdown-toggle dropdown-hover dropdown-icon" data-toggle="dropdown">
                                                            </button>
                                                            <div class="dropdown-menu" role="menu">
                                                                <a class="dropdown-item" href="#">Action</a>
                                                                <a class="dropdown-item" href="#">Another action</a>
                                                                <a class="dropdown-item" href="#">Something else here</a>
                                                                <div class="dropdown-divider"></div>
                                                                <a class="dropdown-item" href="#">Separated link</a>
                                                            </div>
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
                                        <div class="tab-pane fade" id="tab-all-users-deleted" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                                            <table id="tableListUsersSoftDeleted" class="table table-bordered table-striped">
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
                                    <div class="tab-pane fade" id="tab-all-admin" role="tabpanel" aria-labelledby="custom-tabs-one-messages-tab">
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
                                                            <button type="button" class="btn btn-default"><a href="{{route('user.profile', [$user->id, $user->name])}}">Xem chi tiết</a> </button>
                                                            <button type="button" class="btn btn-default dropdown-toggle dropdown-hover dropdown-icon" data-toggle="dropdown">
                                                            </button>
                                                            <div class="dropdown-menu" role="menu">
                                                                <a class="dropdown-item" href="#">Action</a>
                                                                <a class="dropdown-item" href="#">Another action</a>
                                                                <a class="dropdown-item" href="#">Something else here</a>
                                                                <div class="dropdown-divider"></div>
                                                                <a class="dropdown-item" href="#">Separated link</a>
                                                            </div>
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
                                    <div class="tab-pane fade" id="tab-all-mod" role="tabpanel" aria-labelledby="custom-tabs-one-settings-tab">
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
                                                            <button type="button" class="btn btn-default"><a href="{{route('user.profile', [$user->id, $user->name])}}">Xem chi tiết</a> </button>
                                                            <button type="button" class="btn btn-default dropdown-toggle dropdown-hover dropdown-icon" data-toggle="dropdown">
                                                            </button>
                                                            <div class="dropdown-menu" role="menu">
                                                                <a class="dropdown-item" href="#">Action</a>
                                                                <a class="dropdown-item" href="#">Another action</a>
                                                                <a class="dropdown-item" href="#">Something else here</a>
                                                                <div class="dropdown-divider"></div>
                                                                <a class="dropdown-item" href="#">Separated link</a>
                                                            </div>
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
