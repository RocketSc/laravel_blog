<?php

namespace App\Http\Controllers;

use App\Post;

class PagesController extends Controller
{
    public function getIndex()
    {
        //process variable data or params

        //talk to the model
        $posts = Post::orderBy('created_at')->limit(4)->get();

        //receive from the model

        //compile or process data from the model if needed

        //pass that data to the correct view
        return view('pages.welcome', compact('posts'));
    }

    public function getAbout()
    {
        $first = 'Rocket';
        $last = 'Science';

        $full = $first . ' ' . $last;
        $email = 'rocketscience@example.com';
        return view('pages.about', compact('full', 'email'));
    }

    public function getContact()
    {
        return view('pages.contact');
    }

    public function postContact()
    {

    }
}