<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\BookContent;
use App\Models\BookProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\BelongsToCategory;
use App\Models\Category;


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

    public function addReviewForm($id) {
        $book = BookProduct::find($id);
        return view('review.add_review', ['book' => $book]);
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

    public function delete(Request $request, $id)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $review = new Review;
        $userid = Auth::id(); 

        $review->userid = Auth::user()->id;
        $review->bookid = $id;
        $review->rating = $request->input('rating');
        $review->reviewcomment = $request->input('comment');
        
        $review->save();

        return redirect()->action([BookProductController::class, 'show'], ['id' => $review->bookid]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $reviews = Review::where('bookid', '=', $id)->get();
        $book = BookProduct::find($id);

        $bookContentId = $book->bookContent()->get('bookid')[0]->bookid;
        //dd($bookContentId);
        $belongsCategory = BelongsToCategory::where('bookid', '=', $bookContentId)->first();
        $category = Category::where('categoryid', '=', $belongsCategory->categoryid)->first();
        //dd($category);

        return view('review.reviews', ['reviews' => $reviews], ['book' => $book])->with('category', $category);
    }

    public function showUserReviews($id)
    {
        if(Auth::user() == null){
            return redirect('/home');
        }
        else if(Auth::user() != null && Auth::user()->id != $id)
            return redirect('/home');
            
        $reviews = Review::where('userid', '=', $id)->get();
        return view('user.review_history', ['reviews' => $reviews]);
    }

    public function list()
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $reviewid)
    {
        if(Auth::user() == null){
            return redirect('/home');
        }
        else if(Auth::user() != null && Auth::user()->id != $id)
            return redirect('/home');

        $review = Review::find($reviewid);
        return view('review.edit_review', ['review' => $review]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $reviewid)
    {
        $review = Review::find($reviewid);
        $userid = Auth::id(); 

        $review->userid = Auth::user()->id;
        $review->rating = $request->input('rating');
        $review->reviewcomment = $request->input('comment');
        
        $review->save();

        return redirect()->action([BookProductController::class, 'show'], ['id' => $review->bookid]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $reviewid)
    {
        $review = Review::find($reviewid);
        $review->delete();

        return redirect()->back();
    }
}
