@extends('layouts.app')
@section('title', $viewModel->pageTitle)
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            @if($viewModel != null && $viewModel->post !== null && $viewModel->author !== null)
            <h1>{{ $viewModel->post->title }}</h1>

            <span>{{ $viewModel->post->created_at->diffForHumans() }} by {{ $viewModel->author }}</span>

            <hr>
            {!! $viewModel->post->body !!}
            @else
            <p>The post does not exist or it has been removed</p>
            @endif
        </div>
    </div>
</div>
@endsection