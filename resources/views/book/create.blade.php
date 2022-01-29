@extends('layouts.app')

@section('title', 'Books')

@section('content')

<br>
    <h1> Add Book </h1> <p style = "padding: 20px;"> Fill in the form with the corresponding information.</p>
            <div class="information" style = "padding-left: 3px; margin-left: 1%; background-color:lightgray;">

                <div>
                    <form action="/api/books/addBook/confirmed" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('put') }}
                        <div class="form-group" style="padding-left:40px;">
                            <label class="col-form-label mt-4" for="inputDefault">Title</label>
                            <input type="text" class="form-control" placeholder="Title" id="inputDefault"name="title" style = "width: 60%;">
                            
                            <label class="col-form-label mt-4" for="inputDefault">Book Year</label>
                            <input type="number" class="form-control" placeholder="Book Year" id="inputDefault"name="bookyear" style = "width: 60%;">
                            
                            <label class="col-form-label mt-4" for="inputDefault">Author</label>
                            <input type="text" class="form-control" placeholder="Author" id="inputDefault"name="author" style = "width: 60%;">
                            
                            <label class="col-form-label mt-4" for="inputDefault">Book Cover URL</label>
                            <input type="text" class="form-control" placeholder="Book Cover" id="inputDefault"name="bookcover" style = "width: 60%;">
                            

                            <label class="col-form-label mt-4" for="inputDefault">Price</label>
                            <div class="input-group mb-3"style = "width: 60%;">
                            <span class="input-group-text">€</span>
                            <input type="float" class="form-control" placeholder="Price" id="inputDefault"name="price">
                            </div>

                            <label class="col-form-label mt-4" for="inputDefault">Stock</label>
                            <input 
                                type="number" value = 1 min=1 class="form-control" placeholder="Stock" id="inputDefault" name="stock" style = "width: 60%;">
                            

                            <label class="col-form-label mt-4" for="inputDefault">Publisher</label>
                            <input type="text" class="form-control" placeholder="Publisher" id="inputDefault"name="publisher" style = "width: 60%;">
                            

                            <label class="col-form-label mt-4" for="inputDefault">Edition</label>
                            <input type="text" class="form-control" placeholder="Edition" id="inputDefault"name="edition" style = "width: 60%;">
                            

                            <div class="form-group">
                            <label for="exampleSelect1" class="form-label mt-4"> Book type</label>
                            <select class="form-select" id="exampleSelect1" name = "booktype" style = "width: 60%;">
                                <option value = "physical">Physical</option>
                                <option value = "e-book">  E-book</option>
                            </select>
                            </div>
                            
                            <div class="form-group">
                            <label for="exampleSelect1" class="form-label mt-4"> Category</label>
                            <select class="form-select" id="exampleSelect1" name = "category" style = "width: 60%;">
                                <option value = "Romance">Romance</option>
                                <option value = "Comedy">  Comedy</option>
                                <option value = "Biography">  Biography</option>
                                <option value = "Sport">  Sport</option>
                                <option value = "Drama">  Drama</option>
                                <option value = "Sci-Fi">  Sci-Fi</option>
                                <option value = "Western">  Western</option>
                                <option value = "War">  War</option>
                                <option value = "Adventure">  Adventure</option>
                                <option value = "Horror">  Horror</option>
                                <option value = "Fantasy">  Fantasy</option>
                                <option value = "Mystery">  Mystery</option>
                                <option value = "Crime">  Crime</option>
                                <option value = "Family">  Family</option>
                                <option value = "History">  History</option>


                            </select>
                            </div>

                            <br><br>
                            <button class = "btn btn-primary" type="submit"  style="width: 60%;">
                                Save
                            </button>
                            <br><br><br>
                    
                        </div>
                    </form>

                </div>

            </div>

            <br><br><br>


    </div>

   




@endsection
