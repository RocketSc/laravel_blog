@extends('main')

@section('title', 'Main')

@section('content')
    <div class="row">
        <div class="col-md-10">
            <h1>All posts</h1>
        </div>

        <div class="col-md-2">
            <a href="{{ URL::route('posts.create') }}" class="btn btn-primary btn-block btn-h1-spacing">Create new post</a>
        </div>
        <hr>
    </div>

    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Body</th>
                    <th>Created At</th>
                    <th></th>
                </tr>
                    @foreach($posts as $post)
                        <tr>
                            <td>{{ $post->id }}</td>
                            <td>{{ $post->title }}</td>
                            <td>{{
                                mb_strlen($post->body) < 55 ? ($post->body) : (substr($post->body, 0, 50) . '...')
                            }}</td>
                            <td>{{ $post->created_at->toFormattedDateString() }}</td>
                            <td>
                                <a href="{{ URL::route('posts.show', $post) }}" class="btn btn-default">View</a>
                                <a href="{{ URL::route('posts.edit', $post) }}" class="btn btn-default">Edit</a>
                            </td>
                        </tr>
                    @endforeach
            </table>

            <div class="text-center">
                {!! $posts->links() !!}
            </div>
        </div>
    </div>
@endsection
