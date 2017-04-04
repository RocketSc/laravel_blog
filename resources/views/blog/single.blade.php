@extends('main')

@section('title'){{ $post->title }}@endsection

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset2">
            <h1>{{ $post->title }}</h1>
            <p>{{ $post->body }}</p>
            <hr>
            <p>Posted in: {{ $post->category->name }}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h2>Comments:</h2>
            <hr>
            @foreach($post->comments as $comment)
                <h3>{{ $comment->name }}</h3>
                <p>{{ $comment->body }}</p>
                <hr>
            @endforeach
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 col-md-offset2">
            <form action="{{route('comment.store', $post)}}"
                  class="form"
                  method="POST">

                {{ csrf_field() }}
                <div class="form-group">
                    <label for="name">Name: </label>
                    <input class="form-control" type="text" id="name" name="name">
                </div>

                <div class="form-group">
                    <label for="email">Email: </label>
                    <input class="form-control" id="email" type="email" name="email">
                </div>

                <div class="form-group">
                    <label for="comment">Your comment: </label>
                    <textarea class="form-control" name="body" id="comment" cols="30" rows="10"></textarea>
                </div>

                <div class="form-group">
                    <input class="btn btn-success" type="submit" value="Add Comment">
                </div>

            </form>
        </div>
    </div>
@endsection