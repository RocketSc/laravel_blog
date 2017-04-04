<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use Illuminate\Http\Request;

class CommentsController extends Controller
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
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function store(Post $post)
    {
        $this->validate(request(), [
            'name' => 'required|max:191',
            'email' => 'required|email|max:191',
            'body' => 'required|min:5|max:2000'
        ]);

        $comment = (new Comment( request(['name', 'email', 'body']) ));
        $comment->post()->associate($post);

        $comment->approve()->save();

        session()->flash('success', 'Your comment has been added');

        return redirect()->route('blog.single', $post->slug);
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Post $post)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
