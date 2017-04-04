@extends('main')

@section('title', 'Create new post')

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
        <div class="col-md-8 col-md-offset-2">
            <h1>Create new post</h1>
            <hr>
            {!! Form::open([
                'route' => 'posts.store',
                'data-parsley-validate' => ''
            ]) !!}

                {{ Form::label('title', 'Title:') }}
                {{ Form::text('title', null, [
                    'class' => 'form-control',
                    'required' => '',
                    'maxlength' => '191'
                ]) }}

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
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>

                <label for="tags">Tags:</label>
                <select class="form-control select2-selection--multiple"
                        name="tags[]"
                        id="tags"
                        multiple="multiple">
                    @foreach($tags as $tag)
                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                    @endforeach
                </select>

                {{ Form::label('body', 'Post Body:') }}
                {{ Form::textarea('body', null, [
                    'class' => 'form-control',
                ]) }}

                {{ Form::submit('Create Post', ['class' => 'btn btn-success btn-lg btn-block',
                                                'style' => 'margin-top: 20px' ]) }}

            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('scripts')
    <script src="/js/parsley.min.js"></script>
    <script src="/js/select2.min.js"></script>

    <script>
        $('.select2-selection--multiple').select2();
    </script>
@endsection