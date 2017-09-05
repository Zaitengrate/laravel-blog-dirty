@extends('main')

@section('title', '| Edit comment')

@section('content')

    <div class="row">
        <div class="col-md-8">
            <form method="POST" action="{{ route('comments.update', $comment->id) }}">
                <div class="form-group">
                    <label name="name">Name:</label>
                    <textarea type="text" class="form-control input-lg" id="name" name="name" rows="1" style="resize:none;">{{ $comment->name }}</textarea>
                </div>
                <div class="form-group">
                    <label name="email">Email:</label>
                    <textarea type="text" class="form-control input-lg" id="email" name="email" rows="1" style="resize:none;">{{ $comment->email }}</textarea>
                </div>
                <div class="form-group">
                    <label name="comment">Comment:</label>
                    <textarea type="text" class="form-control input-lg" id="comment" name="comment" rows="5" style="resize:none;">{{ $comment->comment }}</textarea>
                </div>
                <div class="col-sm-4">
                    <button type="submit" class="btn btn-success btn-block">Save</button>
                    {{ method_field('PUT') }}
                    {{ csrf_field() }}
                </div>
            </form>
        </div>
    </div>


@stop