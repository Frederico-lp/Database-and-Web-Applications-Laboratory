<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

        // Don't add create and update timestamps in database.
        public $timestamps  = false;

        protected $table = 'cart';

        protected $primaryKey = 'userid';

        /**
         * The attributes that are mass assignable.
         *
         * @var array
         */
        protected $fillable = [
            'bookid', 'userid', 'quantity',
        ];

        public function user()
        {
            return $this->belongsTo('App\Models\User', 'userid');
        }

        public function books()
        {
            return $this->hasMany('App\Models\BookProduct', 'bookid');
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
