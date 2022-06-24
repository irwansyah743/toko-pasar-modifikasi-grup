@extends('front.master')
@section('title')
    Home | Flipmart
@endsection
@section('content')
    <div class="body-content outer-top-xs" id="top-banner-and-menu">
        <div class="container">
            <div class="row">
                <!-- ============================================== SIDEBAR ============================================== -->
                <div class="col-xs-12 col-sm-12 col-md-3 sidebar">
                    @include('front.common.sidebar')

                    <!-- ============================================== CONTENT ============================================== -->
                    <div class="col-xs-12 col-sm-12 col-md-9 homebanner-holder">
                        <!-- ========================================== SECTION – HERO ========================================= -->

                        <div id="hero">
                            <div id="owl-main" class="owl-carousel owl-inner-nav owl-ui-sm">
                                @foreach ($sliders as $slider)
                                    <div class="item hero-image"
                                        style="background-image: linear-gradient(rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.2)),url( {{ asset('storage/' . $slider->slider_img) }});">
                                        <div class="container-fluid ">
                                            <div class="caption bg-color vertical-center text-left">
                                                <h1 class="big-text fadeInDown-1 white">{{ $slider->title }} </h1>
                                                <div class="excerpt fadeInDown-2 hidden-xs white">
                                                    <p>{!! $slider->description !!}</p>
                                                </div>
                                                <div class="button-holder fadeInDown-3"> <a
                                                        href="index.php?page=single-product"
                                                        class="btn-lg btn btn-uppercase btn-primary shop-now-button">Shop
                                                        Now</a>
                                                </div>
                                            </div>
                                            <!-- /.caption -->
                                        </div>
                                        <!-- /.container-fluid -->
                                    </div>
                                    <!-- /.item -->
                                @endforeach
                            </div>
                            <!-- /.owl-carousel -->
                        </div>

                        <!-- ========================================= SECTION – HERO : END ========================================= -->

                        <!-- ============================================== INFO BOXES ============================================== -->
                        <div class="info-boxes wow fadeInUp">
                            <div class="info-boxes-inner">
                                <div class="row">
                                    <div class="col-md-6 col-sm-4 col-lg-4">
                                        <div class="info-box">
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <h4 class="info-box-heading green">money back</h4>
                                                </div>
                                            </div>
                                            <h6 class="text">30 Days Money Back Guarantee</h6>
                                        </div>
                                    </div>
                                    <!-- .col -->

                                    <div class="hidden-md col-sm-4 col-lg-4">
                                        <div class="info-box">
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <h4 class="info-box-heading green">free shipping</h4>
                                                </div>
                                            </div>
                                            <h6 class="text">Shipping on orders over $99</h6>
                                        </div>
                                    </div>
                                    <!-- .col -->

                                    <div class="col-md-6 col-sm-4 col-lg-4">
                                        <div class="info-box">
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <h4 class="info-box-heading green">Special Sale</h4>
                                                </div>
                                            </div>
                                            <h6 class="text">Extra $5 off on all items </h6>
                                        </div>
                                    </div>
                                    <!-- .col -->
                                </div>
                                <!-- /.row -->
                            </div>
                            <!-- /.info-boxes-inner -->

                        </div>
                        <!-- /.info-boxes -->
                        <!-- ============================================== INFO BOXES : END ============================================== -->
                        <!-- ============================================== SCROLL TABS ============================================== -->
                        <div id="product-tabs-slider" class="scroll-tabs outer-top-vs wow fadeInUp">
                            <div class="more-info-tab clearfix ">
                                <h3 class="new-product-title pull-left">New Products</h3>
                                <ul class="nav nav-tabs nav-tab-line pull-right" id="new-products-1">
                                    <li class="active"><a data-transition-type="backSlide" href="#all"
                                            data-toggle="tab">All</a></li>

                                    @foreach ($categories as $category)
                                        <li><a data-transition-type="backSlide" href="#{{ $category->category_slug }}"
                                                data-toggle="tab">{{ $category->category_name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                                <!-- /.nav-tabs -->
                            </div>
                            <div class="tab-content outer-top-xs">

                                <div class="tab-pane in active" id="all">
                                    <div class="product-slider">
                                        <div class="owl-carousel home-owl-carousel custom-carousel owl-theme"
                                            data-item="4">
                                            @foreach ($newProducts as $product)
                                                <div class="item item-carousel">
                                                    <div class="products">
                                                        <div class="product">
                                                            <div class="product-image">
                                                                <div class="image"> <a
                                                                        href="{{ url('product/detail/' . $product->product_slug) }}"><img
                                                                            src=" {{ asset('storage/' . $product->product_thambnail) }}"
                                                                            alt=""></a> </div>
                                                                <!-- /.image -->
                                                                @php
                                                                    $amount = $product->selling_price - $product->discount_price;
                                                                    $discount = ($amount / $product->selling_price) * 100;
                                                                @endphp

                                                                <div>
                                                                    @if ($product->discount_price == null)
                                                                        <div class="tag new"><span>new</span></div>
                                                                    @else
                                                                        <div class="tag hot">
                                                                            <span>{{ round($discount) }}%</span>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <!-- /.product-image -->

                                                            <div class="product-info text-left">
                                                                <h3 class="name"><a
                                                                        href="{{ url('product/detail/' . $product->product_slug) }}">{{ $product->product_name }}</a>
                                                                </h3>
                                                                <div class="rating rateit-small"></div>
                                                                <div class="description"></div>
                                                                <div class="product-price">
                                                                    @if ($product->discount_price)
                                                                        <span class="price">
                                                                            Rp.{{ $product->discount_price }}K
                                                                        </span>
                                                                        <span
                                                                            class="price-before-discount">Rp.{{ $product->selling_price }}K
                                                                        </span>
                                                                    @else
                                                                        <span class="price">
                                                                            Rp.{{ $product->selling_price }}K
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                                <!-- /.product-price -->

                                                            </div>
                                                            <!-- /.product-info -->
                                                            <div class="cart clearfix animate-effect">
                                                                <div class="action">
                                                                    <ul class="list-unstyled">
                                                                        <li class="add-cart-button btn-group">
                                                                            <button data-toggle="modal"
                                                                                data-target="#exampleModal"
                                                                                class="btn btn-primary icon" type="button"
                                                                                title="Add Cart" id="{{ $product->id }}"
                                                                                onclick="productView(this.id)">
                                                                                <i class="fa fa-shopping-cart"></i>
                                                                            </button>
                                                                            <button class="btn btn-primary cart-btn"
                                                                                type="button">Add to cart</button>
                                                                        </li>
                                                                        <button class="btn btn-primary icon" type="button"
                                                                            title="Wishlist" id="{{ $product->id }}"
                                                                            onclick="addToWishList(this.id)"> <i
                                                                                class="fa fa-heart"></i> </button>


                                                                        <li class="lnk"> <a data-toggle="tooltip"
                                                                                class="add-to-cart" href="detail.html"
                                                                                title="Compare"> <i class="fa fa-signal"
                                                                                    aria-hidden="true"></i> </a> </li>
                                                                    </ul>
                                                                </div>
                                                                <!-- /.action -->
                                                            </div>
                                                            <!-- /.cart -->
                                                        </div>
                                                        <!-- /.product -->

                                                    </div>
                                                    <!-- /.products -->
                                                </div>
                                                <!-- /.item -->
                                            @endforeach


                                        </div>
                                        <!-- /.home-owl-carousel -->
                                    </div>
                                    <!-- /.product-slider -->
                                </div>
                                <!-- /.tab-pane -->

                                @foreach ($categories as $category)
                                    <div class="tab-pane" id="{{ $category->category_slug }}">
                                        <div class="product-slider">
                                            <div class="owl-carousel home-owl-carousel custom-carousel owl-theme"
                                                data-item="4">
                                                @forelse ($newProducts as $product)
                                                    @if ($product->category_id == $category->id)
                                                        <div class="item item-carousel">
                                                            <div class="products">
                                                                <div class="product">
                                                                    <div class="product-image">
                                                                        <div class="image"> <a
                                                                                href="{{ url('product/detail/' . $product->product_slug) }}"><img
                                                                                    src=" {{ asset('storage/' . $product->product_thambnail) }}"
                                                                                    alt=""></a> </div>
                                                                        <!-- /.image -->
                                                                        @php
                                                                            $amount = $product->selling_price - $product->discount_price;
                                                                            $discount = ($amount / $product->selling_price) * 100;
                                                                        @endphp

                                                                        <div>
                                                                            @if ($product->discount_price == null)
                                                                                <div class="tag new"><span>new</span>
                                                                                </div>
                                                                            @else
                                                                                <div class="tag hot">
                                                                                    <span>{{ round($discount) }}%</span>
                                                                                </div>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <!-- /.product-image -->

                                                                    <div class="product-info text-left">
                                                                        <h3 class="name"><a
                                                                                href="{{ url('product/detail/' . $product->product_slug) }}">{{ $product->product_name }}</a>
                                                                        </h3>
                                                                        <div class="rating rateit-small"></div>
                                                                        <div class="description"></div>
                                                                        <div class="product-price">
                                                                            @if ($product->discount_price)
                                                                                <span class="price">
                                                                                    Rp.{{ $product->discount_price }}K
                                                                                </span>
                                                                                <span
                                                                                    class="price-before-discount">Rp.{{ $product->selling_price }}K
                                                                                </span>
                                                                            @else
                                                                                <span class="price">
                                                                                    Rp.{{ $product->selling_price }}K
                                                                                </span>
                                                                            @endif
                                                                        </div>
                                                                        <!-- /.product-price -->

                                                                    </div>
                                                                    <!-- /.product-info -->
                                                                    <div class="cart clearfix animate-effect">
                                                                        <div class="action">
                                                                            <ul class="list-unstyled">
                                                                                <li class="add-cart-button btn-group">
                                                                                    <button data-toggle="modal"
                                                                                        data-target="#exampleModal"
                                                                                        class="btn btn-primary icon"
                                                                                        type="button" title="Add Cart"
                                                                                        id="{{ $product->id }}"
                                                                                        onclick="productView(this.id)">
                                                                                        <i class="fa fa-shopping-cart"></i>
                                                                                    </button>
                                                                                    <button data-toggle="modal"
                                                                                        data-target="#exampleModal"
                                                                                        title="Add Cart"
                                                                                        id="{{ $product->id }}"
                                                                                        onclick="productView(this.id)"
                                                                                        class="btn btn-primary cart-btn"
                                                                                        type="button">Add to cart</button>
                                                                                </li>
                                                                                <button class="btn btn-primary icon"
                                                                                    type="button" title="Wishlist"
                                                                                    id="{{ $product->id }}"
                                                                                    onclick="addToWishList(this.id)">
                                                                                    <i class="fa fa-heart"></i>
                                                                                </button>
                                                                                <li class="lnk"> <a
                                                                                        data-toggle="tooltip"
                                                                                        class="add-to-cart"
                                                                                        href="detail.html"
                                                                                        title="Compare">
                                                                                        <i class="fa fa-signal"
                                                                                            aria-hidden="true"></i> </a>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                        <!-- /.action -->
                                                                    </div>
                                                                    <!-- /.cart -->
                                                                </div>
                                                                <!-- /.product -->

                                                            </div>
                                                            <!-- /.products -->
                                                        </div>
                                                        <!-- /.item -->
                                                    @endif
                                                @empty
                                                    <h5 class="text-danger">No new product for this category</h5>
                                                @endforelse


                                            </div>
                                            <!-- /.home-owl-carousel -->
                                        </div>
                                        <!-- /.product-slider -->
                                    </div>
                                    <!-- /.tab-pane -->
                                @endforeach

                            </div>
                            <!-- /.tab-content -->
                        </div>
                        <!-- /.scroll-tabs -->
                        <!-- ============================================== SCROLL TABS : END ============================================== -->
                        <!-- ============================================== WIDE PRODUCTS ============================================== -->
                        <div class="wide-banners wow fadeInUp outer-bottom-xs">
                            <div class="row">
                                <div class="col-md-7 col-sm-7">
                                    <div class="wide-banner cnt-strip">
                                        <div class="image"> <img class="img-responsive"
                                                src=" {{ asset('front-theme/assets/images/banners/home-banner1.jpg') }}"
                                                alt=""> </div>
                                    </div>
                                    <!-- /.wide-banner -->
                                </div>
                                <!-- /.col -->
                                <div class="col-md-5 col-sm-5">
                                    <div class="wide-banner cnt-strip">
                                        <div class="image"> <img class="img-responsive"
                                                src=" {{ asset('front-theme/assets/images/banners/home-banner2.jpg') }}"
                                                alt=""> </div>
                                    </div>
                                    <!-- /.wide-banner -->
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.wide-banners -->

                        <!-- ============================================== WIDE PRODUCTS : END ============================================== -->
                        <!-- ============================================== FEATURED PRODUCTS ============================================== -->
                        <section class="section featured-product wow fadeInUp">
                            <h3 class="section-title">Featured products</h3>
                            <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">
                                @foreach ($featuredProducts as $product)
                                    <div class="item item-carousel">
                                        <div class="products">
                                            <div class="product">
                                                <div class="product-image">
                                                    <div class="image"> <a
                                                            href="{{ url('product/detail/' . $product->product_slug) }}"><img
                                                                src=" {{ asset('storage/' . $product->product_thambnail) }}"
                                                                alt=""></a> </div>
                                                    <!-- /.image -->

                                                    @php
                                                        $amount = $product->selling_price - $product->discount_price;
                                                        $discount = ($amount / $product->selling_price) * 100;
                                                    @endphp

                                                    <div>
                                                        @if ($product->discount_price)
                                                            <div class="tag hot">
                                                                <span>{{ round($discount) }}%</span>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <!-- /.product-image -->

                                                <div class="product-info text-left">
                                                    <h3 class="name"><a
                                                            href="{{ url('product/detail/' . $product->product_slug) }}">{{ $product->product_name }}</a>
                                                    </h3>
                                                    <div class="rating rateit-small"></div>
                                                    <div class="description"></div>
                                                    <div class="product-price">
                                                        @if ($product->discount_price)
                                                            <span class="price">
                                                                Rp.{{ $product->discount_price }}K
                                                            </span>
                                                            <span
                                                                class="price-before-discount">Rp.{{ $product->selling_price }}K
                                                            </span>
                                                        @else
                                                            <span class="price">
                                                                Rp.{{ $product->selling_price }}K
                                                            </span>
                                                        @endif
                                                    </div>
                                                    <!-- /.product-price -->

                                                </div>
                                                <!-- /.product-info -->
                                                <div class="cart clearfix animate-effect">
                                                    <div class="action">
                                                        <ul class="list-unstyled">
                                                            <li class="add-cart-button btn-group">
                                                                <button data-toggle="modal" data-target="#exampleModal"
                                                                    class="btn btn-primary icon" type="button"
                                                                    title="Add Cart" id="{{ $product->id }}"
                                                                    onclick="productView(this.id)"> <i
                                                                        class="fa fa-shopping-cart"></i>
                                                                </button>
                                                                <button class="btn btn-primary cart-btn"
                                                                    type="button">Add
                                                                    to cart</button>
                                                            </li>
                                                            <button class="btn btn-primary icon" type="button"
                                                                title="Wishlist" id="{{ $product->id }}"
                                                                onclick="addToWishList(this.id)"> <i
                                                                    class="fa fa-heart"></i> </button>
                                                            <li class="lnk"> <a data-toggle="tooltip"
                                                                    class="add-to-cart" href="detail.html"
                                                                    title="Compare">
                                                                    <i class="fa fa-signal" aria-hidden="true"></i>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <!-- /.action -->
                                                </div>
                                                <!-- /.cart -->
                                            </div>
                                            <!-- /.product -->

                                        </div>
                                        <!-- /.products -->
                                    </div>
                                    <!-- /.item -->
                                @endforeach
                            </div>
                            <!-- /.home-owl-carousel -->
                        </section>
                        <!-- /.section -->
                        <!-- ============================================== FEATURED PRODUCTS : END ============================================== -->
                        <!-- ============================================== WIDE PRODUCTS ============================================== -->
                        <div class="wide-banners wow fadeInUp outer-bottom-xs">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="wide-banner cnt-strip">
                                        <div class="image"> <img class="img-responsive"
                                                src=" {{ asset('front-theme/assets/images/banners/home-banner.jpg') }}"
                                                alt=""> </div>
                                        <div class="strip strip-text">
                                            <div class="strip-inner">
                                                <h2 class="text-right">New Mens Fashion<br>
                                                    <span class="shopping-needs">Save up to 40% off</span>
                                                </h2>
                                            </div>
                                        </div>
                                        <div class="new-label">
                                            <div class="text">NEW</div>
                                        </div>
                                        <!-- /.new-label -->
                                    </div>
                                    <!-- /.wide-banner -->
                                </div>
                                <!-- /.col -->

                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.wide-banners -->
                        <!-- ============================================== WIDE PRODUCTS : END ============================================== -->

                        <!-- ============================================== PREMIER LEAGUE PRODUCTS ============================================== -->
                        <section class="section featured-product wow fadeInUp">
                            <h3 class="section-title">Premier League</h3>
                            <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">
                                @foreach ($premProducts as $product)
                                    <div class="item item-carousel">
                                        <div class="products">
                                            <div class="product">
                                                <div class="product-image">
                                                    <div class="image"> <a
                                                            href="{{ url('product/detail/' . $product->product_slug) }}"><img
                                                                src=" {{ asset('storage/' . $product->product_thambnail) }}"
                                                                alt=""></a> </div>
                                                    <!-- /.image -->

                                                    @php
                                                        $amount = $product->selling_price - $product->discount_price;
                                                        $discount = ($amount / $product->selling_price) * 100;
                                                    @endphp

                                                    <div>
                                                        @if ($product->discount_price)
                                                            <div class="tag hot">
                                                                <span>{{ round($discount) }}%</span>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <!-- /.product-image -->

                                                <div class="product-info text-left">
                                                    <h3 class="name"><a
                                                            href="{{ url('product/detail/' . $product->product_slug) }}">{{ $product->product_name }}</a>
                                                    </h3>
                                                    <div class="rating rateit-small"></div>
                                                    <div class="description"></div>
                                                    <div class="product-price">
                                                        @if ($product->discount_price)
                                                            <span class="price">
                                                                Rp.{{ $product->discount_price }}K
                                                            </span>
                                                            <span
                                                                class="price-before-discount">Rp.{{ $product->selling_price }}K
                                                            </span>
                                                        @else
                                                            <span class="price">
                                                                Rp.{{ $product->selling_price }}K
                                                            </span>
                                                        @endif
                                                    </div>
                                                    <!-- /.product-price -->

                                                </div>
                                                <!-- /.product-info -->
                                                <div class="cart clearfix animate-effect">
                                                    <div class="action">
                                                        <ul class="list-unstyled">
                                                            <li class="add-cart-button btn-group">
                                                                <button data-toggle="modal" data-target="#exampleModal"
                                                                    class="btn btn-primary icon" type="button"
                                                                    title="Add Cart" id="{{ $product->id }}"
                                                                    onclick="productView(this.id)"> <i
                                                                        class="fa fa-shopping-cart"></i>
                                                                </button>
                                                                <button class="btn btn-primary cart-btn"
                                                                    type="button">Add
                                                                    to cart</button>
                                                            </li>
                                                            <button class="btn btn-primary icon" type="button"
                                                                title="Wishlist" id="{{ $product->id }}"
                                                                onclick="addToWishList(this.id)"> <i
                                                                    class="fa fa-heart"></i> </button>
                                                            <li class="lnk"> <a data-toggle="tooltip"
                                                                    class="add-to-cart" href="detail.html"
                                                                    title="Compare">
                                                                    <i class="fa fa-signal" aria-hidden="true"></i>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <!-- /.action -->
                                                </div>
                                                <!-- /.cart -->
                                            </div>
                                            <!-- /.product -->

                                        </div>
                                        <!-- /.products -->
                                    </div>
                                    <!-- /.item -->
                                @endforeach
                            </div>
                            <!-- /.home-owl-carousel -->
                        </section>
                        <!-- /.section -->
                        <!-- ============================================== PREMIER LEAGUE PRODUCTS : END ============================================== -->
                        <!-- ============================================== LA LIGA PRODUCTS ============================================== -->
                        <section class="section featured-product wow fadeInUp">
                            <h3 class="section-title">Premier League</h3>
                            <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">
                                @foreach ($laligaProducts as $product)
                                    <div class="item item-carousel">
                                        <div class="products">
                                            <div class="product">
                                                <div class="product-image">
                                                    <div class="image"> <a
                                                            href="{{ url('product/detail/' . $product->product_slug) }}"><img
                                                                src=" {{ asset('storage/' . $product->product_thambnail) }}"
                                                                alt=""></a> </div>
                                                    <!-- /.image -->

                                                    @php
                                                        $amount = $product->selling_price - $product->discount_price;
                                                        $discount = ($amount / $product->selling_price) * 100;
                                                    @endphp

                                                    <div>
                                                        @if ($product->discount_price)
                                                            <div class="tag hot">
                                                                <span>{{ round($discount) }}%</span>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <!-- /.product-image -->

                                                <div class="product-info text-left">
                                                    <h3 class="name"><a
                                                            href="{{ url('product/detail/' . $product->product_slug) }}">{{ $product->product_name }}</a>
                                                    </h3>
                                                    <div class="rating rateit-small"></div>
                                                    <div class="description"></div>
                                                    <div class="product-price">
                                                        @if ($product->discount_price)
                                                            <span class="price">
                                                                Rp.{{ $product->discount_price }}K
                                                            </span>
                                                            <span
                                                                class="price-before-discount">Rp.{{ $product->selling_price }}K
                                                            </span>
                                                        @else
                                                            <span class="price">
                                                                Rp.{{ $product->selling_price }}K
                                                            </span>
                                                        @endif
                                                    </div>
                                                    <!-- /.product-price -->

                                                </div>
                                                <!-- /.product-info -->
                                                <div class="cart clearfix animate-effect">
                                                    <div class="action">
                                                        <ul class="list-unstyled">
                                                            <li class="add-cart-button btn-group">
                                                                <button data-toggle="modal" data-target="#exampleModal"
                                                                    class="btn btn-primary icon" type="button"
                                                                    title="Add Cart" id="{{ $product->id }}"
                                                                    onclick="productView(this.id)"> <i
                                                                        class="fa fa-shopping-cart"></i>
                                                                </button>
                                                                <button class="btn btn-primary cart-btn"
                                                                    type="button">Add
                                                                    to cart</button>
                                                            </li>
                                                            <button class="btn btn-primary icon" type="button"
                                                                title="Wishlist" id="{{ $product->id }}"
                                                                onclick="addToWishList(this.id)"> <i
                                                                    class="fa fa-heart"></i> </button>
                                                            <li class="lnk"> <a data-toggle="tooltip"
                                                                    class="add-to-cart" href="detail.html"
                                                                    title="Compare">
                                                                    <i class="fa fa-signal" aria-hidden="true"></i>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <!-- /.action -->
                                                </div>
                                                <!-- /.cart -->
                                            </div>
                                            <!-- /.product -->

                                        </div>
                                        <!-- /.products -->
                                    </div>
                                    <!-- /.item -->
                                @endforeach
                            </div>
                            <!-- /.home-owl-carousel -->
                        </section>
                        <!-- /.section -->
                        <!-- ============================================== LA LIGA PRODUCTS : END ============================================== -->

                        <!-- ============================================== ADIDAS PRODUCTS ============================================== -->
                        <section class="section featured-product wow fadeInUp">
                            <h3 class="section-title">Adidas</h3>
                            <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">
                                @foreach ($adidasProducts as $product)
                                    <div class="item item-carousel">
                                        <div class="products">
                                            <div class="product">
                                                <div class="product-image">
                                                    <div class="image"> <a
                                                            href="{{ url('product/detail/' . $product->product_slug) }}"><img
                                                                src=" {{ asset('storage/' . $product->product_thambnail) }}"
                                                                alt=""></a> </div>
                                                    <!-- /.image -->

                                                    @php
                                                        $amount = $product->selling_price - $product->discount_price;
                                                        $discount = ($amount / $product->selling_price) * 100;
                                                    @endphp

                                                    <div>
                                                        @if ($product->discount_price)
                                                            <div class="tag hot">
                                                                <span>{{ round($discount) }}%</span>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <!-- /.product-image -->

                                                <div class="product-info text-left">
                                                    <h3 class="name"><a
                                                            href="{{ url('product/detail/' . $product->product_slug) }}">{{ $product->product_name }}</a>
                                                    </h3>
                                                    <div class="rating rateit-small"></div>
                                                    <div class="description"></div>
                                                    <div class="product-price">
                                                        @if ($product->discount_price)
                                                            <span class="price">
                                                                Rp.{{ $product->discount_price }}K
                                                            </span>
                                                            <span
                                                                class="price-before-discount">Rp.{{ $product->selling_price }}K
                                                            </span>
                                                        @else
                                                            <span class="price">
                                                                Rp.{{ $product->selling_price }}K
                                                            </span>
                                                        @endif
                                                    </div>
                                                    <!-- /.product-price -->

                                                </div>
                                                <!-- /.product-info -->
                                                <div class="cart clearfix animate-effect">
                                                    <div class="action">
                                                        <ul class="list-unstyled">
                                                            <li class="add-cart-button btn-group">
                                                                <button data-toggle="modal" data-target="#exampleModal"
                                                                    class="btn btn-primary icon" type="button"
                                                                    title="Add Cart" id="{{ $product->id }}"
                                                                    onclick="productView(this.id)"> <i
                                                                        class="fa fa-shopping-cart"></i>
                                                                </button>
                                                                <button class="btn btn-primary cart-btn"
                                                                    type="button">Add
                                                                    to cart</button>
                                                            </li>
                                                            <button class="btn btn-primary icon" type="button"
                                                                title="Wishlist" id="{{ $product->id }}"
                                                                onclick="addToWishList(this.id)"> <i
                                                                    class="fa fa-heart"></i> </button>
                                                            <li class="lnk"> <a data-toggle="tooltip"
                                                                    class="add-to-cart" href="detail.html"
                                                                    title="Compare">
                                                                    <i class="fa fa-signal" aria-hidden="true"></i>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <!-- /.action -->
                                                </div>
                                                <!-- /.cart -->
                                            </div>
                                            <!-- /.product -->

                                        </div>
                                        <!-- /.products -->
                                    </div>
                                    <!-- /.item -->
                                @endforeach
                            </div>
                            <!-- /.home-owl-carousel -->
                        </section>
                        <!-- /.section -->
                        <!-- ============================================== ADIDAS PRODUCTS : END ============================================== -->

                        <!-- ============================================== NIKE PRODUCTS ============================================== -->
                        <section class="section featured-product wow fadeInUp">
                            <h3 class="section-title">Nike</h3>
                            <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">
                                @foreach ($nikeProducts as $product)
                                    <div class="item item-carousel">
                                        <div class="products">
                                            <div class="product">
                                                <div class="product-image">
                                                    <div class="image"> <a
                                                            href="{{ url('product/detail/' . $product->product_slug) }}"><img
                                                                src=" {{ asset('storage/' . $product->product_thambnail) }}"
                                                                alt=""></a> </div>
                                                    <!-- /.image -->

                                                    @php
                                                        $amount = $product->selling_price - $product->discount_price;
                                                        $discount = ($amount / $product->selling_price) * 100;
                                                    @endphp

                                                    <div>
                                                        @if ($product->discount_price)
                                                            <div class="tag hot">
                                                                <span>{{ round($discount) }}%</span>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <!-- /.product-image -->

                                                <div class="product-info text-left">
                                                    <h3 class="name"><a
                                                            href="{{ url('product/detail/' . $product->product_slug) }}">{{ $product->product_name }}</a>
                                                    </h3>
                                                    <div class="rating rateit-small"></div>
                                                    <div class="description"></div>
                                                    <div class="product-price">
                                                        @if ($product->discount_price)
                                                            <span class="price">
                                                                Rp.{{ $product->discount_price }}K
                                                            </span>
                                                            <span
                                                                class="price-before-discount">Rp.{{ $product->selling_price }}K
                                                            </span>
                                                        @else
                                                            <span class="price">
                                                                Rp.{{ $product->selling_price }}K
                                                            </span>
                                                        @endif
                                                    </div>
                                                    <!-- /.product-price -->

                                                </div>
                                                <!-- /.product-info -->
                                                <div class="cart clearfix animate-effect">
                                                    <div class="action">
                                                        <ul class="list-unstyled">
                                                            <li class="add-cart-button btn-group">
                                                                <button data-toggle="modal" data-target="#exampleModal"
                                                                    class="btn btn-primary icon" type="button"
                                                                    title="Add Cart" id="{{ $product->id }}"
                                                                    onclick="productView(this.id)"> <i
                                                                        class="fa fa-shopping-cart"></i>
                                                                </button>
                                                                <button class="btn btn-primary cart-btn"
                                                                    type="button">Add
                                                                    to cart</button>
                                                            </li>
                                                            <button class="btn btn-primary icon" type="button"
                                                                title="Wishlist" id="{{ $product->id }}"
                                                                onclick="addToWishList(this.id)"> <i
                                                                    class="fa fa-heart"></i> </button>
                                                            <li class="lnk"> <a data-toggle="tooltip"
                                                                    class="add-to-cart" href="detail.html"
                                                                    title="Compare">
                                                                    <i class="fa fa-signal" aria-hidden="true"></i>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <!-- /.action -->
                                                </div>
                                                <!-- /.cart -->
                                            </div>
                                            <!-- /.product -->

                                        </div>
                                        <!-- /.products -->
                                    </div>
                                    <!-- /.item -->
                                @endforeach
                            </div>
                            <!-- /.home-owl-carousel -->
                        </section>
                        <!-- /.section -->
                        <!-- ============================================== NIKE PRODUCTS : END ============================================== -->


                        <!-- ============================================== BEST SELLER ============================================== -->

                        <div class="best-deal wow fadeInUp outer-bottom-xs">
                            <h3 class="section-title">Best seller</h3>
                            <div class="sidebar-widget-body outer-top-xs">
                                <div class="owl-carousel best-seller custom-carousel owl-theme outer-top-xs">
                                    <div class="item">
                                        <div class="products best-product">
                                            <div class="product">
                                                <div class="product-micro">
                                                    <div class="row product-micro-row">
                                                        <div class="col col-xs-5">
                                                            <div class="product-image">
                                                                <div class="image"> <a href="#"> <img
                                                                            src=" {{ asset('front-theme/assets/images/products/p20.jpg') }}"
                                                                            alt=""> </a>
                                                                </div>
                                                                <!-- /.image -->

                                                            </div>
                                                            <!-- /.product-image -->
                                                        </div>
                                                        <!-- /.col -->
                                                        <div class="col2 col-xs-7">
                                                            <div class="product-info">
                                                                <h3 class="name"><a href="#">Floral Print
                                                                        Buttoned</a></h3>
                                                                <div class="rating rateit-small"></div>
                                                                <div class="product-price"> <span class="price">
                                                                        $450.99 </span> </div>
                                                                <!-- /.product-price -->

                                                            </div>
                                                        </div>
                                                        <!-- /.col -->
                                                    </div>
                                                    <!-- /.product-micro-row -->
                                                </div>
                                                <!-- /.product-micro -->

                                            </div>
                                            <div class="product">
                                                <div class="product-micro">
                                                    <div class="row product-micro-row">
                                                        <div class="col col-xs-5">
                                                            <div class="product-image">
                                                                <div class="image"> <a href="#"> <img
                                                                            src=" {{ asset('front-theme/assets/images/products/p21.jpg') }}"
                                                                            alt=""> </a>
                                                                </div>
                                                                <!-- /.image -->

                                                            </div>
                                                            <!-- /.product-image -->
                                                        </div>
                                                        <!-- /.col -->
                                                        <div class="col2 col-xs-7">
                                                            <div class="product-info">
                                                                <h3 class="name"><a href="#">Floral Print
                                                                        Buttoned</a></h3>
                                                                <div class="rating rateit-small"></div>
                                                                <div class="product-price"> <span class="price">
                                                                        $450.99 </span> </div>
                                                                <!-- /.product-price -->

                                                            </div>
                                                        </div>
                                                        <!-- /.col -->
                                                    </div>
                                                    <!-- /.product-micro-row -->
                                                </div>
                                                <!-- /.product-micro -->

                                            </div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="products best-product">
                                            <div class="product">
                                                <div class="product-micro">
                                                    <div class="row product-micro-row">
                                                        <div class="col col-xs-5">
                                                            <div class="product-image">
                                                                <div class="image"> <a href="#"> <img
                                                                            src=" {{ asset('front-theme/assets/images/products/p22.jpg') }}"
                                                                            alt=""> </a>
                                                                </div>
                                                                <!-- /.image -->

                                                            </div>
                                                            <!-- /.product-image -->
                                                        </div>
                                                        <!-- /.col -->
                                                        <div class="col2 col-xs-7">
                                                            <div class="product-info">
                                                                <h3 class="name"><a href="#">Floral Print
                                                                        Buttoned</a></h3>
                                                                <div class="rating rateit-small"></div>
                                                                <div class="product-price"> <span class="price">
                                                                        $450.99 </span> </div>
                                                                <!-- /.product-price -->

                                                            </div>
                                                        </div>
                                                        <!-- /.col -->
                                                    </div>
                                                    <!-- /.product-micro-row -->
                                                </div>
                                                <!-- /.product-micro -->

                                            </div>
                                            <div class="product">
                                                <div class="product-micro">
                                                    <div class="row product-micro-row">
                                                        <div class="col col-xs-5">
                                                            <div class="product-image">
                                                                <div class="image"> <a href="#"> <img
                                                                            src=" {{ asset('front-theme/assets/images/products/p23.jpg') }}"
                                                                            alt=""> </a>
                                                                </div>
                                                                <!-- /.image -->

                                                            </div>
                                                            <!-- /.product-image -->
                                                        </div>
                                                        <!-- /.col -->
                                                        <div class="col2 col-xs-7">
                                                            <div class="product-info">
                                                                <h3 class="name"><a href="#">Floral Print
                                                                        Buttoned</a></h3>
                                                                <div class="rating rateit-small"></div>
                                                                <div class="product-price"> <span class="price">
                                                                        $450.99 </span> </div>
                                                                <!-- /.product-price -->

                                                            </div>
                                                        </div>
                                                        <!-- /.col -->
                                                    </div>
                                                    <!-- /.product-micro-row -->
                                                </div>
                                                <!-- /.product-micro -->

                                            </div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="products best-product">
                                            <div class="product">
                                                <div class="product-micro">
                                                    <div class="row product-micro-row">
                                                        <div class="col col-xs-5">
                                                            <div class="product-image">
                                                                <div class="image"> <a href="#"> <img
                                                                            src=" {{ asset('front-theme/assets/images/products/p24.jpg') }}"
                                                                            alt=""> </a>
                                                                </div>
                                                                <!-- /.image -->

                                                            </div>
                                                            <!-- /.product-image -->
                                                        </div>
                                                        <!-- /.col -->
                                                        <div class="col2 col-xs-7">
                                                            <div class="product-info">
                                                                <h3 class="name"><a href="#">Floral Print
                                                                        Buttoned</a></h3>
                                                                <div class="rating rateit-small"></div>
                                                                <div class="product-price"> <span class="price">
                                                                        $450.99 </span> </div>
                                                                <!-- /.product-price -->

                                                            </div>
                                                        </div>
                                                        <!-- /.col -->
                                                    </div>
                                                    <!-- /.product-micro-row -->
                                                </div>
                                                <!-- /.product-micro -->

                                            </div>
                                            <div class="product">
                                                <div class="product-micro">
                                                    <div class="row product-micro-row">
                                                        <div class="col col-xs-5">
                                                            <div class="product-image">
                                                                <div class="image"> <a href="#"> <img
                                                                            src=" {{ asset('front-theme/assets/images/products/p25.jpg') }}"
                                                                            alt=""> </a>
                                                                </div>
                                                                <!-- /.image -->

                                                            </div>
                                                            <!-- /.product-image -->
                                                        </div>
                                                        <!-- /.col -->
                                                        <div class="col2 col-xs-7">
                                                            <div class="product-info">
                                                                <h3 class="name"><a href="#">Floral Print
                                                                        Buttoned</a></h3>
                                                                <div class="rating rateit-small"></div>
                                                                <div class="product-price"> <span class="price">
                                                                        $450.99 </span> </div>
                                                                <!-- /.product-price -->

                                                            </div>
                                                        </div>
                                                        <!-- /.col -->
                                                    </div>
                                                    <!-- /.product-micro-row -->
                                                </div>
                                                <!-- /.product-micro -->

                                            </div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="products best-product">
                                            <div class="product">
                                                <div class="product-micro">
                                                    <div class="row product-micro-row">
                                                        <div class="col col-xs-5">
                                                            <div class="product-image">
                                                                <div class="image"> <a href="#"> <img
                                                                            src=" {{ asset('front-theme/assets/images/products/p26.jpg') }}"
                                                                            alt=""> </a>
                                                                </div>
                                                                <!-- /.image -->

                                                            </div>
                                                            <!-- /.product-image -->
                                                        </div>
                                                        <!-- /.col -->
                                                        <div class="col2 col-xs-7">
                                                            <div class="product-info">
                                                                <h3 class="name"><a href="#">Floral Print
                                                                        Buttoned</a></h3>
                                                                <div class="rating rateit-small"></div>
                                                                <div class="product-price"> <span class="price">
                                                                        $450.99 </span> </div>
                                                                <!-- /.product-price -->

                                                            </div>
                                                        </div>
                                                        <!-- /.col -->
                                                    </div>
                                                    <!-- /.product-micro-row -->
                                                </div>
                                                <!-- /.product-micro -->

                                            </div>
                                            <div class="product">
                                                <div class="product-micro">
                                                    <div class="row product-micro-row">
                                                        <div class="col col-xs-5">
                                                            <div class="product-image">
                                                                <div class="image"> <a href="#"> <img
                                                                            src=" {{ asset('front-theme/assets/images/products/p27.jpg') }}"
                                                                            alt=""> </a>
                                                                </div>
                                                                <!-- /.image -->

                                                            </div>
                                                            <!-- /.product-image -->
                                                        </div>
                                                        <!-- /.col -->
                                                        <div class="col2 col-xs-7">
                                                            <div class="product-info">
                                                                <h3 class="name"><a href="#">Floral Print
                                                                        Buttoned</a></h3>
                                                                <div class="rating rateit-small"></div>
                                                                <div class="product-price"> <span class="price">
                                                                        $450.99 </span> </div>
                                                                <!-- /.product-price -->

                                                            </div>
                                                        </div>
                                                        <!-- /.col -->
                                                    </div>
                                                    <!-- /.product-micro-row -->
                                                </div>
                                                <!-- /.product-micro -->

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.sidebar-widget-body -->
                        </div>
                        <!-- /.sidebar-widget -->
                        <!-- ============================================== BEST SELLER : END ============================================== -->

                        <!-- ============================================== BLOG SLIDER ============================================== -->
                        <section class="section latest-blog outer-bottom-vs wow fadeInUp">
                            <h3 class="section-title">latest form blog</h3>
                            <div class="blog-slider-container outer-top-xs">
                                <div class="owl-carousel blog-slider custom-carousel">
                                    <div class="item">
                                        <div class="blog-post">
                                            <div class="blog-post-image">
                                                <div class="image"> <a href="blog.html"><img
                                                            src=" {{ asset('front-theme/assets/images/blog-post/post1.jpg') }}"
                                                            alt=""></a> </div>
                                            </div>
                                            <!-- /.blog-post-image -->

                                            <div class="blog-post-info text-left">
                                                <h3 class="name"><a href="#">Voluptatem accusantium doloremque
                                                        laudantium</a></h3>
                                                <span class="info">By Jone Doe &nbsp;|&nbsp; 21 March 2016
                                                </span>
                                                <p class="text">Sed quia non numquam eius modi tempora incidunt
                                                    ut
                                                    labore et dolore magnam aliquam quaerat voluptatem.</p>
                                                <a href="#" class="lnk btn btn-primary">Read more</a>
                                            </div>
                                            <!-- /.blog-post-info -->

                                        </div>
                                        <!-- /.blog-post -->
                                    </div>
                                    <!-- /.item -->

                                    <div class="item">
                                        <div class="blog-post">
                                            <div class="blog-post-image">
                                                <div class="image"> <a href="blog.html"><img
                                                            src=" {{ asset('front-theme/assets/images/blog-post/post2.jpg') }}"
                                                            alt=""></a> </div>
                                            </div>
                                            <!-- /.blog-post-image -->

                                            <div class="blog-post-info text-left">
                                                <h3 class="name"><a href="#">Dolorem eum fugiat quo voluptas
                                                        nulla
                                                        pariatur</a></h3>
                                                <span class="info">By Saraha Smith &nbsp;|&nbsp; 21 March 2016
                                                </span>
                                                <p class="text">Sed quia non numquam eius modi tempora incidunt
                                                    ut
                                                    labore et dolore magnam aliquam quaerat voluptatem.</p>
                                                <a href="#" class="lnk btn btn-primary">Read more</a>
                                            </div>
                                            <!-- /.blog-post-info -->

                                        </div>
                                        <!-- /.blog-post -->
                                    </div>
                                    <!-- /.item -->

                                    <!-- /.item -->

                                    <div class="item">
                                        <div class="blog-post">
                                            <div class="blog-post-image">
                                                <div class="image"> <a href="blog.html"><img
                                                            src=" {{ asset('front-theme/assets/images/blog-post/post1.jpg') }}"
                                                            alt=""></a> </div>
                                            </div>
                                            <!-- /.blog-post-image -->

                                            <div class="blog-post-info text-left">
                                                <h3 class="name"><a href="#">Dolorem eum fugiat quo voluptas
                                                        nulla
                                                        pariatur</a></h3>
                                                <span class="info">By Saraha Smith &nbsp;|&nbsp; 21 March 2016
                                                </span>
                                                <p class="text">Sed ut perspiciatis unde omnis iste natus error
                                                    sit
                                                    voluptatem accusantium</p>
                                                <a href="#" class="lnk btn btn-primary">Read more</a>
                                            </div>
                                            <!-- /.blog-post-info -->

                                        </div>
                                        <!-- /.blog-post -->
                                    </div>
                                    <!-- /.item -->

                                    <div class="item">
                                        <div class="blog-post">
                                            <div class="blog-post-image">
                                                <div class="image"> <a href="blog.html"><img
                                                            src=" {{ asset('front-theme/assets/images/blog-post/post2.jpg') }}"
                                                            alt=""></a> </div>
                                            </div>
                                            <!-- /.blog-post-image -->

                                            <div class="blog-post-info text-left">
                                                <h3 class="name"><a href="#">Dolorem eum fugiat quo voluptas
                                                        nulla
                                                        pariatur</a></h3>
                                                <span class="info">By Saraha Smith &nbsp;|&nbsp; 21 March 2016
                                                </span>
                                                <p class="text">Sed ut perspiciatis unde omnis iste natus error
                                                    sit
                                                    voluptatem accusantium</p>
                                                <a href="#" class="lnk btn btn-primary">Read more</a>
                                            </div>
                                            <!-- /.blog-post-info -->

                                        </div>
                                        <!-- /.blog-post -->
                                    </div>
                                    <!-- /.item -->

                                    <div class="item">
                                        <div class="blog-post">
                                            <div class="blog-post-image">
                                                <div class="image"> <a href="blog.html"><img
                                                            src=" {{ asset('front-theme/assets/images/blog-post/post1.jpg') }}"
                                                            alt=""></a> </div>
                                            </div>
                                            <!-- /.blog-post-image -->

                                            <div class="blog-post-info text-left">
                                                <h3 class="name"><a href="#">Dolorem eum fugiat quo voluptas
                                                        nulla
                                                        pariatur</a></h3>
                                                <span class="info">By Saraha Smith &nbsp;|&nbsp; 21 March 2016
                                                </span>
                                                <p class="text">Sed ut perspiciatis unde omnis iste natus error
                                                    sit
                                                    voluptatem accusantium</p>
                                                <a href="#" class="lnk btn btn-primary">Read more</a>
                                            </div>
                                            <!-- /.blog-post-info -->

                                        </div>
                                        <!-- /.blog-post -->
                                    </div>
                                    <!-- /.item -->

                                </div>
                                <!-- /.owl-carousel -->
                            </div>
                            <!-- /.blog-slider-container -->
                        </section>
                        <!-- /.section -->
                        <!-- ============================================== BLOG SLIDER : END ============================================== -->

                        <!-- ============================================== FEATURED PRODUCTS ============================================== -->
                        <section class="section wow fadeInUp new-arriavls">
                            <h3 class="section-title">New Arrivals</h3>
                            <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">
                                <div class="item item-carousel">
                                    <div class="products">
                                        <div class="product">
                                            <div class="product-image">
                                                <div class="image"> <a href="detail.html"><img
                                                            src=" {{ asset('front-theme/assets/images/products/p19.jpg') }}"
                                                            alt=""></a> </div>
                                                <!-- /.image -->

                                                <div class="tag new"><span>new</span></div>
                                            </div>
                                            <!-- /.product-image -->

                                            <div class="product-info text-left">
                                                <h3 class="name"><a href="detail.html">Floral Print Buttoned</a>
                                                </h3>
                                                <div class="rating rateit-small"></div>
                                                <div class="description"></div>
                                                <div class="product-price"> <span class="price"> $450.99
                                                    </span>
                                                    <span class="price-before-discount">$ 800</span>
                                                </div>
                                                <!-- /.product-price -->

                                            </div>
                                            <!-- /.product-info -->
                                            <div class="cart clearfix animate-effect">
                                                <div class="action">
                                                    <ul class="list-unstyled">
                                                        <li class="add-cart-button btn-group">
                                                            <button class="btn btn-primary icon" data-toggle="dropdown"
                                                                type="button"> <i class="fa fa-shopping-cart"></i>
                                                            </button>
                                                            <button class="btn btn-primary cart-btn" type="button">Add to
                                                                cart</button>
                                                        </li>
                                                        <button class="btn btn-primary icon" type="button"
                                                            title="Wishlist" id="{{ $product->id }}"
                                                            onclick="addToWishList(this.id)"> <i class="fa fa-heart"></i>
                                                        </button>
                                                        <li class="lnk"> <a class="add-to-cart" href="detail.html"
                                                                title="Compare"> <i class="fa fa-signal"
                                                                    aria-hidden="true"></i> </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <!-- /.action -->
                                            </div>
                                            <!-- /.cart -->
                                        </div>
                                        <!-- /.product -->

                                    </div>
                                    <!-- /.products -->
                                </div>
                                <!-- /.item -->

                                <div class="item item-carousel">
                                    <div class="products">
                                        <div class="product">
                                            <div class="product-image">
                                                <div class="image"> <a href="detail.html"><img
                                                            src=" {{ asset('front-theme/assets/images/products/p28.jpg') }}"
                                                            alt=""></a> </div>
                                                <!-- /.image -->

                                                <div class="tag new"><span>new</span></div>
                                            </div>
                                            <!-- /.product-image -->

                                            <div class="product-info text-left">
                                                <h3 class="name"><a href="detail.html">Floral Print Buttoned</a>
                                                </h3>
                                                <div class="rating rateit-small"></div>
                                                <div class="description"></div>
                                                <div class="product-price"> <span class="price"> $450.99
                                                    </span>
                                                    <span class="price-before-discount">$ 800</span>
                                                </div>
                                                <!-- /.product-price -->

                                            </div>
                                            <!-- /.product-info -->
                                            <div class="cart clearfix animate-effect">
                                                <div class="action">
                                                    <ul class="list-unstyled">
                                                        <li class="add-cart-button btn-group">
                                                            <button class="btn btn-primary icon" data-toggle="dropdown"
                                                                type="button"> <i class="fa fa-shopping-cart"></i>
                                                            </button>
                                                            <button class="btn btn-primary cart-btn" type="button">Add to
                                                                cart</button>
                                                        </li>
                                                        <button class="btn btn-primary icon" type="button"
                                                            title="Wishlist" id="{{ $product->id }}"
                                                            onclick="addToWishList(this.id)"> <i class="fa fa-heart"></i>
                                                        </button>
                                                        <li class="lnk"> <a class="add-to-cart" href="detail.html"
                                                                title="Compare"> <i class="fa fa-signal"
                                                                    aria-hidden="true"></i> </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <!-- /.action -->
                                            </div>
                                            <!-- /.cart -->
                                        </div>
                                        <!-- /.product -->

                                    </div>
                                    <!-- /.products -->
                                </div>
                                <!-- /.item -->

                                <div class="item item-carousel">
                                    <div class="products">
                                        <div class="product">
                                            <div class="product-image">
                                                <div class="image"> <a href="detail.html"><img
                                                            src=" {{ asset('front-theme/assets/images/products/p30.jpg') }}"
                                                            alt=""></a> </div>
                                                <!-- /.image -->

                                                <div class="tag hot"><span>hot</span></div>
                                            </div>
                                            <!-- /.product-image -->

                                            <div class="product-info text-left">
                                                <h3 class="name"><a href="detail.html">Floral Print Buttoned</a>
                                                </h3>
                                                <div class="rating rateit-small"></div>
                                                <div class="description"></div>
                                                <div class="product-price"> <span class="price"> $450.99
                                                    </span>
                                                    <span class="price-before-discount">$ 800</span>
                                                </div>
                                                <!-- /.product-price -->

                                            </div>
                                            <!-- /.product-info -->
                                            <div class="cart clearfix animate-effect">
                                                <div class="action">
                                                    <ul class="list-unstyled">
                                                        <li class="add-cart-button btn-group">
                                                            <button class="btn btn-primary icon" data-toggle="dropdown"
                                                                type="button"> <i class="fa fa-shopping-cart"></i>
                                                            </button>
                                                            <button class="btn btn-primary cart-btn" type="button">Add to
                                                                cart</button>
                                                        </li>
                                                        <button class="btn btn-primary icon" type="button"
                                                            title="Wishlist" id="{{ $product->id }}"
                                                            onclick="addToWishList(this.id)"> <i class="fa fa-heart"></i>
                                                        </button>
                                                        <li class="lnk"> <a class="add-to-cart" href="detail.html"
                                                                title="Compare"> <i class="fa fa-signal"
                                                                    aria-hidden="true"></i> </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <!-- /.action -->
                                            </div>
                                            <!-- /.cart -->
                                        </div>
                                        <!-- /.product -->

                                    </div>
                                    <!-- /.products -->
                                </div>
                                <!-- /.item -->

                                <div class="item item-carousel">
                                    <div class="products">
                                        <div class="product">
                                            <div class="product-image">
                                                <div class="image"> <a href="detail.html"><img
                                                            src=" {{ asset('front-theme/assets/images/products/p1.jpg') }}"
                                                            alt=""></a> </div>
                                                <!-- /.image -->

                                                <div class="tag hot"><span>hot</span></div>
                                            </div>
                                            <!-- /.product-image -->

                                            <div class="product-info text-left">
                                                <h3 class="name"><a href="detail.html">Floral Print Buttoned</a>
                                                </h3>
                                                <div class="rating rateit-small"></div>
                                                <div class="description"></div>
                                                <div class="product-price"> <span class="price"> $450.99
                                                    </span>
                                                    <span class="price-before-discount">$ 800</span>
                                                </div>
                                                <!-- /.product-price -->

                                            </div>
                                            <!-- /.product-info -->
                                            <div class="cart clearfix animate-effect">
                                                <div class="action">
                                                    <ul class="list-unstyled">
                                                        <li class="add-cart-button btn-group">
                                                            <button class="btn btn-primary icon" data-toggle="dropdown"
                                                                type="button"> <i class="fa fa-shopping-cart"></i>
                                                            </button>
                                                            <button class="btn btn-primary cart-btn" type="button">Add to
                                                                cart</button>
                                                        </li>
                                                        <button class="btn btn-primary icon" type="button"
                                                            title="Wishlist" id="{{ $product->id }}"
                                                            onclick="addToWishList(this.id)"> <i class="fa fa-heart"></i>
                                                        </button>
                                                        <li class="lnk"> <a class="add-to-cart" href="detail.html"
                                                                title="Compare"> <i class="fa fa-signal"
                                                                    aria-hidden="true"></i> </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <!-- /.action -->
                                            </div>
                                            <!-- /.cart -->
                                        </div>
                                        <!-- /.product -->

                                    </div>
                                    <!-- /.products -->
                                </div>
                                <!-- /.item -->

                                <div class="item item-carousel">
                                    <div class="products">
                                        <div class="product">
                                            <div class="product-image">
                                                <div class="image"> <a href="detail.html"><img
                                                            src=" {{ asset('front-theme/assets/images/products/p2.jpg') }}"
                                                            alt=""></a> </div>
                                                <!-- /.image -->

                                                <div class="tag sale"><span>sale</span></div>
                                            </div>
                                            <!-- /.product-image -->

                                            <div class="product-info text-left">
                                                <h3 class="name"><a href="detail.html">Floral Print Buttoned</a>
                                                </h3>
                                                <div class="rating rateit-small"></div>
                                                <div class="description"></div>
                                                <div class="product-price"> <span class="price"> $450.99
                                                    </span>
                                                    <span class="price-before-discount">$ 800</span>
                                                </div>
                                                <!-- /.product-price -->

                                            </div>
                                            <!-- /.product-info -->
                                            <div class="cart clearfix animate-effect">
                                                <div class="action">
                                                    <ul class="list-unstyled">
                                                        <li class="add-cart-button btn-group">
                                                            <button class="btn btn-primary icon" data-toggle="dropdown"
                                                                type="button"> <i class="fa fa-shopping-cart"></i>
                                                            </button>
                                                            <button class="btn btn-primary cart-btn" type="button">Add to
                                                                cart</button>
                                                        </li>
                                                        <button class="btn btn-primary icon" type="button"
                                                            title="Wishlist" id="{{ $product->id }}"
                                                            onclick="addToWishList(this.id)"> <i class="fa fa-heart"></i>
                                                        </button>
                                                        <li class="lnk"> <a class="add-to-cart" href="detail.html"
                                                                title="Compare"> <i class="fa fa-signal"
                                                                    aria-hidden="true"></i> </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <!-- /.action -->
                                            </div>
                                            <!-- /.cart -->
                                        </div>
                                        <!-- /.product -->

                                    </div>
                                    <!-- /.products -->
                                </div>
                                <!-- /.item -->

                                <div class="item item-carousel">
                                    <div class="products">
                                        <div class="product">
                                            <div class="product-image">
                                                <div class="image"> <a href="detail.html"><img
                                                            src=" {{ asset('front-theme/assets/images/products/p3.jpg') }}"
                                                            alt=""></a> </div>
                                                <!-- /.image -->

                                                <div class="tag sale"><span>sale</span></div>
                                            </div>
                                            <!-- /.product-image -->

                                            <div class="product-info text-left">
                                                <h3 class="name"><a href="detail.html">Floral Print Buttoned</a>
                                                </h3>
                                                <div class="rating rateit-small"></div>
                                                <div class="description"></div>
                                                <div class="product-price"> <span class="price"> $450.99
                                                    </span>
                                                    <span class="price-before-discount">$ 800</span>
                                                </div>
                                                <!-- /.product-price -->

                                            </div>
                                            <!-- /.product-info -->
                                            <div class="cart clearfix animate-effect">
                                                <div class="action">
                                                    <ul class="list-unstyled">
                                                        <li class="add-cart-button btn-group">
                                                            <button class="btn btn-primary icon" data-toggle="dropdown"
                                                                type="button"> <i class="fa fa-shopping-cart"></i>
                                                            </button>
                                                            <button class="btn btn-primary cart-btn" type="button">Add to
                                                                cart</button>
                                                        </li>
                                                        <button class="btn btn-primary icon" type="button"
                                                            title="Wishlist" id="{{ $product->id }}"
                                                            onclick="addToWishList(this.id)"> <i class="fa fa-heart"></i>
                                                        </button>
                                                        <li class="lnk"> <a class="add-to-cart" href="detail.html"
                                                                title="Compare"> <i class="fa fa-signal"
                                                                    aria-hidden="true"></i> </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <!-- /.action -->
                                            </div>
                                            <!-- /.cart -->
                                        </div>
                                        <!-- /.product -->

                                    </div>
                                    <!-- /.products -->
                                </div>
                                <!-- /.item -->
                            </div>
                            <!-- /.home-owl-carousel -->
                        </section>
                        <!-- /.section -->
                        <!-- ============================================== FEATURED PRODUCTS : END ============================================== -->

                    </div>
                    <!-- /.homebanner-holder -->
                    <!-- ============================================== CONTENT : END ============================================== -->
                </div>
                <!-- /.row -->
                <!-- ============================================== BRANDS CAROUSEL ============================================== -->
                @include('front.components.brands')
                <!-- /.logo-slider -->
                <!-- ============================================== BRANDS CAROUSEL : END ============================================== -->
            </div>
            <!-- /.container -->
        </div>
    @endsection
