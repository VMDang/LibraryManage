@extends("layouts.footer")

@section('title-page')
    <title>Borrow Book | Library Manage</title>
@endsection

@section('style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/material_blue.css">
@endsection

@section('script')
    <script src="{{asset('js/book/borrowing.js')}}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr("#borrow_date");
        flatpickr("#due_date");
    </script>
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Danh sách phiếu mượn sách</h3>
                            </div>
                            <!-- ./card-header -->
                            <div class="card-body">
                                <table id="tableListBorrowers" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Họ tên</th>
                                            <th>Email</th>
                                            <th>Tên sách</th>
                                            <th>Trạng thái</th>
                                            <th>Lời nhắn từ người mượn</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($borrowings as $index => $borrowing)
                                        <tr class="view-form" data-toggle="modal" data-target="#borrowing-click" data-index="{{$index}}">
                                            <td>{{$borrowing->id}}</td>
                                            <td>{{$borrowing->user->name}}</td>
                                            <td>{{$borrowing->user->email}}</td>
                                            <td>{{$borrowing->book->name}}</td>
                                            <td><?php echo $borrowing->status ? '<span style="color:green;">Đã duyệt</span>' : '<span style="color:red;">Chưa duyệt</span>' ?></td>
                                            <td>{{$borrowing->message_user}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <!-- /.row -->
                <div class="modal fade" id="borrowing-click">
                    <div class="modal-dialog">
                        <div class="modal-content bg-secondary">
                            <div class="modal-header">
                                <h4 class="modal-title">Phiếu mượn sách</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form class="form-horizontal" method="post" action="">
                                    @csrf
                                    <input type="hidden" id="book-id" name="book_id" value="">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="fullname">Họ tên</label>
                                                <input type="text" id="fullname" class="form-control" value="" readonly>
                                            </div>
                                            <!-- /.form-group -->
                                            <div class="form-group">
                                                <label for="gender">Giới tính</label>
                                                <input type="text" class="form-control" id="gender" value="" readonly>
                                            </div>
                                            <!-- /.form-group -->
                                            <!-- Date -->
                                            <div class="form-group">
                                              <label for="birthday">Ngày sinh</label>
                                              <input type="text" class="form-control" id="birthday" value="" readonly>
                                            </div>
                                            <!-- /.form-group -->
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" class="form-control" id="email" value="" readonly>
                                            </div>
                                            <!-- /.form-group -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="bookname">Tên sách</label>
                                                <input type="text" class="form-control" id="bookname" value="" readonly>
                                            </div>
                                            <!-- /.form-group -->
                                            <div class="form-group">
                                                <label for="author">Tác giả</label>
                                                <input type="text" class="form-control" id="author" value="" readonly>
                                            </div>
                                            <!-- /.form-group -->
                                            <div class="form-group">
                                                <label for="location">Vị trí</label>
                                                <input type="text" class="form-control" id="location" value="Tầng 1 - Phòng 1 - Kệ 1" readonly>
                                            </div>
                                            <!-- /.form-group -->
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    <!-- /.row -->

                                            <h5>Lời nhắn gửi đến người dùng</h5>
                                            <div class="form-group">
                                                <textarea class="form-control" style="width: 100%;"></textarea>
                                                <!-- /.form-group -->
                                            </div>
                                            <div class="form-group">
                                                <label for="borrow_date">Ngày mượn</label>
                                                <input  type="text" class="form-control" id="borrow_date" placeholder="YYYY-MM-DD">
                                            </div>
                                            <div class="form-group">
                                                <label for="due_date">Đến ngày</label>
                                                <input  type="text" class="form-control" id="due_date" placeholder="YYYY-MM-DD">
                                            </div>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-outline-light" data-dismiss="modal">Từ chối</button>
                                        <button type="button" class="btn btn-outline-light">Phê duyệt</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->
            </div>
        </section>
    </div>
@endsection
