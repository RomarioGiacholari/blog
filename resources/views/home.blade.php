@extends('layouts.app')
@section('title', $viewModel->pageTitle)
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
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
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($viewModel->posts as $post)
                                        <tr>
                                            <td><a href=" {{ route('posts.show' , ['post' => $post] ) }}">{{ $post->title }}</a></td>
                                            <td><a href=" {{ route('posts.edit', ['post' => $post] ) }} ">edit</a></td>
                                            <td>
                                                <form action="{{ route('posts.destroy', ['post' => $post] ) }}" method="POST">

                                                    {{ method_field('DELETE') }}

                                                    {{csrf_field()}}

                                                    <a href="#" onclick="$(this).closest('form').submit()" style="color:red">delete</a>
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