<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Review;
use App\Models\Slider;
use App\Models\Product;
use App\Models\Category;
use App\Models\MultiImg;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class IndexController extends Controller
{
    public function index()
    {
        $data['categories'] = Category::orderBy('nama_kategori', 'ASC')->get();
        $data['newProducts'] =  Product::where('status', 1)->orderBy('id_produk', 'DESC')->limit(8)->get();
        $data['featuredProducts'] = Product::where('status', 1)->where('unggulan', 1)->orderBy('id_produk', 'DESC')->limit(8)->get();
        $data['subcategories'] = SubCategory::latest()->get();
        $data['sliders'] = Slider::where('status', 1)->orderBy('id_banner', 'DESC')->limit(3)->get();

        // CATEGORY PRODUCTS
        $spionId = Category::skip(0)->first()->getKey();
        $data['spionProducts'] = Product::where('status', 1)->where('id_kategori', $spionId)->orderBy('id_produk', 'DESC')->limit(8)->get();
        $shockbreakerId = Category::skip(1)->first()->getKey();
        $data['shockbreakerProducts'] = Product::where('status', 1)->where('id_kategori', $shockbreakerId)->orderBy('id_produk', 'DESC')->limit(8)->get();
    
        // BRAND PRODUCTS
        $ohlinsId = Brand::skip(0)->first()->getKey();
        $data['ohlinsproducts'] = Product::where('status', 1)->where('id_merek', $ohlinsId)->orderBy('id_produk', 'DESC')->limit(8)->get();
        $scarletsId = Brand::skip(1)->first()->getKey();
        $data['scarletproducts'] = Product::where('status', 1)->where('id_merek', $scarletsId)->orderBy('id_produk', 'DESC')->limit(8)->get();
        return view('front.index', $data);
    }

    public function productDetail($slug)
    {
        $data['product'] = Product::where('slug_produk', $slug)->get()->first();
        $data['reviewcount'] = Review::where('id_produk', $data['product']->getKey())->where('status', 1)->latest()->get();
        $data['avarage'] = Review::where('id_produk', $data['product']->getKey())->where('status', 1)->avg('rating');

        $data['related_products'] = Product::where('id_kategori',  $data['product']->id_kategori)->where('slug_produk', '!=', $slug)->get();
        $warna_produk =  $data['product']->warna_produk;
        $data['colors'] = explode(',', $warna_produk);
        $data['sizes'] = Product::where('slug_produk', $slug)->select('ukuran_produk')->get();
        $ukuran_produk =  $data['product']->ukuran_produk;
        $data['sizes'] = explode(',', $ukuran_produk);
        $data['multiImages'] = MultiImg::where('id_produk',  $data['product']->getKey())->get();

        $tags =  $data['product']->tag_produk;

        $tagsFix = [];

        $tag = explode(',', $tags);
        $arrayCount = count($tag);
        for ($i = 0; $i < $arrayCount; $i++) {
            $tagsFix = array_merge($tagsFix, [$tag[$i]]);
        }

        $data['productTags'] = $tagsFix;

        return view('front.product.product_detail', $data);
    }

// CONTOH SORTING
    public function productCategory($categoryId, $sort = null)
    {
        $category = Category::find($categoryId);

        if (!$category) {
            abort(404); // Or return a view with a user-friendly error message
        }

        $query = Product::where('status', 1)->where('id_kategori', $categoryId);

        switch ($sort) {
            case 'price_low':
                $query = $query->orderBy(DB::raw('CAST(harga_jual AS UNSIGNED)'), 'asc');
                break;
            case 'price_high':
                $query = $query->orderBy(DB::raw('CAST(harga_jual AS UNSIGNED)'), 'desc');
                break;
            case 'alpha':
                $query = $query->orderBy('nama_produk', 'asc');
                break;
            default:
                $query = $query->orderBy('id_produk', 'asc');
        }

        $data['products'] = $query->paginate(4);
        $data['sliders'] = Slider::where('status', 1)->orderBy('id_banner', 'DESC')->limit(3)->get();
        $data['categories'] = Category::orderBy('nama_kategori', 'ASC')->get();
        $data['subcategories'] = SubCategory::orderBy('nama_subkategori', 'ASC')->get();
        $data['nama_kategori'] = $category->nama_kategori;
        $data['categoryId'] = $categoryId;

        return view('front.product.category_products', $data);
    }

// AKHIR SORTING


    public function productSubcategory($subcategoryId, $sort = null)
    {

        $subcategory = SubCategory::find($subcategoryId);

        if (!$subcategory) {
            abort(404); // Or return a view with a user-friendly error message
        }

        $query = Product::where('status', 1)->where('id_subkategori', $subcategoryId);

        switch ($sort) {
            case 'price_low':
                $query = $query->orderBy(DB::raw('CAST(harga_jual AS UNSIGNED)'), 'asc');
                break;
            case 'price_high':
                $query = $query->orderBy(DB::raw('CAST(harga_jual AS UNSIGNED)'), 'desc');
                break;
            case 'alpha':
                $query = $query->orderBy('nama_produk', 'asc');
                break;
            default:
                $query = $query->orderBy('id_produk', 'asc');
        }
        $data['sliders'] = Slider::where('status', 1)->orderBy('id_banner', 'DESC')->limit(3)->get();
        $data['products'] = $query->paginate(4);
        $data['categories'] = Category::orderBy('nama_kategori', 'ASC')->get();
        $data['subcategories'] = SubCategory::orderBy('nama_subkategori', 'ASC')->get();
        $data['nama_subkategori'] = $subcategory->nama_subkategori;
        $data['nama_kategori'] = $subcategory->category->nama_kategori;
        $data['subcategoryId'] = $subcategoryId;
        return view('front.product.subcategory_products', $data);
    }

    public function productTag($keyword, $sort = null)
    {
        $query = Product::where('status', 1)->where('tag_produk', 'LIKE', '%' . $keyword . '%');

        switch ($sort) {
            case 'price_low':
                $query = $query->orderBy(DB::raw('CAST(harga_jual AS UNSIGNED)'), 'asc');
                break;
            case 'price_high':
                $query = $query->orderBy(DB::raw('CAST(harga_jual AS UNSIGNED)'), 'desc');
                break;
            case 'alpha':
                $query = $query->orderBy('nama_produk', 'asc');
                break;
            default:
                $query = $query->orderBy('id_produk', 'asc');
        }

        $data['sliders'] = Slider::where('status', 1)->orderBy('id_banner', 'DESC')->limit(3)->get();
        $data['products'] = $query->paginate(4);
        $data['categories'] = Category::orderBy('nama_kategori', 'ASC')->get();
        $data['subcategories'] = SubCategory::orderBy('nama_subkategori', 'ASC')->get();
        $data['keyword'] = $keyword;
        return view('front.product.tag_products', $data);
    }

    /// Product View With Ajax
    public function productViewAjax($id)
    {
        $product = Product::with('category', 'brand')->findOrFail($id);

        $color = $product->warna_produk;
        $warna_produk = explode(',', $color);

        $size = $product->ukuran_produk;
        $ukuran_produk = explode(',', $size);

        return response()->json(array(
            'product' => $product,
            'colors' => $warna_produk,
            'sizes' => $ukuran_produk,
        ));
    } // end method 

    public function searchProduct(Request $request)
    {
        $request->validate([
            'keyword' => 'required',
        ]);

        $data['products'] = Product::where('status', 1)->where('nama_produk', 'LIKE', '%' . $request->keyword . '%')->orWhere('slug_produk', 'LIKE', '%' .  $request->keyword . '%')->orWhere('tag_produk', 'LIKE', '%' .  $request->keyword . '%')->orderBy('id_produk', 'DESC')->paginate(4);
        $data['categories'] = Category::orderBy('nama_kategori', 'ASC')->get();
        $data['subcategories'] = SubCategory::orderBy('nama_subkategori', 'ASC')->get();
        $data['keyword'] =  $request->keyword;
        return view('front.product.search', $data);
    }

    public function sort($sort)
    {
        switch ($sort) {
            case 'price_low':
                $data['products'] = Product::orderBy('harga_jual', 'asc')->get();
                break;
            case 'price_high':
                $data['products'] = Product::orderBy('harga_jual', 'desc')->get();
                break;
            case 'alpha':
                $data['products'] = Product::orderBy('name', 'asc')->get();
                break;
            default:
                $data['products'] = Product::all();
        }

        $data['sliders'] = Slider::where('status', 1)->orderBy('id_banner', 'DESC')->limit(3)->get();
        $data['products'] = Product::where('status', 1)->where('id_kategori', $category->getKey())->orderBy('id_produk', 'ASC')->paginate(4);
        $data['categories'] = Category::orderBy('nama_kategori', 'ASC')->get();
        $data['subcategories'] = SubCategory::orderBy('nama_subkategori', 'ASC')->get();
        $data['nama_kategori'] = $category->nama_kategori;
        
        return view('front.product.category_products', $data);
    }

}