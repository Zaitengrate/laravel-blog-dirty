@extends('main')

@section('title', '|Edit blogpost')

@section('content')

    <div class="row">
        <div class="col-md-8">
            <form method="POST" action="{{ route('posts.update', $post->id) }}">
                <div class="form-group">
                    <label for="title">Title:</label>
                    <textarea type="text" class="form-control input-lg" id="title" name="title" rows="1" style="resize:none;">{{ $post->title }}</textarea>
                </div>
                <div class="form-group">
                    <label for="slug">Url:</label>
                    <textarea type="text" class="form-control input-lg" id="slug" name="slug" rows="1" style="resize:none;">{{ $post->slug }}</textarea>
                </div>
                <div class="form-group">
                    <label for="body">Body:</label>
                    <textarea type="text" class="form-control input-lg" id="body" name="body" rows="10">{{ $post->body }}</textarea>
                </div>

        </div>


        <div class="col-md-4">
            <div class="well">
                <dl class="dl-horizontal">
                    <dt>Created at:</dt>
                    <dd>{{ date('j F, Y. G:i', strtotime($post->created_at)) }}</dd>
                </dl>

                <dl class="dl-horizontal">
                    <dt>Last updated:</dt>
                    <dd>{{ date('j F, Y. G:i', strtotime($post->created_at)) }}</dd>
                </dl>
                <hr>

                <div class="row">
                  <div class="col-sm-6">
                      <a href="{{ route('posts.show', $post->id) }}" class="btn btn-danger btn-block">Cancel</a>
                  </div>
                  <div class="col-sm-6">
                    <button type="submit" class="btn btn-success btn-block">Save</button>
                    {{ method_field('PUT') }}
                    <input type="hidden" name="_token" value="{{ Session::token() }}">
                  </div>
                </div>
            </div>
            </form>
        </div>
    </div>
@stop
