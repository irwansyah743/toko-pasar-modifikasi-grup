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
            @if ($alluser == true)
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
                                    class="ti-more"></i>All Users</a></li>
                    </ul>
                </li>
            @endif
            @if ($alladmin == true)
                <li class="treeview {{ $prefix == '/alladmin' ? 'active' : '' }}">
                    <a href="#">
                        <i data-feather="user"></i>
                        <span>Admin</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-right pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{ $route == 'all.admin' ? 'active' : '' }}"><a
                                href="{{ route('all.admin') }}"><i class="ti-more"></i>All Admin</a></li>
                    </ul>
                </li>
            @endif
            @if ($report == true)
                <li class="treeview {{ $prefix == '/report' ? 'active' : '' }}">
                    <a href="#">
                        <i data-feather="mail"></i>
                        <span>Report</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-right pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{ $route == 'all.report' ? 'active' : '' }}"><a
                                href="{{ route('all.report') }}"><i class="ti-more"></i>All Report</a></li>
                    </ul>
                </li>
            @endif

            <hr>
            @if ($brand == true)
                <li class="treeview {{ $prefix == '/brand' ? 'active' : '' }}">
                    <a href="#">
                        <i data-feather="file"></i>
                        <span>Brand</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-right pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{ $route == 'all.brand' ? 'active' : '' }}"><a
                                href="{{ route('all.brand') }}"><i class="ti-more"></i>All Brands</a></li>
                        <li><a href="calendar.html"><i class="ti-more"></i>Calendar</a></li>
                    </ul>
                </li>
            @endif
            @if ($category == true)
                <li
                    class="treeview {{ $prefix == '/category' || $prefix == '/subcategory' || $prefix == '/subsubcategory' ? 'active' : '' }}">
                    <a href="#">
                        <i data-feather="file"></i> <span>Category</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-right pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{ $route == 'all.category' ? 'active' : '' }}"><a
                                href="{{ route('all.category') }}"><i class="ti-more"></i>All Categories</a></li>
                        <li class="{{ $route == 'all.subcategory' ? 'active' : '' }}"><a
                                href="{{ route('all.subcategory') }}"><i class="ti-more"></i>SubCategories</a>
                        </li>
                        <li class="{{ $route == 'all.subsubcategory' ? 'active' : '' }}"><a
                                href="{{ route('all.subsubcategory') }}"><i class="ti-more"></i>SubSubCategories</a>
                        </li>
                    </ul>
                </li>
            @endif
            @if ($product == true)
                <li class="treeview {{ $prefix == '/product' ? 'active' : '' }}">
                    <a href="#">
                        <i data-feather="file"></i>
                        <span>Product</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-right pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{ $route == 'create.product' ? 'active' : '' }}"><a
                                href="{{ route('create.product') }}"><i class="ti-more"></i>Add Products</a></li>

                        <li class="{{ $route == 'manage.product' ? 'active' : '' }}"><a
                                href="{{ route('manage.product') }}"><i class="ti-more"></i>Manage Products</a>
                        </li>
                    </ul>
                </li>
            @endif
            @if ($slider == true)
                <li class="treeview {{ $prefix == '/slider' ? 'active' : '' }}  ">
                    <a href="#">
                        <i data-feather="file"></i>
                        <span>Slider</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-right pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{ $route == 'manage.slider' ? 'active' : '' }}"><a
                                href="{{ route('manage.slider') }}"><i class="ti-more"></i>Manage Slider</a></li>
                    </ul>
                </li>
            @endif
            @if ($coupon == true)
                <li class="treeview {{ $prefix == '/coupon' ? 'active' : '' }}  ">
                    <a href="#">
                        <i data-feather="file"></i>
                        <span>Coupons</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-right pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{ $route == 'manage.coupon' ? 'active' : '' }}"><a
                                href="{{ route('manage.coupon') }}"><i class="ti-more"></i>Manage Coupon</a></li>
                    </ul>
                </li>
            @endif
            @if ($orders == true)
                <li class="treeview {{ $prefix == '/orders' ? 'active' : '' }}">
                    <a href="#">
                        <i data-feather="message-circle"></i>
                        <span>Orders</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-right pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{ $route == 'pending.orders' ? 'active' : '' }}"><a
                                href="{{ route('pending.orders') }}"><i class="ti-more"></i>Pending Orders</a></li>
                        <li class="{{ $route == 'capture.orders' ? 'active' : '' }}"><a
                                href="{{ route('capture.orders') }}"><i class="ti-more"></i>Capture Orders</a></li>
                        <li class="{{ $route == 'settlement.orders' ? 'active' : '' }}"><a
                                href="{{ route('settlement.orders') }}"><i class="ti-more"></i>Settlement
                                Orders</a>
                        </li>
                        <li class="{{ $route == 'failure.orders' ? 'active' : '' }}"><a
                                href="{{ route('failure.orders') }}"><i class="ti-more"></i>Failed Orders</a></li>
                    </ul>
                </li>
            @endif

            @if ($review == true)
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
                                href="{{ route('pending.review') }}"><i class="ti-more"></i>Pending Review</a></li>
                        <li class="{{ $route == 'publish.review' ? 'active' : '' }}"><a
                                href="{{ route('publish.review') }}"><i class="ti-more"></i>Published Review</a>
                        </li>
                    </ul>
                </li>
            @endif





        </ul>
    </section>

</aside>
