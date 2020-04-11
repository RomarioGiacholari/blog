@extends('layouts.app')
@if($viewModel != null && $viewModel->pageTitle !== null && $viewModel->photo !== null && $viewModel->photoFriendlyName !== null)
@section('title', $viewModel->pageTitle)
@section('content')
<div class="container">
    <h1>{{ $viewModel->photoFriendlyName }}</h1>
    <hr />
    <div class="row">
        <div class="col-md-12">
            <img src="{{ secure_asset($viewModel->photo) }}" height="200" width="400" class="img-responsive" title="{{ $viewModel->photoFriendlyName }}" alt="{{ $viewModel->photoFriendlyName }}">
        </div>
    </div>
</div>
@endsection
@endif