<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PostRequest;
use App\Models\Post;
use App\Repository\Elequents\PostRepository;
use App\Repository\Elequents\UserRepository;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct(private PostRepository $elequent_post, private UserRepository $elequent_user){
        $this->authorizeResource(Post::class, "post");
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = $this->elequent_post->all();
        return view("admin.post.index", compact("posts"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = $this->elequent_user->all();
        return view("admin.post.create", compact("users"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        $this->elequent_post->store($request->toDTO());
        return redirect()->route("post.index");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $post = $this->elequent_post->find($post->id);
        $users = $this->elequent_user->all();
        return view("admin.post.edit", compact("users", "post"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, Post $post)
    {   
        $this->elequent_post->update($post, $request->toDTO());
        return redirect()->route("post.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return back();
    }
}
