@extends('layouts.app')
@if($viewModel != null && $viewModel->pageTitle != null)
@section('title', $viewModel->pageTitle)
@endif
@if($viewModel != null && $viewModel->episodes !== null)
@section('content')
<div class="container">
    <h1 style="font-family:Comic Sans MS"><u>Episodes</u></h1>
    <hr />

    <div id="pinBoot">
        @foreach($viewModel->episodes as $episode)
        <div class="thumbnail white-panel">
            <a href="{{ route('episodes.show',['episode' => $episode]) }}">No.{{ $episode->id}} - {{ $episode->title }} </a>
            <hr>
            <p class="post-body">{{ $episode->description }}</p>
        </div>
        @endforeach
    </div>

    <div style="padding:80px">
        {{ $viewModel->episodes->links() }}
    </div>
</div>
@endsection
@else
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <p>Episodes coming soon...</p>
        </div>
    </div>
</div>
@endsection
@endif