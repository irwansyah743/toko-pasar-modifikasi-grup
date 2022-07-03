@php
$brands = App\Models\Brand::latest()->get();
@endphp

<div id="brands-carousel" class="logo-slider wow fadeInUp">
    <div class="logo-slider-inner">
        <div id="brand-slider" class="owl-carousel brand-slider custom-carousel owl-theme">

            @foreach ($brands as $brand)
                <div class="item m-t-15"> <a href="#" class="image"> <img
                            data-echo=" {{ asset('storage/' . $brand->brand_image) }}"
                            src=" {{ asset('front-theme/assets/images/blank.gif') }}" alt=""
                            style="max-height: 120px; max-width:120px;"> </a>
                </div>
                <!--/.item-->
            @endforeach

        </div>
        <!-- /.owl-carousel #logo-slider -->
    </div>
    <!-- /.logo-slider-inner -->

</div>
