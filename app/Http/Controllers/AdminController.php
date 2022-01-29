<?php

namespace App\Http\Controllers;

use App\Models\OrderInformation;
use App\Models\Notification;
use App\Models\User;
use App\Models\UserOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{

    public function users(){
        $users = User::paginate(15);
        if (Auth::user()->isadmin == 'True'){
            return view('admin.users')->with('users', $users);
        }
        else return redirect('/home');
    }

    public function userDetails($id){
        $user = User::find($id);
        $orders = UserOrder::where('userid', '=', $id)->get();

        return view('admin.user_details', ['orders' => $orders])->with('user', $user);
    }

    public function updateStatus(Request $request, $orderid, $bookid){
        $orderInformation = OrderInformation::where('orderid', '=', $orderid)
        ->where('bookid', '=', $bookid)   
        ->first();

        if($orderInformation) {
            $orderInformation->orderstatus = $request->input('orderstatus');
            $orderInformation->save();
        }
        // send notification
        $user_order = UserOrder::find($orderid);
        $notification = new Notification;
        $notification->notificationmessage = 'Status changed';
        $notification->userid = $user_order->userid;
        $notification->orderid = $orderInformation->orderid;
        $notification->bookid = $orderInformation->bookid;

        $notification->save();
        
        return redirect('/home');

    }

    public function updateUser(Request $request, $id){
        $user = User::find($id);

        if($user) {
            $user->isadmin = $request->input('admin');
            $user->isblocked = $request->input('blocked');
            $user->save();
        }
        $url = '/admin/users/' . (string)$user->id;
        return redirect($url);

    }

}