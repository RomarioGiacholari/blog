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
        <div class="col-md-12">
            <p class="font-size-16">
                Thank you for visiting the site. My name is Romario and I am a web developer based in Brighton, UK.
                My passion is web development and I really enjoy solving programming tasks.
                Apart from that, I am also a big fan of football - I dare you challenge me on a 5-aside game :)
                I come from Albania. However, I grew up in Kardamyli, a small village which is located south of Greece.
                I am officially now a graduate from Aston University - BSc Computing for Business.
                If you are interested in working together or just because you want to get in touch, do not hesitate to <a href="{{ route('contact.create') }}"><u>contact me</u></a>.
            </p>
        </div>
        <div class="col-md-12">
            <img class="img-responsive" id="thumbnail" src="https://assets.giacholari.com/images/gallery/me-driving-certificate.jpg" height="450" width="350" title="Romario Giacholari" alt="Romario Giacholari" />
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script defer src="https://assets.giacholari.com/js/blog/photos/refreshPhoto.js"></script>
@endsection
@endif