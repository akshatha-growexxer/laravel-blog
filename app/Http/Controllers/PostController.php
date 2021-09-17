<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Foundation\Validation\ValidatesRequests;

class PostController extends Controller
{
    const PAGINATION=5;
    const SUCCESS_MESSAGE = 'Post Added Successfully';
    const UPDATE_MESSAGE  = 'Post Updated Successfully';
    const DELETE_MESSAGE  = 'Post Deleted Successfully';
    const STATUS          = 'success';

    /**
     * Function to display the index post page with pagination
     * @author Akshatha
     * @param null
     * @return void
     */
    public function index()
    {
        $posts = Post::latest()->paginate(self::PAGINATION);
        return view('posts.index', compact('posts'));
            
    }

    /**
     * Function to create a post
     * @author Akshatha
     * @param null
     * @return void
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Function to store the information into Post 
     * @author Akshatha
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        $post = Post::create($request->all());
        return redirect('/posts/' . $post->id)->with(self::STATUS, self::SUCCESS_MESSAGE);
    }

    /**
     * Function to display the result
     * @author Akshatha
     * @param Post $post
     * @return void
     */
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    /**
     * Function to Edit the Post
     * @author Akshatha
     * @param Post $post
     * @return void
     */
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    /**
     * Function to Update the Post
     * @author Akshatha
     * @param Request $request
     * @param Post $post
     * @return void
     */
    public function update(Request $request, Post $post)
    {
        $post->update($request->all());
        return redirect('/posts/' . $post->id)->with(self::STATUS, self::UPDATE_MESSAGE);
    }

    /**
     * Function to delete the Post
     * @author Akshatha
     * @param Post $post
     * @return void
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index')
            ->with(self::STATUS, self::DELETE_MESSAGE);
    }
}
