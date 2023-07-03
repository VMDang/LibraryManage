@extends("layouts.footer")

@section('title-page')
    <title> List Book | Library Manage</title>
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

        <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Danh sách các cuốn sách </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Danh sách cuốn sách </li>
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
                            <h3 class="card-title">Tìm kiếm sách</h3>
                        </div>
                        <form action="" method="post" id="formFilterBook">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" style="text-align: right">Tên sách :
                                                </label>
                                            <div class="col-sm-9">
                                                <input class="form-control" name="name" id="name"
                                                       value="{{ isset($filters['name']) ? $filters['name'] : '' }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group row">
                                            <label class="col-sm-5 col-form-label" style="text-align: right">Giá tiền :
                                                </label>
                                            <div class="col-sm-7">
                                                <input class="form-control" name="cost" id="cost"
                                                       value="{{ isset($filters['cost']) ? $filters['cost'] : '' }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label"
                                                   style="text-align: right">Tác giả: </label>
                                            <div class="col-sm-9">
                                                <input class="form-control" name="author" id="author"
                                                       value="{{ isset($filters['author']) ? $filters['author'] : '' }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label" style="text-align: right">Thể loại :  </label>
                                            <div class="col-sm-7">
                                                <select class="form-control" name="category" id="category">
                                                <option value="">Chọn thể loại</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
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
                                           aria-controls="custom-tabs-one-home" aria-selected="true">Sách
                                        </a>
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
                                                <th style="width: 17%">Tên sách</th>
                                                <th style="width: 15%">Tác giả </th>
                                                <th style="width: 20%">Thể loại</th>
                                                <th style="width: 10%">Giá tiền</th>
                                                <th style="width: 10%">Tình trạng</th>
                                                <th style="width: 15%">Hành động</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($books as $index => $book)
                                                <tr>
                                                    <td>{{$index}}</td>
                                                    <td>{{$book->name}}</td>
                                                    <td>{{$book->author}}</td>
                                                    <td>
                                                    @foreach ($book_categories as $book_category)
                                                        @if ($book_category->book_id == $book->id)
                                                           {{ $book_category->category->name }}<br>
                                                        @endif
                                                    @endforeach
                                                    </td>
                                                    <td>{{$book->cost}}</td>
                                                    <td>
                                                        @if($book->status==1)
                                                           Có thể mượn
                                                        @else
                                                           Hết
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <button type="button" class="btn btn-default"><a href="{{route('viewbook.detail', [$book->id, $book->name])}}">
                                                                    Xem chi tiết</a></button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach

                                            </tbody>
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
