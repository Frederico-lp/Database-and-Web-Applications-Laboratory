<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class User extends Authenticatable
{
    // use HasFactory;
    use Notifiable;

    // Don't add create and update timestamps in database.
    public $timestamps  = false;

    protected $table = 'users';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','isBlocked', 'isAdmin', 'profilePicture'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    
    
    
    //tenho duvidas aqui
    public function reports()
    {
        return $this->hasMany('App\Models\Report');
    }

    public function cart()
    {
        return $this->hasOne('App\Models\Cart');
    }

    public function wishlist()
    {
        return $this->hasOne('App\Models\Wishlist');
    }
    
    public function reviews()
    {
        return $this->hasMany('App\Models\Review');
    }
    
    public function notifications()
    {
        return $this->hasMany('App\Models\Notification');
    }
    
    public function orders()
    {
        return $this->hasMany('App\Models\UserOrder');
    }
    
    public function creditCards()
    {
        return $this->hasMany('App\Models\Card');
    }
    
    //falta o message
}
