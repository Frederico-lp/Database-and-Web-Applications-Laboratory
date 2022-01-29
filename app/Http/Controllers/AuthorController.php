<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $author = new Author();

        $this->authorize('create', $author);

        $author->authorname = $request->input('name');
        $author->save();

        return $author;
    }

    public function delete(Request $request, $id)
    {
      $author = Author::find($id);

      $this->authorize('delete', $author);
      $author->delete();

      return $author;
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function show(Author $author)
    {
        $this->authorize('show', $author);
        return view('pages.author', ['author' => $author]);
    }

    public function list()
    {
      $this->authorize('list', Author::class);
      $authors = Auth::authors()->orderBy('authorname');
      return view('pages.authors', ['authors' => $authors]);
    }

}
