<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\Category;
use App\Models\MultiImg;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Models\SubSubCategory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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
        $data['admin'] = Admin::find(Auth::user()->getKey());
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
        $data['admin'] = Admin::find(Auth::user()->getKey());
        $data['products'] = Product::latest()->get();
        $data['categories'] = Category::orderBy('nama_kategori', 'ASC')->get();
        $data['subcategories'] = SubCategory::orderBy('nama_subkategori', 'ASC')->get();
        $data['subsubcategories'] = SubSubCategory::orderBy('nama_subsubkategori', 'ASC')->get();
        $data['brands'] = Brand::orderBy('nama_merek', 'ASC')->get();
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
            'id_merek' => 'required',
            'id_kategori' => 'required',
            'id_subkategori' => 'required',
            'id_subsubkategori' => 'required',
            'nama_produk' => 'required|unique:produk,nama_produk',
            'kode_produk' => 'required|unique:produk,kode_produk',
            // 'kuantitas_produk' => 'required|numeric',
            'tag_produk' => 'required',
            'ukuran_produk' => 'required',
            'warna_produk' => 'required',
            'harga_jual' => 'required',
            'deskripsi_singkat' => 'required|max:255',
            'deskripsi_panjang' => 'required',
            'multi_img' => 'required',
            'multi_img.*' => 'image|max:2048',
            'thumbnail_produk' => 'required|image|max:2048',
        ], [
            'multi_img.*.image' => 'The product images must be images',
            'multi_img.*.max' => 'Maximum size is 2MB each'
        ]);



        $image = $request->file('thumbnail_produk');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(917, 1000)->save('storage/thumbnails/' . $name_gen);
        $save_url = 'thumbnails/' . $name_gen;

        $ukuran_produk = explode(',', $request->ukuran_produk);
        $warna_produk = explode(',', $request->warna_produk);

        $id_produk = DB::table('produk')->insertGetId([
            'id_merek' => $request->id_merek,
            'id_kategori' => $request->id_kategori,
            'id_subkategori' => $request->id_subkategori,
            'id_subsubkategori' => $request->id_subsubkategori,
            'nama_produk' => $request->nama_produk,

            'slug_produk' =>  strtolower(str_replace(' ', '-', $request->nama_produk)),

            'kode_produk' => $request->kode_produk,

            'kuantitas_produk' => 0,
            'tag_produk' => $request->tag_produk,

            'ukuran_produk' => $request->ukuran_produk,

            'warna_produk' => $request->warna_produk,


            'harga_jual' => $request->harga_jual,
            'harga_diskon' => $request->harga_diskon,
            'deskripsi_singkat' => $request->deskripsi_singkat,

            'deskripsi_panjang' => $request->deskripsi_panjang,
            'diskon_besar' => $request->diskon_besar,
            'unggulan' => $request->unggulan,
            'penawaran_spesial' => $request->penawaran_spesial,
            'penawaran_khusus' => $request->penawaran_khusus,
            'thumbnail_produk' => $save_url,
            'status' => 1,
            'created_at' => Carbon::now(),

        ]);

        foreach ($ukuran_produk as $ukuran) {
            foreach ($warna_produk as $warna) {
                ProductDetail::insert([
                    'id_produk' => $id_produk,
                    'warna_produk' => $warna,
                    'ukuran_produk' => $ukuran,
                    'kuantitas_produk' => 0,
                    'created_at' => Carbon::now(),
                ]);
            }
        }

        ////////// Multiple Image Upload Start ///////////

        $images = $request->file('multi_img');
        foreach ($images as $img) {
            $make_name = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
            Image::make($img)->resize(917, 1000)->save('storage/product-images/' . $make_name);
            $uploadPath = 'product-images/' . $make_name;
            MultiImg::insert([
                'id_produk' => $id_produk,
                'nama_gambar_produk' => $uploadPath,
                'created_at' => Carbon::now(),
            ]);
        }

        ////////// Een Multiple Image Upload Start ///////////
        $notification = array(
            'message' => 'Product Added Successfully',
            'alert-type' => 'success'
        );

        return to_route('product.edit', $id_produk)->with($notification);
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
        $data['admin'] = Admin::find(Auth::user()->getKey());
        $data['categories'] = Category::orderBy('nama_kategori', 'ASC')->get();
        $data['subcategories'] = SubCategory::orderBy('nama_subkategori', 'ASC')->get();
        $data['subsubcategories'] = SubSubCategory::orderBy('nama_subsubkategori', 'ASC')->get();
        $data['brands'] = Brand::orderBy('nama_merek', 'ASC')->get();
        $data['product'] = $product;
        $data['multiimg'] = MultiImg::where('id_produk',  $product->getKey())->get();
        return view('back.product.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'id_merek' => 'required',
            'id_kategori' => 'required',
            'id_subkategori' => 'required',
            'id_subsubkategori' => 'required',
            'nama_produk' => 'required',
            'kode_produk' => 'required',
            // 'kuantitas_produk' => 'required|numeric',
            'tag_produk' => 'required',
            'ukuran_produk' => 'required',
            'warna_produk' => 'required',
            'harga_jual' => 'required',
            'deskripsi_singkat' => 'required|max:255',
            'deskripsi_panjang' => 'required',
        ]);

        Product::where('id_produk', $product->getKey())->update([
            'id_merek' => $request->id_merek,
            'id_kategori' => $request->id_kategori,
            'id_subkategori' => $request->id_subkategori,
            'id_subsubkategori' => $request->id_subsubkategori,
            'nama_produk' => $request->nama_produk,

            'slug_produk' =>  strtolower(str_replace(' ', '-', $request->nama_produk)),

            'kode_produk' => $request->kode_produk,

            'tag_produk' => $request->tag_produk,

            // 'kuantitas_produk' => $request->kuantitas_produk,
            // 'ukuran_produk' => $request->ukuran_produk,
            // 'warna_produk' => $request->warna_produk,


            'harga_jual' => $request->harga_jual,
            'harga_diskon' => $request->harga_diskon,
            'deskripsi_singkat' => $request->deskripsi_singkat,

            'deskripsi_panjang' => $request->deskripsi_panjang,
            'diskon_besar' => $request->diskon_besar,
            'unggulan' => $request->unggulan,
            'penawaran_spesial' => $request->penawaran_spesial,
            'penawaran_khusus' => $request->penawaran_khusus,
            'updated_at' => Carbon::now(),

        ]);

        foreach ($request->ukuran_produk as $id_produk_detail => $ukuran) {
            ProductDetail::where('id_produk_detail', $id_produk_detail)->update([
                'ukuran_produk' => $ukuran,
                'warna_produk' => $request->warna_produk[$id_produk_detail],
                'kuantitas_produk' => $request->kuantitas_produk[$id_produk_detail],
                'updated_at' => Carbon::now(),
            ]);
        }

        $notification = array(
            'message' => 'A product has been updated',
            'alert-type' => 'success'
        );

        return to_route('manage.product')->with($notification);
    }

    public function ProductInactive(Product $product)
    {
        $product->update(['status' => 0]);
        $notification = array(
            'message' => 'Product ' . $product->nama_produk . ' is Inactive',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }


    public function ProductActive(Product $product)
    {
        $product->update(['status' => 1]);
        $notification = array(
            'message' => 'Product ' . $product->nama_produk . ' is Active',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {

        if ($images = MultiImg::where('id_produk',  $product->getKey())->get()) {
            foreach ($images as $image) {
                Storage::delete($image->nama_gambar_produk);
            }
        }

        if ($product->thumbnail_produk) {
            Storage::delete($product->thumbnail_produk);
        }
        MultiImg::where('id_produk', $product->getKey())->delete();
        Product::destroy($product->getKey());

        $notification = array(
            'message' => 'A product has been deleted',
            'alert-type' => 'success'
        );
        return to_route('manage.product')->with($notification);
    }

    public function storeImages(Request $request)
    {
        $request->validate([
            'multi_img' => 'required',
            'multi_img.*' => 'image|max:2048',
        ], [
            'multi_img.*.image' => 'The product images must be images',
            'multi_img.*.max' => 'Maximum size is 2MB each'
        ]);

        $images = $request->file('multi_img');
        foreach ($images as $img) {
            $make_name = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
            Image::make($img)->resize(917, 1000)->save('storage/product-images/' . $make_name);
            $uploadPath = 'product-images/' . $make_name;
            MultiImg::insert([
                'id_produk' => $request->id_produk,
                'nama_gambar_produk' => $uploadPath,
                'created_at' => Carbon::now(),

            ]);
        }
        $notification = array(
            'message' => 'An image has been added',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroyImages(MultiImg $multiimg)
    {

        if ($multiimg->nama_gambar_produk) {
            Storage::delete($multiimg->nama_gambar_produk);
        }
        MultiImg::destroy($multiimg->getKey());
        $notification = array(
            'message' => 'An image has been deleted',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function updateThumbnail(Request $request, Product $product)
    {
        $request->validate([
            'thumbnail_produk' => 'required|image|max:2048'
        ]);
        Storage::delete($request->old_img);

        $image = $request->file('thumbnail_produk');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(917, 1000)->save('storage/thumbnails/' . $name_gen);
        $save_url = 'thumbnails/' . $name_gen;

        Product::findOrFail($product->getKey())->update([
            'thumbnail_produk' => $save_url,
            'updated_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Product Image Thambnail Updated Successfully',
            'alert-type' => 'info'
        );

        return redirect()->back()->with($notification);
    } // end method

}
