@extends('main')

@section('title', 'Blog')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1>Blog</h1>
        </div>
    </div>

    @foreach($posts as $post)

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h2>{{ $post->title }}</h2>
                <h5>Published: {{ $post->created_at->toFormattedDateString() }}</h5>
                <p>{{ mb_strlen(strip_tags($post->body)) < 300 ? (strip_tags($post->body)) : (substr(strip_tags($post->body), 0, 295) . '...') }}</p>
                <a class="btn btn-primary" href="{{ URL::route('blog.single', $post->slug) }}">Read More</a>
            </div>
        </div>
        <hr>
    @endforeach
    <div class="row">
        <div class="col-md-12">
            <div class="text-center">
                {!! $posts->links() !!}
            </div>
        </div>
    </div>

@endsection