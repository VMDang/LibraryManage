@extends("layouts.footer")

@section('title-page')
    <title> List Books | Library Manage</title>
@endsection

@section('style')
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
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


@endsection
@section('content')
    <?php $years = range(strftime("%Y", time()), 1930); ?>

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Danh sách</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Danh sách</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div style="padding-bottom:20px">
                                <a href="{{ url('/books/create') }}" class="btn btn-success btn-sm" title="Add New Book">
                                   Add New
                                </a>
                                    
                                </div>
                                <table id="tableListUser" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>                                           
                                       <th>STT</th>
                                       <th>Category</th>
                                       <th>Shelf</th>
                                       <th>Title</th>
                                       <th>Content</th>    
                                       <th>File_Book</th>      
                                       <th>Author</th>                                       
                                       <th>Cost</th>      
                                       <th>Number</th>  
                                       @cannot('isUser')
                                       <th>Kiểm duyệt</th>  
                                       @endcan                                                        
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
                                            @cannot('isUser')
                                            <td class='d-flex p-3 text-white'>
                                                <a href="{{ url('/books/' . $item->id . '/edit') }}">
                                                   <button class="btn btn-primary btn-sm mr-2"> Edit</button></a>             
                                                <form method="POST" action="{{ url('/books' . '/' . $item->id) }}" accept-charset="UTF-8">
                                                    {{ method_field('DELETE') }}
                                                    {{ csrf_field() }}
                                                    <button type="submit" class="btn btn-danger btn-sm" title="Delete books" onclick="return confirm("Confirm delete?")">
                                                       Delete
                                                    </button>
                                                </form>
                                            </td>
                                            @endcan
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    
                    </div>
                
                </div>
               
            </div>
          
            
    </div>


@endsection