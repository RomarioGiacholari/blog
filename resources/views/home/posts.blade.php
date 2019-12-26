@extends('layouts.app')
@if($viewModel != null && $viewModel->pageTitle != null)
@section('title', $viewModel->pageTitle)
@endif
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
        <p><a href="{{ route('posts.create') }}">New post</a></p>
        <hr />
            @if($viewModel != null && $viewModel->posts !== null && !$viewModel->posts->isEmpty())
            <div class="panel panel-default">
                <div class="panel-heading">Posts</div>
                <div class="panel-body">
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
                                    <td> {{ $post->created_at->diffForHumans() }}</td>
                                    <td> {{ $post->updated_at->diffForHumans() }} </td>
                                    <td><a href=" {{ route('posts.edit', ['post' => $post] ) }} " class="btn btn-sm btn-primary" role="button">edit</a></td>
                                    <td>
                                        <form onsubmit="event.preventDefault(); deletePost(event);" action="{{ route('posts.destroy', ['post' => $post] ) }}" method="POST">

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
            <p>There are no posts to display. <a href="{{ route('welcome') }}">Redirect to welcome page</a></p>
            @endif
        </div>
    </div>
</div>
@endsection
@if($viewModel != null && $viewModel->posts !== null)
@section('scripts')
<script defer>
    function deletePost(event) {
        var message = "Do you want to remove the post?";
        var isSuccess = confirm(message);
        var form = event.target;

        if (isSuccess) {
            form.submit();
        }
    }
</script>
@endsection
@endif