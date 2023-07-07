@extends('layouts.footer')

@section('title-page')
    <title>Borrow Book | Library Manage</title>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('themes/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/plugins/daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/dist/css/adminlte.min.css') }}">
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
{{--    <script src="{{ asset('themes/plugins/daterangepicker/moment.min.js') }}"></script>--}}
{{--    <script src="{{ asset('themes/plugins/daterangepicker/daterangepicker.js') }}"></script>--}}
    <script src="{{asset('js/borrow/create.js')}}" defer></script>
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Phiếu mượn sách</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-item active">Phiếu mượn sách</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- SELECT2 EXAMPLE -->
                <div class="card card-default">
                    <div class="card-header" style="text-align: center; background-color:SteelBlue;">
                        <h3 class="card-title">Thông tin phiếu mượn sách</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form class="form-horizontal" method="post" action="{{route('borrow.store')}}">
                            @csrf
                            <input type="hidden" id="book-id" name="book_id" value="">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fullName">Họ tên</label>
                                        <input type="text" class="form-control" id="fullName" value="{{$user->name}}" readonly >
                                    </div>
                                    <!-- /.form-group -->
                                    <div class="form-group">
                                        <label for="gender">Giới tính</label>
                                        <input class="form-control" type="text" value="{{$user->gender ? 'Nam' : 'Nữ'}}" readonly >
                                    </div>
                                    <!-- /.form-group -->
                                    <!-- Date -->
                                    <div class="form-group">
                                      <label>Ngày sinh</label>
                                      <input class="form-control" type="text" value="{{date('d/m/Y', strtotime($user->birthday))}}" readonly >
                                    </div>
                                    <!-- /.form-group -->
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" value="{{$user->email}}" readonly>
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                                <!-- /.col -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="book">Tên sách</label>
                                        <select class="form-control select2" id="select-book-id"  style="width: 100%;" name="book-name">
                                            <option data-id="0" selected="selected">Tên sách</option>
                                            @foreach($books as $book)
                                                <option data-id="{{$book->id}}" data-author="{{$book->author}}">{{$book->name}}</option>
                                            @endforeach
                                        </select>

                                        @if ($errors->any())
                                            <ul class="alert-danger" style="border-radius: 4px; margin-bottom: 0px">
                                                <li class="alert-danger">{{ $errors->first('book_id') }}</li>
                                            </ul>
                                        @endif

                                    </div>
                                    <!-- /.form-group -->
                                    <div class="form-group">
                                        <label for="author">Tác giả</label>
                                        <input class="form-control" id="input-author" type="text" value="" readonly >
                                    </div>
                                    <!-- /.form-group -->
                                    <div class="form-group">
                                        <label for="location">Vị trí</label>
                                        <select class="form-control select2" id="select-book-location"  style="width: 100%;" name="book_location">

                                        </select>
                                        @if ($errors->any())
                                            <ul class="alert-danger" style="border-radius: 4px; margin-bottom: 0px">
                                                <li class="alert-danger">{{ $errors->first('book_location') }}</li>
                                            </ul>
                                        @endif
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->

                            <h5>Lời nhắn gửi đến người kiểm duyệt</h5>
                            <div class="form-group">
                                <textarea class="form-control" style="width: 100%;" name="message_user"></textarea>
                                <!-- /.form-group -->
                            </div>
                            <div class="card-footer" style="text-align: center;">
                                <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-2"></i>Gửi yêu cầu</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card-body -->

                </div>
                <!-- /.card -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
