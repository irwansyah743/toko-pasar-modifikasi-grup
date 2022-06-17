@php
$categories = App\Models\Category::orderBy('category_name', 'ASC')->get();
$subcategories = App\Models\SubCategory::latest()->get();
@endphp

<header class="header-style-1">

    <!-- ============================================== TOP MENU ============================================== -->
    <div class="top-bar animate-dropdown">
        <div class="container">
            <div class="header-top-inner">
                <div class="cnt-account">
                    <ul class="list-unstyled">
                        <li><a href="#"><i class="icon fa fa-user"></i>My Account</a></li>
                        <li><a href="#"><i class="icon fa fa-heart"></i>Wishlist</a></li>
                        <li><a href="#"><i class="icon fa fa-shopping-cart"></i>My Cart</a></li>
                        <li><a href="#"><i class="icon fa fa-check"></i>Checkout</a></li>
                        <li>
                            @auth
                                <a href="{{ route('profile') }}"><i class="icon fa fa-user"></i>User
                                    Profile</a>
                            @else
                                <a href="{{ route('login') }}"><i class="icon fa fa-lock"></i>Login/Register</a>
                            @endauth
                        </li>
                    </ul>
                </div>
                <!-- /.cnt-account -->

                <div class="cnt-block">
                    <ul class="list-unstyled list-inline">
                        <li class="dropdown dropdown-small"> <a href="#" class="dropdown-toggle" data-hover="dropdown"
                                data-toggle="dropdown"><span class="value">USD </span><b
                                    class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">USD</a></li>
                                <li><a href="#">INR</a></li>
                                <li><a href="#">GBP</a></li>
                            </ul>
                        </li>
                        <li class="dropdown dropdown-small"> <a href="#" class="dropdown-toggle" data-hover="dropdown"
                                data-toggle="dropdown"><span class="value">English </span><b
                                    class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">English</a></li>
                                <li><a href="#">French</a></li>
                                <li><a href="#">German</a></li>
                            </ul>
                        </li>
                    </ul>
                    <!-- /.list-unstyled -->
                </div>
                <!-- /.cnt-cart -->
                <div class="clearfix"></div>
            </div>
            <!-- /.header-top-inner -->
        </div>
        <!-- /.container -->
    </div>
    <!-- /.header-top -->
    <!-- ============================================== TOP MENU : END ============================================== -->
    <div class="main-header">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-3 logo-holder">
                    <!-- ============================================================= LOGO ============================================================= -->
                    <div class="logo"> <a href="{{ url('/') }}"> <img
                                src="{{ asset('front-theme/assets/images/logo.png') }}" alt="logo"> </a>
                    </div>
                    <!-- /.logo -->
                    <!-- ============================================================= LOGO : END ============================================================= -->
                </div>
                <!-- /.logo-holder -->

                <div class="col-xs-12 col-sm-12 col-md-7 top-search-holder">
                    <!-- /.contact-row -->
                    <!-- ============================================================= SEARCH AREA ============================================================= -->
                    <div class="search-area">
                        <form>
                            <div class="control-group">
                                <ul class="categories-filter animate-dropdown">
                                    <li class="dropdown"> <a class="dropdown-toggle" data-toggle="dropdown"
                                            href="category.html">Categories <b class="caret"></b></a>
                                        <ul class="dropdown-menu" role="menu">
                                            <li class="menu-header">Computer</li>
                                            <li role="presentation"><a role="menuitem" tabindex="-1"
                                                    href="category.html">- Clothing</a></li>
                                            <li role="presentation"><a role="menuitem" tabindex="-1"
                                                    href="category.html">- Electronics</a></li>
                                            <li role="presentation"><a role="menuitem" tabindex="-1"
                                                    href="category.html">- Shoes</a></li>
                                            <li role="presentation"><a role="menuitem" tabindex="-1"
                                                    href="category.html">- Watches</a></li>
                                        </ul>
                                    </li>
                                </ul>
                                <input class="search-field" placeholder="Search here..." />
                                <a class="search-button" href="#"></a>
                            </div>
                        </form>
                    </div>
                    <!-- /.search-area -->
                    <!-- ============================================================= SEARCH AREA : END ============================================================= -->
                </div>
                <!-- /.top-search-holder -->

                <div class="col-xs-12 col-sm-12 col-md-2 animate-dropdown top-cart-row">
                    <!-- ============================================================= SHOPPING CART DROPDOWN ============================================================= -->

                    <div class="dropdown dropdown-cart"> <a href="#" class="dropdown-toggle lnk-cart"
                            data-toggle="dropdown">
                            <div class="items-cart-inner">
                                <div class="basket"> <i class="glyphicon glyphicon-shopping-cart"></i> </div>
                                <div class="basket-item-count"><span class="count">2</span></div>
                                <div class="total-price-basket"> <span class="lbl">cart -</span> <span
                                        class="total-price"> <span class="sign">$</span><span
                                            class="value">600.00</span> </span> </div>
                            </div>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <div class="cart-item product-summary">
                                    <div class="row">
                                        <div class="col-xs-4">
                                            <div class="image"> <a href="detail.html"><img
                                                        src="{{ asset('front-theme/assets/images/cart.jpg') }}"
                                                        alt=""></a> </div>
                                        </div>
                                        <div class="col-xs-7">
                                            <h3 class="name"><a href="index.php?page-detail">Simple
                                                    Product</a></h3>
                                            <div class="price">$600.00</div>
                                        </div>
                                        <div class="col-xs-1 action"> <a href="#"><i class="fa fa-trash"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.cart-item -->
                                <div class="clearfix"></div>
                                <hr>
                                <div class="clearfix cart-total">
                                    <div class="pull-right"> <span class="text">Sub Total :</span><span
                                            class='price'>$600.00</span> </div>
                                    <div class="clearfix"></div>
                                    <a href="checkout.html"
                                        class="btn btn-upper btn-primary btn-block m-t-20">Checkout</a>
                                </div>
                                <!-- /.cart-total-->

                            </li>
                        </ul>
                        <!-- /.dropdown-menu-->
                    </div>
                    <!-- /.dropdown-cart -->

                    <!-- ============================================================= SHOPPING CART DROPDOWN : END============================================================= -->
                </div>
                <!-- /.top-cart-row -->
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container -->

    </div>
    <!-- /.main-header -->

    <!-- ============================================== NAVBAR ============================================== -->
    <div class="header-nav animate-dropdown">
        <div class="container">
            <div class="yamm navbar navbar-default" role="navigation">
                <div class="navbar-header">
                    <button data-target="#mc-horizontal-menu-collapse" data-toggle="collapse"
                        class="navbar-toggle collapsed" type="button">
                        <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span
                            class="icon-bar"></span> <span class="icon-bar"></span> </button>
                </div>
                <div class="nav-bg-class">
                    <div class="navbar-collapse collapse" id="mc-horizontal-menu-collapse">
                        <div class="nav-outer">
                            <ul class="nav navbar-nav">
                                <li class="active dropdown yamm-fw"> <a href="{{ url('/') }}"
                                        class="dropdown-toggle">Home</a> </li>
                                @foreach ($categories as $category)
                                    <li class="dropdown yamm mega-menu">
                                        <a href="{{ url('/product/category/' . $category->id) }}"
                                            data-hover="dropdown"
                                            class="dropdown-toggle">{{ $category->category_name }}</a>
                                        <ul class="dropdown-menu container">
                                            <li>
                                                <div class="yamm-content ">
                                                    <div class="row">
                                                        <div class="col-xs-12 col-sm-6 col-md-8 col-menu">
                                                            <ul class="links">
                                                                @foreach ($subcategories as $subcategory)
                                                                    @if ($subcategory->category->category_name == $category->category_name)
                                                                        <li class="col-xs-12 col-sm-6 col-md-3 link"><a
                                                                                href="{{ url('/product/subcategory/' . $subcategory->id) }}">{{ $subcategory->subcategory_name }}</a>
                                                                        </li>
                                                                    @endif
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                        <!-- /.col -->

                                                        <div
                                                            class="col-xs-12 col-sm-6 col-md-4 col-menu banner-image pb-3">
                                                            <img class="img-responsive" style="max-height: 200px;"
                                                                src="{{ asset('storage/' . $category->category_image) }}"
                                                                alt="">
                                                        </div>
                                                        {{-- <div class="col-xs-12 col-sm-6 col-md-4 col-menu banner-image">
                                                            <img class="img-responsive"
                                                                src="{{ asset('front-theme/assets/images/banners/top-menu-banner.jpg') }}"
                                                                alt="">
                                                        </div> --}}
                                                        <!-- /.yamm-content -->
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                @endforeach
                                <li class="dropdown"> <a href="#" class="dropdown-toggle" data-hover="dropdown"
                                        data-toggle="dropdown">Pages</a>
                                    <ul class="dropdown-menu pages">
                                        <li>
                                            <div class="yamm-content">
                                                <div class="row">
                                                    <div class="col-xs-12 col-menu">
                                                        <ul class="links">
                                                            <li><a href="home.html">Home</a></li>
                                                            <li><a href="category.html">Category</a></li>
                                                            <li><a href="detail.html">Detail</a></li>
                                                            <li><a href="shopping-cart.html">Shopping Cart Summary</a>
                                                            </li>
                                                            <li><a href="checkout.html">Checkout</a></li>
                                                            <li><a href="blog.html">Blog</a></li>
                                                            <li><a href="blog-details.html">Blog Detail</a></li>
                                                            <li><a href="contact.html">Contact</a></li>
                                                            <li><a href="{{ route('login') }}">Sign In</a></li>
                                                            <li><a href="my-wishlist.html">Wishlist</a></li>
                                                            <li><a href="terms-conditions.html">Terms and Condition</a>
                                                            </li>
                                                            <li><a href="track-orders.html">Track Orders</a></li>
                                                            <li><a href="product-comparison.html">Product-Comparison</a>
                                                            </li>
                                                            <li><a href="faq.html">FAQ</a></li>
                                                            <li><a href="404.html">404</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li class="dropdown  navbar-right special-menu"> <a href="#">Todays offer</a> </li>
                            </ul>
                            <!-- /.navbar-nav -->
                            <div class="clearfix"></div>
                        </div>
                        <!-- /.nav-outer -->
                    </div>
                    <!-- /.navbar-collapse -->

                </div>
                <!-- /.nav-bg-class -->
            </div>
            <!-- /.navbar-default -->
        </div>
        <!-- /.container-class -->

    </div>
    <!-- /.header-nav -->
    <!-- ============================================== NAVBAR : END ============================================== -->

</header>
