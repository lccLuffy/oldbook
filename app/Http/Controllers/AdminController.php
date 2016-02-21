<?php

namespace App\Http\Controllers;

use App\Book;
use App\Category;
use App\Http\Requests;
use App\User;

class AdminController extends Controller
{
    public function index()
    {
        $data = array();
        $user_count = User::count();
        $category_count = Category::count();
        $book_count = Book::count();
        dd();
        $data['user_count'] = $user_count;
        $data['category_count'] = $category_count;
        $data['book_count'] = $book_count;

        return view('auth.admin.index')->with($data);
    }

    public function user()
    {

        $data = array();
        $data['users'] = User::all();

        return view('auth.admin.show_users')->with($data);
    }
}
