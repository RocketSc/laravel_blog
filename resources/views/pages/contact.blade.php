@extends('main')

@section('title', 'Contact')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1>Contact Me</h1>
            <hr>
            <form action="{{ route('contact.send') }}" method="POST">
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input id="email" class="form-control" name="email" type="email">
                </div>
                <div class="form-group">
                    <label for="subject">Subject:</label>
                    <input id="subject" class="form-control" name="subject" type="text">
                </div>

                <div class="form-group">
                    <label for="message">Message:</label>
                    <textarea
                            id="message"
                            class="form-control"
                            name="message"
                            placeholder="Type your message here...">
                    </textarea>
                </div>

                <div class="form-group">
                    <input class="btn btn-success" type="submit" name="submit" value="Send Message">
                </div>
            </form>
        </div>
    </div>

@endsection