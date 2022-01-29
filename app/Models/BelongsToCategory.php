<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BelongsToCategory extends Model
{
    use HasFactory;

    // Don't add create and update timestamps in database.
    public $timestamps  = false;

    protected $table = 'belongs_to_category';
    protected $primaryKey = 'bookid';

    protected $fillable = [
        'bookid', 'categoryid'
    ];

    public function book()
    {
        return $this->hasOne('App\Models\BookContent');
    }

    public function categories()
    {
        return $this->hasMany('App\Models\Category');
    }

    
}
