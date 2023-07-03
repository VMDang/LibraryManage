@extends('layouts.navbar')

@section('sidebar')
    <?php if (!empty($userFlash)) $user = $userFlash[0] ?>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="{{route('home')}}" class="brand-link">
            <img src="{{asset("img/LibraryLogo.png")}}" alt="Library Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">Library Manage</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{asset($user->image)}}" class="img-circle elevation-2" alt="User Avatar" style="width: 33.6px; height: 33.6px">
                </div>
                <div class="info">
                    <a href="{{route('user.profile', ['id' => $user->id ,'name' => $user->name ])}}" class="d-block">{{$user->name}}</a>
                </div>
            </div>

            <!-- SidebarSearch Form -->
            <div class="form-inline">
                <div class="input-group" data-widget="sidebar-search">
                    <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-sidebar">
                            <i class="fas fa-search fa-fw"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    <li class="nav-item">
                        <a href="{{route('home')}}" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-user"></i>
                            <p>
                                Người dùng
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('user.profile', ['id' => $user->id ,'name' => $user->name ])}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Thông tin cá nhân</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('user.list')}}" class="nav-link">
                                    <i class="fas fa-list nav-icon"></i>
                                    <p>Danh sách</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-book"></i>
                            <p>
                                Sách
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('viewbook.create')}}" class="nav-link">
                                    <i class="fas fa-list nav-icon"></i>
                                    <p>Danh sách</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="fas fa-book-reader nav-icon"></i>
                                    <p>Ebook</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="fas fa-heart nav-icon"></i>
                                    <p>Đã thích</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-bible"></i>
                            <p>
                                Mượn Sách
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('borrow.create')}}" class="nav-link">
                                    <i class="fas fa-file-export nav-icon"></i>
                                    <p>Tạo yêu cầu</p>
                                </a>
                            </li>
                            @cannot('isUser')
                                <li class="nav-item">
                                    <a href="{{route('borrow.approve')}}" class="nav-link">
                                        <i class="fas fa-clipboard-check nav-icon"></i>
                                        <p>Phê duyệt yêu cầu</p>
                                    </a>
                                </li>
                            @endcannot
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-book" ></i>
                            <p>
                                Trả sách
                                <i class="fas fa-angle-left right" ></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            
                            <li class="nav-item">
                                <a href="{{route('return.create')}}" class="nav-link">
                                    <i class="fas fa-book-reader nav-icon"></i>
                                    <p>Tạo yêu cầu</p>
                                </a>
                            </li>
                            @cannot('isUser')
                                <li class="nav-item">
                                    <a href="{{route('return.approve')}}" class="nav-link">
                                        <i class="fas fa-book-reader nav-icon"></i>
                                        <p>Phê duyệt yêu cầu</p>
                                    </a>
                                </li>
                            @endcannot
                        </ul>
                    </li>
                    <li class="nav-item">
<<<<<<< HEAD
                        <a href="{{route('history.history')}}" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Lịch sử mượn trả 
                            </p>
                        </a>
                    </li>
=======
                            <a href="#" class="nav-link" id="categorySidebar">
                                <ion-icon name="albums" class = "nav-icon fas"></ion-icon>
                                <p>
                                    Thể Loại
                                    <i class="fas fa-angle-left center right"></i>
                                </p>
                               
                                
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('category.list')}}" class="nav-link">
                                        <i class="fas fa-list nav-icon"></i>
                                        <p>Danh sách</p>
                                    </a>
                                </li>
                            </ul>
                        @cannot('isUser')
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('category.add')}}" class="nav-link">
                                        <i class="fas fa-list nav-icon"></i>
                                        <p>Thêm</p>
                                    </a>
                                </li>
                            </ul>
                        @endcannot
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link" id="locationSidebar">
                            <ion-icon name="location" class = "nav-icon fas"></ion-icon>
                            <p>
                                Vị trí 
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('shelf.list')}}" class="nav-link">
                                    <i class="fas fa-list nav-icon"></i>
                                    <p>Danh sách</p>
                                </a>
                            </li>
                        </ul>
                    @cannot('isUser')
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('shelf.add')}}" class="nav-link">
                                    <i class="fas fa-list nav-icon"></i>
                                    <p>Thêm</p>
                                </a>
                            </li>
                        </ul>
                        {{-- <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('category.list')}}" class="nav-link">
                                    <i class="fas fa-list nav-icon"></i>
                                    <p>Sửa</p>
                                </a>
                            </li>
                        </ul> --}}
                    @endcannot
                </li>
>>>>>>> 43f457e7d921d5358d8c438abda2df53eae3a71e
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
@endsection
