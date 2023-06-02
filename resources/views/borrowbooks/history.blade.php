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
                                <h3 class="card-title">Lịch sử mượn sách</h3>
                            </div>
                            <!-- ./card-header -->
                            <div class="card-body">
                                <table id="tableListBorrowers" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Tên sách</th>
                                            <th>Ngày mượn</th>
                                            <th>Ngày đến hạn </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($borrowings as  $borrowing) 
                                    @if($borrowing->user->id==$user->id)
                                        <tr>
                                            
                                            <td>{{$borrowing->book->name}}</td>
                                            <td>{{$borrowing->borrow_date}}</td>
                                            <td>{{$borrowing->due_date}}</td>
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
