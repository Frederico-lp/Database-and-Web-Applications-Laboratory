<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookContent extends Model
{
    use HasFactory;

    // Don't add create and update timestamps in database.
    public $timestamps  = false;

    protected $table = 'book_content';
    protected $primaryKey = 'bookid';

    protected $fillable = [
        'bookid', 'title', 'bookyear','average', 'authorid', 'bookcover'
    ];

    public function bookProduct() {
        return $this->hasMany('App\Models\BookProduct');
    }

    public function reviews()
    {
        return $this->hasMany('App\Models\Review');
    }

    public function author()
    {
        return $this->belongsTo('App\Models\Author', 'authorid');
    }

    public function belongToCategory() {
        return $this->belongsTo('App\Models\BelongsToCategory');
    }

}
