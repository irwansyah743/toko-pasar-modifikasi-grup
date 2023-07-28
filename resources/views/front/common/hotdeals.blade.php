 @php
     $hotDeals = App\Models\Product::where('status', 1)
         ->where('discount_price', '!=', null)
         ->where('hot_deals', 1)
         ->orderBy('id', 'ASC')
         ->limit(8)
         ->get();
 @endphp

 <!-- ============================================== HOT DEALS ============================================== -->
 <div class="sidebar-widget hot-deals wow fadeInUp outer-bottom-xs">
     <h3 class="section-title">hot deals</h3>
     <div class="owl-carousel sidebar-carousel custom-carousel owl-theme outer-top-ss">
         @foreach ($hotDeals as $product)
             <div class="item">
                 <div class="products">
                     <div class="hot-deal-wrapper">
                         <div class="image"> <img src="{{ asset('storage/' . $product->product_thambnail) }}"
                                 alt="{{ $product->product_name }}">
                         </div>
                         @php
                             $amount = $product->selling_price - $product->discount_price;
                             $discount = ($amount / $product->selling_price) * 100;
                             $avarage = App\Models\Review::where('id_produk', $product->id)
                                 ->where('status', 1)
                                 ->avg('rating');
                         @endphp

                         {{-- HOT DEALS ARE GUARANTEED TO HAVE DISCOUNT --}}
                         <div class="sale-offer-tag"><span>{{ round($discount) }}%<br>
                                 off</span></div>



                     </div>
                     <!-- /.hot-deal-wrapper -->

                     <div class="product-info text-left m-t-20">
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
                         <div class="product-price">

                             {{-- HOT DEALS ARE GUARANTEED TO HAVE DISCOUNT --}}
                             <span class="price">
                                 Rp.{{ $product->discount_price }}
                             </span>
                             <span class="price-before-discount">Rp.{{ $product->selling_price }}
                             </span>

                         </div>
                         <!-- /.product-price -->

                     </div>
                     <!-- /.product-info -->

                     <div class="cart clearfix animate-effect">
                         <div class="action">
                             <div class="add-cart-button btn-group" style="display: flex;">
                                 <button data-toggle="modal" data-target="#exampleModal" class="btn btn-primary icon"
                                     type="button" title="Add Cart" id="{{ $product->id }}"
                                     style="display:flex; align-items: center;" onclick="productView(this.id)">
                                     <i class="fa fa-shopping-cart"></i> </button>
                                 <button data-toggle="modal" data-target="#exampleModal" title="Add Cart"
                                     id="{{ $product->id }}" onclick="productView(this.id)"
                                     class="btn btn-primary cart-btn" type="button">Add to cart</button>
                             </div>
                         </div>
                         <!-- /.action -->
                     </div>
                     <!-- /.cart -->
                 </div>
             </div>
         @endforeach

     </div>
     <!-- /.sidebar-widget -->
 </div>
 <!-- ============================================== HOT DEALS: END ============================================== -->
