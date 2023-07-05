@extends("layouts.footer")

@section('title-page')
    <title>Borrow Book | Library Manage</title>
@endsection

@section('style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/material_blue.css">
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="{{asset('js/borrow/borrowing.js')}}" defer></script>
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
                                            <th>Thời gian tạo</th>
                                            <th>Họ tên</th>
                                            <th>Email</th>
                                            <th>Tên sách</th>
                                            <th>Trạng thái</th>
                                            <th>Hành động</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($borrowings as $index => $borrowing)
                                        <tr class="view-form" data-toggle="modal" data-target="#borrowing-click" data-index="{{$index}}">
                                            <td>{{date('H:m:s d/m/Y', strtotime($borrowing->created_at))}}</td>
                                            <td>{{$borrowing->user->name ?? ''}}</td>
                                            <td>{{$borrowing->user->email ?? ''}}</td>
                                            <td>{{$borrowing->book->name ?? ''}}</td>
                                            <td>
                                                @if($borrowing->status == 0)
                                                    <span style="color: blue;">Chưa duyệt</span>
                                                @elseif($borrowing->status == 1)
                                                    <span style="color:green;">Đồng ý</span>
                                                @elseif($borrowing->status == 2)
                                                    <span style="color:red;">Từ chối</span>
                                                @endif
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-outline-success btnDetail"
                                                    data-id="{{$borrowing->id}}"
                                                    data-toggle="popover" data-trigger="hover" data-placement="bottom"
                                                    data-content="Chỉnh sửa">
                                                <i class="fas fa-edit"></i>
                                                </button>
                                            </td>
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
            <div class="modal fade" id="modalApprove">
                <div class="modal-dialog modal-lg" style="width: 85%; max-width: 90%;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="modalApproveTitle">Phê duyệt yêu cầu mượn sách</h4>
                            <button type="button" class="close closeModal" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form class="form-horizontal" method="post" action="{{route('borrow.approve')}}">
                            @csrf
                            <div class="modal-body">
                                <input type="hidden" id="id" class="form-control" name="id">
                                <div class="row">
                                    <div class="col-md-6">

                                        <div class="row">
                                            <label class="col-lg-3 col-form-label" for="name" id="">Họ và Tên</label>
                                            <div class="form-group col-lg-9">
                                                <input type="text" name="name" id="name" class="form-control" readonly>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <label class="col-lg-3 col-form-label" for="gender">Giới tính</label>
                                            <div class="form-group col-lg-9" style="height: 38px;">
                                                <div class="icheck-primary d-inline">
                                                    <input type="radio" id="gender1" name="gender" value="1" checked>
                                                    <label for="gender1" style="margin-right: 10px">
                                                        Nam
                                                    </label>
                                                </div>
                                                <div class="icheck-primary d-inline">
                                                    <input type="radio" id="gender2" name="gender" value="0">
                                                    <label for="gender2">
                                                        Nữ
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <label for="birthday" class="col-sm-3">Ngày sinh</label>
                                            <div class="form-group col-lg-9">
                                                <input type="date" name="birthday" id="birthday" class="form-control" disabled>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <label class="col-lg-3 col-form-label" for="email">Email</label>
                                            <div class="form-group col-lg-9">
                                                <input type="email" name="email" id="email" class="form-control" readonly>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label class="col-lg-3 col-form-label" for="status">Trạng thái</label>
                                            <div class="form-group col-lg-9">
                                                <input type="text" name="status" id="status" class="form-control" checked readonly>
                                            </div>
                                        </div>

                                        <div class=" row">
                                            <label class="col-lg-3 col-form-label" for="message_user">Lời nhắn từ người dùng</label>
                                            <div class="form-group col-lg-9">
                                                <textarea class="form-control" style="width: 100%;" id="message_user" name="message_user" readonly></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">

                                        <div class="row">
                                            <label class="col-lg-3 col-form-label" for="book">Tên sách</label>
                                            <div class="form-group col-lg-9">
                                                <input type="text" name="bookname" id="bookname" class="form-control" readonly>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <label class="col-lg-3 col-form-label" for="author">Tác giả</label>
                                            <div class="form-group col-lg-9">
                                                <input type="text" name="author" id="author" class="form-control" readonly>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <label class="col-lg-3 col-form-label" for="location">Vị trí</label>
                                            <div class="form-group col-lg-9">
                                                <input type="text" name="location" id="location" class="form-control" readonly>
                                            </div>
                                        </div>

                                        <div class=" row">
                                            <label class="col-lg-3 col-form-label" for="borrow_date">Ngày mượn</label>
                                            <div class="form-group col-lg-9">
                                                <input type="date" name="borrow_date" id="borrow_date" class="form-control">
                                            </div>
                                        </div>

                                        <div class=" row">
                                            <label class="col-lg-3 col-form-label" for="due_date">Hạn trả</label>
                                            <div class="form-group col-lg-9">
                                                <input type="date" name="due_date" id="due_date" class="form-control">
                                            </div>
                                        </div>

                                        <div class=" row">
                                            <label class="col-lg-3 col-form-label" for="message_approver">Lời nhắn đến người dùng</label>
                                            <div class="form-group col-lg-9">
                                                <textarea class="form-control" style="width: 100%;" name="message_approver" id="message_approver"></textarea>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default closeModal" data-dismiss="modal">Đóng
                                </button>

                                <button type="submit" class="btn btn-danger" id="btnDeni" name="btn" value="2"><i class="fas fa-handshake-slash"></i>
                                    Từ chối
                                </button>
                                <button type="submit" class="btn btn-primary" id="btnSave" name="btn" value="1"><i class="fas fa-save"></i>
                                    Phê duyệt
                                </button>
                            </div>
                        </form>

                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
                </div>
                <!-- /.modal -->
        </section>
    </div>
@endsection
