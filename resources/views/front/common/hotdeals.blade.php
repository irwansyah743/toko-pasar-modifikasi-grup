 @php
     $hotDeals = App\Models\Product::where('status', 1)
         ->where('harga_diskon', '!=', null)
         ->where('diskon_besar', 1)
         ->orderBy('id_produk', 'ASC')
         ->limit(8)
         ->get();
 @endphp