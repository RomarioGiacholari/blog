@extends('layouts.app')
@section('title', $viewModel->pageTitle)
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            @if($viewModel !== null && $viewModel->posts !== null && !$viewModel->posts->isEmpty())
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>
                <div class="panel-body">
                    @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Created at</th>
                                    <th>Updated at</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($viewModel->posts as $post)
                                <tr>
                                    <td><a href=" {{ route('posts.show' , ['post' => $post] ) }}">{{ $post->title }}</a></td>
                                    <td> {{ $post->created_at }}</td>
                                    <td> {{ $post->updated_at }} </td>
                                    <td><a href=" {{ route('posts.edit', ['post' => $post] ) }} " class="btn btn-sm btn-primary" role="button">edit</a></td>
                                    <td>
                                        <form action="{{ route('posts.destroy', ['post' => $post] ) }}" method="POST">

                                            {{ method_field('DELETE') }}

                                            {{ csrf_field() }}

                                            <button class="btn btn-sm btn-danger" role="button">delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @else
            <p>There are no posts to display</p>
            @endif
        </div>
    </div>
</div>
@endsection