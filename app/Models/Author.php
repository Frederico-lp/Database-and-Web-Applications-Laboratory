<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    // Don't add create and update timestamps in database.
    public $timestamps  = false;

    protected $table = 'author';
    protected $primaryKey = 'authorid';

    protected $fillable = [
        'authorid', 'authorname', 'description','picture'
    ];

    public function books()
    {
        return $this->hasMany('App\Models\BookContent');
    }

}
