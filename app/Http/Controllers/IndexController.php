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

class IndexController extends Controller
{
    public function index()
    {
        $data['categories'] = Category::orderBy('category_name', 'ASC')->get();
        $data['newProducts'] =  Product::where('status', 1)->orderBy('id', 'DESC')->limit(8)->get();
        $data['featuredProducts'] = Product::where('status', 1)->where('featured', 1)->orderBy('id', 'DESC')->limit(8)->get();
        $data['subcategories'] = SubCategory::latest()->get();
        $data['sliders'] = Slider::where('status', 1)->orderBy('id', 'DESC')->limit(3)->get();

        // CATEGORY PRODUCTS
        $spionId = Category::skip(0)->first()->id;
        $data['spionProducts'] = Product::where('status', 1)->where('category_id', $spionId)->orderBy('id', 'DESC')->limit(8)->get();
        $shockbreakerId = Category::skip(1)->first()->id;
        $data['shockbreakerProducts'] = Product::where('status', 1)->where('category_id', $shockbreakerId)->orderBy('id', 'DESC')->limit(8)->get();
    
        // BRAND PRODUCTS
        $ohlinsId = Brand::skip(0)->first()->id;
        $data['ohlinsproducts'] = Product::where('status', 1)->where('brand_id', $ohlinsId)->orderBy('id', 'DESC')->limit(8)->get();
        $scarletsId = Brand::skip(1)->first()->id;
        $data['scarletproducts'] = Product::where('status', 1)->where('brand_id', $scarletsId)->orderBy('id', 'DESC')->limit(8)->get();
        return view('front.index', $data);
    }

    public function productDetail($slug)
    {
        $data['product'] = Product::where('product_slug', $slug)->get()->first();
        $data['reviewcount'] = Review::where('product_id', $data['product']->id)->where('status', 1)->latest()->get();
        $data['avarage'] = Review::where('product_id', $data['product']->id)->where('status', 1)->avg('rating');

        $data['related_products'] = Product::where('category_id',  $data['product']->category_id)->where('product_slug', '!=', $slug)->get();
        $product_color =  $data['product']->product_color;
        $data['colors'] = explode(',', $product_color);
        $data['sizes'] = Product::where('product_slug', $slug)->select('product_size')->get();
        $product_size =  $data['product']->product_size;
        $data['sizes'] = explode(',', $product_size);
        $data['multiImages'] = MultiImg::where('product_id',  $data['product']->id)->get();

        $tags =  $data['product']->product_tags;

        $tagsFix = [];

        $tag = explode(',', $tags);
        $arrayCount = count($tag);
        for ($i = 0; $i < $arrayCount; $i++) {
            $tagsFix = array_merge($tagsFix, [$tag[$i]]);
        }

        $data['productTags'] = $tagsFix;

        return view('front.product.product_detail', $data);
    }

    public function productCategory(Category $category)
    {
        $data['sliders'] = Slider::where('status', 1)->orderBy('id', 'DESC')->limit(3)->get();
        $data['products'] = Product::where('status', 1)->where('category_id', $category->id)->orderBy('id', 'ASC')->paginate(4);
        $data['categories'] = Category::orderBy('category_name', 'ASC')->get();
        $data['subcategories'] = SubCategory::orderBy('subcategory_name', 'ASC')->get();
        $data['category_name'] = $category->category_name;
        return view('front.product.category_products', $data);
    }

    public function productSubcategory(Subcategory $subcategory)
    {
        $data['sliders'] = Slider::where('status', 1)->orderBy('id', 'DESC')->limit(3)->get();
        $data['products'] = Product::where('status', 1)->where('subcategory_id', $subcategory->id)->orderBy('id', 'DESC')->paginate(4);
        $data['categories'] = Category::orderBy('category_name', 'ASC')->get();
        $data['subcategories'] = SubCategory::orderBy('subcategory_name', 'ASC')->get();
        $data['subcategory_name'] = $subcategory->subcategory_name;
        $data['category_name'] = $subcategory->category->category_name;
        return view('front.product.subcategory_products', $data);
    }

    public function productTag($keyword)
    {
        $data['sliders'] = Slider::where('status', 1)->orderBy('id', 'DESC')->limit(3)->get();
        $data['products'] = Product::where('status', 1)->where('product_tags', 'LIKE', '%' . $keyword . '%')->orderBy('id', 'DESC')->paginate(4);
        $data['categories'] = Category::orderBy('category_name', 'ASC')->get();
        $data['subcategories'] = SubCategory::orderBy('subcategory_name', 'ASC')->get();
        $data['keyword'] = $keyword;
        return view('front.product.tag_products', $data);
    }

    /// Product View With Ajax
    public function productViewAjax($id)
    {
        $product = Product::with('category', 'brand')->findOrFail($id);

        $color = $product->product_color;
        $product_color = explode(',', $color);

        $size = $product->product_size;
        $product_size = explode(',', $size);

        return response()->json(array(
            'product' => $product,
            'colors' => $product_color,
            'sizes' => $product_size,
        ));
    } // end method 

    public function searchProduct(Request $request)
    {
        $request->validate([
            'keyword' => 'required',
        ]);

        $data['products'] = Product::where('status', 1)->where('product_name', 'LIKE', '%' . $request->keyword . '%')->orWhere('product_slug', 'LIKE', '%' .  $request->keyword . '%')->orWhere('product_tags', 'LIKE', '%' .  $request->keyword . '%')->orderBy('id', 'DESC')->paginate(4);
        $data['categories'] = Category::orderBy('category_name', 'ASC')->get();
        $data['subcategories'] = SubCategory::orderBy('subcategory_name', 'ASC')->get();
        $data['keyword'] =  $request->keyword;
        return view('front.product.search', $data);
    }
}