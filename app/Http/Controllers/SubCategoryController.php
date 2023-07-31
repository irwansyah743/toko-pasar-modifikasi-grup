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
use App\Http\Requests\StoreSubCategoryRequest;
use App\Http\Requests\UpdateSubCategoryRequest;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['categories'] = Category::orderBy('nama_kategori', 'ASC')->get();
        $data['admin'] = Admin::find(Auth::user()->getKey());
        $data['subcategories'] = SubCategory::latest()->get();
        $data['subsubcategoriesToDelete'] = DB::table('sub_sub_kategori')->select('id_subkategori', DB::raw('count(*)'))->groupBy('id_subkategori')->get();
        return view('back.category.subcategory', $data);
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
     * @param  \App\Http\Requests\StoreSubCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_subkategori' => 'required|max:50|unique:sub_kategori,nama_subkategori',
            'id_kategori' => 'required',
        ], [
            'id_kategori.required' => "Subcategory must belong to a category"
        ]);


        $validated['nama_subkategori'] = $request->nama_subkategori;
        $validated['id_kategori'] = $request->id_kategori;
        $validated['slug_subkategori'] = strtolower(str_replace(' ', '-', $request->nama_subkategori));
        $validated['created_at'] = Carbon::now();

        // BATCH INSERT
        SubCategory::create($validated);

        $notification = array(
            'message' => 'A new subcategory has been added',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function show(SubCategory $subCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(SubCategory $subCategory)
    {
        $data['admin'] = Admin::find(Auth::user()->getKey());
        $data['categories'] = Category::orderBy('nama_kategori', 'ASC')->get();
        $data['subcategory'] = $subCategory;
        return view('back.category.subcategory_edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSubCategoryRequest  $request
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubCategory $subCategory)
    {
        $validated = $request->validate([
            'nama_subkategori' => 'required|max:50',
            'id_kategori' => 'required',
        ], [
            'id_kategori.required' => "Subcategory must belong to a category"
        ]);


        $validated['nama_subkategori'] = $request->nama_subkategori;
        $validated['id_kategori'] = $request->id_kategori;
        $validated['slug_subkategori'] = strtolower(str_replace(' ', '-', $request->nama_subkategori));
        $validated['created_at'] = Carbon::now();

        SubCategory::where('id_subkategori', $subCategory->getKey())->update($validated);

        $notification = array(
            'message' => 'A subcategory has been updated',
            'alert-type' => 'success'
        );

        return to_route('all.subcategory')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubCategory $subCategory)
    {
        SubCategory::destroy($subCategory->getKey());
        SubSubCategory::where('id_subkategori', $subCategory->getKey())->delete();
        $notification = array(
            'message' => 'A subcategory has been deleted',
            'alert-type' => 'success'
        );
        return to_route('all.subcategory')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function getSubCategory($id_kategori)
    {

        $data = SubCategory::where('id_kategori', $id_kategori)->orderBy('nama_subkategori', 'ASC')->get();

        // MEnggunakan response akan menyesuaikan header menjadi json type
        return response()->json($data);
    }
}
