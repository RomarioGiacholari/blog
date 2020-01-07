@extends('layouts.app')
@if($viewModel != null && $viewModel->pageTitle != null && $viewModel->message != null)
@section('title', $viewModel->pageTitle)
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Thank you!</h1>
            <hr>
            <p>{{ $viewModel->message }}</p>
            <a href="{{ route('posts.index') }}" class="btn btn-primary btn-block" role="button">check out my blog!</a>
        </div>
    </div>
</div>
@endsection
@endif