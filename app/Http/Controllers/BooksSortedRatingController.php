<?php

namespace App\Http\Controllers;

use App\Models\BookProduct;
use App\Models\BookContent;

use Illuminate\Http\Request;

class BooksSortedRatingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $books = BookProduct::all();
        $sorted = $books->sortByDesc(function ($book) {
            $bookContent = $book->bookid($book->bookcontentid);

            return $bookContent->average;
        });
        return view('pages.books_home')->with('books', $sorted);
    }
}
