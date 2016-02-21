<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests;
use App\User;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect()->route('book.index');
    }

    public function about()
    {
        return view('about');
    }

    public function showUser($id)
    {
        $user = User::findOrFail($id);

        $data = [];

        $data['user'] = $user;
        $data['user_info'] = $user->user_info;

        return view('auth.user_center')->with($data);
    }

}
