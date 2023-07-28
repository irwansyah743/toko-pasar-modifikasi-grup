@php

$tags = App\Models\Product::groupBy('tag_produk')
    ->select('tag_produk')
    ->get();

$tagsFix = [];
foreach ($tags as $tag) {
    $tag = explode(',', $tag->tag_produk);
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
                    href="{{ url('/product/tags/' . $tag) }}">{{ str_replace(',', ' ', $tag) }}</a>
            @endforeach
        </div>
        <!-- /.tag-list -->
    </div>
    <!-- /.sidebar-widget-body -->
</div>
<!-- /.sidebar-widget -->
<!-- ============================================== PRODUCT TAGS : END ============================================== -->
<!-- ============================================== SPECIAL DEALS ============================================== -->
@include('front.common.penawaran_khusus')
<!-- /.sidebar-widget -->
<!-- ============================================== SPECIAL DEALS : END ============================================== -->





</div>
<!-- /.sidemenu-holder -->
<!-- ============================================== SIDEBAR : END ============================================== -->
