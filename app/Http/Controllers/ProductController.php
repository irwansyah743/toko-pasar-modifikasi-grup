<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Models\MultiImg;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Models\SubSubCategory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Intervention\Image\ImageManagerStatic as Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['admin'] = Admin::find(Auth::user()->id);
        $data['products'] = Product::latest()->get();
        return view('back.product.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['admin'] = Admin::find(Auth::user()->id);
        $data['products'] = Product::latest()->get();
        $data['categories'] = Category::orderBy('category_name', 'ASC')->get();
        $data['subcategories'] = SubCategory::orderBy('subcategory_name', 'ASC')->get();
        $data['subsubcategories'] = SubSubCategory::orderBy('subsubcategory_name', 'ASC')->get();
        $data['brands'] = Brand::orderBy('brand_name', 'ASC')->get();
        return view('back.product.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'brand_id' => 'required',
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'subsubcategory_id' => 'required',
            'product_name' => 'required|unique:products,product_name',
            'product_code' => 'required|unique:products,product_code',
            'product_qty' => 'required|numeric',
            'product_tags' => 'required',
            'product_size' => 'required',
            'product_color' => 'required',
            'selling_price' => 'required',
            'short_descp' => 'required|max:255',
            'long_descp' => 'required',
            'multi_img' => 'required',
            'multi_img.*' => 'image|max:2048',
            'product_thambnail' => 'required|image|max:2048',
        ], [
            'multi_img.*.image' => 'The product images must be images',
            'multi_img.*.max' => 'Maximum size is 2MB each'
        ]);





        $image = $request->file('product_thambnail');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(917, 1000)->save('storage/thumbnails/' . $name_gen);
        $save_url = 'thumbnails/' . $name_gen;

        $product_id = DB::table('products')->insertGetId([
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_id' => $request->subsubcategory_id,
            'product_name' => $request->product_name,

            'product_slug' =>  strtolower(str_replace(' ', '-', $request->product_name)),

            'product_code' => $request->product_code,

            'product_qty' => $request->product_qty,
            'product_tags' => $request->product_tags,

            'product_size' => $request->product_size,

            'product_color' => $request->product_color,


            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'short_descp' => $request->short_descp,

            'long_descp' => $request->long_descp,
            'hot_deals' => $request->hot_deals,
            'featured' => $request->featured,
            'special_offer' => $request->special_offer,
            'special_deals' => $request->special_deals,
            'product_thambnail' => $save_url,
            'status' => 1,
            'created_at' => Carbon::now(),

        ]);


        ////////// Multiple Image Upload Start ///////////

        $images = $request->file('multi_img');
        foreach ($images as $img) {
            $make_name = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
            Image::make($img)->resize(917, 1000)->save('storage/product-images/' . $make_name);
            $uploadPath = 'product-images/' . $make_name;
            MultiImg::insert([
                'product_id' => $product_id,
                'photo_name' => $uploadPath,
                'created_at' => Carbon::now(),

            ]);
        }

        ////////// Een Multiple Image Upload Start ///////////
        $notification = array(
            'message' => 'Product Added Successfully',
            'alert-type' => 'success'
        );

        return to_route('manage.product')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}