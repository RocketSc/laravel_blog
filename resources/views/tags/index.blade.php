@extends('main')

@section('title', 'All Tags')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <h1>Tags</h1>
            <table class="table">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                </tr>

                @foreach($tags as $tag)
                    <tr>
                        <td>{{ $tag->id }}</td>
                        <td>{{ $tag->name }}</td>
                    </tr>
                @endforeach

            </table>
        </div>

        <div class="col-md-3">
            <div class="well">
                <form action="{{ route('tags.store') }}" method="POST">
                    {{ csrf_field() }}

                    <h2>New Tag</h2>
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input class="form-control" type="text" id="name" name="name">
                    </div>
                    <div class="form-group">
                        <input class="form-control btn btn-primary" type="submit" value="Create">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection