<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        if(Auth::user() == null){
            return redirect('/home');
        }
        else if(Auth::user() != null && Auth::user()->id != $id)
            return redirect('/home');

        $bookIds = Wishlist::where('userid', $id)->get();
        return view('wishlist.index',['bookIds' => $bookIds]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $wishlist = new Wishlist;

        //$this->authorize('create', $cart);

        $wishlist->name = $request->input('quantity');
        //$cart->userid = Auth::user()->id;
        $wishlist->bookId = $request->route('id');
        $wishlist->save();

        dd($wishlist);
        return $wishlist;
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id)
    {
        $errors = [];

        $wishlist = new Wishlist;
        $userid = Auth::id(); 
        
        $uniqueBook = Wishlist::where('bookid', '=', $id)
        ->where('userid', '=', $userid)   //para teste
        ->first();

        if ($uniqueBook === null) {
            
            $wishlist->userid = Auth::user()->id;

            $wishlist->bookid = $id;
    
            $wishlist->save();
    
    
            return redirect('/home');
        } 
        array_push($errors, 'Error: Book alredy in wishlist');
        return redirect()->back()->with('errors', $errors);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Wishlist  $wishlist
     * @return \Illuminate\Http\Response
     */
    public function show(Wishlist $wishlist)
    {
        $this->authorize('show', $wishlist);
        return view('pages.wishlist', ['wishlist' => $wishlist]);
    }

    public function list()
    {
      if (!Auth::check()) return redirect('/login');
      $this->authorize('list', Wishlist::class);
      $books = Auth::registered_user()->wishlist();
      return view('pages.books', ['books' => $books]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Wishlist  $wishlist
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $bookid)
    {
        $wishlist = Wishlist::where('bookid', '=', $bookid)
        ->where('userid', '=', $id);   //para teste
        //dd($cart);
        $wishlist->delete();
        return redirect()->back();
    }
}
