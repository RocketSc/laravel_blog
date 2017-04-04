<?php

namespace App\Http\Controllers;

use App\Post;
use Mail;

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
        $this->validate(request(),[
            'email'   => 'required|email',
            'subject' => 'required|min:3',
            'message' => 'required|min:10'
        ]);

        $data = [
            'email' => request('email'),
            'subject' => request('subject'),
            'bodyMessage' => request('message')
        ];

        Mail::send('emails.contact', $data, function($message) use ($data) {
            $message->from($data['email']);
            $message->to('admin@test.io');
            $message->subject($data['subject']);
        });

        session()->flash('success', 'Your email was sent');

        return redirect()->route('blog.index');
    }
}