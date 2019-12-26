@extends('layouts.app')
@if($viewModel != null && $viewModel->pageTitle !== null && $viewModel->photo !== null && $viewModel->photoFriendlyName !== null)
@section('title', $viewModel->pageTitle)
@section('content')
<div class="container">
    <h1 style="font-family:Comic Sans MS"><u>{{ $viewModel->photoFriendlyName }}</u></h1>
    <hr />
    <div class="row">
        <div class="col-md-12">
            <img src="{{ asset($viewModel->photo) }}" class="img-responsive" title="{{ $viewModel->photoFriendlyName }}" alt="{{ $viewModel->photoFriendlyName }}">
        </div>
    </div>
</div>
@endsection
@endif