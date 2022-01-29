<?php

namespace App\Policies;

use App\Models\User;
use App\Models\UserOrder;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class OrderPolicy
{
    use HandlesAuthorization;

    public function show(User $user, UserOrder $order)
    {
      // Only a card owner can see it
      return $user->id == $order->userid;
    }

    public function list(User $user)
    {
      // Any user can list its own cards
      return Auth::check();
    }

    public function create(User $user)
    {
      // Any user can create a new card
      return Auth::check();
    }

}
