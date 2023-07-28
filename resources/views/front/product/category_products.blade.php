@extends('front.master')
@section('content')
@section('title')
    {{ $nama_kategori }}
@endsection





<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="#">Home</a></li>
                <li class='active'>{{ $nama_kategori }}</li>
            </ul>
        </div>
        <!-- /.breadcrumb-inner -->
    </div>
    <!-- /.container -->
</div>
<!-- /.breadcrumb -->
<div class="body-content outer-top-xs">
    <div class='container'>
        <div class='row'>
            <div class='col-md-3 sidebar'>

                <!-- ===== == TOP NAVIGATION ======= ==== -->
                @include('front.common.vertical_menu')
                <!-- = ==== TOP NAVIGATION : END === ===== -->




                <div class="sidebar-module-container">
                    <div class="sidebar-filter">
                        <!-- ============================================== SIDEBAR CATEGORY ============================================== -->
                        <div class="sidebar-widget wow fadeInUp">
                            <h3 class="section-title">shop by</h3>
                            <div class="widget-header">
                                <h4 class="widget-title">Kategori</h4>
                            </div>
                            <div class="sidebar-widget-body">
                                <div class="accordion">


                                    @foreach ($categories as $category)
                                        <div class="accordion-group">
                                            <div class="accordion-heading"> <a href="#collapse{{ $category->id }}"
                                                    data-toggle="collapse" class="accordion-toggle collapsed">

                                                    {{ $category->nama_kategori }}

                                                </a> </div>
                                            <!-- /.accordion-heading -->
                                            <div class="accordion-body collapse" id="collapse{{ $category->id }}"
                                                style="height: 0px;">
                                                <div class="accordion-inner">


                                                    @foreach ($subcategories as $subcategory)
                                                        @if ($subcategory->id_kategori == $category->id)
                                                            <ul>
                                                                <li><a
                                                                        href="{{ url('/product/subcategory/' . $subcategory->id) }}">

                                                                        {{ $subcategory->subcategory_name }}

                                                                    </a>
                                                                </li>

                                                            </ul>
                                                        @endif
                                                    @endforeach


                                                </div>
                                                <!-- /.accordion-inner -->
                                            </div>
                                            <!-- /.accordion-body -->
                                        </div>
                                        <!-- /.accordion-group -->
                                    @endforeach











                                </div>
                                <!-- /.accordion -->
                            </div>
                            <!-- /.sidebar-widget-body -->
                        </div>
                        <!-- /.sidebar-widget -->
                        <!-- ============================================== SIDEBAR CATEGORY : END ============================================== -->


                    </div>
                    <!-- /.sidebar-filter -->
                </div>
                <!-- /.sidebar-module-container -->
            </div>
            <!-- /.sidebar -->
            <div class='col-md-9'>



                <!-- == ==== SECTION – HERO === ====== -->

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
                                        <div class="button-holder fadeInDown-3"> <a href="index.php?page=single-product"
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


                <div class="clearfix filters-container m-t-10">
                    <div class="row">
                        <div class="col col-sm-6 col-md-2">
                            <div class="filter-tabs">
                                <ul id="filter-tabs" class="nav nav-tabs nav-tab-box nav-tab-fa-icon">
                                    <li class="active"><a data-toggle="tab" href="#list-container"><i
                                                class="icon fa fa-th-list"></i>List</a></li>
                                    <li> <a data-toggle="tab" href="#grid-container"><i
                                                class="icon fa fa-th-large"></i>Grid</a> </li>
                                </ul>
                            </div>
                            <!-- /.filter-tabs -->
                        </div>
                        <!-- /.col -->
                        <div class="col col-sm-12 col-md-6">
                            <div class="col col-sm-3 col-md-6 no-padding">
                                <div class="lbl-cnt"> <span class="lbl">Sort by</span>
                                    <div class="fld inline">
                                        <div class="dropdown dropdown-small dropdown-med dropdown-white inline">
                                            <button data-toggle="dropdown" type="button" class="btn dropdown-toggle">
                                                Position <span class="caret"></span> </button>
                                            <ul role="menu" class="dropdown-menu">
                                                <li role="presentation"><a href="#">position</a></li>
                                                <li role="presentation"><a href="#">Price:Lowest first</a></li>
                                                <li role="presentation"><a href="#">Price:Highest first</a></li>
                                                <li role="presentation"><a href="#">Product Name:A to Z</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- /.fld -->
                                </div>
                                <!-- /.lbl-cnt -->
                            </div>
                            <!-- /.col -->
                            <div class="col col-sm-3 col-md-6 no-padding">
                                <div class="lbl-cnt"> <span class="lbl">Show</span>
                                    <div class="fld inline">
                                        <div class="dropdown dropdown-small dropdown-med dropdown-white inline">
                                            <button data-toggle="dropdown" type="button" class="btn dropdown-toggle"> 1
                                                <span class="caret"></span> </button>
                                            <ul role="menu" class="dropdown-menu">
                                                <li role="presentation"><a href="#">1</a></li>
                                                <li role="presentation"><a href="#">2</a></li>
                                                <li role="presentation"><a href="#">3</a></li>
                                                <li role="presentation"><a href="#">4</a></li>
                                                <li role="presentation"><a href="#">5</a></li>
                                                <li role="presentation"><a href="#">6</a></li>
                                                <li role="presentation"><a href="#">7</a></li>
                                                <li role="presentation"><a href="#">8</a></li>
                                                <li role="presentation"><a href="#">9</a></li>
                                                <li role="presentation"><a href="#">10</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- /.fld -->
                                </div>
                                <!-- /.lbl-cnt -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.col -->
                        <div class="col col-sm-6 col-md-4 text-right">

                            <!-- /.pagination-container -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>


                <!--    //////////////////// START Product Grid View  ////////////// -->

                <div class="search-result-container ">
                    <div id="myTabContent" class="tab-content category-list">
                        <div class="tab-pane " id="grid-container">
                            <div class="category-product">
                                <div class="row">
                                    @foreach ($products as $product)
                                        <div class="col-sm-6 col-md-4 wow fadeInUp">
                                            <div class="products">
                                                <div class="product">
                                                    <div class="product-image">
                                                        <div class="image"> <a
                                                                href="{{ url('product/detail/' . $product->slug_produk) }}"><img
                                                                    src="{{ asset('storage/' . $product->thumbnail_produk) }}"
                                                                    alt=""></a> </div>
                                                        <!-- /.image -->

                                                        @php
                                                            $amount = $product->harga_jual - $product->harga_diskon;
                                                            $discount = ($amount / $product->harga_jual) * 100;
                                                            $avarage = App\Models\Review::where('id_produk', $product->id)
                                                                ->where('status', 1)
                                                                ->avg('rating');
                                                        @endphp

                                                        <div>
                                                            @if ($product->harga_diskon == null)
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
                                                                href="{{ url('product/detail/' . $product->slug_produk) }}">

                                                                {{ $product->nama_produk }}

                                                            </a>
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


                                                        @if ($product->harga_diskon == null)
                                                            <div class="product-price"> <span class="price">
                                                                    Rp. {{ $product->harga_jual }} </span> </div>
                                                        @else
                                                            <div class="product-price"> <span class="price">
                                                                    Rp. {{ $product->harga_diskon }} </span> <span
                                                                    class="price-before-discount">Rp.
                                                                    {{ $product->harga_jual }}</span> </div>
                                                        @endif




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
                                                                        class="fa fa-heart"></i>
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
                                    @endforeach











                                </div>
                                <!-- /.row -->
                            </div>
                            <!-- /.category-product -->

                        </div>
                        <!-- /.tab-pane -->

                        <!--            //////////////////// END Product Grid View  ////////////// -->




                        <!--            //////////////////// Product List View Start ////////////// -->



                        <div class="tab-pane active" id="list-container">
                            <div class="category-product">

                                @foreach ($products as $product)
                                    @php
                                        $amount = $product->harga_jual - $product->harga_diskon;
                                        $discount = ($amount / $product->harga_jual) * 100;
                                        $avarage = App\Models\Review::where('id_produk', $product->id)
                                            ->where('status', 1)
                                            ->avg('rating');
                                    @endphp
                                    <div class="category-product-inner wow fadeInUp">
                                        <div class="products">
                                            <div class="product-list product">
                                                <div class="row product-list-row">
                                                    <div class="col col-sm-4 col-lg-4">
                                                        <div class="product-image">
                                                            <div class="image"> <img
                                                                    src="{{ asset('storage/' . $product->thumbnail_produk) }}"
                                                                    alt=""> </div>
                                                        </div>
                                                        <!-- /.product-image -->
                                                    </div>
                                                    <!-- /.col -->
                                                    <div class="col col-sm-8 col-lg-8">
                                                        <div class="product-info">
                                                            <h3 class="name"><a
                                                                    href="{{ url('product/detail/' . $product->slug_produk) }}">

                                                                    {{ $product->nama_produk }}

                                                                </a>
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


                                                            @if ($product->harga_diskon == null)
                                                                <div class="product-price"> <span class="price">
                                                                        Rp. {{ $product->harga_jual }} </span>
                                                                </div>
                                                            @else
                                                                <div class="product-price"> <span class="price">
                                                                        Rp. {{ $product->harga_diskon }} </span>
                                                                    <span class="price-before-discount">Rp.
                                                                        {{ $product->harga_jual }}</span>
                                                                </div>
                                                            @endif

                                                            <!-- /.product-price -->
                                                            <div class="description m-t-10">

                                                                {{ $product->deskripsi_singkat }}

                                                            </div>
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
                                                                                type="button" data-toggle="modal"
                                                                                data-target="#exampleModal"
                                                                                title="Add Cart"
                                                                                id="{{ $product->id }}"
                                                                                onclick="productView(this.id)">Add to
                                                                                cart</button>
                                                                        </li>
                                                                        <button class="btn btn-primary icon"
                                                                            type="button" title="Wishlist"
                                                                            id="{{ $product->id }}"
                                                                            onclick="addToWishList(this.id)"> <i
                                                                                class="fa fa-heart"></i>
                                                                        </button>

                                                                    </ul>
                                                                </div>
                                                                <!-- /.action -->
                                                            </div>
                                                            <!-- /.cart -->

                                                        </div>
                                                        <!-- /.product-info -->
                                                    </div>
                                                    <!-- /.col -->
                                                </div>





                                                <!-- /.product-list-row -->
                                                <div>
                                                    @if ($product->harga_diskon == null)
                                                        <div class="tag new"><span>new</span></div>
                                                    @else
                                                        <div class="tag hot">
                                                            <span>{{ round($discount) }}%</span>
                                                        </div>
                                                    @endif
                                                </div>



                                            </div>
                                            <!-- /.product-list -->
                                        </div>
                                        <!-- /.products -->
                                    </div>
                                    <!-- /.category-product-inner -->
                                @endforeach

                                <!--            //////////////////// Product List View END ////////////// -->


                            </div>
                            <!-- /.category-product -->
                        </div>
                        <!-- /.tab-pane #list-container -->
                    </div>
                    <!-- /.tab-content -->
                    <div class="clearfix filters-container">
                        <div class="text-right">
                            <div class="pagination-container">
                                <ul class="list-inline list-unstyled">
                                    {{ $products->links() }}
                                </ul>
                                <!-- /.list-inline -->
                            </div>
                            <!-- /.pagination-container -->
                        </div>
                        <!-- /.text-right -->

                    </div>
                    <!-- /.filters-container -->

                </div>
                <!-- /.search-result-container -->

            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        <!-- ============================================== BRANDS CAROUSEL ============================================== -->
        @include('front.components.brands')
        <!-- /.logo-slider -->
        <!-- ============================================== BRANDS CAROUSEL : END ============================================== -->
    </div>
    <!-- /.container -->

</div>
<!-- /.body-content -->








@endsection
