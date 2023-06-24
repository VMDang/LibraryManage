@extends("layouts.footer")

@section('title-page')
    <title> Shelfs </title>
@endsection

@section('style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/material_blue.css">
    <style>
      #booksModal {
        background-color: rgba(255, 255, 255, 0.9); /* Màu nền trắng với độ mờ 90% */
        color: rgba(101, 101, 101, 0.9);
        max-width: 70%;
        margin: auto;
        border-radius: 15px; /* Border-radius là 15px */
        padding: 20px; /* Tùy chỉnh padding tùy theo nhu cầu */
      }
    </style>
@endsection

@section('script')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>

<script>
  $(document).ready(function() {
    $('.open-books-modal').on('click', function(e) {
        e.preventDefault();

        var shelfID = $(this).data('shelf-id');
        var bookList = $(this).data('book-list');

        // Hiển thị tên của category trong modal
        $('#modalShelfID').text($(this).closest('tr').find('td:nth-child(2)').text());

        // Hiển thị danh sách sách trong modal
        var modalBookList = $('#modalBookList');
        modalBookList.empty();

        bookList.forEach(function(book) {
            var row = $('<tr>');
            row.append('<td>' + book.name + '</td>');
            row.append('<td>' + book.category_id + '</td>');
            row.append('<td>' + book.preview_content + '</td>');
            row.append('<td>' + book.file_book + '</td>');
            row.append('<td>' + book.author + '</td>');
            row.append('<td>' + book.publisher + '</td>');
            row.append('<td>' + book.date_publication + '</td>');
            row.append('<td>' + book.cost + '</td>');
            row.append('<td>' + book.number + '</td>');
            row.append('<td>' + book.status + '</td>');

            modalBookList.append(row);
        });

        // Mở modal sách
        $.magnificPopup.open({
            items: {
                src: '#booksModal'
            },
            type: 'inline',
            midClick: true,
            closeBtnInside: true
        });
    });
  });
</script>
@endsection

@section('content')
<div class="content-wrapper">
  <!--header-->
  <section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6"> 
            <div class="card-header">
                <h2 class="card-title">Danh sách vị trí </h3>
            </div>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                <li class="breadcrumb-item active">danh sách vị trí</li>
            </ol>
          </div>
        </div>
    </div>  
  </section>  
  <!--End header-->   
  <!-- main content-->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                  <thead>
                      <tr>
                          <th>ID</th>
                          <th>Location</th>
                          <th>Status</th>
                          <th>Books</th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach($allShelfs as $shelf)
                      <tr>
                          <td>{{ $shelf->id }}</td>
                          <td>{{ $shelf->location  }}</td>
                          <td>{{ $shelf->status === 0 ? "Đầy" : "Còn trống" }}</td>
                          <td>
                              <a class="open-books-modal" href="#" data-shelf-id="{{ $shelf->id }}" data-book-list="{{ $booksByShelf[$shelf->id] }}">View Books</a>
                          </td>
                      </tr>
                      @endforeach
                  </tbody>
              </table>
          </div>
            <!-- /.card-body -->
        </div>  
          <!-- Books Modal -->
          <div id="booksModal" class="white-popup mfp-hide">
            <h2>Books for shelf: <span id="modalShelfID"></span></h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Categories</th>
                        <th>Preview Content</th>
                        <th>File Book</th>
                        <th>Author</th>
                        <th>Publisher</th>
                        <th>Date of Publication</th>
                        <th>Cost</th>
                        <th>Number</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody id="modalBookList">
                </tbody>
            </table>
          </div>
          <!-- End Books Modal -->
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--End main content-->
</div>
@endsection
