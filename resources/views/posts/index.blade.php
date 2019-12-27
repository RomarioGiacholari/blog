@extends('layouts.app')
@if($viewModel != null && $viewModel->pageTitle != null)
@section('title', $viewModel->pageTitle)
@endif
@if($viewModel != null && $viewModel->posts !== null && !$viewModel->posts->isEmpty())
@section('content')
<div class="container">
    <h1 style="font-family:Comic Sans MS"><u>Posts|Snippets</u></h1>
    <hr />
    <div id="pinBoot">
        @foreach($viewModel->posts as $post)
        <div class="thumbnail white-panel">
            <a href="{{ route('posts.show',['post' => $post]) }}">{{ $post->title }} </a>
            <hr>
            <p class="post-body">{{ $post->excerpt }}</p>
        </div>
        @endforeach
    </div>

    <div style="padding:80px">
        {{ $viewModel->posts->links() }}
    </div>
</div>
@endsection
@else
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <p>Blog posts coming soon...</p>
        </div>
    </div>
</div>
@endsection
@endif