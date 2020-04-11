@extends('layouts.app')
@section('title', $viewModel->pageTitle)
@section('content')
<div class="container">
    <h1>Photos</h1>
    <hr />
    <div id="pinBoot" data-identifier="js-photos-partial-container"></div>
</div>
@endsection
@section('scripts')
<script src="{{ secure_asset('js/photos/fetchPhotos.js') }}" defer></script>
@endsection