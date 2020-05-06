@extends('layouts.app')
@section('title', $viewModel->pageTitle)
@section('content')
<div class="container">
    <h1>Photos</h1>
    <hr />
    <div id="pinBoot" data-identifier="js-photos-partial-container">
        @foreach(range(1, 15) as $rangeItem)
        <div class="thumbnail white-panel" id="photos-placeholder"></div>
        @endforeach
    </div>
</div>
@endsection
@section('scripts')
<script src="https://romariogiacholari.github.io/static/js/blog/photos/fetchPhotos.js" defer></script>
@endsection