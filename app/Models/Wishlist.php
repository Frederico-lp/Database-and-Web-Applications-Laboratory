<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;

        // Don't add create and update timestamps in database.
        public $timestamps  = false;

        protected $table = 'wishlist';
        protected $primaryKey = 'userid';


        protected $fillable = [
            'bookid', 'userid',
        ];


        public function user()
        {
            return $this->belongsTo('App\Models\User');
        }

        public function books()
        {
            return $this->hasMany('App\Models\BookProduct');
        }

        public function bookid($id){
            $book = BookProduct::find($id);
            //dd($book);
            return $book;
        }

        public function bookContentid($id) {
            $book = BookContent::find($id);
            //dd($book);
            return $book;
        }

}
