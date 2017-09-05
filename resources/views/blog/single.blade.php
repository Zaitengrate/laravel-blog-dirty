@extends('main')

@section('title', '| '.$post->title)

@section('assets')

    <link rel='stylesheet' href='/css/parsley.css'>
    <link rel='stylesheet' href='/css/select2.min.css'>
    <link rel='stylesheet' href='/css/styles.css'>

@endsection

@section('content')


    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1>{{ htmlspecialchars($post->title) }}</h1>
            <p>{!! $post->body !!}</p>
            <hr>
            <p>Posted In: {{ $post->category->name }}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h3 class="comments-title"><span class="glyphicon glyphicon-comment"></span> {{ $post->comments()->count() }} Comments</h3>
            @foreach($post->comments as $comment)
                <div class="comment">
                    <div class="author-info">
                        <img src="{{ "https://www.gravatar.com/avatar/" . md5(strtolower(trim($comment->email))) . "?s=50&d=mm" }}" class="author-image">
                        <div class="author-name">
                            <h4>{{ $comment->name }}</h4>
                            <div class="author-time">
                                <p>{{ $comment->created_at }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="comment-content">
                        {{ $comment->comment }}
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="row">
        <div id="comment-form" class="col-md-8 col-md-offset-2">
            <form method="POST" action="{{ route('comments.store', $post->id) }}">
                <div class="row">
                    <div class="col-md-6">
                        <label name="name">Name</label>
                        <textarea type="text" class="form-control input-lg" id="name" name="name" rows="1"></textarea>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label name="email">Email</label>
                        <input id='email' name='email' class='form-control' rows="1">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <label name="comment">Comment</label>
                        <textarea id='comment' name='comment' rows='5' class='form-control'></textarea>
                    </div>
                </div>

                <input type='submit' value='Add comment' class='btn btn-success btn-lg btn-block'>
                <input type='hidden' name='_token' value='{{ Session::token() }}'>
            </form>
        </div>
    </div>


@stop
