@extends('layouts.footer')

@section('title-page')
    <title>Add Book | Library Manage</title>
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
    <!-- <script src="{{ asset('themes/plugins/daterangepicker/moment.min.js') }}"></script>
    <script src="{{ asset('themes/plugins/daterangepicker/daterangepicker.js') }}"></script> -->
    <script src="{{asset('js/book/list.js')}}" defer></script>
    
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Thêm sách</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-item active">Thêm sách</li>
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
                    <div class="card-header" style="text-align: center;">
                        <h3 class="card-title">Thông tin sách</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form class="form-horizontal" method="post" action="{{route('books.store')}}">
                            @csrf
                            <input type="hidden" id="book-id" name="book_id" value="">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fullName">Tên sách</label>
                                        <input type="text" class="form-control" id="name" value="" name="name">
                                    </div>
                                    <!-- /.form-group -->
                                    <div class="form-group">
                                        <label for="gender">Tác giả</label>
                                        <input class="form-control" type="text" id="author" value="" name="author" >
                                    </div>
                                    <!-- /.form-group -->
                                    <!-- Date -->
                                    <div class="form-group">
                                      <label>Nhà xuất bản</label>
                                      <input class="form-control" type="text" value="" name="publisher" id="publisher">
                                    </div>
                                    <!-- /.form-group -->
                                    <!-- /.form-group -->
                                </div>
                                <!-- /.col -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Ngày xuất bản</label>
                                        <input type="text" class="form-control" id="date_publication" value="" name="date_publication">
                                    </div>
                                    <div class="form-group">
                                        <label for="shelf">Vị trí</label>
                                        <select class="form-control select2" style="width: 100%;" id="shelf" name="shelf" >
                                            <option value="">-- Chọn vị trí --</option>
                                            @foreach ($shelfs as $shelf)
                                                <option value="{{ $shelf->id }}">{{ $shelf->location }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="shelf">Thể loại</label>
                                        <select class="form-control select2" style="width: 100%;" id="category" name="category" >
                                            <option value="">-- Chọn thể loại --</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->

                            <h5>Giới thiệu sách</h5>
                            <div class="form-group">
                                <textarea class="form-control" style="width: 100%;" name="preview_content"></textarea>
                                <!-- /.form-group -->
                            </div>
                            <div class="card-footer" style="text-align: center;">
                                <button type="submit" class="btn btn-primary">Add Book</button>
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
