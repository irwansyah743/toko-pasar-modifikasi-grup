@php
$specDeals = App\Models\Product::where('status', 1)
    ->where('penawaran_khusus', 1)
    ->orderBy('id_produk', 'DESC')
    ->limit(4)
    ->get();

@endphp