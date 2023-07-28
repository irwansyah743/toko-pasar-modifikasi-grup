<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Models\SubSubCategory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreSubSubCategoryRequest;
use App\Http\Requests\UpdateSubSubCategoryRequest;

class SubSubCategoryController extends Controller
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
        $data['subsubcategories'] = SubSubCategory::latest()->get();
        return view('back.category.sub_subcategory', $data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function getSubSubCategory($id_subkategori)
    {

        $data = SubSubCategory::where('id_subkategori', $id_subkategori)->orderBy('nama_subsubkategori', 'ASC')->get();
        return response()->json($data);
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
     * @param  \App\Http\Requests\StoreSubSubCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_subsubkategori' => 'required|max:50',
            'id_kategori' => 'required',
            'id_subkategori' => 'required',
        ], [
            'id_kategori.required' => "Sub-subcategory must belong to a category",
            'id_subkategori.required' => "Sub-subcategory must belong to a subcategory"
        ]);


        $validated['nama_subsubkategori'] = $request->nama_subsubkategori;
        $validated['id_kategori'] = $request->id_kategori;
        $validated['id_subkategori'] = $request->id_subkategori;
        $validated['slug_subsubkategori'] = strtolower(str_replace(' ', '-', $request->nama_subsubkategori));
        $validated['created_at'] = Carbon::now();

        // BATCH INSERT
        SubSubCategory::create($validated);

        $notification = array(
            'message' => 'A new sub-subcategory has been added',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubSubCategory  $subSubCategory
     * @return \Illuminate\Http\Response
     */
    public function show(SubSubCategory $subSubCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubSubCategory  $subSubCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(SubSubCategory $subSubCategory)
    {
        $data['admin'] = Admin::find(Auth::user()->getKey());
        $data['categories'] = Category::orderBy('nama_kategori', 'ASC')->get();
        $data['subcategories'] = SubCategory::latest()->get();
        $data['subsubcategory'] = $subSubCategory;
        return view('back.category.sub_subcategory_edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSubSubCategoryRequest  $request
     * @param  \App\Models\SubSubCategory  $subSubCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubSubCategory $subSubCategory)
    {
        $validated = $request->validate([
            'nama_subsubkategori' => 'required|max:50',
            'id_kategori' => 'required',
            'id_subkategori' => 'required',
        ], [
            'id_kategori.required' => "Sub-subcategory must belong to a category",
            'id_subkategori.required' => "Sub-subcategory must belong to a subcategory"
        ]);


        $validated['nama_subsubkategori'] = $request->nama_subsubkategori;
        $validated['id_kategori'] = $request->id_kategori;
        $validated['id_subkategori'] = $request->id_subkategori;
        $validated['slug_subsubkategori'] = strtolower(str_replace(' ', '-', $request->nama_subsubkategori));
        $validated['created_at'] = Carbon::now();

        SubSubCategory::where('id', $subSubCategory->getKey())->update($validated);

        $notification = array(
            'message' => 'A sub-subcategory has been updated',
            'alert-type' => 'success'
        );

        return to_route('all.subsubcategory')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubSubCategory  $subSubCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubSubCategory $subSubCategory)
    {
        SubSubCategory::destroy($subSubCategory->getKey());
        $notification = array(
            'message' => 'A sub-subcategory has been deleted',
            'alert-type' => 'success'
        );
        return to_route('all.subcategory')->with($notification);
    }
}