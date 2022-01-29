<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookProduct extends Model
{
    use HasFactory;

    // Don't add create and update timestamps in database.
    public $timestamps  = false;

    protected $table = 'book_product';
    protected $primaryKey = 'bookid';

    protected $fillable = [
        'bookid', 'price', 'stock','publisher', 'edition', 'booktype', 'bookcontentid'
    ];

    public function bookContent() {
        return $this->belongsTo('App\Models\BookContent', 'bookcontentid');
    }

    public function carts()
    {
        return $this->belongsTo('App\Models\Cart');
    }

    public function wishlists()
    {
        return $this->belongsTo('App\Models\Wishlist');
    }

    public function order()
    {
        return $this->belongsTo('App\Models\OrderInformation');
    }

    public function bookid($id){
        // $book = BookContent::where('bookcontentid', '=', $id)
        // ->first();
        $book = BookContent::find($id);
        // //dd($book);
        return $book;
    }

    public function getAuthor($id) {
        $author = Author::find($id);
        return $author;
    } 
}
