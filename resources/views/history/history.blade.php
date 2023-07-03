@extends("layouts.footer")

@section('title-page')
    <title>History Borrow | Library Manage</title>
@endsection

@section('style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/material_blue.css">
@endsection

@section('script')
    <script src="{{asset('js/book/borrowing.js')}}" defer></script>
@endsection

@section('content')
<div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Lịch sử mượn trả sách</h3>
                            </div>
                            <!-- ./card-header -->
                            <div class="card-body">
                                <table id="tableListBorrowers" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Tên sách</th>
                                            <th>Ngày mượn</th>
                                            <th>Ngày đến hạn </th>
                                            <th>Trạng thái  </th>
                                            <th>Ngày trả </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($borrowings as  $borrowing) 
                                    @if($borrowing->user->id==$user->id)
                                        <tr>  
                                            <td>{{$borrowing->book->name}}</td>
                                            <td>{{$borrowing->borrow_date}}</td>
                                            <td>{{$borrowing->due_date}}</td>
                                            <td>
                                                @if($borrowing->status == 0)
                                                   Đang chờ xác nhận mượn
                                                @elseif($returns->where('borrow_id',$borrowing->id)->where('approve_status',0)->count()>0)
                                                   Đang chờ xác nhận trả

                                                @elseif($returns->where('borrow_id',$borrowing->id)->where('approve_status',1)->count()>0)
                                                   Đã trả
                                                @else
                                                   Đang mượn
                                                @endif
                                            </td>
                                            <td>@if ($returns->where('borrow_id', $borrowing->id)->where('approve_status', 1)->count() > 0)
                                                   {{ $returns->where('borrow_id', $borrowing->id)->where('approve_status', 1)->first()->date_return }}
                                                @else
                                                    -
                                                @endif
                                            </td>
                                        </tr>
                                    
                                    @endif
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
                
                        
                   
                </div>
                <!-- /.modal -->
            </div>
        </section>
    </div>
@endsection
