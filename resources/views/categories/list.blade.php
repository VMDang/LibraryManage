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
  <script>
    function validateForm() {
    var name = document.getElementById('input-name1');
    var description = document.getElementById('input-description');

    // Kiểm tra xem các trường đã được chọn hết hay chưa
    if (name.value === '' || description.value === '') {
        alert('Vui lòng chọn đầy đủ các trường!');
        return false; // Ngăn form được submit
    }
    return true; // Cho phép form được submit
    }
</script>
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
                <h2 class="card-title">Danh sách thể loại</h2>
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
            <form class="form-horizontal" method="post" action="{{route('category.search')}}"  style="margin-left: 100px;">
              <div style="display: flex;">
                <div class="card" style="display: inline-block;">
                  <input class="form-control" id="input-category-search" type="text" name="name" value="Nhập tên thể loại">
                </div>
                <div class="card" style="text-align: center; margin-left : 10px; display: inline-block; max-height:20px;" >
                  <button type="submit" class="btn btn-primary" style="display:flex;">
                    <ion-icon name="search-outline" style="margin-top: 3px; margin-right: 4px;"></ion-icon>
                    <div style="display: inline-block;">Tìm kiếm</div>
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
                          <th>Tên thể loại</th>
                          <th>Mô tả</th>
                          @cannot('isUser')
                          <th>Trạng thái</th>
                          @endcannot
                          <th>Sách </th>
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
                          @cannot('isUser')
                              @if($category->status == 1 )
                                  <td style="color: blue;"> Kích hoạt</td>
                              @elseif($category->status == 0 )
                                  <td style="color: red">Không kích hoạt</td>
                              @endif
                          @endcannot
                          <td>
                              <a class="open-books-modal" href="#" data-category-name="{{ $category->name }}" data-book-list="{{ $booksByCategory[$category->id] }}">Xem sách</a>
                          </td>
                          @cannot('isUser')
                          <td style="width:120px;">
                            <div style="display:flex;">
                              <button type="button" class="btn btn-outline-success updateBtn" style="margin-right: 3px"
                              data-category="{{ $category }}">
                              <i class="fas fa-edit"></i>
                              </button>
                              <button type="button" class="btn btn-outline-danger deleteBtn" style="color: blue;" data-category = "{{ $category->id }}">
                                  <ion-icon name="trash" class="fas"></ion-icon>
                              </button>
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
              <h2>Danh sách các sách của thể loại: <span id="modalCategoryName"></span></h2>
              <table class="table table-bordered table-hover">
                  <thead>
                      <tr>
                          <th>Tên sách</th>
                          <th>Mã vị trí</th>
                          <th>Giới thiệu</th>
                          <th>File sách</th>
                          <th>Tác giả</th>
                          <th>Nhà xuất bản</th>
                          <th>Ngày xuất bản</th>
                          <th>Giá</th>
                          <th>Số lượng</th>
                          <th>Trạng thái</th>
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
                <form class="form-horizontal" method="post" action="{{route('category.update')}}" onsubmit="return validateForm()">
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
                                <select class="form-control select2" id="input-status"  style="width: 100%;" name="status">
                                  <option value=1 >Kích hoạt</option>
                                  <option value=0 >Không kích hoạt</option>
                              </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description">Mô tả</label>
                        <textarea id="input-description" class="form-control" style="width: 100%;min-height: 200px;" name="description"></textarea>
                    </div>
                    <div class="card-footer" style="text-align: center;">
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
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
