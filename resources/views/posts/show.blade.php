@extends('main')

@section('title', '| View Post')

@section('content')

    <div class="row">
        <div class="col-md-8">
          <h1>{{ $post->title }}</h1>

          <p class="lead">{!! $post->body !!}</p>
          <hr>
          <div class="tags">
              @foreach ($post->tags as $tag)
                  <span class="label label-default">{{ $tag->name }}</span>
              @endforeach
          </div>

            <div id="backend-comments">
                <h3>Comments <small>{{ $post->comments()->count() }} total</small></h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Comment</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($post->comments as $comment)
                            <tr>
                                <td>{{ $comment->name }}</td>
                                <td>{{ $comment->email }}</td>
                                <td>{{ $comment->comment }}</td>
                                <td>
                                    <a href="{{ route('comments.edit', $comment->id) }}" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-pencil"></span></a>
                                    <a href="{{ route('comments.delete', $comment->id) }}" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span> </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-md-4">
            <div class="well">
                <dl class="dl-vertical">
                    <dt>Created at:</dt>
                    <dd>{{ date('j F, Y. G:i', strtotime($post->created_at)) }}</dd>

                    <dt>Last updated:</dt>
                    <dd>{{ date('j F, Y. G:i', strtotime($post->created_at)) }}</dd>

                    <dt>Category:</dt>
                    <dd>{{ $post->category->name }}</dd>

                    <dt>Url:</dt>
                    <dd><a href="{{ route('blog.single', $post->slug) }}"></a>{{ route('blog.single', $post->slug) }}</dd>
                </dl>
                <hr>

                <div class="row">
                  <div class="col-sm-6">
                      <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-primary btn-block">Edit</a>
                  </div>
                  <div class="col-sm-6">
                      <form method="POST" action="{{ route('posts.destroy', $post->id)}}">
                          <input type="submit" value="Delete" class="btn btn-danger btn-block">
                          <input type="hidden" name="_token" value="{{ Session::token() }}">
                          {{ method_field('DELETE') }}
                      </form>
                  </div>
                  <div class="row">
                      <div class="col-sm-12">
                          <br>
                          <a href="{{ route('posts.index') }}" class="btn btn-default btn-block">Show all posts</a>
                      </div>
                  </div>
                </div>
            </div>
        </div>
    </div>

@endsection
