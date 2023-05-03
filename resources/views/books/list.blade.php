@extends("layouts.footer")

@section('title-page')
    <title> List Books | Library Manage</title>
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
    <?php $years = range(strftime("%Y", time()), 1930); ?>

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

        <section class="content-section">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card-header">
                            <h3 class="card-title">Tìm kiếm sách theo</h3>
                        </div>
                        <form action="" method="post" id="formFilterUser">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" style="text-align: right">
                                                Tên
                                            </label>
                                            <div class="col-sm-9">
                                                <input class="form-control" name="name" id="name"
                                                       value="{{ isset($filters['name']) ? $filters['name'] : '' }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group row">
                                            <label class="col-sm-5 col-form-label" style="text-align: right">
                                            Thể loại
                                            </label>
                                            <div class="col-sm-7">
                                                <input class="form-control" name="phone" id="phone"
                                                       value="{{ isset($filters['phone']) ? $filters['phone'] : '' }}">
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
                            
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="tab-content" id="custom-tabs-one-tabContent">
                                    <div class="tab-pane fade show active" id="tab-all-users-not-delete" role="tabpanel"
                                         aria-labelledby="custom-tabs-one-home-tab">
                                        <table id="tableListUsers" class="table table-bordered table-striped">
                                            <thead>
                                            <tr>                                           
                                               <th>#</th>
                                               <th>Category</th>
                                               <th>Shelf</th>
                                               <th>Title</th>
                                               <th>Content</th>    
                                               <th>File_Book</th>      
                                               <th>Author</th>                                       
                                               <th>Cost</th>      
                                               <th>Number</th>  
                                               <th></th>                                                          
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($books as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $item->category_id }}</td>
                                                    <td>{{ $item->shelf_id }}</td>
                                                    <td>{{ $item->title }}</td>
                                                    <td>{{ $item->preview_content }}</td>
                                                    <td>{{ $item->file_book }}</td>
                                                    <td>{{ $item->author }}</td>
                                                    <td>{{ $item->cost}}</td>
                                                    <td>{{ $item->number}}</td>
                                                    <td class='d-flex p-3 text-white'>
                                                        <a href="{{ url('/books/' . $item->id . '/edit') }}">
                                                           <button class="btn btn-primary btn-sm mr-2"> Edit</button></a>             
                                                        <form method="POST" action="{{ url('/books' . '/' . $item->id) }}" accept-charset="UTF-8">
                                                            {{ method_field('DELETE') }}
                                                            {{ csrf_field() }}
                                                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Student" onclick="return confirm("Confirm delete?")">
                                                               Delete
                                                            </button>
                                                        </form>
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


@endsection