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

    <script src="{{asset('js/book/list.js')}}" defer></script>
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

        {{--        <section class="content-section">--}}
        {{--            <div class="container-fluid">--}}
        {{--                <div class="row">--}}
        {{--                    <div class="col-12">--}}
        {{--                        <div class="card-header">--}}
        {{--                            <h3 class="card-title">Tìm kiếm sách</h3>--}}
        {{--                        </div> -->--}}
        {{--                        <form action="" method="post" id="formFilterBook">--}}
        {{--                            @csrf--}}
        {{--                            <div class="card-body">--}}
        {{--                                <div class="row">--}}
        {{--                                    <div class="col-lg-3">--}}
        {{--                                        <div class="form-group row">--}}
        {{--                                            <label class="col-sm-3 col-form-label" style="text-align: right">Tên sách :--}}
        {{--                                                </label>--}}
        {{--                                            <div class="col-sm-9">--}}
        {{--                                                <input class="form-control" name="name" id="name"--}}
        {{--                                                       value="{{ isset($filters['name']) ? $filters['name'] : '' }}">--}}
        {{--                                            </div>--}}
        {{--                                        </div>--}}
        {{--                                    </div>--}}
        {{--                                    <div class="col-lg-4">--}}
        {{--                                        <div class="form-group row">--}}
        {{--                                            <label class="col-sm-5 col-form-label" style="text-align: right">Giá tiền :--}}
        {{--                                                </label>--}}
        {{--                                            <div class="col-sm-7">--}}
        {{--                                                <input class="form-control" name="cost" id="cost"--}}
        {{--                                                       value="{{ isset($filters['cost']) ? $filters['cost'] : '' }}">--}}
        {{--                                            </div>--}}
        {{--                                        </div>--}}
        {{--                                    </div>--}}
        {{--                                    <div class="col-lg-5">--}}
        {{--                                        <div class="form-group row">--}}
        {{--                                            <label class="col-sm-3 col-form-label"--}}
        {{--                                                   style="text-align: right">Tác giả: </label>--}}
        {{--                                            <div class="col-sm-9">--}}
        {{--                                                <input class="form-control" name="author" id="author"--}}
        {{--                                                       value="{{ isset($filters['author']) ? $filters['author'] : '' }}">--}}
        {{--                                            </div>--}}
        {{--                                        </div>--}}
        {{--                                    </div>--}}
        {{--                                </div>--}}
        {{--                                <div class="row">--}}
        {{--                                    <div class="col-lg-3">--}}
        {{--                                        <div class="form-group row">--}}
        {{--                                            <label class="col-sm-4 col-form-label" style="text-align: right">Thể loại :  </label>--}}
        {{--                                            <div class="col-sm-7">--}}
        {{--                                                <select class="form-control" name="category" id="category">--}}
        {{--                                                <option value="">Chọn thể loại</option>--}}
        {{--                                                @foreach($categories as $category)--}}
        {{--                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>--}}
        {{--                                                @endforeach--}}
        {{--                                                </select>--}}
        {{--                                            </div>--}}
        {{--                                        </div>--}}
        {{--                                    </div>--}}

        {{--                                </div>--}}
        {{--                            </div>--}}
        {{--                            <div class="card-footer">--}}
        {{--                                    <div class="form-group row">--}}
        {{--                                        <label class="col-lg-1"></label>--}}
        {{--                                        <div class="col-sm-2">--}}
        {{--                                            <button type="submit" class="btn btn-primary" id="btnFilter"><i class="fa fa-search mr-1"></i>Tìm kiếm</button>--}}
        {{--                                        </div>--}}
        {{--                                        <div class="col-sm-2">--}}
        {{--                                            <button type="button" class="btn btn-default" id="btnReset"><i class="fa fa-undo mr-1"></i>Đặt lại</button>--}}
        {{--                                        </div>--}}
        {{--                                    </div>--}}
        {{--                            </div>--}}
        {{--                        </form>--}}
        {{--                    </div>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--        </section>--}}

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
                                        <table id="tableListBooks" class="table table-bordered table-striped">
                                            <thead>
                                            <tr>
                                                <th style="width: 3%">#</th>
                                                <th >Tên sách</th>
                                                <th>Tác giả </th>
                                                <th>Nhà xuất bản</th>
{{--                                                <th> Ngày xuất bản</th>--}}
                                                <th>Thể loại</th>
                                                <th>Vị trí</th>
                                                <th>Số lượng</th>
                                                <th>Tình trạng</th>
                                                <th style="width:11%">Hành động</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($books as $index => $book)
                                                <tr>
                                                    <td>{{++$index}}</td>
                                                    <td>{{$book->name}}</td>
                                                    <td>{{$book->author}}</td>
                                                    <td>{{$book->publisher}}</td>
{{--                                                    <td>{{date('d/m/Y', strtotime($book->date_publication))}}</td>--}}
                                                    <td>
                                                        @foreach ($book_categories as $book_category)
                                                            @if ($book_category->book_id == $book->id)
                                                                {{ $book_category->category->name }}<br>
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        @foreach ($books_shelf as $bs)
                                                            @if ($bs->book_id == $book->id)
                                                                {{ $bs->shelf->location }}<br>
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                    <td style="text-align: center">{{$book->number}}</td>
                                                    @if($book->status==1 && $book->number > 0)
                                                        <td style="color: blue">Có thể mượn</td>
                                                    @elseif($book->number == 0)
                                                        <td style="color: red"> Đã hết</td>
                                                    @endif
                                                    <td>
                                                        <a href="{{route('books.detail', [$book->id, $book->name])}}" style="display: inline-block">
                                                            <button type="button" class="btn btn-outline-info btnView" data-id=""
                                                                    data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Xem chi tiết">
                                                                <i class="fas fa-eye"></i>
                                                            </button>
                                                        </a>
                                                        <button type="button" class="btn btn-outline-primary btnBorrowBook" data-book-id="{{$book->id}}" data-user-id="0"
                                                                data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Yêu cầu mượn sách">
                                                                <i class="fas fa-file-export"></i>
                                                        </button>
                                                        @cannot('isUser')
                                                            <a href="{{route('books.edit', $book->id)}}" style="display: inline-block">
                                                                <button type="button" class="btn btn-outline-success btnEdit" data-id=""
                                                                        data-toggle="popover" data-trigger="hover" data-placement="bottom" data-content="Chỉnh sửa">
                                                                    <i class="fas fa-edit"></i>
                                                                </button>
                                                            </a>
                                                            <form action="{{route('books.destroy', $book->id)}}" method="post" style="display: inline-block">
                                                                @csrf
                                                                <button type="submit" class="btn btn-outline-danger btnDelete" data-id=""
                                                                        data-toggle="popover" data-trigger="hover" data-placement="bottom" data-content="Xóa cuốn sách">
                                                                    <i class="fas fa-trash"></i>
                                                                </button>
                                                            </form>
                                                        @endcannot
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

        <div class="modal fade" id="modalBorrowBook">
            <div class="modal-dialog modal-lg" style="width: 70%; max-width: 90%;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modalBorrowBookTitle">Tạo yêu cầu mượn sách</h4>
                        <button type="button" class="close closeModal" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form class="form-horizontal" method="post" action="{{route('borrow.store')}}">
                        @csrf
                        <div class="modal-body">
                            <input type="hidden" id="book_id" class="form-control" name="book_id" value="">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <label class="col-lg-3 col-form-label" for="name" id="">Họ và Tên</label>
                                        <div class="form-group col-lg-9">
                                            <input type="text" name="name" id="name" class="form-control" readonly>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <label class="col-lg-3 col-form-label" for="gender">Giới tính</label>
                                        <div class="form-group col-lg-9" style="height: 38px;">
                                            <div class="icheck-primary d-inline">
                                                <input type="radio" id="gender1" name="gender" value="1" checked>
                                                <label for="gender1" style="margin-right: 10px">
                                                    Nam
                                                </label>
                                            </div>
                                            <div class="icheck-primary d-inline">
                                                <input type="radio" id="gender2" name="gender" value="0">
                                                <label for="gender2">
                                                    Nữ
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label for="birthday" class="col-sm-3 col-form-label">Ngày sinh</label>
                                        <div class="form-group col-lg-9">
                                            <input type="date" name="birthday" id="birthday" class="form-control" disabled>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <label class="col-lg-3 col-form-label" for="email">Email</label>
                                        <div class="form-group col-lg-9">
                                            <input type="email" name="email" id="email" class="form-control" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <label class="col-lg-3 col-form-label" for="book">Tên sách</label>
                                        <div class="form-group col-lg-9">
                                            <input type="text" name="book-name" id="book-name" class="form-control" readonly>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <label class="col-lg-3 col-form-label" for="author">Tác giả</label>
                                        <div class="form-group col-lg-9">
                                            <input type="text" name="author" id="author" class="form-control" readonly>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <label class="col-lg-3 col-form-label" for="book_location">Vị trí</label>
                                        <div class="form-group col-lg-9">
                                            <input type="text" name="book_location" id="book_location" class="form-control" value="N/A" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="row">
                                        <label class="col-lg-6 col-form-label" for="message_user">Lời nhắn gửi đến người kiểm duyệt</label>
                                        <div class="form-group col-lg-12">
                                            <textarea class="form-control" style="width: 100%;" id="message_user" name="message_user"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default closeModal" data-dismiss="modal">Đóng
                            </button>

                            <button type="submit" class="btn btn-primary" id="btnSave"><i class="fas fa-save"></i>
                                Gửi yêu cầu
                            </button>
                        </div>
                    </form>

                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    </div>
    </div>
    <!-- /.content-wrapper -->
@endsection
