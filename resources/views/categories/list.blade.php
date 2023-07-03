@extends("layouts.footer")

@section('title-page')
    <title> Categories </title>
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
      #updateModal {
        background-color: rgba(255, 255, 255, 0.9); /* Màu nền trắng với độ mờ 90% */
        color: rgba(101, 101, 101, 0.9);
        max-width: 70%;
        margin: auto;
        border-radius: 15px; /* Border-radius là 15px */
        padding: 20px; /* Tùy chỉnh padding tùy theo nhu cầu */
      }
      .deleteBtn:hover ion-icon {
          color: white;
      }
      
    </style>
@endsection

@section('script')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
  <script src="{{asset('js/category/category.js')}}" defer></script>  
@endsection

@section('content')
<div class="content-wrapper">
  @if(Session::has('error'))
                  <div id="error-alert" class="alert alert-danger" style="max-width: 400px; ">
                      {{ Session::get('error') }}
                  </div>
  @endif
  <!--header-->
  <section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6"> 
            <div class="card-header">
                <h2 class="card-title">Danh sách thể loại</h3>
            </div>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                <li class="breadcrumb-item active">danh sách thể loại</li>
            </ol>
          </div>
          <div class="running-line" style="width: 100%; height: 1px; background-color: rgb(204, 204, 204);"></div>
        </div>
    </div>  
  </section>  
  <!--End header-->   
   <!--search+create-->
   <section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6"> 
            @cannot('isUser')
            <a href="{{route('category.add')}}" class=" btn btn-block btn-primary" style="max-width:130px; max-height:40px; margin-left : 30px; display: flex;" id="addBtn">
              <ion-icon name="add" style="color: white; margin-top:5px;display: inline-block;" class="fa "></ion-icon>
              <p style="display: inline-block; margin-top:1px;">Tạo thể loại</p>
            </a>
            @endcannot
          </div>
          <div class="col-sm-6 " >
            <form class="form-horizontal" method="post" action="{{route('category.search')}}" style="margin-left: 100px;">
              <div style="display: flex;">
                <div class="card" style="display: inline-block;">
                  <input class="form-control" id="input-category-search" type="text" name="name" value="Nhập tên thể loại">
                </div>
                <div class="card" style="text-align: center; margin-left : 10px; display: inline-block; max-height:20px;" >
                  <button type="submit" class="btn btn-primary" style="display:flex;">
                    <ion-icon name="search-outline" style="margin-top: 3px; margin-right: 4px;"></ion-icon>
                    <div style="display: inline-block;">Search</div>
                  </button>
                </div>
              </div>
            
            </form>
          </div>
        </div>
    </div>  
  </section>  
  <!--End search+create-->  
  <!-- main content-->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped table-hover">
                  <thead>
                      <tr>
                          <th>ID</th>
                          <th>Name</th>
                          <th>Description</th>
                          <th>Status</th>
                          <th>Books</th>
                          @cannot('isUser')
                            <th>Hành động</th>
                          @endcannot
                      </tr>
                  </thead>
                  <tbody>
                      @foreach($allCategories as $category)
                      <tr>
                          <td>{{ $category->id }}</td>
                          <td>{{ $category->name }}</td>
                          <td>{{ $category->description }}</td>
                          <td>{{ $category->status }}</td>
                          <td>
                              <a class="open-books-modal" href="#" data-category-name="{{ $category->name }}" data-book-list="{{ $booksByCategory[$category->id] }}">View Books</a>
                          </td>
                          @cannot('isUser')
                          <td style="width:120px;">
                            <div style="display:flex;">
                              <button type="button" class="btn btn-outline-success updateBtn" style="margin-right: 3px"
                              data-category="{{ $category }}">
                              <i class="fas fa-edit"></i>
                              </button>
                              <form method="post" action="{{route('category.delete')}}" >
                                @csrf
                                <input type="hidden" id="input-name" type="number" name="id" value="{{$category->id}}">
                                <button type="submit" class="btn btn-outline-danger deleteBtn" style="color: blue;">
                                    <ion-icon name="trash" class="fas"></ion-icon> 
                                </button>
                              </form>
                            </div>
                          </td>
                          @endcannot
                      </tr>
                      @endforeach
                  </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          
            <!-- Books Modal -->
            <div id="booksModal" class="white-popup mfp-hide">
              <h2>Books for Category: <span id="modalCategoryName"></span></h2>
              <table class="table table-bordered table-hover">
                  <thead>
                      <tr>
                          <th>Name</th>
                          <th>Shelf ID</th>
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
            
            <!-- Update modal -->
            <div id="updateModal" class="white-popup mfp-hide">
              <h2>Sửa thể loại </h2>
              <div class="card-body">
                <form class="form-horizontal" method="post" action="{{route('category.update')}}">
                    @csrf
                    <input  id="input-id" type="hidden" name="category_id" value="">
                    <div class="row">
                        <!--cot 1-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Tên thể loại</label>
                                <input class="form-control" id="input-name1" type="text" name="name" >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="status">Trạng thái</label>
                                <input class="form-control" id="input-status" type="number" name="status"  >
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description">Mô tả</label>
                        <textarea id="input-description" class="form-control" style="width: 100%;min-height: 200px;" name="description"></textarea>
                    </div>
                    <div class="card-footer" style="text-align: center;">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
              </div>
              
            </div>
            <!-- ./Update modal-->
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--End main content-->
</div>
@endsection
