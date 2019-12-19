@extends('layouts.app')
@section('title', $viewModel->pageTitle)
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            @if($viewModel !== null && $viewModel->post !== null && $viewModel->author !== null)
            <h1 style="font-family:Comic Sans MS;"> <u> {{ $viewModel->post->title }} </u> </h1>

            {{ $viewModel->post->created_at->diffForHumans() }} by {{ $viewModel->author }}

            <hr>
            <p class="post-show-body"> {{ $viewModel->post->body }} </p>
            @else
            <p>The post does not exist or it has been removed</p>
            @endif
        </div>
    </div>
</div>
@endsection