<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

        // Don't add create and update timestamps in database.
        public $timestamps  = false;

        protected $table = 'notification';
        protected $primaryKey = 'notificationid';

        public function user()
        {
            return $this->belongsTo('App\Models\User');
        }

        public function orderInformation()
        {
            return $this->belongsTo('App\Models\OrderInformation');
        }
    
        public function getBookProduct($id) {
            $book = BookProduct::find($id);
            return $book;
        }

        public function getBookContent($id) {
            $book = BookContent::find($id);
            return $book;
        }
}
