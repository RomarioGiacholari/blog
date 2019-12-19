@extends('layouts.app')
@if($viewModel != null && $viewModel->pageTitle != null && $viewModel->introduction != null && $viewModel->content != null && $viewModel->contactEmail != null)
@section('title', $viewModel->pageTitle)
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Privacy policy</h1>
            <hr />
            <p class="font-size-16"> {{ $viewModel->introduction }} </p>

            @foreach($viewModel->content as $title => $text)

            <h3>{{ $title }}</h3>

            @if($title == 'Contact')
            <p class="font-size-16">
                {{ $text }} <a href="mailto:{{ $viewModel->contactEmail }}">{{ $viewModel->contactEmail }}</a>.
            </p>
            @else
            <p class="font-size-16">{{ $text }}</p>
            @endif

            @endforeach
        </div>
    </div>
</div>
@endsection
@endif