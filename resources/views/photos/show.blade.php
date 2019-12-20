@extends('layouts.app')
@if($viewModel != null && $viewModel->pageTitle !== null && $viewModel->photo !== null)
@section('title', $viewModel->pageTitle)
@section('content')
<div class="container">
    <h1 style="font-family:Comic Sans MS"><u>Photo identifier:</u></h1>
    <p>{{ $viewModel->photo }}</p>
    <hr />
    <div class="row">
        <div class="col-md-12">
            <img src="{{ asset($viewModel->photo) }}" class="img-responsive" alt="{{ $viewModel->photo }}">
        </div>
    </div>
</div>
@endsection
@endif