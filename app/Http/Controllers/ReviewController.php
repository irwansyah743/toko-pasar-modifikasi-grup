<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Review;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreReviewRequest;
use App\Http\Requests\UpdateReviewRequest;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreReviewRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Product $product)
    {

        $request->validate([
            'summary' => 'required',
            'comment' => 'required',
        ]);

        if (Review::where('id_produk', $product->id)->where('user_id', Auth::id())->count() > 0) {
            $notification = array(
                'message' => 'You have already wrote a review for this product',
                'alert-type' => 'warning'
            );

            return redirect()->back()->with($notification);
        }

        Review::insert([
            'id_produk' => $product->id,
            'user_id' => Auth::id(),
            'comment' => $request->comment,
            'summary' => $request->summary,
            'rating' => $request->quality,
            'created_at' => Carbon::now(),

        ]);

        $notification = array(
            'message' => 'Admin will approve your review soon',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateReviewRequest  $request
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReviewRequest $request, Review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(Review $review)
    {
        Review::destroy($review->id);

        $notification = array(
            'message' => 'A review has been deleted',
            'alert-type' => 'success'
        );


        return redirect()->back()->with($notification);
    }

    public function pendingReview()
    {
        $admin = Admin::find(Auth::user()->id);
        $review = Review::where('status', 0)->orderBy('id', 'DESC')->get();
        return view('back.review.pending_review', compact('review', 'admin'));
    } // end method 



    public function reviewApprove($id)
    {

        Review::where('id', $id)->update(['status' => 1]);

        $notification = array(
            'message' => 'Review Approved Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    } // end mehtod 

    public function publishedReview()
    {
        $admin = Admin::find(Auth::user()->id);
        $review = Review::where('status', 1)->orderBy('id', 'DESC')->get();
        return view('back.review.publish_review', compact('review', 'admin'));
    }
}