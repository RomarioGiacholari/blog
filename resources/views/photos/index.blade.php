@extends('layouts.app')
@section('title', $viewModel->pageTitle)
@section('content')
<div class="container">
    <h1 style="font-family:Comic Sans MS"><u>Photos</u></h1>
    <hr />
    @if($viewModel !== null && $viewModel->photos !== null)
    <div id="pinBoot">
        @foreach($viewModel->photos as $photo)
        <div class="thumbnail white-panel">
            <img src="{{ asset($photo) }}" alt="">
        </div>
        @endforeach
    </div>
    @else
    <p>Photos coming soon ...</p>
    @endif
</div>
@endsection