@extends('layouts.app')
@if($viewModel != null && $viewModel->pageTitle != null && $viewModel->message != null)
@section('title', $viewModel->pageTitle)
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 style="font-family:Comic Sans MS"><u>Payment declined!</u></h1>
            <hr>
            <p>{{ $viewModel->message }}</p>
            <a href="{{ route('coffee.index') }}" class="btn btn-primary btn-block" role="button">back</a>
        </div>
    </div>
</div>
@endsection
@endif