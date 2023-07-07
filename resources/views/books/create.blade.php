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
    <script src="{{asset('js/book/create.js')}}" defer></script>

@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Tạo một cuốn sách</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-item active">Tạo một cuốn sách</li>
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
                                        @if ($errors->any())
                                            <ul class="alert-danger" style="border-radius: 4px; margin-bottom: 0px">
                                                <li class="alert-danger">{{ $errors->first('name') }}</li>
                                            </ul>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="gender">Tác giả</label>
                                        <input class="form-control" type="text" id="author" value="" name="author" >
                                        @if ($errors->any())
                                            <ul class="alert-danger" style="border-radius: 4px; margin-bottom: 0px">
                                                <li class="alert-danger">{{ $errors->first('author') }}</li>
                                            </ul>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                      <label for="publisher">Nhà xuất bản</label>
                                      <input class="form-control" type="text" value="" name="publisher" id="publisher">
                                    </div>
                                    <div class="form-group">
                                        <label for="date_publication">Ngày xuất bản</label>
                                        <input type="date" class="form-control" id="date_publication" value="" name="date_publication">
                                    </div>
                                </div>
                                <!-- /.col -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="number">Số lượng</label>
                                        <input class="form-control" type="number" value="number" name="number" id="number">
                                        @if ($errors->any())
                                            <ul class="alert-danger" style="border-radius: 4px; margin-bottom: 0px">
                                                <li class="alert-danger">{{ $errors->first('number') }}</li>
                                            </ul>
                                        @endif

                                    </div>
                                    <div class="form-group">
                                        <label for="cost">Giá tiền</label>
                                        <input class="form-control" type="number" value="cost" name="cost" id="cost">
                                        @if ($errors->any())
                                            <ul class="alert-danger" style="border-radius: 4px; margin-bottom: 0px">
                                                <li class="alert-danger">{{ $errors->first('cost') }}</li>
                                            </ul>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="shelf">Vị trí</label>
                                        <select class="form-control select2" style="width: 100%;" id="shelf" name="shelves[]" multiple="multiple" data-placeholder="--- Chọn vị trí ---">
                                            <option value="">-- Chọn vị trí --</option>
                                            @foreach ($shelves as $shelf)
                                                <option value="{{ $shelf->id }}">{{ $shelf->location }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->any())
                                            <ul class="alert-danger" style="border-radius: 4px; margin-bottom: 0px">
                                                <li class="alert-danger">{{ $errors->first('shelves') }}</li>
                                            </ul>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="category">Thể loại</label>
                                        <select class="form-control select2-blue" style="width: 100%;" id="category" name="categories[]" multiple="multiple" data-placeholder="--- Chọn thể loại ---">
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->any())
                                            <ul class="alert-danger" style="border-radius: 4px; margin-bottom: 0px">
                                                <li class="alert-danger">{{ $errors->first('categories') }}</li>
                                            </ul>
                                        @endif
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
                                <button type="submit" class="btn btn-primary" id="btnSave"><i class="fas fa-save mr-2"></i>
                                    Lưu thông tin
                                </button>
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
