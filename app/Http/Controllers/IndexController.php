<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $data['categories'] = Category::orderBy('category_name', 'ASC')->get();
        $data['products'] = Product::where('status', 1)->orderBy('id', 'DESC')->limit(8)->get();
        $data['subcategories'] = SubCategory::latest()->get();
        $data['sliders'] = Slider::where('status', 1)->orderBy('id', 'DESC')->limit(3)->get();
        return view('front.index', $data);
    }
}