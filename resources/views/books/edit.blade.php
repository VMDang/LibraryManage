@extends("layouts.footer")

@section('title-page')
    <title>Book Detail  | Library Manage</title>
@endsection



@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Thông tin sách</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Trang chủ</a></li>
                            <li class="breadcrumb-item active">Thông tin sách</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <!-- SELECT2 EXAMPLE -->
                <div class="card card-default">
                    <div class="card-header" style="text-align: center;">
                        <h3 class="card-title">Thông tin sách</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form class="form-horizontal" method="post" action="{{route('books.update',['id' => $book->id])}}">
                        @method('PUT')
                            @csrf
                            <input type="hidden" id="book-id" name="book_id" value="">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fullName">Tên sách</label>
                                        <input type="text" class="form-control" id="name" value="{{ $book->name}}" name="name">
                                    </div>
                                    <!-- /.form-group -->
                                    <div class="form-group">
                                        <label for="gender">Tác giả</label>
                                        <input class="form-control" type="text" id="author" value="{{ $book->author}}" name="author" >
                                    </div>
                                    <!-- /.form-group -->
                                    <!-- Date -->
                                    <div class="form-group">
                                      <label>Nhà xuất bản</label>
                                      <input class="form-control" type="text" value="" name="publisher" value="{{ $book->publisher}}"  id="publisher">
                                    </div>
                                    <!-- /.form-group -->
                                    <!-- /.form-group -->
                                </div>
                                <!-- /.col -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Ngày xuất bản</label>
                                        <input type="text" class="form-control" id="date_publication" value="{{ $book->date_publication}}" name="date_publication">
                                    </div>
                                    <div class="form-group">
                                        <label for="shelf">Vị trí</label>
                                        <select class="form-control select2" style="width: 100%;" id="shelf" name="shelf" >
                                            <option value="">-- Chọn vị trí --</option>
                                            @foreach ($shelf_books as $shelf_book)
                                                <!-- @if ($shelf_book->book_id == $book->id) -->
                                                <option value="{{ $shelf_book->shelf->location }}">{{ $shelf_book->shelf->location }}</option>
                                                <!-- @endif -->
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="shelf">Thể loại</label>
                                        <select class="form-control select2" style="width: 100%;" id="category" name="category" >
                                            <option value="">-- Chọn thể loại --</option>
                                            @foreach ($book_categories as $book_category)
                                                <option value="{{ $book_category->category->name }}">{{ $book_category->category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->

                            <h5>Giới thiệu sách</h5>
                            <div class="form-group">
                                <textarea class="form-control" style="width: 100%;" name="preview_content" value="{{ $book->preview_content}}"></textarea>
                                <!-- /.form-group -->
                            </div>
                            <div class="card-footer" style="text-align: center;">
                                <button type="submit" class="btn btn-primary">Update Book</button>
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
