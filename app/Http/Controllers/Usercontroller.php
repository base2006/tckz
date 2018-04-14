<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Usercontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
//        if (!Auth::user()->hasRole('admin')) {
//            $id = Auth::user()->id;
//        }

        $user = User::find($id);

        return view('user.profile')->with('user', $user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
//        if (!Auth::user()->hasRole('admin')) {
//            $id = Auth::user()->id;
//        }

        $user = User::find($id);

        return view('user.edit')->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (!empty($request->get('password'))) {
            $request->validate([
                'name' => 'required',
                'email' => 'required|email',
                'password' => 'required|min:6|confirmed'
            ]);
        } else {
            $request->validate([
                'name' => 'required',
                'email' => 'required|email'
            ]);
        }

        $user = User::find($id);

        $user->name = $request->input('name');
        $user->email = $request->input('email');

        if (!empty($request->get('password'))) {
            $user->password = Hash::make($request->input('password'));
        }

        $user->save();

        return redirect()->route('user.profile', $user->id)->with('success', 'Your profile has been updated succesfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);

        if ($user->id == Auth::user()->id) {
            return view('home')->with('error', 'Your own account can not be removed');
        }

        $user->delete();

        $success = "The user has successfully been deleted.";

        return view('home')->with('success', $success);
    }
}
