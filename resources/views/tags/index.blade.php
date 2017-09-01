@extends('main')

@section('title', '| All tags')

@section('content')

    <div class="row">
        <div class="col-md-8">
            <h1>Tags</h1>
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($tags as $tag)
                    <tr>
                        <th>{{ $tag->id }}</th>
                        <td><a href="{{ route('tags.show', $tag->id) }}">{{ $tag->name }}</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="col-md-3">
            <div class="well">
                <form method="POST" action="{{ route('tags.store') }}">
                    <div class="form-group">
                        <label name='name'>Name:</label>
                        <textarea id='name' name='name' class='form-control'></textarea>
                    </div>
                    <input type='submit' value='Create Tag' class='btn btn-success btn-lg btn-block'>
                    <input type='hidden' name='_token' value='{{ Session::token() }}'>
                </form>
            </div>
        </div>
    </div>

@stop
