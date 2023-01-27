<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $posts = Post::paginate(10);

        return view('home', ['posts'=> $posts]);
    }

    public function info(User $user)
    {
        return view('admin.users.userInfo', ['user'=>$user]);
    }

}
