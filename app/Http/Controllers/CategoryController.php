<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Models\SubSubCategory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['admin'] = Admin::find(Auth::user()->getKey());
        $data['categories'] = Category::latest()->get();
        $data['subcategoriesToDelete'] = DB::table('sub_kategori')->select('id_kategori', DB::raw('count(*)'))->groupBy('id_kategori')->get();
        return view('back.category.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kategori' => 'required|max:50|unique:categories,nama_kategori',
            'ikon_kategori' => 'required|max:255',
            'gambar_kategori' => 'required|image|max:2048',
        ]);

        if ($request->file('gambar_kategori')) {
            $validated['gambar_kategori'] = $request->file('gambar_kategori')->store('category-images');
        }

        $validated['nama_kategori'] = $request->nama_kategori;
        $validated['ikon_kategori'] = $request->ikon_kategori;
        $validated['slug_kategori'] = strtolower(str_replace(' ', '-', $request->nama_kategori));
        $validated['created_at'] = Carbon::now();

        // BATCH INSERT
        Category::create($validated);

        $notification = array(
            'message' => 'A new category has been added',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $data['admin'] = Admin::find(Auth::user()->getKey());
        $data['category'] = $category;
        return view('back.category.category_edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoryRequest  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'nama_kategori' => 'required|max:50',
            'ikon_kategori' => 'required|max:255',

        ]);

        if ($request->file('gambar_kategori')) {
            if ($request->old_image) {
                Storage::delete($request->old_image);
            }
            $validated['gambar_kategori'] = $request->file('gambar_kategori')->store('category-images');
        }

        $validated['nama_kategori'] = $request->nama_kategori;
        $validated['ikon_kategori'] = $request->ikon_kategori;
        $validated['updated_at'] = Carbon::now();

        Category::where('id', $category->getKey())->update($validated);

        $notification = array(
            'message' => 'A category has been updated',
            'alert-type' => 'success'
        );

        return to_route('all.category')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        Category::destroy($category->getKey());
        SubCategory::where('id_kategori', $category->getKey())->delete();
        SubSubCategory::where('id_kategori', $category->getKey())->delete();
        $notification = array(
            'message' => 'A category has been deleted',
            'alert-type' => 'success'
        );

        return to_route('all.category')->with($notification);
    }
}