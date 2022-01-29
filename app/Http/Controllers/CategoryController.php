<?php

namespace App\Http\Controllers;

use App\Models\BelongsToCategory;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\BookContent;
use App\Models\BookProduct;

class CategoryController extends Controller
{
























    ///////////////////////////////////////////////////////////////////////////////////
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $category = new Category();

        // $this->authorize('create', $category);

        // $category->label = $request->input('label');
        // $category->save();

        // return $category;
    }

    public function delete(Request $request, $id)
    {
      $category = Category::find($id);

      $this->authorize('delete', $category);
      $category->delete();

      return $category;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($key)
    {
        $category = $key;

        $categoryid = Category::where('label', '=', $category)->first();

        //collection with id of bookContents of chosen category and id of category 
        $belongsToCategory = BelongsToCategory::where('categoryid', '=', $categoryid->categoryid)->get();

        //first entry of colletion
        if($belongsToCategory->isNotEmpty())
            $belongsToIds = $belongsToCategory[0]->bookid;
        //else return redirect('/home');  //alterar esta pagina
        else return view('pages.empty');

        //bookContents with requested categories 
        $bookContent = BookContent::where('bookid', '=', $belongsToIds)->get();
       
        $counter = -1;
        foreach($belongsToCategory as $belongstocategory){   
            if ($counter++ == 0) continue;

            $belongsToIds = $belongstocategory->bookid;
            $tempBook = BookProduct::where('bookcontentid', '=', $belongsToIds)->get();
            $bookContent = $bookContent->merge($tempBook);
        }
        

        //ids
        $contentids = $bookContent[0]->bookid;

        $books = BookProduct::where('bookcontentid', '=', $contentids)->get();

        $counter = -1;
        foreach($bookContent as $bookcontent){   
            if ($counter++ == 0) continue;

            $contentids = $bookcontent->bookid;
            $tempBook = BookProduct::where('bookcontentid', '=', $contentids)->get();
            $books = $books->merge($tempBook);
        }

        return view('pages.search', ['books' => $books]);
    }

    public function list()
    {

    }

}
