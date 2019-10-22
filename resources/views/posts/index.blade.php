@extends('layouts.app')
@section('title', $viewModel->pageTitle)
@section('content')
<div class="container">
    <h1 style="font-family:Comic Sans MS"><u>Posts</u></h1>
    <hr />
    
    @if($viewModel !== null && $viewModel->posts !== null && !$viewModel->posts->isEmpty())

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

    @else
        <p>Blog posts coming soon</p>
    @endif
</div>
@endsection