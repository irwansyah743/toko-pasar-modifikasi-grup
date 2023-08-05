@php
$categories = App\Models\Category::orderBy('nama_kategori', 'ASC')->get();
$subcategories = App\Models\SubCategory::latest()->get();
@endphp

<header class="header-style-1">

    <!-- ============================================== TOP MENU ============================================== -->
    <div class="top-bar animate-dropdown">
        <div class="container">
            <div class="header-top-inner">
                <div class="cnt-account">
                    <ul class="list-unstyled">

                        <li><a href="{{ route('wishlist') }}"><i class="icon fa fa-heart"></i>Wishlist</a></li>
                        <li><a href="{{ route('mycart') }}"><i class="icon fa fa-shopping-cart"></i>Keranjang</a></li>
                        <li><a href="{{ route('checkout') }}"><i class="icon fa fa-check"></i>Checkout</a></li>
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
                    <div class="logo">
                        <a href="{{ url('/') }}" style="font-size: 18px; color: white; font-weight: bold;">
                            TokoPasarModifikasiGrup
                            {{-- <img src="{{ asset('front-theme/assets/images/logo.png') }}" alt="logo">  --}}
                        </a>
                    </div>
                    <!-- /.logo -->
                    <!-- ============================================================= LOGO : END ============================================================= -->
                </div>
                <!-- /.logo-holder -->

                <div class="col-xs-12 col-sm-12 col-md-7 top-search-holder">
                    <!-- /.contact-row -->
                    <!-- ============================================================= SEARCH AREA ============================================================= -->
                    <div class="search-area">
                        <form action="{{ route('search') }}" method="get">
                            @csrf
                            <div class="control-group">
                                <input class="search-field" type="text" name="keyword"
                                    placeholder="Search here..." />

                                <button class="search-button"></button>
                            </div>
                        </form>
                    </div>
                    <!-- /.search-area -->
                    <!-- ============================================================= SEARCH AREA : END ============================================================= -->
                </div>
                <!-- /.top-search-holder -->

                <div class="col-xs-12 col-sm-12 col-md-2 animate-dropdown top-cart-row">

                    <!-- ===== === SHOPPING CART DROPDOWN ===== == -->

                    <div class="dropdown dropdown-cart"> <a href="#" class="dropdown-toggle lnk-cart"
                            data-toggle="dropdown">
                            <div class="items-cart-inner">
                                <div class="basket"> <i class="glyphicon glyphicon-shopping-cart"></i> </div>
                                <div class="basket-item-count"><span class="count" id="cartQty"> </span></div>
                                <div class="total-price-basket"> <span class="lbl">Rp -</span>
                                    <span class="total-price"><span class="sign cartTotal"></span></span>

                                </div>
                            </div>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <!--   // Mini Cart Start with Ajax -->

                                <div id="miniCart">

                                </div>

                                <!--   // End Mini Cart Start with Ajax -->


                                <div class="clearfix cart-total">
                                    <div class="pull-right"> <span class="text">Sub Total :</span>
                                        <span class='price cartTotal'> </span>
                                    </div>
                                    <div class="clearfix"></div>
                                    <a href="{{ route('checkout') }}"
                                        class="btn btn-upper btn-primary btn-block m-t-20">Checkout</a>
                                </div>
                                <!-- /.cart-total-->

                            </li>
                        </ul>
                        <!-- /.dropdown-menu-->
                    </div>
                    <!-- /.dropdown-cart -->

                    <!-- == === SHOPPING CART DROPDOWN : END=== === -->
                </div>
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
                                <li class="dropdown yamm-fw"> <a href="{{ url('/') }}"
                                        class="dropdown-toggle">Home</a> </li>
                                @foreach ($categories as $category)
                                    <li class="dropdown yamm mega-menu">
                                        <a href="{{ url('/product/category/' . $category->getKey()) }}"
                                            data-hover="dropdown"
                                            class="dropdown-toggle">{{ $category->nama_kategori }}</a>
                                        <ul class="dropdown-menu container">
                                            <li>
                                                <div class="yamm-content ">
                                                    <div class="row">
                                                        <div class="col-xs-12 col-sm-6 col-md-8 col-menu">
                                                            <ul class="links">
                                                                @foreach ($subcategories as $subcategory)
                                                                    @if ($subcategory->category->nama_kategori == $category->nama_kategori)
                                                                        <li class="col-xs-12 col-sm-6 col-md-3 link"><a
                                                                                href="{{ url('/product/subcategory/' . $subcategory->getKey()) }}">{{ $subcategory->nama_subkategori }}</a>
                                                                        </li>
                                                                    @endif
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                        <!-- /.col -->

                                                        <div
                                                            class="col-xs-12 col-sm-6 col-md-4 col-menu banner-image pb-3">
                                                            <img class="img-responsive" style="max-height: 200px;"
                                                                src="{{ asset('storage/' . $category->gambar_kategori) }}"
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
