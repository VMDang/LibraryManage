    @extends("layouts.footer")

    @section('title-page')
        <title>Return Book | Library Manage</title>
    @endsection

    @section('style')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/material_blue.css">
    @endsection

    @section('script')
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        {{-- <script src="{{asset('js/return/return.js')}}" defer></script> --}}

        <script>
            $(document).ready(function() {
                $('.btnDetail').on('click', function() {
                    var index = $(this).closest('tr').data('index');
                    var info = @json($returnInfo);
                   
    
                    // Gán thông tin từ danh sách vào modal
                    $('#id').val(info[index].id);
                    $('#name').val(info[index].user_name);
                    $('#gender' + info[index].gender).prop('checked', true);
                    $('#birthday').val(info[index].birthday);
                    $('#email').val(info[index].user_email);
                    // Cập nhật trạng thái trong modal
                        if(info[index].approve_status == 0)
                        $('#approve_status').val("Chưa duyệt");
                        else if(info[index].approve_status == 1)
                        $('#approve_status').val("Đồng ý");
                        else if(info[index].approve_status == 2)
                        $('#approve_status').val("Từ chối");
                    
                    
                    $('#message_user').val(info[index].message_user);
                    $('#bookname').val(info[index].book_name);
                    $('#author').val(info[index].author);
                    $('#location').val('Tầng 1 Phòng 1 Kệ 1');
                    $('#borrow_date').val(info[index].borrow_date);
                    $('#date_return').val(info[index].date_return);
                    $('#message_mod').val(info[index].message_mod);
                     // Hiển thị modal
                    $('#modalApprove').modal('show');
                });
    
                $('.closeModal').on('click', function() {
                    // Đóng modal
                    $('#modalApprove').modal('hide');
                });
             //Thêm sự kiện click cho các button
                $('#btnDeni, #btnSave').on('click', function() {
                   var status = $(this).data('status');
                   $('#approve_status').val(status);
                  });

                 //Cảnh báo nhập ngày trả trước khi phê duyệt
                      $('#btnSave').on('click', function(event) {
                     event.preventDefault();
                          // Kiểm tra trạng thái của trường ngày trả
                     var dateReturn = $('#date_return').val();
                     if (dateReturn === '') {
                         // Hiển thị thông báo cảnh báo
                         $('#dateReturnError').show();
                         return; // Dừng lại và không thực hiện phê duyệt
                     } else {
                         // Ẩn thông báo cảnh báo nếu ngày trả đã được nhập
                         $('#dateReturnError').hide();
                     }
                     
                     // Tiếp tục thực hiện phê duyệt
                     var status = $(this).data('status');
                     $('#approve_status').val(status);
                     $('form').submit();
                 });
                 
                 $('#btnDeni').on('click', function(event) {
                 event.preventDefault();
                 
                 // Kiểm tra trạng thái của trường message_mod
                 var messageMod = $('#message_mod').val();
                 if (messageMod === '') {
                     // Hiển thị thông báo cảnh báo lời nhắn đến người dùng
                     $('#reasonError').show();
                     return; // Dừng lại và không thực hiện phê duyệt
                 } else {
                     // Ẩn thông báo cảnh báo nếu lời nhắn đến người dùng đã được nhập
                     $('#reasonError').hide();
                 }
                 
                    // Tiếp tục thực hiện phê duyệt
                    var status = $(this).data('status');
                 $('#approve_status').val(status);
                    $('form').submit();
                });

               });
        </script>
@endsection

    @section('content')
        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header" style="background-color: rgb(0, 140, 255)">
                                    <h3 class="card-title" >Danh sách phiếu trả sách</h3>
                                </div>
                                <!-- ./card-header -->
                                <div class="card-body">
                                    <table id="tableListReturners" class="table table-bordered table-hover">
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
                                            @foreach($returnInfo as $index => $info)
                                            <tr class="view-form" data-toggle="modal" data-target="#return-click" data-index="{{$index}}">
                                                <td>{{date('H:m:s d/m/Y', strtotime($info->created_at))}}</td>
                                                <td>{{$info->user_name ?? ''}}</td>
                                                <td>{{$info->user_email ?? ''}}</td>
                                                <td>{{$info->book_name ?? ''}}</td>
                                                <td>
                                                    @if($info->approve_status == 0)
                                                        <span style="color: blue;">Chưa duyệt</span>
                                                    @elseif($info->approve_status == 1)
                                                        <span style="color:green;">Đồng ý</span>
                                                    @elseif($info->approve_status == 2)
                                                        <span style="color:red;">Từ chối</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-outline-success btnDetail"
                                                        data-id="{{$info->id}}"
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
                {{-- modal     --}}
                    <div class="modal fade" id="modalApprove">
                    <div class="modal-dialog modal-lg" style="width: 85%; max-width: 90%;">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="modalApproveTitle">Phê duyệt yêu cầu trả sách</h4>
                                <button type="button" class="close closeModal" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form class="form-horizontal" method="post" action="{{route('return.approve')}}">
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
                                                    <input type="text" name="birthday" id="birthday" class="form-control" disabled>
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
                                                    <input type="text" name="approve_status" id="approve_status" class="form-control"     readonly>
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
                                                    <input type="text" name="location" id="location" class="form-control" value="Tầng 1 Phòng 1 Kệ 1" readonly>
                                                </div>
                                            </div>

                                            <div class=" row">
                                                <label class="col-lg-3 col-form-label" for="borrow_date">Ngày mượn</label>
                                                <div class="form-group col-lg-9">
                                                    <input type="date" name="borrow_date" id="borrow_date" class="form-control" readonly>
                                                </div>
                                            </div>

                                            <div class=" row">
                                                <label class="col-lg-3 col-form-label" for="due_date">Ngày Trả</label>
                                                <div class="form-group col-lg-9">
                                                    <input type="date" name="date_return" id="date_return" class="form-control">
                                                    <span id="dateReturnError" style="color: red; display: none;">Nhập ngày trả trước khi phê duyệt</span>

                                                </div>
                                            </div>

                                            <div class=" row">
                                                <label class="col-lg-3 col-form-label" for="message_mod">Lời nhắn đến người dùng</label>
                                                <div class="form-group col-lg-9">
                                                    <textarea class="form-control" style="width: 100%;" name="message_mod" id="message_mod"></textarea>
                                                    <span id="reasonError" style="color: red; display: none;">Nhập lời nhắn/lý do đến người yêu cầu trước khi từ chối</span>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default closeModal" data-dismiss="modal">Đóng
                                    </button>

                                    <button type="submit" class="btn btn-danger" id="btnDeni" data-status="2">
                                        <i class="fas fa-handshake-slash"></i> Từ chối
                                    </button>
                                    <button type="submit" class="btn btn-primary" id="btnSave" data-status="1">
                                        <i class="fas fa-save"></i> Phê duyệt
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
