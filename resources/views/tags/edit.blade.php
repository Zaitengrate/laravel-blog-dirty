@extends('main')

@section('title', '| Edit Tag')

@section('content')

    <div class="row">
        <div class="col-md-8">
            <form method="POST" action="{{ route('tags.update', $tag->id) }}">
              <div class="form-group">
                  <label name="name">Tag:</label>
                  <textarea type="text" class="form-control input-lg" id="name" name="name" rows="1" style="resize:none;">{{ $tag->name }}</textarea>
              </div>
              <div class="col-sm-4">
                  <button type="submit" class="btn btn-success btn-block">Save</button>
                  {{ method_field('PUT') }}
                  <input type="hidden" name="_token" value="{{ Session::token() }}">
              </div>
            </form>
        </div>
    </div>

@stop
