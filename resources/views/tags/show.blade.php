@extends('main')

@section('title', $tag->name . ' tag' )

@section('content')
    <div class="row">
        <div class="col-md-8">
            <h1>{{ $tag->name }} Tag <small>{{ $tag->posts()->count() }} Posts</small></h1>
        </div>

        <div class="col-md-2">
            <a class="btn btn-primary btn-block pull-right" href="{{ route('tags.edit', $tag) }}">Edit</a>
        </div>

        <div class="col-md-2">
            <form action="{{ route('tags.destroy', $tag) }}" method="POST">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <button class="btn btn-danger btn-block">Delete</button>
            </form>
        </div>
    </div>

    <div class="row col-md-12">
        <table class="table">
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Tags</th>
                <th></th>
            </tr>
            @foreach($tag->posts as $post)
                <tr>
                    <td>{{ $post->id }}</td>
                    <td>{{ $post->title }}</td>
                    <td>
                        @foreach($post->tags as $tag)
                            <span class="label label-default">{{ $tag->name }}</span>
                        @endforeach
                    </td>
                    <td><a href="{{ route('posts.show', $post) }}" class="btn btn-default btn-sm">View</a></td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection