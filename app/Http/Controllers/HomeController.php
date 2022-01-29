<?php

namespace App\Http\Controllers;

use App\Models\BookProduct;
use Illuminate\Http\Request;

class HomeController extends Controller
{
 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $books = BookProduct::all();
        return view('home.best_price')->with('books', $books);
    }

    public function listById()
    {
        $books = BookProduct::paginate( 18 );
        return view('pages.listing_id')->with('books', $books);
    }

    public function listByRating()
    {
        $books = BookProduct::paginate( 18 );
        return view('pages.listing_rating')->with('books', $books);
    }
    public function listbyPrice()
    {
        $books = BookProduct::paginate( 18 );
        return view('pages.listing_price')->with('books', $books);
    }
     
}

