@extends('main')

@section('title', 'Edit Comment')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1>Edit Comment</h1>
            <form action="{{ route('comment.update', $comment) }}" class="form" method="POST">
                {{ csrf_field() }}
                {{ method_field('PUT') }}

                <div class="form-group">
                    <label for="name">Name: </label>
                    <input class="form-control" type="text" id="name" value="{{ $comment->name }}" disabled>
                </div>

                <div class="form-group">
                    <label for="email">Email: </label>
                    <input class="form-control" type="text" id="email" value="{{ $comment->email }}" disabled>
                </div>

                <div class="form-group">
                    <label for="comment">Comment: </label>
                    <textarea id="comment" class="form-control" name="body" cols="30" rows="10">{{ $comment->body }}</textarea>
                </div>

                <div class="form-group">
                    <input class="btn btn-success" type="submit" value="Save">
                </div>
            </form>
        </div>
    </div>
@endsection