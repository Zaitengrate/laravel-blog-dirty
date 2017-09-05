@extends('main')

@section('title', '| Delete comment')

@section('content')

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1>Delete this comment?</h1>
            <p>
                <strong>Name: </strong> {{ $comment->name }}<br>
                <strong>Email: </strong> {{ $comment->email }}<br>
                <strong>Comment: </strong> {{ $comment->comment }}<br>
            </p>

            <div class="col-sm-6">
                <form method="POST" action="{{ route('comments.destroy', $comment->id)}}">
                    <input type="submit" value="Delete" class="btn btn-danger btn-block">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                </form>
            </div>
        </div>
    </div>

@stop