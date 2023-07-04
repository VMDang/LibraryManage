@extends("layouts.footer")

@section('title-page')
    <title> Edit Books | Library Manage</title>
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
<div class="ml-20" style="width:80% ; margin-left:20% ; margin-top:5%">
  <div class="card-header">Edit Books</div>
  <div class="card-body">
       
      <form action="{{ url('books/' .$books->id) }}" method="post" style="width:50%">
        {!! csrf_field() !!}
        @method("PATCH")
        
        <label>Category Id</label></br>
        <input type="text" name="category_id" id="category_id" value="{{$books->category_id}}" class="form-control"></br>
        <label>Shelf Id</label></br>
        <input type="text" name="shelf_id" id="shelf_id" value="{{$books->shelf_id}}" class="form-control"></br>
        <label>Title</label></br>
        <input type="text" name="title" id="title" value="{{$books->title}}" class="form-control"></br>
        <label>Preview Content</label></br>
        <input type="text" name="preview_content" id="preview_content" value="{{$books->preview_content}}" class="form-control"></br>
        <label>File Book</label></br>
        <input type="text" name="file_book" id="file_book" value="{{$books->file_book}}" class="form-control"></br>
        <label>Author</label></br>
        <input type="text" name="author" id="author" value="{{$books->author}}" class="form-control"></br>
        <label>Cost</label></br>
        <input type="text" name="cost" id="cost" value="{{$books->cost}}" class="form-control"></br>
        <label>Number</label></br>
        <input type="text" name="number" id="number" value="{{$books->number}}" class="form-control"></br>
        <input type="submit" value="Update" class="btn btn-success"></br>
    </form>
    
  </div>
</div>

@endsection