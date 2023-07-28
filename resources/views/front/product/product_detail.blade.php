@extends('front.master')
@section('content')
@section('title')
    {{ $product->nama_produk }} Product Details
@endsection



<!-- ===== ======== HEADER : END ============================================== -->
<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="{{ url('/') }}">Home</a></li>
                <li class='active'> {{ $product->nama_produk }}</li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->
<div class="body-content outer-top-xs">
    <div class='container'>
        <div class='row single-product'>
            <div class='col-md-3 sidebar'>
                <div class="sidebar-module-container">
                    @include('front.common.vertical_menu')



                    <!-- ============================================== HOT DEALS ============================================== -->
                    @include('front.common.hotdeals')
                    <!-- ============================================== HOT DEALS: END ============================================== -->







                </div>
            </div><!-- /.sidebar -->
            <div class='col-md-9'>
                <div class="detail-block">
                    <div class="row  wow fadeInUp">

                        <div class="col-xs-12 col-sm-6 col-md-5 gallery-holder">
                            <div class="product-item-holder size-big single-product-gallery small-gallery">

                                <div id="owl-single-product">

                                    @foreach ($multiImages as $img)
                                        <div class="single-product-gallery-item" id="slide{{ $img->getKey() }}">
                                            <a data-lightbox="image-1" data-title="Gallery"
                                                href="{{ asset('storage/' . $img->nama_gambar_produk) }} ">
                                                <img class="img-responsive" alt=""
                                                    src="{{ asset('storage/' . $img->nama_gambar_produk) }} "
                                                    data-echo="{{ asset('storage/' . $img->nama_gambar_produk) }} " />
                                            </a>
                                        </div><!-- /.single-product-gallery-item -->
                                    @endforeach


                                </div><!-- /.single-product-slider -->


                                <div class="single-product-gallery-thumbs gallery-thumbs">

                                    <div id="owl-single-product-thumbnails">

                                        @foreach ($multiImages as $img)
                                            <div class="item">
                                                <a class="horizontal-thumb active" data-target="#owl-single-product"
                                                    data-slide="1" href="#slide{{ $img->getKey() }}">
                                                    <img class="img-responsive" width="85" alt=""
                                                        src="{{ asset('storage/' . $img->nama_gambar_produk) }} "
                                                        data-echo="{{ asset('storage/' . $img->nama_gambar_produk) }} " />
                                                </a>
                                            </div>
                                        @endforeach




                                    </div><!-- /#owl-single-product-thumbnails -->



                                </div><!-- /.gallery-thumbs -->

                            </div><!-- /.single-product-gallery -->
                        </div><!-- /.gallery-holder -->
                        <div class='col-sm-6 col-md-7 product-info-block'>
                            <div class="product-info">


                                <h1 class="name" id="pname">

                                    {{ $product->nama_produk }}

                                </h1>

                                <div class="rating-reviews m-t-20">
                                    <div class="row">
                                        <div class="col-sm-3">

                                            @if ($avarage == 0)
                                                No Rating Yet
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



                                        <div class="col-sm-8">
                                            <div class="reviews">
                                                <a href="#" class="lnk">({{ count($reviewcount) }}
                                                    Reviews)</a>
                                            </div>
                                        </div>
                                    </div><!-- /.row -->
                                </div><!-- /.rating-reviews -->

                                <div class="stock-container info-container m-t-10">
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <div class="stock-box">
                                                <span class="label">Availability :</span>
                                            </div>
                                        </div>
                                        <div class="col-sm-9">
                                            <div class="stock-box">
                                                <span class="value">{{ $product->kuantitas_produk }}</span>
                                            </div>
                                        </div>
                                    </div><!-- /.row -->
                                </div><!-- /.stock-container -->

                                <div class="description-container m-t-20">

                                    {{ $product->deskripsi_singkat }}

                                </div><!-- /.description-container -->

                                <div class="price-container info-container m-t-20">
                                    <div class="row">


                                        <div class="col-sm-6">
                                            <div class="price-box">
                                                @if ($product->harga_diskon == null)
                                                    <span class="price">Rp. {{ $product->harga_jual }}</span>
                                                @else
                                                    <span class="price">Rp. {{ $product->harga_diskon }}</span>
                                                    <span
                                                        class="price-strike">Rp.{{ $product->harga_jual }}</span>
                                                @endif


                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="favorite-button m-t-10">
                                                <button class="btn btn-primary icon" type="button" title="Wishlist"
                                                    id="{{ $product->getKey() }}" onclick="addToWishList(this.id)"> <i
                                                        class="fa fa-heart"></i>
                                                </button>

                                                <a class="btn btn-primary" data-toggle="tooltip" data-placement="right"
                                                    title="E-mail" href="#">
                                                    <i class="fa fa-envelope"></i>
                                                </a>
                                            </div>
                                        </div>

                                    </div><!-- /.row -->
                                </div><!-- /.price-container -->

                                {{-- COLOR AND SIZE --}}

                                <div class="row">


                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="info-title control-label">Color </label>
                                            <select class="form-control unicase-form-control selectpicker"
                                                id="color">
                                                <option selected disabled>--Choose Color--</option>
                                                @foreach ($colors as $color)
                                                    <option value="{{ $color }}">{{ ucwords($color) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="info-title control-label">Size </label>
                                            <select class="form-control unicase-form-control selectpicker"
                                                id="size">
                                                <option selected disabled>--Choose Size--</option>
                                                @foreach ($sizes as $size)
                                                    <option value="{{ $size }}">{{ ucwords($size) }}
                                                    </option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>

                                </div><!-- /.row -->

                                {{-- END COLOR AND SIZE --}}

                                <div class="quantity-container info-container">
                                    <div class="row">

                                        <div class="col-sm-2">
                                            <span class="label">kuantitas :</span>
                                        </div>

                                        <div class="col-sm-2">
                                            <div class="cart-quantity">
                                                <div class="quant-input">
                                                    <div class="arrows">
                                                        <!-- <div class="arrow plus gradient"><span class="ir"><i
                                                                    class="icon fa fa-sort-asc"></i></span></div>
                                                        <div class="arrow minus gradient"><span class="ir"><i
                                                                    class="icon fa fa-sort-desc"></i></span></div> -->
                                                    </div>
                                                    <input type="number" id="kuantitas" value="1"
                                                        min="1" max="{{ $product->kuantitas_produk }}">
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" id="pid" value="{{ $product->getKey() }}">
                                        <div class="col-sm-7">
                                            <button type="submit" onclick="addToCart({{ $product->kuantitas_produk }})" class="btn btn-primary"><i
                                                    class="fa fa-shopping-cart inner-right-vs"></i> ADD TO
                                                CART</button>
                                        </div>


                                    </div><!-- /.row -->
                                </div><!-- /.quantity-container -->






                            </div><!-- /.product-info -->
                        </div><!-- /.col-sm-7 -->
                    </div><!-- /.row -->
                </div>

                <div class="product-tabs inner-bottom-xs  wow fadeInUp">
                    <div class="row">
                        <div class="col-sm-3">
                            <ul id="product-tabs" class="nav nav-tabs nav-tab-cell">
                                <li class="active"><a data-toggle="tab" href="#description">DESCRIPTION</a>
                                </li>
                                <li><a data-toggle="tab" href="#review">REVIEW</a></li>
                                <li><a data-toggle="tab" href="#tags">TAGS</a></li>
                            </ul><!-- /.nav-tabs #product-tabs -->
                        </div>
                        <div class="col-sm-9">

                            <div class="tab-content">

                                <div id="description" class="tab-pane in active">
                                    <div class="product-tab">
                                        <p class="text">

                                            {!! $product->deskripsi_panjang !!}

                                        </p>
                                    </div>
                                </div><!-- /.tab-pane -->

                                <div id="review" class="tab-pane">
                                    <div class="product-tab">

                                        <div class="product-reviews">
                                            <h4 class="title">Customer Reviews</h4>

                                            @php
                                                $reviews = App\Models\Review::where('id_produk', $product->getKey())
                                                    ->latest()
                                                    ->limit(5)
                                                    ->get();
                                            @endphp

                                            <div class="reviews">

                                                @foreach ($reviews as $item)
                                                    @if ($item->status == 0)
                                                    @else
                                                        <div class="review">

                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <img style="border-radius: 50%"
                                                                        src="{{ !empty('storage/' . $item->user->profile_photo_path) ? url('storage/' . $item->user->profile_photo_path) : url('upload/no_image.jpg') }}"
                                                                        width="40px;" height="40px;"><b>
                                                                        {{ $item->user->name }}</b>
                                                                    @if ($item->rating == null)
                                                                    @elseif($item->rating == 1)
                                                                        <span class="fa fa-star checked"></span>
                                                                        <span class="fa fa-star"></span>
                                                                        <span class="fa fa-star"></span>
                                                                        <span class="fa fa-star"></span>
                                                                        <span class="fa fa-star"></span>
                                                                    @elseif($item->rating == 2)
                                                                        <span class="fa fa-star checked"></span>
                                                                        <span class="fa fa-star checked"></span>
                                                                        <span class="fa fa-star"></span>
                                                                        <span class="fa fa-star"></span>
                                                                        <span class="fa fa-star"></span>
                                                                    @elseif($item->rating == 3)
                                                                        <span class="fa fa-star checked"></span>
                                                                        <span class="fa fa-star checked"></span>
                                                                        <span class="fa fa-star checked"></span>
                                                                        <span class="fa fa-star"></span>
                                                                        <span class="fa fa-star"></span>
                                                                    @elseif($item->rating == 4)
                                                                        <span class="fa fa-star checked"></span>
                                                                        <span class="fa fa-star checked"></span>
                                                                        <span class="fa fa-star checked"></span>
                                                                        <span class="fa fa-star checked"></span>
                                                                        <span class="fa fa-star"></span>
                                                                    @elseif($item->rating == 5)
                                                                        <span class="fa fa-star checked"></span>
                                                                        <span class="fa fa-star checked"></span>
                                                                        <span class="fa fa-star checked"></span>
                                                                        <span class="fa fa-star checked"></span>
                                                                        <span class="fa fa-star checked"></span>
                                                                    @endif
                                                                </div>

                                                                <div class="col-md-9">

                                                                </div>
                                                            </div> <!-- // end row -->



                                                            <div class="review-title"><span
                                                                    class="rangkuman">{{ $item->rangkuman }}</span><span
                                                                    class="date"><i
                                                                        class="fa fa-calendar"></i><span>
                                                                        {{ Carbon\Carbon::parse($item->created_at)->diffForHumans() }}
                                                                    </span></span></div>
                                                            <div class="text">"{{ $item->komentar }}"</div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div><!-- /.reviews -->
                                        </div><!-- /.product-reviews -->



                                        <div class="product-add-review">
                                            <h4 class="title">Write your own review</h4>
                                            <div class="review-table">

                                            </div><!-- /.review-table -->

                                            <div class="review-form">
                                                @guest
                                                    <p> <b> For Add Product Review. You Need to Login First <a
                                                                href="{{ route('login') }}">Login Here</a> </b> </p>
                                                @else
                                                    <div class="form-container">

                                                        <form role="form" class="cnt-form" method="post"
                                                            action="{{ route('review.store', $product->getKey()) }}">
                                                            @csrf
                                                            <table class="table">
                                                                <thead>
                                                                    <tr>
                                                                        <th class="cell-label">&nbsp;</th>
                                                                        <th>1 star</th>
                                                                        <th>2 stars</th>
                                                                        <th>3 stars</th>
                                                                        <th>4 stars</th>
                                                                        <th>5 stars</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td class="cell-label">Quality</td>
                                                                        <td><input type="radio" name="quality"
                                                                                class="radio" value="1"></td>
                                                                        <td><input type="radio" name="quality"
                                                                                class="radio" value="2"></td>
                                                                        <td><input type="radio" name="quality"
                                                                                class="radio" value="3"></td>
                                                                        <td><input type="radio" name="quality"
                                                                                class="radio" value="4"></td>
                                                                        <td><input type="radio" name="quality"
                                                                                class="radio" value="5"></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table><!-- /.table .table-bordered -->
                                                            <div class="row">
                                                                <div class="col-sm-6">

                                                                    <div class="form-group">
                                                                        <label for="rangkuman">rangkuman <span
                                                                                class="astk">*</span></label>
                                                                        <input type="text" name="rangkuman"
                                                                            class="form-control txt" id="rangkuman"
                                                                            placeholder="">
                                                                    </div><!-- /.form-group -->
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="komentar">Review <span
                                                                                class="astk">*</span></label>
                                                                        <textarea class="form-control txt txt-review" name="komentar" id="komentar" rows="4" placeholder=""></textarea>
                                                                    </div><!-- /.form-group -->
                                                                </div>
                                                            </div><!-- /.row -->

                                                            <div class="action text-right">
                                                                <button type="submit"
                                                                    class="btn btn-primary btn-upper">SUBMIT
                                                                    REVIEW</button>
                                                            </div><!-- /.action -->

                                                        </form><!-- /.cnt-form -->
                                                    </div><!-- /.form-container -->

                                                @endguest


                                            </div><!-- /.review-form -->

                                        </div><!-- /.product-add-review -->

                                    </div><!-- /.product-tab -->
                                </div><!-- /.tab-pane -->
                                <div id="tags" class="tab-pane">
                                    <div class="product-tab">
                                        <div class="tag-list">
                                            @foreach ($productTags as $tag)
                                                <a class="badge badge-primary" title="{{ $tag }}"
                                                    href="{{ url('/product/tags/' . $tag) }}">{{ str_replace(',', ' ', $tag) }}</a>
                                            @endforeach
                                        </div>
                                        <!-- /.tag-list -->
                                    </div>
                                </div><!-- /.tab-pane -->



                            </div><!-- /.tab-content -->
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.product-tabs -->



            </div><!-- /.col -->
            <div class="clearfix"></div>
        </div><!-- /.row -->

    </div>
@endsection
