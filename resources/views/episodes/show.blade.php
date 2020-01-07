@extends('layouts.app')
@if($viewModel != null && $viewModel->pageTitle !== null && $viewModel->episode !== null)
@section('title', $viewModel->pageTitle)
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>No.{{ $viewModel->episode->id}} - {{ $viewModel->episode->title }}</h1>
            <hr>
            <audio controls="controls" autobuffer="autobuffer">
                <source src="data:audio/mp3;base64,{{ $viewModel->episode->audioBase64 }}" />
            </audio>
            <p class="post-show-body"> {{ $viewModel->episode->description }} </p>
        </div>
    </div>
</div>
@endsection
@endif