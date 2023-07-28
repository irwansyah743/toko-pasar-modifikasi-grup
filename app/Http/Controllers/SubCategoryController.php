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
        $data['categories'] = Category::orderBy('category_name', 'ASC')->get();
        $data['admin'] = Admin::find(Auth::user()->id);
        $data['subcategories'] = SubCategory::latest()->get();
        $data['subsubcategoriesToDelete'] = DB::table('sub_sub_kategori')->select('subcategory_id', DB::raw('count(*)'))->groupBy('subcategory_id')->get();
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
            'subcategory_name' => 'required|max:50|unique:sub_categories,subcategory_name',
            'category_id' => 'required',
        ], [
            'category_id.required' => "Subcategory must belong to a category"
        ]);


        $validated['subcategory_name'] = $request->subcategory_name;
        $validated['category_id'] = $request->category_id;
        $validated['subcategory_slug'] = strtolower(str_replace(' ', '-', $request->subcategory_name));
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
        $data['admin'] = Admin::find(Auth::user()->id);
        $data['categories'] = Category::orderBy('category_name', 'ASC')->get();
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
            'subcategory_name' => 'required|max:50',
            'category_id' => 'required',
        ], [
            'category_id.required' => "Subcategory must belong to a category"
        ]);


        $validated['subcategory_name'] = $request->subcategory_name;
        $validated['category_id'] = $request->category_id;
        $validated['subcategory_slug'] = strtolower(str_replace(' ', '-', $request->subcategory_name));
        $validated['created_at'] = Carbon::now();

        SubCategory::where('id', $subCategory->id)->update($validated);

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
        SubCategory::destroy($subCategory->id);
        SubSubCategory::where('subcategory_id', $subCategory->id)->delete();
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
    public function getSubCategory($category_id)
    {

        $data = SubCategory::where('category_id', $category_id)->orderBy('subcategory_name', 'ASC')->get();

        // MEnggunakan response akan menyesuaikan header menjadi json type
        return response()->json($data);
    }
}