@extends('layouts.footer')

@section('title-page')
    <title>Add Category | Library Manage</title>
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
    <script src="{{ asset('themes/plugins/daterangepicker/moment.min.js') }}"></script>
    <script src="{{ asset('themes/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{asset('js/category/category.js')}}" defer></script>
    <script>
        $(document).ready(function() {
        $('#categorySidebar').addClass('active');
    });
    </script>
    <script>
        function validateForm() {
        var name = document.getElementById('input-name');
        var description = document.getElementById('description');
        
        // Kiểm tra xem các trường đã được chọn hết hay chưa
        if (name.value === '' || description.value === '') {
            alert('Vui lòng chọn đầy đủ các trường!');
            return false; // Ngăn form được submit
        }
        return true; // Cho phép form được submit
        }
    </script>
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Thêm một thể loại </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-item active">thêm một thể loại</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content-->
        <section class="content">
            <div class="container-fluid">
                <!-- SELECT2 EXAMPLE -->
                <div class="card card-default">
                    <div class="card-header" style="text-align: center;">
                        <h3 class="card-title">Thông tin thể loại</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form class="form-horizontal" method="post" action="{{route('category.store')}}" onsubmit="return validateForm()">
                            @csrf
                            <div class="row">
                                <!--cot 1-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Tên thể loại</label>
                                        <input class="form-control" id="input-name" type="text" name="name" >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="status">Trạng thái</label>
                                        <select class="form-control select2" id="input-status"  style="width: 100%;" name="status">
                                            <option value=1 >Kích hoạt</option>
                                            <option value=0 >Không kích hoạt</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description">Mô tả</label>
                                <textarea class="form-control" style="width: 100%;min-height: 200px;" name="description"></textarea>
                            </div>
                            <div class="card-footer" style="text-align: center;">
                                <button type="submit" class="btn btn-primary">Thêm</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Main content-->
    </div>
@endsection
