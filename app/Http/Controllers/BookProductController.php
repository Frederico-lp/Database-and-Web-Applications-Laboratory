<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\BelongsToCategory;
use App\Models\BookProduct;
use App\Models\Notification;
use App\Models\Cart;
use App\Models\BookContent;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Review;


class BookProductController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('book.create');
    }

    public function delete(Request $request, $id)
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $bookProduct = new BookProduct;
        $bookContent = new BookContent;

        $author = Author::where('authorname', '=', $request->input('author'))->first();

        if($author){
            $bookContent->authorid = $author->authorid;
        }
        else{
            $newAuthor = new Author;
            $newAuthor->authorname = $bookContent->authorid = $request->input('author');
            $newAuthor->description = " ";
            $newAuthor->save();

            $bookContent->authorid = $newAuthor->authorid;
        }
 
        $bookContent->title = $request->input('title');
        $bookContent->bookyear = $request->input('bookyear');
        $bookContent->average = 0.0;
        $bookContent->bookcover = $request->input('bookcover');
        $bookContent->save();
    
        $bookProduct->price = $request->input('price');
        if($bookProduct->booktype == 'e-book'){
            $bookProduct->stock = 0;
        }
        else $bookProduct->stock = $request->input('stock');
        $bookProduct->publisher = $request->input('publisher');
        $bookProduct->booktype = $request->input('booktype');
        $bookProduct->bookcontentid = $bookContent->bookid;
        $bookProduct->save();

        $category = Category::where('label', '=', $request->input('category'))->first();
        $belongsToCategory = new BelongsToCategory;
        $belongsToCategory->bookid = $bookContent->bookid;
        $belongsToCategory->categoryid = $category->categoryid;
        $belongsToCategory->save();

        $url = '/api/books/viewBook/' . (string)$bookProduct->bookid;
        return redirect( $url);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BookProduct  $bookProduct
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $reviews = Review::where('bookid', '=', $id)->get();
        $book = BookProduct::find($id);

        $bookContentId = $book->bookContent()->get('bookid')[0]->bookid;
        $belongsCategory = BelongsToCategory::where('bookid', '=', $bookContentId)->get();
        $categories = [];
        foreach($belongsCategory as $belongsCategory){ 
            $category = Category::where('categoryid', '=', $belongsCategory->categoryid)->first();

            array_push($categories, $category->label);
        }

        return view('review.reviews', ['reviews' => $reviews], ['book' => $book])->with('categories', $categories);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BookProduct  $bookProduct
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book = BookProduct::find($id);

        $bookContentId = $book->bookContent()->get('bookid')[0]->bookid;
        $belongsCategory = BelongsToCategory::where('bookid', '=', $bookContentId)->get();
        $categories = [];
        foreach($belongsCategory as $belongsCategory){ 
            $category = Category::where('categoryid', '=', $belongsCategory->categoryid)->first();

            array_push($categories, $category->label);
        }

        return view('book.edit')->with('book', $book)->with('categories', $categories);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BookProduct  $bookProduct
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $bookProduct = BookProduct::find($id);
    
        $bookContent = $bookProduct->bookid($bookProduct->bookcontentid);

        $author = Author::where('authorname', '=', $request->input('author'))->first();

        if($author){
            $bookContent->authorid = $author->authorid;
        }
        else{
            $newAuthor = new Author;
            $newAuthor->authorname = $bookContent->authorid = $request->input('author');
            $newAuthor->description = " ";
            $newAuthor->save();

            $bookContent->authorid = $newAuthor->authorid;
        }
        
        if($bookContent) {
            $bookContent->title = $request->input('title');
            $bookContent->bookyear = $request->input('bookyear');
            $bookContent->bookcover = $request->input('bookcover');
            $bookContent->save();
        }
        
        if($bookProduct) {
            $bookProduct->price = $request->input('price');
            if($bookProduct->booktype == 'e-book'){
                $bookProduct->stock = 0;
            }
            else $bookProduct->stock = $request->input('stock');
            
            $bookProduct->publisher = $request->input('publisher');
            $bookProduct->booktype = $request->input('booktype');
            $bookProduct->bookcontentid = $bookContent->bookid;
            $bookProduct->save();

            // send notification
            $users_cart = Cart::where('bookid', '=', $id)->get();
            foreach($users_cart as $cart) {
                $notification = new Notification;
                $notification->notificationmessage = 'Price of Book on Cart changed';
                $notification->userid = $cart->userid;
                $notification->orderid = null;
                $notification->bookid = $id;

                $notification->save();
            }
        }



        $belongsCategory = BelongsToCategory::where('bookid', '=', $bookProduct->bookid)->get();
        $categories = [];
        $categoryIds = [];
        foreach($belongsCategory as $belongsCategory){ 
            $category = Category::where('categoryid', '=', $belongsCategory->categoryid)->first();
            array_push($categoryIds, $category->categoryid);
            array_push($categories, $category->label);
        }
        //categories has now the original number of categories

        $newCategories = [];
        for($i=0; $i<count($categories); $i++){
            $name = 'category' . (string)$i;
            $newCategory = $request->input($name);
            $categoryObject = Category::where('label', '=', $newCategory)->first();
            //if inserted category exists
            if($categoryObject){
                $belongsToCategory = BelongsToCategory::where('bookid', '=', $bookContent->bookid)
                ->where('categoryid', '=', $categoryIds[$i])->first();
                

                $newCategoryObject = Category::where('label', '=', $newCategory)->first();
                $belongsToCategory->categoryid = $newCategoryObject->categoryid;
                $belongsToCategory->save();
            }
        }

        $url = '/api/books/viewBook/' . (string)$bookProduct->bookid;
        return redirect( $url);
    }

}
