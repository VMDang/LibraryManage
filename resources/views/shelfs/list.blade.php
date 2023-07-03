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
      #updateModalShelf {
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
    function handleFloorChange(selectElement) {
         // Lấy giá trị floor được chọn
         var selectedFloor = selectElement.value;
         console.log(selectedFloor);
        // Lấy danh sách phòng tương ứng với floor từ biến $rooms
        var roomsInSelectedFloor = {!! json_encode($rooms) !!}[selectedFloor];

        // Cập nhật danh sách phòng trong dropdown Room
        var roomSelect = document.getElementById('roomSelectUpdate');
        roomSelect.innerHTML = '<option value="">-- Chọn phòng --</option>';

        // Thêm các option phòng vào dropdown Room
        for (var room in roomsInSelectedFloor) {
            var option = document.createElement('option');
            option.value = room;
            option.text = room;
            roomSelect.appendChild(option);
        }
    }
</script>
<script>
    function handleRoomChange(selectElement) {
        // Lấy giá trị room được chọn
        var selectedRoom = selectElement.value;
        
        // Lấy danh sách shelf tương ứng với room từ biến $rooms
        var selectedFloor = document.getElementById('floorSelectUpdate').value;
        var shelvesInSelectedRoom = {!! json_encode($rooms) !!}[selectedFloor][selectedRoom];

        // Cập nhật danh sách shelf trong dropdown Shelf
        var shelfSelect = document.getElementById('shelfSelectUpdate');
        shelfSelect.innerHTML = '<option value="">-- Chọn kệ --</option>';

        // Thêm các option shelf vào dropdown Shelf
        for (var i = 0; i < shelvesInSelectedRoom.length; i++){
            var option = document.createElement('option');
            option.value = shelvesInSelectedRoom[i];
            option.text = shelvesInSelectedRoom[i];
            shelfSelect.appendChild(option);
        }
    }
</script>
<script>
  function validateForm() {
        var floorSelect = document.getElementById('floorSelectUpdate');
        var roomSelect = document.getElementById('roomSelectUpdate');
        var shelfSelect = document.getElementById('shelfSelectUpdate');
        var inputName = document.getElementById('input-name');
        var inputStatus = document.getElementById('input-status');
        // Kiểm tra xem các trường đã được chọn hết hay chưa
        if (floorSelect.value === '' || roomSelect.value === '' || shelfSelect.value === ''|| inputName.value === ''|| inputStatus.value === '') {
            alert('Vui lòng chọn đầy đủ các trường!');
            return false; // Ngăn form được submit
        }
        return true; // Cho phép form được submit
    }
</script>
<script src="{{asset('js/shelf/shelf.js')}}" defer></script>
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
    <!--search+create-->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6"> 
            @cannot('isUser')
            <a href="{{route('shelf.add')}}" class=" btn btn-block btn-primary" style="max-width:130px; max-height:40px; margin-left : 30px; display: flex;" id="addBtn">
              <ion-icon name="add" style="color: white; margin-top:5px;display: inline-block;" class="fa "></ion-icon>
              <p style="display: inline-block; margin-top:1px;">Tạo vị trí</p>
            </a>
            @endcannot
          </div>
          <div class="col-sm-6 " >
            <form class="form-horizontal" method="post" action="{{route('shelf.search')}}" style="margin-left: 100px;">
              <div style="display: flex;">
                <div class="card" style="display: inline-block;">
                  <input class="form-control" id="input-shelf-search" type="text" name="name" value="Nhập mã vị trí">
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
                            <th>Vị trí</th>
                            <th>Trạng thái</th>
                            <th>Sách</th>
                            @cannot('isUser')
                              <th>Hành động</th>
                            @endcannot
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($allShelfs as $shelf)
                        <tr>
                            <td>{{ $shelf->id }}</td>
                            <td>{{ $shelf->location  }}</td>
                            <td>
                              @if($shelf->status === 0)
                                <span style="color: red;">Đầy</span>
                              @else
                                <span style="color:blue;">Còn trống</span>
                              @endif
                            </td>
                            <td>
                                <a class="open-books-modal" href="#" data-shelf-id="{{ $shelf->id }}" data-book-list="{{ $booksByShelf[$shelf->id] }}">Xem sách</a>
                            </td>
                            @cannot('isUser')
                            <td style="width:120px;">
                              <div style="display:flex;" >
                                <button type="button" class="btn btn-outline-success updateBtn" style="margin-right: 3px"
                                data-shelf="{{ $shelf }}">
                                <i class="fas fa-edit"></i>
                                </button>
                                <button type="button" class="btn btn-outline-danger deleteBtn" style="color: blue;" data-shelf="{{ $shelf->id }}">
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
            </div>  
            <!-- Books Modal -->
            <div id="booksModal" class="white-popup mfp-hide">
              <h2>Books for shelf: <span id="modalShelfID"></span></h2>
              <table class="table table-bordered table-hover">
                  <thead>
                      <tr>
                        <th>Tên sách</th>
                        <th>Thể loại</th>
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
            <div id="updateModalShelf" class="white-popup mfp-hide">
              <h2>Sửa vị trí </h2>
              <div class="card-body">
                <form class="form-horizontal" onsubmit="return validateForm()" method="post" action="{{route('shelf.update')}}" >
                  @csrf
                  <div class="row">
                      <!--cot 1-->
                      <div class="col-md-6">
                          <div class="form-group">
                              <label for="name">Mã vị trí</label>
                              <input class="form-control" id="input-shelfID" type="text" name="shelfID" readonly>
                          </div>
                      </div>
                      <div class="col-md-6">
                          <div class="form-group">
                              <label for="status">Trạng thái</label>
                              <select class="form-control select2" id="statusSelectUpdate"  style="width: 100%;" name="status" >
                                  <option value="">-- Chọn trạng thái --</option>
                                  @foreach ($statusOption as $status )
                                      <option value="{{ $status }}">{{ $status }}</option>
                                  @endforeach
                              </select>
                          </div>
                      </div>
                  </div>
                  <h5>Vị trí</h5>
                  <div class="row" style="margin-top:30px;">
                      <div class="col-md-4">
                          <div class="form-group">
                              <label for="floor">Tầng</label>
                              <select class="form-control select2" id="floorSelectUpdate"  style="width: 100%;" name="floor" onchange="handleFloorChange(this)">
                                  <option value="">-- Chọn tầng --</option>
                                  @foreach ($rooms as $floor => $roomsInFloor)
                                      <option value="{{ $floor }}">{{ $floor }}</option>
                                  @endforeach
                              </select>
                          </div>
                      </div>
                      <div class="col-md-4">
                          <div class="form-group">
                              <label for="room">Phòng</label>
                              <select class="form-control select2" style="width: 100%;" id="roomSelectUpdate" name="room" onchange="handleRoomChange(this)">
                                  <option value="">-- Chọn phòng --</option>
                              </select>
                          </div>
                      </div>
                      <div class="col-md-4">
                          <div class="form-group">
                              <label for="shelf">Kệ</label>
                              <select class="form-control select2" style="width: 100%;" id="shelfSelectUpdate" name="shelf" >
                                  <option value="">-- Chọn kệ --</option>
                              </select>
                          </div>
                      </div>
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
    
    </section>
    <!--End main content-->
  </div>
@endsection
