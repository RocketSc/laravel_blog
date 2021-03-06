<?php

namespace App\Http\Controllers;

use App\Category;
use App\Tag;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Http\Request;
use App\Post;
use Storage;

class PostsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('id', 'desc')->paginate(5);

        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate the data
        $this->validate($request, [
            'title' => 'required|max:191',
            'slug' => 'required|alpha_dash|min:6|max:50|unique:posts,slug',
            'category_id' => 'required|integer',
            'body'  => 'required',
            'featured_image' => 'sometimes|image'
        ]);

        //store in the database
        $post = new Post;

        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->body = clean($request->body);
        $post->category_id = $request->category_id;


        if ( $request->hasFile('featured_image') ) {
            $image = $request->file('featured_image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('images/' . $filename);

            Image::configure(['driver' => 'gd']);
            Image::make($image)->resize(800, 400)->save($location);

            $post->image = $filename;
        }

        $post->save();

        if (isset($request->tags)) {
            $post->tags()->sync($request->tags, false);
        } else {
            $post->tags()->sync([], false);
        }

        session()->flash('success', 'The blog post was successfully saved!');

        //redirect to another page
        return redirect()->route('posts.show', $post);
    }

    /**
     * Display the specified resource.
     *
     * @param  Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        $categories = Category::all();
        $tags = Tag::all();

        $tags_array = array_map(function($tag) {
            return $tag->id;
        }, $post->tags->all());

        return view('posts.edit', compact('post', 'categories', 'tags', 'tags_array'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //validate slug if it has been changed
        if ($request->input('slug') != $post->slug) {
            $this->validate($request,[
                'slug' => 'required|alpha_dash|min:6|max:50|unique:posts,slug'
            ]);
        }

        $this->validate($request, [
            'title' => 'required|max:191',
            'category_id' => 'required|integer',
            'body'  => 'required',
            'featured_image' => 'sometimes|image'
        ]);


        $post->title = $request->input('title');
        $post->slug = $request->input('slug');
        $post->category_id = $request->category_id;
        $post->body = clean($request->body);

        if ( $request->hasFile('featured_image') ) {
            $image = $request->file('featured_image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('images/' . $filename);

            Image::configure(['driver' => 'gd']);
            Image::make($image)->resize(800, 400)->save($location);

            $oldFileName = $post->image;
            $post->image = $filename;

            Storage::delete($oldFileName);
        }

        $post->save();

        if (isset($request->tags)) {
            $post->tags()->sync($request->tags, true);
        } else {
            $post->tags()->sync([], true);
        }

        session()->flash('success', 'The blog post was successfully updated!');

        //redirect to another page
        return redirect()->route('posts.show', $post->id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->tags()->detach();

        Storage::delete($post->image);
        $post->delete();

        session()->flash('success', 'The blog post was successfully deleted');

        return redirect()->route('posts.index');
    }
}
