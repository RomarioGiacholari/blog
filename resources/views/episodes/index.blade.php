@extends('layouts.app')
@if($viewModel != null && $viewModel->pageTitle != null && $viewModel->episodes !== null)
@section('title', $viewModel->pageTitle)
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
@endif