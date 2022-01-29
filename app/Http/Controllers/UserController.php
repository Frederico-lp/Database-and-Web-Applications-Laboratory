<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //SELECT * from user
        //$data = 
        return view('user/profile');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RegisteredUser  $registeredUser
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $user = User::find($id);
        //dd($user);
        if(Auth::user() != null){
            if(Auth::user()->id != $id)
                return redirect('/home');

            else return view('user.profile_info')->with('user', $user);
        }
        else return redirect('/home');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $registeredUser
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $user = User::find($id);
        if(Auth::user() != null){
            if(Auth::user()->id != $id)
                return redirect('/home');

            else return view('user.edit')->with('user', $user);
        }
        else return redirect('/home');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RegisteredUser  $registeredUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $user = User::find($id);

        // Make sure you've got the Page model
        if($user) {
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            if($request->filled('password')) {
                $user->password = $request->input('password');
            }
            $user->save();
        }
        return redirect('/home');
 
    }

    public function confirmDelete()
    {
        return view('user.confirm_delete');

    }


    public function destroy($id)
    {
        if(Auth::user() == null){
            return redirect('/home');
        }
        else if(Auth::user() != null && Auth::user()->id != $id)
            return redirect('/home');

        $user = User::find($id);
        //dd($cart);
        $user->delete();
        return redirect('/login');
    }
}
