@extends('layouts.app')
@if($viewModel != null && $viewModel->pageTitle != null)
@section('title', $viewModel->pageTitle)
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>About me</h1>
            <hr />
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 text-center">
            <img style="padding:10px;" class="img-thumbnail" id="thumbnail" src="https://assets.giacholari.com/images/gallery/me-driving-certificate.jpg" height="450" width="350" title="Romario Giacholari" alt="Romario Giacholari" />
        </div>
        <div class="col-md-8">
            <p class="font-size-16" style="padding:20px;">
                Thank you for visiting the site. My name is Romario and I am a web developer based in Birmingham, UK. 
                My passion is web development and I really enjoy solving programming tasks.
                Apart from that, I am also a big fan of football - I dare you challenge me on a 5-aside game :).
                I come from Albania. However I grew up in Kardamyli, a small village south of Greece.
                This summer I am about to graduate from Aston University - BSC Computing with business.
                If you are interested in working together, do not hesitate to contact me.
            </p>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="https://assets.giacholari.com/js/blog/photos/refreshPhoto.js" defer></script>
@endsection
@endif