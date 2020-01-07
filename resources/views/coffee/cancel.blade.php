@extends('layouts.app')
@if($viewModel != null && $viewModel->pageTitle != null && $viewModel->message != null)
@section('title', $viewModel->pageTitle)
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Payment canceled</h1>
            <hr>
            <p>{{ $viewModel->message }}</p>
            <a href="{{ route('coffee.index') }}" class="btn btn-primary btn-block" role="button">back</a>
        </div>
    </div>
</div>
@endsection
@endif