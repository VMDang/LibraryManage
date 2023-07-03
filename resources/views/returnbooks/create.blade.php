@extends('layouts.footer')

@section('title-page')
    <title>Return Book | Library Manage</title>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('themes/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/plugins/daterangepicker/daterangepicker.css') }}">
    <!-- <link rel="stylesheet" href="{{ asset('themes/plugins/daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" type="text/css" href="/jquery.datetimepicker.css"/> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/material_blue.css">
    

@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script src="{{ asset('themes/plugins/daterangepicker/moment.min.js') }}"></script>
    <script src="{{ asset('themes/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="/jquery.js"></script>
    <script src="/build/jquery.datetimepicker.full.min.js"></script>
    <script>
        flatpickr("#myID");
    </script>
    
    <script>
        // khi chọn tên sách
        document.getElementById('select-book-id').addEventListener('change', function() {
            var selectedOption = this.options[this.selectedIndex];
            var author = selectedOption.getAttribute('data-author');
            var borrowId = selectedOption.getAttribute('data-borrow_id');
        // Thay đổi giá trị của trường tác giả và borrow_id
            document.getElementById('input-author').value = author;
            document.getElementById('input-borrow_id').value = borrowId;
        });
\
    </script>
    
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Phiếu trả sách</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-item active">Phiếu trả sách</li>
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
                        <h3 class="card-title">Thông tin phiếu trả sách</h3>
                    </div>
                    <!-- /.card-header -->
                    <form class="form-returnbook" action="{{route('return.store')}}" method="POST"
                                id="form-id" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="borrow_id" >

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="fullName">Họ tên</label>
                                    <input type="text" class="form-control" id="fullName"  style="background-color:white ; color:black;"  value="{{$user->name}}" readonly >
                                </div>
                                <!-- /.form-group -->
                                <div class="form-group">
                                    <label for="gender">Giới tính</label>
                                    <input id="gender" class="form-control" required style="background-color:white ; color:black;" value="{{ $user->gender ? 'Nam' : 'Nữ'}}" readonly >


                                </div>
                                <!-- /.form-group -->
                                <!-- Date -->
                                <div class="form-group">
                                  <label>Ngày sinh</label>
                                  <input type="text" class="form-control select2" id="quantity" placeholder="yyyy/mm/dd" style="background-color:white ; color:black;" value="{{date('d/m/Y', strtotime($user->birthday))}}" readonly>

                                </div>
                                <!-- /.form-group -->
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email"  style="background-color:white ; color:black;" value="{{$user->email}}" readonly>
                                </div>
                                <!-- /.form-group -->
                                <!-- /.form-group -->
                            </div>
                            <!-- /.col -->
                           
                               <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="book">Tên sách</label>

                                        <select class="form-control select2" id="select-book-id"  style="width: 100%;" name="book-name">
                                            <option data-id="0" selected="selected">Tên sách</option>
                                             @foreach($returnInfo as $info)
                                              <option value="{{$info->book_id}}" data-borrow_id="{{$info->borrow_id}}" data-author="{{$info->author}}">{{$info->book_name}}</option>
                                             @endforeach

                                        </select>

                                        @if ($errors->any())
                                            {{--<div class="form-control">--}}
                                            <ul class="alert-danger" style="border-radius: 4px; margin-bottom: 0px">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                            {{--</div>--}}
                                        @endif
                                    </div>
                                    <!-- /.form-group -->
                                    <div class="form-group">
                                        <label for="author">Tác giả</label>
                                        <input class="form-control" id="input-author" type="text" value="" readonly >
                                    </div>
                                    <!-- /.form-group -->
                                    <div class="form-group">
                                        <label>Vị trí</label>
                                        <input type="text" class="form-control" id="quantity" value="Tầng 1 - Phòng 1 - Kệ 1" readonly />
                                    </div>
                                    <div class="form-group" style="display:none">
                                        <label for="borrow_id">Borrow ID</label>
                                        <input class="form-control" id="input-borrow_id" name="borrow_id" type="text" value="" readonly>
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

