@extends("layouts.footer")

@section('title-page')
    <title>Return Book | Library Manage</title>
@endsection

@section('style')

@endsection

@section('script')

@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header" style="background-color:steelblue">
                                <h3 class="card-title">Danh sách phiếu trả sách 
                                    </h3>
                            </div>
                            <!-- ./card-header -->
                            <div class="card-body">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Họ tên</th>
                                            <th>Email</th>
                                            <th>Trạng thái</th>
                                            <th>Lời nhắn</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr data-toggle="modal" data-target="#modal-secondary" >
                                            <td>user1</td>
                                            <td>user1@gmail.com</td>
                                            <td>Chưa duyệt</td>
                                            <td>.....</td>
                                        </tr>
                                        <tr data-toggle="modal" data-target="#modal-secondary" >
                                            <td>user2</td>
                                            <td>user2@gmail.com</td>
                                            <td>Chưa duyệt</td>
                                            <td>....</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <!-- /.row -->
                <div class="modal fade" id="modal-secondary">
                    <div class="modal-dialog">
                        <div class="modal-content bg-secondary">
                            <div class="modal-header">
                                <h4 class="modal-title">Phiếu trả sách</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fullName">Họ tên</label>
                                            <input type="text" class="form-control" id="fullName" placeholder="Auto">
                                        </div>
                                        <!-- /.form-group -->
                                        <div class="form-group">
                                            <label for="gender">Giới tính</label>
                                            <input type="text" class="form-control" id="fullName" placeholder="Auto">
                                        </div>
                                        <!-- /.form-group -->
                                        <!-- Date -->
                                        <div class="form-group">
                                          <label>Ngày sinh</label>
                                          <input type="text" class="form-control" id="fullName" placeholder="Auto">
                                        </div>
                                        <!-- /.form-group -->
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" id="email" placeholder="auto">
                                        </div>
                                        <!-- /.form-group -->
                                        <div class="form-group">
                                            <label for="phone">Số điện thoại</label>
                                            <input type="text" class="form-control" id="phone" placeholder="auto">
                                        </div>
                                        <!-- /.form-group -->
                                        <div class="form-group">
                                            <label for="address">Địa chỉ</label>
                                            <input type="text" class="form-control" id="address" placeholder="auto">
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="book">Tên sách</label>
                                            <input type="text" class="form-control" id="fullName" placeholder="Auto">
                                        </div>
                                        <!-- /.form-group -->
                                        <div class="form-group">
                                            <label for="author">Tác giả</label>
                                            <input type="text" class="form-control" id="fullName" placeholder="Auto">
                                        </div>
                                        <!-- /.form-group -->
                                        <div class="form-group">
                                            <label>Mã sách</label>
                                            <input type="text" class="form-control" id="bookId" placeholder="auto">
                                        </div>
                                        <!-- /.form-group -->
                                        <div class="form-group">
                                            <label>Số Lượng</label>
                                            <input type="text" class="form-control" id="quantity" placeholder="auto">
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
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-outline-light" data-dismiss="modal" style="background-color:steelblue">Từ chối</button>
                                <button type="button" class="btn btn-outline-light" style="background-color:steelblue">Phê duyệt</button>
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