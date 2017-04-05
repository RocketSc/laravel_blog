@extends('main')

@section('title', 'Edit tag')

@section('content')
    <form action="{{ route('tags.update', $tag) }}" method="POST">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        
        <div class="form-group">
            <label for="name">Name:</label>
            <input class="form-control"
                   id="name"
                   type="text"
                   name="name"
                   value="{{ $tag->name }}">
        </div>
        
        <div class="form-group">
            <input class="btn btn-success" type="submit" value="Save">
        </div>
    </form>
@endsection  