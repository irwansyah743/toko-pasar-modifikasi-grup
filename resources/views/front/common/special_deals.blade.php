@php
$specDeals = App\Models\Product::where('status', 1)
    ->where('special_deals', 1)
    ->orderBy('id', 'DESC')
    ->limit(4)
    ->get();

@endphp

<div class="sidebar-widget outer-bottom-small wow fadeInUp">
    <h3 class="section-title">Special Deals</h3>
    <div class="sidebar-widget-body outer-top-xs">
        <div class="owl-carousel sidebar-carousel special-offer custom-carousel owl-theme outer-top-xs">
            <div class="item">
                <div class="products special-product">

                    @foreach ($specDeals as $product)
                        <div class="product">
                            <div class="product-micro">
                                <div class="row product-micro-row">
                                    <div class="col col-xs-5">
                                        <div class="product-image">
                                            <div class="image"> <a
                                                    href="{{ url('product/detail/' . $product->product_slug) }}"> <img
                                                        src=" {{ asset('storage/' . $product->product_thambnail) }}"
                                                        alt=""> </a>
                                            </div>
                                            <!-- /.image -->

                                        </div>
                                        <!-- /.product-image -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col col-xs-7">
                                        <div class="product-info">
                                            <h3 class="name"><a
                                                    href="{{ url('product/detail/' . $product->product_slug) }}">{{ $product->product_name }}</a>
                                            </h3>
                                            @php
                                                $avarage = App\Models\Review::where('product_id', $product->id)
                                                    ->where('status', 1)
                                                    ->avg('rating');
                                            @endphp
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
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.product-micro-row -->
                            </div>
                            <!-- /.product-micro -->

                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- /.sidebar-widget-body -->
</div>
