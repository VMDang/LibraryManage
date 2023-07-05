@extends("layouts.footer")

@section('title-page')
    <title>Book Detail | Library Manage</title>
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
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">

                        <!-- Profile Image -->
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <img
                                        src="{{asset('img/123.webp')}}"
                                        alt="Book Avatar"
                                        style="max-width:100%;height:auto;">

                                </div>

                                <h3 class="profile-username text-center">{{$book->name}}</h3>

                                <p class="text-muted text-center">Book</p>

                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                    </div>
                    <!-- /.col -->
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header p-2">
                                <ul class="nav nav-pills">
                                    <li class="nav-item"><a class="nav-link active" href="#infoUser" data-toggle="tab">Thông
                                            tin sách</a></li>
                                </ul>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="tab-content">

                                    {{--tab info User: Thông tin của người dùng--}}
                                    <div class="active tab-pane" id="infoUser">
                                        <ul class="list-group">
                                            <li class="list-group-item">
                                                <div class="row">
                                                    <div class="col-sm-2"><i class="fas fa-book"
                                                                             style="margin-left: 2px"></i><b> Tên
                                                            sách : </b></div>
                                                    <div
                                                        class="col-sm-10">{{$book->name}}</div>
                                                </div>
                                            </li>
                                            <li class="list-group-item">
                                                <div class="row">
                                                    <div class="col-sm-2"><i class="fas fa-user"
                                                                             style="margin-left: 2px"></i><b> Tác

                                                            giả : </b></div>
                                                    <div class="col-sm-10">{{$book->author}}</div>
                                                </div>
                                            </li>
                                            <li class="list-group-item">
                                                <div class="row">
                                                    <div class="col-sm-2"><i class="fas fa-tags"
                                                                             style="margin-left: 2px"></i><b>
                                                            Thể
                                                            loại : </b></div>
                                                    <div
                                                        class="col-sm-10">
                                                        @foreach ($book_categories as $book_category)
                                                            @if ($book_category->book_id == $book->id)
                                                                {{ $book_category->category->name }}<br>
                                                            @endif
                                                        @endforeach</div>
                                                </div>
                                            </li>
                                            <li class="list-group-item">
                                                <div class="row">
                                                    <div class="col-sm-2"><i class="fas fa-dollar-sign"
                                                                             style="margin-left: 2px"></i><b>
                                                            Giá : </b></div>
                                                    <div class="col-sm-10">{{$book->cost}}</div>
                                                </div>
                                            </li>
                                            <li class="list-group-item">
                                                <div class="row">
                                                    <div class="col-sm-2"><i class="fas fa-check"
                                                                             style="margin-left: 2px"></i><b> Trạng
                                                            thái: </b></div>
                                                    <div class="col-sm-10">
                                                        @if($book->status==1)
                                                            Có thể mượn
                                                        @else
                                                            Hết
                                                        @endif </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item">
                                                <div class="row">
                                                    <div class="col-sm-2"><i class="fas fa-map-marker-alt mr-1"
                                                                             style="margin-left: 2px"></i><b>
                                                            Vị trí : </b></div>
                                                    <div class="col-sm-10">
                                                        @foreach ($shelf_books as $shelf_book)
                                                            @if ($shelf_book->book_id == $book->id)
                                                                {{ $shelf_book->shelf->location }}<br>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </li>

                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.col -->
        </section>
        <!-- /.content -->
    </div>
@endsection

