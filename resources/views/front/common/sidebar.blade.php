@php

$tags = App\Models\Product::groupBy('product_tags')
    ->select('product_tags')
    ->get();

$tagsFix = [];
foreach ($tags as $tag) {
    $tag = explode(',', $tag->product_tags);
    $arrayCount = count($tag);
    for ($i = 0; $i < $arrayCount; $i++) {
        $tagsFix = array_merge($tagsFix, [$tag[$i]]);
    }
}
$tagsFix = array_unique($tagsFix);

@endphp

<!-- ============================================== VERTICAL CATEGORY NAV ============================================== -->
@include('front.common.vertical_menu')
<!-- ============================================== HOT DEALS ============================================== -->
@include('front.common.hotdeals')
<!-- ============================================== SPECIAL OFFER ============================================== -->

@include('front.common.special_offers')
<!-- /.sidebar-widget -->
<!-- ============================================== SPECIAL OFFER : END ============================================== -->
<!-- ============================================== PRODUCT TAGS ============================================== -->
<div class="sidebar-widget product-tag wow fadeInUp">
    <h3 class="section-title">Product tags</h3>
    <div class="sidebar-widget-body outer-top-xs">
        <div class="tag-list">
            @foreach ($tagsFix as $tag)
                <a class="item" title="{{ $tag }}"
                    href="category.html">{{ str_replace(',', ' ', $tag) }}</a>
            @endforeach
        </div>
        <!-- /.tag-list -->
    </div>
    <!-- /.sidebar-widget-body -->
</div>
<!-- /.sidebar-widget -->
<!-- ============================================== PRODUCT TAGS : END ============================================== -->
<!-- ============================================== SPECIAL DEALS ============================================== -->
@include('front.common.special_deals')
<!-- /.sidebar-widget -->
<!-- ============================================== SPECIAL DEALS : END ============================================== -->
<!-- ============================================== NEWSLETTER ============================================== -->
<div class="sidebar-widget newsletter wow fadeInUp outer-bottom-small">
    <h3 class="section-title">Newsletters</h3>
    <div class="sidebar-widget-body outer-top-xs">
        <p>Sign Up for Our Newsletter!</p>
        <form>
            <div class="form-group">
                <label class="sr-only" for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1"
                    placeholder="Subscribe to our newsletter">
            </div>
            <button class="btn btn-primary">Subscribe</button>
        </form>
    </div>
    <!-- /.sidebar-widget-body -->
</div>
<!-- /.sidebar-widget -->
<!-- ============================================== NEWSLETTER: END ============================================== -->

<!-- ============================================== Testimonials============================================== -->
<div class="sidebar-widget  wow fadeInUp outer-top-vs ">
    <div id="advertisement" class="advertisement">
        <div class="item">
            <div class="avatar"><img src=" {{ asset('front-theme/assets/images/testimonials/member1.png') }}"
                    alt="Image">
            </div>
            <div class="testimonials"><em>"</em> Vtae sodales aliq uam morbi non sem lacus port
                mollis. Nunc condime tum metus eud molest sed consectetuer.<em>"</em></div>
            <div class="clients_author">John Doe <span>Abc Company</span> </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /.item -->

        <div class="item">
            <div class="avatar"><img src=" {{ asset('front-theme/assets/images/testimonials/member3.png') }}"
                    alt="Image">
            </div>
            <div class="testimonials"><em>"</em>Vtae sodales aliq uam morbi non sem lacus port
                mollis. Nunc condime tum metus eud molest sed consectetuer.<em>"</em></div>
            <div class="clients_author">Stephen Doe <span>Xperia Designs</span> </div>
        </div>
        <!-- /.item -->

        <div class="item">
            <div class="avatar"><img src=" {{ asset('front-theme/assets/images/testimonials/member2.png') }}"
                    alt="Image">
            </div>
            <div class="testimonials"><em>"</em> Vtae sodales aliq uam morbi non sem lacus port
                mollis. Nunc condime tum metus eud molest sed consectetuer.<em>"</em></div>
            <div class="clients_author">Saraha Smith <span>Datsun &amp; Co</span> </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /.item -->

    </div>
    <!-- /.owl-carousel -->
</div>

<!-- ============================================== Testimonials: END ============================================== -->

<div class="home-banner"> <img src=" {{ asset('front-theme/assets/images/banners/LHS-banner.jpg') }}" alt="Image">
</div>
</div>
<!-- /.sidemenu-holder -->
<!-- ============================================== SIDEBAR : END ============================================== -->
