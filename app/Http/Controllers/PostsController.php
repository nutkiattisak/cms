<?php

namespace App\Http\Controllers;

use App\Post;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Requests\Posts\CreatePostsRequest;
use App\Http\Requests\Posts\UpdatePostsRequest;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        $chkTrashed = false;
        return view('posts.index')->with('posts', $posts)->with('chkTrashed', $chkTrashed);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create')->with('categories', Category::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostsRequest $request)
    {
        $image = $request->image->store('posts');
        Post::create([
            'title' => $request->title,
            'description' =>$request->description,
            'content' => $request->content,
            'image' => $image,
            'category_id'=>$request->category,
            'published_at'=>$request->published_at
        ]);

        session()->flash('success', 'Create post successfully.');
        return redirect(route('posts.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.create')->with('post', $post)->with('categories', Category::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostsRequest $request, Post $post)
    {
        $data = $request->only(['title', 'description', 'content', 'published_at', 'category_id']);
        
        if($request->hasFile('image')){
            $image = $request->image->store('posts');

            Storage::delete($post->image);

            $post->deleteImage();

            $data['image'] = $image;
        }

        $post->update($data);

        session()->flash('success', 'Post updated successfully.');

        return redirect(route('posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::withTrashed()->where('id', $id)->firstOrFail();

        if($post->trashed()){
            //Storage::delete($post->image);

            $post->deleteImage();

            $post->forceDelete();
        }
        else{
            $post->delete();
        }

        session()->flash('success', 'Post trashed successfully.');

        return redirect(route('posts.index'));
    }

     /**
     * Display a list of all trashed posts.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function trashed()
    {
        $trashed = Post::onlyTrashed()->get();

        $chkTrashed = true;

        return view('posts.index')->with('posts', $trashed)->with('chkTrashed', $chkTrashed);
    }

    public function restore($id)
    {
        $post = Post::withTrashed()->where('id', $id)->firstOrFail();
        $post->restore();

        session()->flash('success', 'Post Restore Success');

        return redirect()->back();
    }
}
