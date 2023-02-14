@extends("layouts.footer")

@section('title-page')
    <title>User Profile | Library Manage</title>
@endsection

@section('script')
    <script src="{{asset('js/user/profile.js')}}" defer></script>
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Thông tin người dùng</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Trang chủ</a></li>
                            <li class="breadcrumb-item active">Thông tin cá nhân</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">

                        <!-- Profile Image -->
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle"
                                         src="{{ asset($user->image) }}"
                                         alt="User Avatar">
                                </div>

                                <h3 class="profile-username text-center">{{$user->name }}</h3>

                                <p class="text-muted text-center">Student</p>
                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <b>Sách đang mượn</b> <a href="#" class="float-right">link</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Vai trò</b> <a class="float-right">
                                            @if($user->role_id == 1)
                                                Admin
                                            @elseif($user->role_id == 2)
                                                Moderator
                                            @else
                                                Người dùng
                                            @endif
                                        </a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Trạng thái</b> <a
                                            class="float-right"><?php echo $user->status ? '<span style="color:green;">Bình thường</span>' : '<span style="color:red;">Tạm thời khóa</span>' ?></a>
                                    </li>
                                </ul>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                        <!-- About Me Box -->
                        {{--                        <div class="card card-primary">--}}
                        {{--                            <div class="card-header">--}}
                        {{--                                <h3 class="card-title">About Me</h3>--}}
                        {{--                            </div>--}}
                        {{--                            <!-- /.card-header -->--}}
                        {{--                            <div class="card-body">--}}
                        {{--                                <strong><i class="fas fa-book mr-1"></i> Education</strong>--}}

                        {{--                                <p class="text-muted">--}}
                        {{--                                    B.S. in Computer Science from the University of Tennessee at Knoxville--}}
                        {{--                                </p>--}}

                        {{--                                <hr>--}}

                        {{--                                <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>--}}

                        {{--                                <p class="text-muted">Malibu, California</p>--}}

                        {{--                                <hr>--}}

                        {{--                                <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>--}}

                        {{--                                <p class="text-muted">--}}
                        {{--                                    <span class="tag tag-danger">UI Design</span>--}}
                        {{--                                    <span class="tag tag-success">Coding</span>--}}
                        {{--                                    <span class="tag tag-info">Javascript</span>--}}
                        {{--                                    <span class="tag tag-warning">PHP</span>--}}
                        {{--                                    <span class="tag tag-primary">Node.js</span>--}}
                        {{--                                </p>--}}

                        {{--                                <hr>--}}

                        {{--                                <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>--}}

                        {{--                                <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>--}}
                        {{--                            </div>--}}
                        {{--                            <!-- /.card-body -->--}}
                        {{--                        </div>--}}
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header p-2">
                                <ul class="nav nav-pills">
                                    <li class="nav-item"><a class="nav-link active" href="#infoUser" data-toggle="tab">Thông
                                            tin cá nhân</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#timeline1" data-toggle="tab">Timeline</a>
                                    </li>
                                    @if(\Illuminate\Support\Facades\Auth::id() == $user->id)
                                        <li class="nav-item ml-auto"><a class="nav-link" href="#updateInfoUser"
                                                                        data-toggle="tab">Cập nhật thông tin cá nhân</a>
                                        </li>
                                    @endif
                                </ul>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="tab-content">

                                    {{--tab info User: Thông tin của người dùng--}}
                                    <div class="active tab-pane" id="infoUser">
                                        <ul class="list-group">
                                            <li class="list-group-item">
                                                <div class="row">
                                                    <div class="col-sm-2"><i class="fas fa-user mr-1"
                                                                             style="margin-left: 2px"></i><b> Họ
                                                            tên: </b></div>
                                                    <div
                                                        class="col-sm-10">{{$user->name}}</div>
                                                </div>
                                            </li>
                                            <li class="list-group-item">
                                                <div class="row">
                                                    <div class="col-sm-2"><i class="fas fa-venus-mars mr-1"
                                                                             style="margin-left: -2px"></i><b> Giới
                                                            tính: </b></div>
                                                    <div class="col-sm-10">{{ $user->gender ? 'Nam' : 'Nữ'}}</div>
                                                </div>
                                            </li>
                                            <li class="list-group-item">
                                                <div class="row">
                                                    <div class="col-sm-2"><i class="fas fa-birthday-cake"
                                                                             style="margin-left: 1px; margin-right: 5px"></i><b>
                                                            Ngày
                                                            sinh: </b></div>
                                                    <div
                                                        class="col-sm-10">{{date('d/m/Y', strtotime($user->birthday))}}</div>
                                                </div>
                                            </li>
                                            <li class="list-group-item">
                                                <div class="row">
                                                    <div class="col-sm-2"><i class="fas fa-envelope mr-1"></i><b>
                                                            Email: </b></div>
                                                    <div class="col-sm-10">{{$user->email}}</div>
                                                </div>
                                            </li>
                                            <li class="list-group-item">
                                                <div class="row">
                                                    <div class="col-sm-2"><i class="fas fa-phone mr-1"></i><b> Số điện
                                                            thoại: </b></div>
                                                    <div class="col-sm-10">{{$user->phone}}</div>
                                                </div>
                                            </li>
                                            <li class="list-group-item">
                                                <div class="row">
                                                    <div class="col-sm-2"><i class="fas fa-map-marker-alt mr-1"
                                                                             style="margin-left: 3px"></i><b>
                                                            Địa chỉ: </b></div>
                                                    <div class="col-sm-10">{{$user->address}}</div>
                                                </div>
                                            </li>
                                            @cannot('isUser')
                                                <li class="list-group-item">
                                                    <div class="row">
                                                        @canany(['UPDATE_OTHER_ACC', 'isAdmin'])
                                                            <div class="btn-group">
                                                                <button type="button" class="btn btn-info"><i class="fa fa-user-tag mr-1"></i>Cập nhật vai trò</button>
                                                                <button type="button" class="btn btn-info dropdown-toggle dropdown-hover dropdown-icon" data-toggle="dropdown">
                                                                    <span class="sr-only">Toggle Dropdown</span>
                                                                </button>
                                                                <div class="dropdown-menu" role="menu">
                                                                    <button type="button" class="dropdown-item btn-change-role" value="1" data-id ="{{$user->id}}">
                                                                        Chỉ định làm quản trị viên
                                                                    </button>
                                                                    <button type="button" class="dropdown-item btn-change-role" value="2" data-id ="{{$user->id}}">
                                                                        Chỉ định làm người kiểm duyệt
                                                                    </button>
                                                                    <button type="button" class="dropdown-item btn-change-role" value="3" data-id ="{{$user->id}}">
                                                                        Chỉ định làm người dùng
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        @endcanany
                                                        @can('DEL_OTHER_ACC')
                                                            @unless(\Illuminate\Support\Facades\Gate::any(['isAdmin', 'isMod'], $user) && \Illuminate\Support\Facades\Gate::check('isMod'))
                                                                @if(\Illuminate\Support\Facades\Gate::check('Locked', $user))
                                                                    <div class="col-sm-3">
                                                                        <button type="button" class="btn btn-block btn-primary"
                                                                                id="btnRecoverAccount" data-id ="{{$user->id}}" style="background: green">
                                                                            <i class="fa fa-user-lock"></i> Khôi phục
                                                                            tài khoản
                                                                        </button>
                                                                    </div>
                                                                        <div class="col-sm-3">
                                                                            <button type="button" class="btn btn-block btn-danger"
                                                                                    id="btnDeleteAccount" data-id ="{{$user->id}}">
                                                                                <i class="fa fa-user-slash"></i> Xóa tài
                                                                                khoản
                                                                            </button>
                                                                        </div>
                                                                @else
                                                                    <div class="col-sm-3">
                                                                        <button type="button" class="btn btn-block btn-warning"
                                                                                id="btnLockAccount" data-id ="{{$user->id}}">
                                                                            <i class="fa fa-user-lock"></i> Khóa tài
                                                                            khoản
                                                                        </button>
                                                                    </div>
                                                                @endif
                                                            @endunless
                                                        @endcan
                                                    </div>
                                                </li>
                                            @endcannot
                                        </ul>
                                    </div>

                                    <!-- /.tab-pane -->
                                    <div class="tab-pane" id="timeline1">
                                        <!-- The timeline -->
                                        <div class="timeline timeline-inverse">
                                            <!-- timeline time label -->
                                            <div class="time-label">
                        <span class="bg-danger">
                          10 Feb. 2014
                        </span>
                                            </div>
                                            <!-- /.timeline-label -->
                                            <!-- timeline item -->
                                            <div>
                                                <i class="fas fa-envelope bg-primary"></i>

                                                <div class="timeline-item">
                                                    <span class="time"><i class="far fa-clock"></i> 12:05</span>

                                                    <h3 class="timeline-header"><a href="#">Support Team</a> sent you an
                                                        email</h3>

                                                    <div class="timeline-body">
                                                        Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                                                        weebly ning heekya handango imeem plugg dopplr jibjab, movity
                                                        jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo
                                                        kaboodle
                                                        quora plaxo ideeli hulu weebly balihoo...
                                                    </div>
                                                    <div class="timeline-footer">
                                                        <a href="#" class="btn btn-primary btn-sm">Read more</a>
                                                        <a href="#" class="btn btn-danger btn-sm">Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- END timeline item -->
                                            <!-- timeline item -->
                                            <div>
                                                <i class="fas fa-user bg-info"></i>

                                                <div class="timeline-item">
                                                    <span class="time"><i class="far fa-clock"></i> 5 mins ago</span>

                                                    <h3 class="timeline-header border-0"><a href="#">Sarah Young</a>
                                                        accepted your friend request
                                                    </h3>
                                                </div>
                                            </div>
                                            <!-- END timeline item -->
                                            <!-- timeline item -->
                                            <div>
                                                <i class="fas fa-comments bg-warning"></i>

                                                <div class="timeline-item">
                                                    <span class="time"><i class="far fa-clock"></i> 27 mins ago</span>

                                                    <h3 class="timeline-header"><a href="#">Jay White</a> commented on
                                                        your post</h3>

                                                    <div class="timeline-body">
                                                        Take me to your leader!
                                                        Switzerland is small and neutral!
                                                        We are more like Germany, ambitious and misunderstood!
                                                    </div>
                                                    <div class="timeline-footer">
                                                        <a href="#" class="btn btn-warning btn-flat btn-sm">View
                                                            comment</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- END timeline item -->
                                            <!-- timeline time label -->
                                            <div class="time-label">
                        <span class="bg-success">
                          3 Jan. 2014
                        </span>
                                            </div>
                                            <!-- /.timeline-label -->
                                            <!-- timeline item -->
                                            <div>
                                                <i class="fas fa-camera bg-purple"></i>

                                                <div class="timeline-item">
                                                    <span class="time"><i class="far fa-clock"></i> 2 days ago</span>

                                                    <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new
                                                        photos</h3>

                                                    <div class="timeline-body">
                                                        <img src="http://placehold.it/150x100" alt="...">
                                                        <img src="http://placehold.it/150x100" alt="...">
                                                        <img src="http://placehold.it/150x100" alt="...">
                                                        <img src="http://placehold.it/150x100" alt="...">
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- END timeline item -->
                                            <div>
                                                <i class="far fa-clock bg-gray"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.tab-pane -->

                                    {{--tab Update infoUser: Chỉnh sửa thông tin cá nhân người dùng Thông tin người dùng--}}
                                    @if(\Illuminate\Support\Facades\Auth::id() == $user->id)
                                        <div class="tab-pane" id="updateInfoUser">
                                            <form class="form-horizontal" action="" method="post"
                                                  id="formUpdateInfoUser" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="id" value="{{$user->id}}">
                                                <div class="row">
                                                    <label for="name" class="col-sm-2 col-form-label">Họ và Tên:</label>
                                                    <div class="form-group col-sm-10">
                                                        <input type="text" class="form-control" name="name"
                                                               id="name" placeholder="Họ và Tên"
                                                               value="{{$user->name}}">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <label for="gender1" class="col-sm-2 col-form-label">Giới
                                                        tính:</label>
                                                    <div class="form-group col-sm-10">
                                                        <div class="icheck-primary d-inline">
                                                            <input type="radio" id="gender1" name="gender" value="1"
                                                                   @if($user->gender) checked @endif>
                                                            <label for="gender1" style="margin-right: 10px">
                                                                Nam
                                                            </label>
                                                        </div>
                                                        <div class="icheck-primary d-inline">
                                                            <input type="radio" id="gender2" name="gender" value="0"
                                                                   @if(!$user->gender) checked @endif>
                                                            <label for="gender2">
                                                                Nữ
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <label for="birthday" class="col-sm-2 col-form-label">Ngày
                                                        sinh: </label>
                                                    <div class="form-group col-sm-10">
                                                        <div class="input-group date" id="birthdayDate"
                                                             data-target-input="nearest">
                                                            <div class="input-group-append" data-target="#birthdayDate"
                                                                 data-toggle="datetimepicker">
                                                                <div class="input-group-text">
                                                                    <i class="fa fa-calendar"></i>
                                                                </div>
                                                            </div>
                                                            <input type="text" class="form-control datetimepicker-input"
                                                                   id="birthday" name="birthday"
                                                                   data-target="#birthdayDate"
                                                                   data-toggle="datetimepicker" data-min="01/01/1950"
                                                                   value="{{date('d/m/Y', strtotime($user->birthday))}}"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                                                    <div class="form-group col-sm-10">
                                                        <input type="email" class="form-control" name="email" id="email"
                                                               placeholder="Email" value="{{$user->email}}" readonly>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <label for="phone" class="col-sm-2 col-form-label">Số điện
                                                        thoại:</label>
                                                    <div class="form-group col-sm-10">
                                                        <input type="text" class="form-control" name="phone" id="phone"
                                                               placeholder="Số điện thoại" value="{{$user->phone}}">
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <label for="address" class="col-sm-2 col-form-label">Địa
                                                        chỉ:</label>
                                                    <div class="form-group col-sm-10">
                                                    <textarea class="form-control" name="address" id="address"
                                                              placeholder="Địa chỉ">{{$user->address}}</textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="offset-sm-2 col-sm-10">
                                                        <button type="submit" class="btn btn-danger" id="btnSubmit">Cập
                                                            nhật
                                                        </button>
                                                    </div>
                                                </div>

                                            </form>
                                        </div>
                                    @endif
                                    <!-- /.tab-pane -->
                                </div>
                                <!-- /.tab-content -->
                            </div><!-- /.card-body -->
                        </div>
                        <!-- /.nav-tabs-custom -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection

