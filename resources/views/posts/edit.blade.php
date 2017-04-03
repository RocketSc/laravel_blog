@extends('main')

@section('title', 'Edit Blog Post')

@section('content')
    <div class="row">
        {!!  Form::model($post, ['route' => ['posts.update', $post->id]]) !!}
        <input type="hidden" name="_method" value="PUT">
        <div class="col-md-8">
            {{ Form::label('title', 'Title:') }}
            {{ Form::text('title', null, ['class' => 'form-control']) }}

            {{ Form::label('slug', 'Slug:') }}
            {{ Form::text('slug', null, [
                'class' => 'form-control',
                'required' => '',
                'data-parsley-type' =>"alphanum",
                'minlength' => '6',
                'maxlength' => '50'
            ]) }}

            <label for="category_id">Category:</label>
            <select class="form-control" name="category_id" id="category_id">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}"
                    @if ($category->id == $post->category->id)
                        selected="selected"
                    @endif
                    >{{ $category->name }}</option>
                @endforeach
            </select>

            {{ Form::label('body', 'Body:', ['class' => 'form-spacing-top']) }}
            {{ Form::textarea('body', null, ['class' => 'form-control']) }}
        </div>

        <div class="col-md-4">
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
                    {{ Form::submit('Update Post', ['class' => 'btn btn-success btn-block']) }}
                </div>

                <div class="col-sm-6">
                    <a href="{{ URL::route('posts.show', $post) }}" class="btn btn-danger btn-block">Cancel</a>
                </div>

            </div>

        </div>
        {!! Form::close() !!}
    </div>
@endsection