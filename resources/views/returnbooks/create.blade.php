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
<!-- 
</script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
            //Date picker
            $('#birthdayDate').datepicker({
                format: 'dd/mm/yyyy',
                autoclose: true
            });
            $('#birthdayDate .input-group-prepend button').click(function () {
            $('#birthdayDate').datepicker('show');
        });

        });
    //     $(document).ready(function () {
    //     $('#birthdayDate').datepicker({
    //         format: 'dd/mm/yyyy',
    //         autoclose: true
    //     });
    // });
    </script> -->
    <script>
        flatpickr("#myID");
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
                    <input type="hidden" name="borrow_id" value="{{$borrow_id}}">

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
                                    
                                    <input  class="form-control" style="background-color:white; color: black" value="{{$book->title}}" readonly>

                        
                                </div>
                                <!-- /.form-group -->
                                <div class="form-group">
                                    <label for="author" >Tác giả</label>
                                  <input class="form-control" style="background-color:white; color: black" value="{{$book->author}}" readonly>
                                    
                                </div>
                                <!-- /.form-group -->
                                <div class="form-group">
                                    <label>Vị trí</label>
                                    <input type="text" class="form-control select2" id="bookId" placeholder="Tầng 1, phòng 1, kệ 1" style="background-color:white ; color:black;" readonly>
                                </div>
                                <!-- /.form-group -->
                                
                    </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <h5>Lời nhắn gửi đến người kiểm duyệt</h5>
                        <div class="form-group">
                            <textarea class="form-control" name="message_user" placeholder="Bạn đọc gửi góp ý tại đây"  style="width: 100% ; background-color:white ; color:black;"></textarea>
                            <!-- /.form-group -->
                        </div>
                        
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer" style="text-align: center;">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    </form>
                    
                </div>
                <!-- /.card -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection