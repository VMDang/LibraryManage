@extends('layouts.footer')

@section('title-page')
    <title>Add Shelf | Library Manage</title>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('themes/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/plugins/daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/dist/css/adminlte.min.css') }}">
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script src="{{ asset('themes/plugins/daterangepicker/moment.min.js') }}"></script>
    <script src="{{ asset('themes/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <script>
    
        function handleFloorChange(selectElement) {
            // Lấy giá trị floor được chọn
            var selectedFloor = selectElement.value;
    
            // Lấy danh sách phòng tương ứng với floor từ biến $rooms
            var roomsInSelectedFloor = {!! json_encode($rooms) !!}[selectedFloor];
    
            // Cập nhật danh sách phòng trong dropdown Room
            var roomSelect = document.getElementById('roomSelect');
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
            var selectedFloor = document.getElementById('floorSelect').value;
            var shelvesInSelectedRoom = {!! json_encode($rooms) !!}[selectedFloor][selectedRoom];
    
            // Cập nhật danh sách shelf trong dropdown Shelf
            var shelfSelect = document.getElementById('shelfSelect');
            shelfSelect.innerHTML = '<option value="">-- Chọn kệ --</option>';
    
            // Thêm các option shelf vào dropdown Shelf
            for (var i = 0; i < shelvesInSelectedRoom.length; i++) {
                var option = document.createElement('option');
                option.value = shelvesInSelectedRoom[i];
                option.text = shelvesInSelectedRoom[i];
                shelfSelect.appendChild(option);
            }
        }
    </script>
    <script>
        $(document).ready(function() {
        $('#locationSidebar').addClass('active');
    });
    </script>
    <script>
        function validateForm() {
        var floorSelect = document.getElementById('floorSelect');
        var roomSelect = document.getElementById('roomSelect');
        var shelfSelect = document.getElementById('shelfSelect');
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
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Thêm một vị trí </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-item active">thêm một vị trí</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content-->
        <section class="content">
            <div class="container-fluid">
                <!-- SELECT2 EXAMPLE -->
                <div class="card card-default">
                    <div class="card-header" style="text-align: center;">
                        <h3 class="card-title">Thông tin vị trí </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form class="form-horizontal" onsubmit="return validateForm()" method="post" action="{{route('shelf.store')}}">
                            @csrf
                            <div class="row">
                                <!--cot 1-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Mã vị trí</label>
                                        <input class="form-control" id="input-name" type="text" name="name" >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="status">Trạng thái</label>
                                        <select class="form-control select2" id="statusSelect"  style="width: 100%;" name="status">
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
                                        <select class="form-control select2" id="floorSelect"  style="width: 100%;" name="floor" onchange="handleFloorChange(this)">
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
                                        <select class="form-control select2" style="width: 100%;" id="roomSelect" name="room" onchange="handleRoomChange(this)">
                                            <option value="">-- Chọn phòng --</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="shelf">Kệ</label>
                                        <select class="form-control select2" style="width: 100%;" id="shelfSelect" name="shelf" >
                                            <option value="">-- Chọn kệ --</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer" style="text-align: center;">
                                <button type="submit" class="btn btn-primary">Thêm</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Main content-->
    </div>
@endsection
