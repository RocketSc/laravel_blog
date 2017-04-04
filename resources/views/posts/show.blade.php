@extends('main')

@section('title', 'View Post')

@section('content')
<div class="row">
    <div class="col-md-8">
        <h1>{{ $post->title }}</h1>

        <div class="tags">
            @foreach($post->tags as $tag)
                <span class="label label-default">{{ $tag->name }}</span>
            @endforeach
        </div>

        <p class="lead">{{ $post->body }}</p>
        
        <div id="backend-comments">
            <h3>Comments <small>{{ $post->comments()->count() }} total</small></h3>
            
            <table class="table">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Comment</th>
                    <th style="width: 70px"></th>
                </tr>
                @foreach($post->comments as $comment)
                    <tr>
                        <td>{{ $comment->name }}</td>
                        <td>{{ $comment->email }}</td>
                        <td>{{ $comment->body }}</td>
                        <td>
                            <a class="btn btn-xs btn-primary" href="{{ route('comment.edit', $comment) }}"><span class="glyphicon glyphicon-pencil"></span></a>
                            <a class="btn btn-xs btn-danger" href="#"><span class="glyphicon glyphicon-trash"></span></a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>

    </div>

    <div class="col-md-4">
        <dl class="dl-horizontal">
            <dt>Url:</dt>
            <dd><a href="{{ URL::route('blog.single', $post->slug) }}">{{ URL::route('blog.single', $post->slug) }}</a></dd>
        </dl>

        <dl class="dl-horizontal">
            <dt>Category:</dt>
            <dd>{{ $post->category->name }}</dd>
        </dl>

        <dl class="dl-horizontal">
            <dt>Created At:</dt>
            <dd>{{ $post->created_at->diffForHumans() }}</dd>
        </dl>

        <dl class="dl-horizontal">
            <dt>Updated At:</dt>
            <dd>{{ $post->updated_at->diffForHumans() }}</dd>
        </dl>

        <hr>

        <div class="row">

            <div class="col-sm-6">
                <a href="/posts/{{ $post->id }}/edit" class="btn btn-primary btn-block">Edit</a>
            </div>

            <div class="col-sm-6">
                <form action="{{ URL::route('posts.destroy', $post) }}" method="POST">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button class="btn btn-danger btn-block">Delete</button>
                </form>
            </div>

        </div>

        <div class="row">
            <div class="col-md-12">
                <a href="{{ URL::route('posts.index') }}" class="btn btn-default btn-block btn-h1-spacing"><< See all posts</a>
            </div>
        </div>
    </div>
</div>
@endsection