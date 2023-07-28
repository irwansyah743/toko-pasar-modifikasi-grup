@extends('front.master')
@section('title')
    Home | TokoPasarModifikasiGrup
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
                                        style="background-image: linear-gradient(rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.2)),url( {{ asset('storage/' . $slider->gambar_banner) }});">
                                        <div class="container-fluid ">
                                            <div class="caption bg-color vertical-center text-left">
                                                <h1 class="big-text fadeInDown-1 white">{{ $slider->judul }} </h1>
                                                <div class="excerpt fadeInDown-2 hidden-xs white">
                                                    <p>{!! $slider->deskripsi !!}</p>
                                                </div>
                                                <div class="button-holder fadeInDown-3"> <a
                                                        href="{{ url('product/detail/real-madrid-home-kit-2022-2023') }}"
                                                        class="btn-lg btn btn-uppercase btn-primary shop-now-button">Belanja sekarang</a>
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
                                                    <h4 class="info-box-heading green">Gratis Pengiriman</h4>
                                                </div>
                                            </div>
                                            <h6 class="text">Pemesanan dengan Rp. 300.000</h6>
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
                                            <h6 class="text">20% Hanya pada bulan ini </h6>
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
                                                                    $avarage = App\Models\Review::where('id_produk', $product->id)
                                                                        ->where('status', 1)
                                                                        ->avg('rating');
                                                                    
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
                                                                <div>

                                                                    @if ($avarage == 0)
                                                                    @elseif($avarage == 1 || $avarage < 2)
                                                                        <span class="fa fa-star checked"></span>
                                                                        <span class="fa fa-star"></span>
                                                                        <span class="fa fa-star"></span>
                                                                        <span class="fa fa-star"></span>
                                                                        <span class="fa fa-star"></span>
                                                                    @elseif($avarage == 2 || $avarage < 3)
                                                                        <span class="fa fa-star checked"></span>
                                                                        <span class="fa fa-star checked"></span>
                                                                        <span class="fa fa-star"></span>
                                                                        <span class="fa fa-star"></span>
                                                                        <span class="fa fa-star"></span>
                                                                    @elseif($avarage == 3 || $avarage < 4)
                                                                        <span class="fa fa-star checked"></span>
                                                                        <span class="fa fa-star checked"></span>
                                                                        <span class="fa fa-star checked"></span>
                                                                        <span class="fa fa-star"></span>
                                                                        <span class="fa fa-star"></span>
                                                                    @elseif($avarage == 4 || $avarage < 5)
                                                                        <span class="fa fa-star checked"></span>
                                                                        <span class="fa fa-star checked"></span>
                                                                        <span class="fa fa-star checked"></span>
                                                                        <span class="fa fa-star checked"></span>
                                                                        <span class="fa fa-star"></span>
                                                                    @elseif($avarage == 5 || $avarage < 5)
                                                                        <span class="fa fa-star checked"></span>
                                                                        <span class="fa fa-star checked"></span>
                                                                        <span class="fa fa-star checked"></span>
                                                                        <span class="fa fa-star checked"></span>
                                                                        <span class="fa fa-star checked"></span>
                                                                    @endif


                                                                </div>

                                                                <div class="description"></div>
                                                                <div class="product-price">
                                                                    @if ($product->discount_price)
                                                                        <span class="price">
                                                                            Rp.{{ $product->discount_price }}
                                                                        </span>
                                                                        <span
                                                                            class="price-before-discount">Rp.{{ $product->selling_price }}
                                                                        </span>
                                                                    @else
                                                                        <span class="price">
                                                                            Rp.{{ $product->selling_price }}
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
                                                                            <button class="btn btn-primary cart-btn"
                                                                                type="button">Tambah ke keranjang</button>
                                                                        </li>
                                                                        <button class="btn btn-primary icon"
                                                                            type="button" title="Wishlist"
                                                                            id="{{ $product->id }}"
                                                                            onclick="addToWishList(this.id)"> <i
                                                                                class="fa fa-heart"></i> </button>



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
                                                                            $avarage = App\Models\Review::where('id_produk', $product->id)
                                                                                ->where('status', 1)
                                                                                ->avg('rating');
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
                                                                        <div>

                                                                            @if ($avarage == 0)
                                                                            @elseif($avarage == 1 || $avarage < 2)
                                                                                <span class="fa fa-star checked"></span>
                                                                                <span class="fa fa-star"></span>
                                                                                <span class="fa fa-star"></span>
                                                                                <span class="fa fa-star"></span>
                                                                                <span class="fa fa-star"></span>
                                                                            @elseif($avarage == 2 || $avarage < 3)
                                                                                <span class="fa fa-star checked"></span>
                                                                                <span class="fa fa-star checked"></span>
                                                                                <span class="fa fa-star"></span>
                                                                                <span class="fa fa-star"></span>
                                                                                <span class="fa fa-star"></span>
                                                                            @elseif($avarage == 3 || $avarage < 4)
                                                                                <span class="fa fa-star checked"></span>
                                                                                <span class="fa fa-star checked"></span>
                                                                                <span class="fa fa-star checked"></span>
                                                                                <span class="fa fa-star"></span>
                                                                                <span class="fa fa-star"></span>
                                                                            @elseif($avarage == 4 || $avarage < 5)
                                                                                <span class="fa fa-star checked"></span>
                                                                                <span class="fa fa-star checked"></span>
                                                                                <span class="fa fa-star checked"></span>
                                                                                <span class="fa fa-star checked"></span>
                                                                                <span class="fa fa-star"></span>
                                                                            @elseif($avarage == 5 || $avarage < 5)
                                                                                <span class="fa fa-star checked"></span>
                                                                                <span class="fa fa-star checked"></span>
                                                                                <span class="fa fa-star checked"></span>
                                                                                <span class="fa fa-star checked"></span>
                                                                                <span class="fa fa-star checked"></span>
                                                                            @endif


                                                                        </div>
                                                                        <div class="description"></div>
                                                                        <div class="product-price">
                                                                            @if ($product->discount_price)
                                                                                <span class="price">
                                                                                    Rp.{{ $product->discount_price }}
                                                                                </span>
                                                                                <span
                                                                                    class="price-before-discount">Rp.{{ $product->selling_price }}
                                                                                </span>
                                                                            @else
                                                                                <span class="price">
                                                                                    Rp.{{ $product->selling_price }}
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
                                                                                        type="button">Tambah ke keranjang</button>
                                                                                </li>
                                                                                <button class="btn btn-primary icon"
                                                                                    type="button" title="Wishlist"
                                                                                    id="{{ $product->id }}"
                                                                                    onclick="addToWishList(this.id)">
                                                                                    <i class="fa fa-heart"></i>
                                                                                </button>

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
                                                        $avarage = App\Models\Review::where('id_produk', $product->id)
                                                            ->where('status', 1)
                                                            ->avg('rating');
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
                                                    <div>

                                                        @if ($avarage == 0)
                                                        @elseif($avarage == 1 || $avarage < 2)
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star"></span>
                                                            <span class="fa fa-star"></span>
                                                            <span class="fa fa-star"></span>
                                                            <span class="fa fa-star"></span>
                                                        @elseif($avarage == 2 || $avarage < 3)
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star"></span>
                                                            <span class="fa fa-star"></span>
                                                            <span class="fa fa-star"></span>
                                                        @elseif($avarage == 3 || $avarage < 4)
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star"></span>
                                                            <span class="fa fa-star"></span>
                                                        @elseif($avarage == 4 || $avarage < 5)
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star"></span>
                                                        @elseif($avarage == 5 || $avarage < 5)
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                        @endif


                                                    </div>
                                                    <div class="description"></div>
                                                    <div class="product-price">
                                                        @if ($product->discount_price)
                                                            <span class="price">
                                                                Rp.{{ $product->discount_price }}
                                                            </span>
                                                            <span
                                                                class="price-before-discount">Rp.{{ $product->selling_price }}
                                                            </span>
                                                        @else
                                                            <span class="price">
                                                                Rp.{{ $product->selling_price }}
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
                                                                    type="button">Tambah ke keranjang</button>
                                                            </li>
                                                            <button class="btn btn-primary icon" type="button"
                                                                title="Wishlist" id="{{ $product->id }}"
                                                                onclick="addToWishList(this.id)"> <i
                                                                    class="fa fa-heart"></i> </button>

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

                        <!-- ============================================== Shockbreaker LEAGUE PRODUCTS ============================================== -->
                        <section class="section featured-product wow fadeInUp">
                            <h3 class="section-title">Spion</h3>
                            <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">
                                @foreach ($shockbreakerProducts as $product)
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
                                                        $avarage = App\Models\Review::where('id_produk', $product->id)
                                                            ->where('status', 1)
                                                            ->avg('rating');
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
                                                    <div>

                                                        @if ($avarage == 0)
                                                        @elseif($avarage == 1 || $avarage < 2)
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star"></span>
                                                            <span class="fa fa-star"></span>
                                                            <span class="fa fa-star"></span>
                                                            <span class="fa fa-star"></span>
                                                        @elseif($avarage == 2 || $avarage < 3)
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star"></span>
                                                            <span class="fa fa-star"></span>
                                                            <span class="fa fa-star"></span>
                                                        @elseif($avarage == 3 || $avarage < 4)
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star"></span>
                                                            <span class="fa fa-star"></span>
                                                        @elseif($avarage == 4 || $avarage < 5)
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star"></span>
                                                        @elseif($avarage == 5 || $avarage < 5)
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                        @endif


                                                    </div>
                                                    <div class="description"></div>
                                                    <div class="product-price">
                                                        @if ($product->discount_price)
                                                            <span class="price">
                                                                Rp.{{ $product->discount_price }}
                                                            </span>
                                                            <span
                                                                class="price-before-discount">Rp.{{ $product->selling_price }}
                                                            </span>
                                                        @else
                                                            <span class="price">
                                                                Rp.{{ $product->selling_price }}
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
                                                                    type="button">Tambah ke keranjang</button>
                                                            </li>
                                                            <button class="btn btn-primary icon" type="button"
                                                                title="Wishlist" id="{{ $product->id }}"
                                                                onclick="addToWishList(this.id)"> <i
                                                                    class="fa fa-heart"></i> </button>

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
                        <!-- ============================================== Shockbreaker LEAGUE PRODUCTS : END ============================================== -->
                        <!-- ============================================== Spion PRODUCTS ============================================== -->
                        <section class="section featured-product wow fadeInUp">
                            <h3 class="section-title">Shockbreaker</h3>
                            <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">
                                @foreach ($spionProducts as $product)
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
                                                        $avarage = App\Models\Review::where('id_produk', $product->id)
                                                            ->where('status', 1)
                                                            ->avg('rating');
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
                                                    <div>

                                                        @if ($avarage == 0)
                                                        @elseif($avarage == 1 || $avarage < 2)
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star"></span>
                                                            <span class="fa fa-star"></span>
                                                            <span class="fa fa-star"></span>
                                                            <span class="fa fa-star"></span>
                                                        @elseif($avarage == 2 || $avarage < 3)
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star"></span>
                                                            <span class="fa fa-star"></span>
                                                            <span class="fa fa-star"></span>
                                                        @elseif($avarage == 3 || $avarage < 4)
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star"></span>
                                                            <span class="fa fa-star"></span>
                                                        @elseif($avarage == 4 || $avarage < 5)
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star"></span>
                                                        @elseif($avarage == 5 || $avarage < 5)
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                        @endif


                                                    </div>
                                                    <div class="description"></div>
                                                    <div class="product-price">
                                                        @if ($product->discount_price)
                                                            <span class="price">
                                                                Rp.{{ $product->discount_price }}
                                                            </span>
                                                            <span
                                                                class="price-before-discount">Rp.{{ $product->selling_price }}
                                                            </span>
                                                        @else
                                                            <span class="price">
                                                                Rp.{{ $product->selling_price }}
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
                                                                    type="button">Tambah Ke keranjang</button>
                                                            </li>
                                                            <button class="btn btn-primary icon" type="button"
                                                                title="Wishlist" id="{{ $product->id }}"
                                                                onclick="addToWishList(this.id)"> <i
                                                                    class="fa fa-heart"></i> </button>

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
                        <!-- ============================================== Spion PRODUCTS : END ============================================== -->

                        <!-- ============================================== OHLINS PRODUCTS ============================================== -->
                        <section class="section featured-product wow fadeInUp">
                            <h3 class="section-title">Ohlins</h3>
                            <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">
                                @foreach ($ohlinsproducts as $product)
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
                                                        $avarage = App\Models\Review::where('id_produk', $product->id)
                                                            ->where('status', 1)
                                                            ->avg('rating');
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
                                                    <div>

                                                        @if ($avarage == 0)
                                                        @elseif($avarage == 1 || $avarage < 2)
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star"></span>
                                                            <span class="fa fa-star"></span>
                                                            <span class="fa fa-star"></span>
                                                            <span class="fa fa-star"></span>
                                                        @elseif($avarage == 2 || $avarage < 3)
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star"></span>
                                                            <span class="fa fa-star"></span>
                                                            <span class="fa fa-star"></span>
                                                        @elseif($avarage == 3 || $avarage < 4)
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star"></span>
                                                            <span class="fa fa-star"></span>
                                                        @elseif($avarage == 4 || $avarage < 5)
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star"></span>
                                                        @elseif($avarage == 5 || $avarage < 5)
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                        @endif


                                                    </div>
                                                    <div class="description"></div>
                                                    <div class="product-price">
                                                        @if ($product->discount_price)
                                                            <span class="price">
                                                                Rp.{{ $product->discount_price }}
                                                            </span>
                                                            <span
                                                                class="price-before-discount">Rp.{{ $product->selling_price }}
                                                            </span>
                                                        @else
                                                            <span class="price">
                                                                Rp.{{ $product->selling_price }}
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
                                                                    type="button">Tambah ke keranjang</button>
                                                            </li>
                                                            <button class="btn btn-primary icon" type="button"
                                                                title="Wishlist" id="{{ $product->id }}"
                                                                onclick="addToWishList(this.id)"> <i
                                                                    class="fa fa-heart"></i> </button>

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
                        <!-- ============================================== OHLINS PRODUCTS : END ============================================== -->

                        <!-- ============================================== Scarlet PRODUCTS ============================================== -->
                        <section class="section featured-product wow fadeInUp">
                            <h3 class="section-title">Scarlet</h3>
                            <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">
                                @foreach ($scarletproducts as $product)
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
                                                        $avarage = App\Models\Review::where('id_produk', $product->id)
                                                            ->where('status', 1)
                                                            ->avg('rating');
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
                                                    <div>

                                                        @if ($avarage == 0)
                                                        @elseif($avarage == 1 || $avarage < 2)
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star"></span>
                                                            <span class="fa fa-star"></span>
                                                            <span class="fa fa-star"></span>
                                                            <span class="fa fa-star"></span>
                                                        @elseif($avarage == 2 || $avarage < 3)
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star"></span>
                                                            <span class="fa fa-star"></span>
                                                            <span class="fa fa-star"></span>
                                                        @elseif($avarage == 3 || $avarage < 4)
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star"></span>
                                                            <span class="fa fa-star"></span>
                                                        @elseif($avarage == 4 || $avarage < 5)
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star"></span>
                                                        @elseif($avarage == 5 || $avarage < 5)
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                        @endif


                                                    </div>
                                                    <div class="description"></div>
                                                    <div class="product-price">
                                                        @if ($product->discount_price)
                                                            <span class="price">
                                                                Rp.{{ $product->discount_price }}
                                                            </span>
                                                            <span
                                                                class="price-before-discount">Rp.{{ $product->selling_price }}
                                                            </span>
                                                        @else
                                                            <span class="price">
                                                                Rp.{{ $product->selling_price }}
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
                                                                    type="button">Tambah ke keranjang</button>
                                                            </li>
                                                            <button class="btn btn-primary icon" type="button"
                                                                title="Wishlist" id="{{ $product->id }}"
                                                                onclick="addToWishList(this.id)"> <i
                                                                    class="fa fa-heart"></i> </button>

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
                        <!-- ============================================== Scarlet PRODUCTS : END ============================================== -->




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
