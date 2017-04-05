@extends('main')

@section('title', 'Edit Blog Post')

@section('stylesheets')
    <link rel="stylesheet" href="/css/parsley.css">
    <link rel="stylesheet" href="/css/select2.min.css">
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=doxwikvb6n32tjhxpkhkb30bodc0o633pcrckmwe09ry8dhl"></script>

    <script>
      tinymce.init({
        selector: 'textarea',
        plugins: 'link code image',
        menubar: false
      });
    </script>
@endsection

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

            <label for="tags">Tags:</label>
            <select class="form-control select2-selection--multiple"
                    name="tags[]"
                    id="tags"
                    multiple="multiple">
                @foreach($tags as $tag)
                    <option value="{{ $tag->id }}"
                            @if( array_search($tag->id, $tags_array) !== false )
                                selected="selected"
                            @endif
                    >{{ $tag->name }}</option>
                @endforeach
            </select>

            <div class="form-group">
                <label for="featured_image" class="">Update Featured Image:</label>
                <input type="file" id="featured_image" name="featured_image">
            </div>

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

@section('scripts')
    <script src="/js/parsley.min.js"></script>
    <script src="/js/select2.min.js"></script>

    <script>
      $('.select2-selection--multiple').select2();
    </script>
@endsection