@php
$prefix = Request::route()->getPrefix();
$route = Route::current()->getName();

$brand =
    auth()
        ->guard('admin')
        ->user()->brand == 1;
$category =
    auth()
        ->guard('admin')
        ->user()->category == 1;
$product =
    auth()
        ->guard('admin')
        ->user()->product == 1;
$slider =
    auth()
        ->guard('admin')
        ->user()->slider == 1;
$coupon =
    auth()
        ->guard('admin')
        ->user()->coupon == 1;
$review =
    auth()
        ->guard('admin')
        ->user()->review == 1;
$orders =
    auth()
        ->guard('admin')
        ->user()->orders == 1;
$report =
    auth()
        ->guard('admin')
        ->user()->report == 1;
$alluser =
    auth()
        ->guard('admin')
        ->user()->alluser == 1;
$alladmin =
    auth()
        ->guard('admin')
        ->user()->alladmin == 1;

@endphp

<aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar">

        <div class="user-profile">
            <div class="ulogo">
                <a href="{{ route('admin.dashboard') }}">
                    <!-- logo for regular state and mobile devices -->
                    <div class="d-flex align-items-center justify-content-center">
                        <img src="{{ asset('front-theme/assets/images/logo.png') }}" alt="">

                    </div>
                </a>
            </div>
        </div>

        <!-- sidebar menu-->
        <ul class="sidebar-menu" data-widget="tree">

            <li class="{{ $route == 'admin.dashboard' ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard') }}">
                    <i data-feather="pie-chart"></i>
                    <span>Dashboard</span>
                </a>
            </li>

                <li class="treeview {{ $prefix == '/alluser' ? 'active' : '' }}">
                    <a href="#">
                        <i data-feather="user"></i>
                        <span>Users</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-right pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{ $route == 'all.user' ? 'active' : '' }}"><a href="{{ route('all.user') }}"><i
                                    class="ti-more"></i>Semua Users</a></li>
                    </ul>
                </li>


                <li class="treeview {{ $prefix == '/alladmin' ? 'active' : '' }}">
                    <a href="#">
                        <i data-feather="user"></i>
                        <span>Admin</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-right pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{ $route == 'all.admin' ? 'active' : '' }}"><a href="{{ route('all.admin') }}"><i
                                    class="ti-more"></i>Semua Admin</a></li>
                    </ul>
                </li>

                <li class="treeview {{ $prefix == '/report' ? 'active' : '' }}">
                    <a href="#">
                        <i data-feather="mail"></i>
                        <span>Laporan</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-right pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{ $route == 'all.report' ? 'active' : '' }}"><a
                                href="{{ route('all.report') }}"><i class="ti-more"></i>Semua Laporan</a></li>
                    </ul>
                </li>


            <hr>

                <li class="treeview {{ $prefix == '/brand' ? 'active' : '' }}">
                    <a href="#">
                        <i data-feather="file"></i>
                        <span>Merek</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-right pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{ $route == 'all.brand' ? 'active' : '' }}"><a href="{{ route('all.brand') }}"><i
                                    class="ti-more"></i>Semua Merek</a></li>
                        <li><a href="calendar.html"><i class="ti-more"></i>Kalender</a></li>
                    </ul>
                </li>


                <li class="treeview {{ $prefix == '/suplier' ? 'active' : '' }}">
                    <a href="#">
                        <i data-feather="file"></i>
                        <span>Suplier</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-right pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{ $route == 'all.suplier' ? 'active' : '' }}"><a href="{{ route('all.suplier') }}"><i
                                    class="ti-more"></i>Semua Suplier</a></li>
                    </ul>
                </li>

                <li
                    class="treeview {{ $prefix == '/category' || $prefix == '/subcategory' || $prefix == '/subsubcategory' ? 'active' : '' }}">
                    <a href="#">
                        <i data-feather="file"></i> <span>Kategori</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-right pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{ $route == 'all.category' ? 'active' : '' }}"><a
                                href="{{ route('all.category') }}"><i class="ti-more"></i>Semua kategori</a></li>
                        <li class="{{ $route == 'all.subcategory' ? 'active' : '' }}"><a
                                href="{{ route('all.subcategory') }}"><i class="ti-more"></i>Sub Kategori</a>
                        </li>
                        <li class="{{ $route == 'all.subsubcategory' ? 'active' : '' }}"><a
                                href="{{ route('all.subsubcategory') }}"><i class="ti-more"></i>SubSub Kategori</a>
                        </li>
                    </ul>
                </li>

                <li class="treeview {{ $prefix == '/product' ? 'active' : '' }}">
                    <a href="#">
                        <i data-feather="file"></i>
                        <span>Produk</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-right pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{ $route == 'create.product' ? 'active' : '' }}"><a
                                href="{{ route('create.product') }}"><i class="ti-more"></i>Tambah Produk</a></li>

                        <li class="{{ $route == 'manage.product' ? 'active' : '' }}"><a
                                href="{{ route('manage.product') }}"><i class="ti-more"></i>Mengelola Produk</a>
                        </li>
                    </ul>
                </li>
                <li class="treeview {{ $prefix == '/orders' ? 'active' : '' }}">
                    <a href="#">
                        <i data-feather="message-circle"></i>
                        <span>pesanan</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-right pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{ $route == 'success.orders' ? 'active' : '' }}"><a
                                href="{{ route('success.orders') }}"><i class="ti-more"></i>Pesanan Sukses</a></li>
                        <li class="{{ $route == 'failure.orders' ? 'active' : '' }}"><a
                                href="{{ route('failure.orders') }}"><i class="ti-more"></i>Pesanan Gagal</a></li>
                        <li class="{{ $route == 'error.orders' ? 'active' : '' }}"><a
                                href="{{ route('error.orders') }}"><i class="ti-more"></i>Pesanan Tertunda</a></li>
                    </ul>
                </li>

                <li class="treeview {{ $prefix == '/review' ? 'active' : '' }}">
                    <a href="#">
                        <i data-feather="message-circle"></i>
                        <span>Review</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-right pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{ $route == 'pending.review' ? 'active' : '' }}"><a
                                href="{{ route('pending.review') }}"><i class="ti-more"></i>Review Tertunda</a></li>
                        <li class="{{ $route == 'publish.review' ? 'active' : '' }}"><a
                                href="{{ route('publish.review') }}"><i class="ti-more"></i>Review publish</a>
                        </li>
                    </ul>
                </li>






        </ul>
    </section>

</aside>
