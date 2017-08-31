@extends('main')

@section('title', '| All categories')

@section('content')

    <div class="row">
        <div class="col-md-8">
            <h1>Categories</h1>
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($categories as $category)
                    <tr>
                        <th>{{ $category->id }}</th>
                        <td>{{ $category->name }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="col-md-3">
            <div class="well">
                <form method="POST" action="{{ route('categories.store') }}">
                    <div class="form-group">
                        <label name='name'>Name:</label>
                        <textarea id='name' name='name' class='form-control'></textarea>
                    </div>
                    <input type='submit' value='Create Category' class='btn btn-success btn-lg btn-block'>
                    <input type='hidden' name='_token' value='{{ Session::token() }}'>
                </form>
            </div>
        </div>
    </div>

@stop
