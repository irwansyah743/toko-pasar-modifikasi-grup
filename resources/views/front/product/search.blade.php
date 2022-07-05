@extends('front.master')
@section('content')
@section('title')
    {{ ucwords($keyword) }}
@endsection





<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="#">Home</a></li>
                <li class='active'>{{ ucwords($keyword) }}</li>
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
                                <h4 class="widget-title">Category</h4>
                            </div>
                            <div class="sidebar-widget-body">
                                <div class="accordion">


                                    @foreach ($categories as $category)
                                        <div class="accordion-group">
                                            <div class="accordion-heading"> <a href="#collapse{{ $category->id }}"
                                                    data-toggle="collapse" class="accordion-toggle collapsed">

                                                    {{ $category->category_name }}

                                                </a> </div>
                                            <!-- /.accordion-heading -->
                                            <div class="accordion-body collapse" id="collapse{{ $category->id }}"
                                                style="height: 0px;">
                                                <div class="accordion-inner">


                                                    @foreach ($subcategories as $subcategory)
                                                        @if ($subcategory->category_id == $category->id)
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





                <!--    //////////////////// START Product Grid View  ////////////// -->

                <div class="search-result-container ">
                    <div id="myTabContent" class="tab-content category-list">
                        <!--            //////////////////// Product List View Start ////////////// -->



                        <div class="tab-pane active" id="list-container">
                            <div class="category-product">

                                @foreach ($products as $product)
                                    @php
                                        $amount = $product->selling_price - $product->discount_price;
                                        $discount = ($amount / $product->selling_price) * 100;
                                        $avarage = App\Models\Review::where('product_id', $product->id)
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
                                                                    src="{{ asset('storage/' . $product->product_thambnail) }}"
                                                                    alt=""> </div>
                                                        </div>
                                                        <!-- /.product-image -->
                                                    </div>
                                                    <!-- /.col -->
                                                    <div class="col col-sm-8 col-lg-8">
                                                        <div class="product-info">
                                                            <h3 class="name"><a
                                                                    href="{{ url('product/detail/' . $product->product_slug) }}">

                                                                    {{ $product->product_name }}

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


                                                            @if ($product->discount_price == null)
                                                                <div class="product-price"> <span class="price">
                                                                        Rp. {{ $product->selling_price }} </span>
                                                                </div>
                                                            @else
                                                                <div class="product-price"> <span class="price">
                                                                        Rp. {{ $product->discount_price }} </span>
                                                                    <span class="price-before-discount">Rp.
                                                                        {{ $product->selling_price }}</span>
                                                                </div>
                                                            @endif

                                                            <!-- /.product-price -->
                                                            <div class="description m-t-10">

                                                                {{ $product->short_descp }}

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
                                                    @if ($product->discount_price == null)
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
