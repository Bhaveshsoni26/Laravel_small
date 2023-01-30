<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Yoeunes\Toastr\Facades\Toastr;

class PostController extends Controller
{
    //
    public function index()
    {
        $posts = auth()->user()->posts()->paginate(5);

        return view('admin.posts.index', ['posts'=>$posts]);
    }
    



    public function show(Post $post)
    {
        return view('blog-post', ['posts' => $post]);
    }

    public function create()
    {

        $this->authorize('create', Post::class);

        return view('admin.posts.create');
    }

    public function store()
    {

        $this->authorize('create', Post::class);

        $inputs = request()->validate([
            'title' => 'required|min:8|max:50',
            'post_image' => 'mimes:jpg,png,jpeg',
            'body' => 'required'
        ]);

        if (request('post_image')) {

            $inputs['post_image'] = request('post_image')->store('images');
        }
        auth()->user()->posts()->create($inputs);

        // session()->flash('post-created-message', 'Post Created');
        Toastr::success('Post created successfully');

        return redirect()->route('post.index');
    }

    public function destroy(Post $post, Request $request)
    {
        $post->delete();

        Toastr::warning('Post was deleted');
        // $request->session()->flash('message','Post was deleted');

        return back();
    }

    public function edit(Post $post)
    {
        return view('admin.posts.edit', ['post'=>$post]);
    }

    public function update(Post $post)
    {
        $inputs = request()->validate([
            'title' => 'required|min:8|max:50',
            'post_image' => 'mimes:jpg,png,jpeg',
            'body' => 'required'
        ]);
        if (request('post_image')) {

            $inputs['post_image'] = request('post_image')->store('images');

            $post->post_image = $inputs['post_image'];
        }
        $post->title = $inputs['title'];
        $post->body = $inputs['body'];

        $this->authorize('update', $post);
           
        $post->update();
        
        Toastr::info('Post Updated');
        // session()->flash('post-updated-message', 'Post Updated');

        return redirect()->route('post.index');
    }
}
