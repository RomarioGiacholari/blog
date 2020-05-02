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
        <div class="col-md-4">
            @if(app()->env = 'local')
            <img  style="padding:10px;" class="img-rounded" id="thumbnail" src="{{ asset('me-driving-certificate.jpg') }}" height="450" width="350" title="Romario Giacholari" alt="Romario Giacholari" />
            @else
            <img  style="padding:10px;" class="img-circle" id="thumbnail" src="{{ secure_asset('romario-giacholari.jpg') }}" height="250" width="250" title="Romario Giacholari" alt="Romario Giacholari" />
            @endif
        </div>
        <div class="col-md-8">
            <p style="padding:10px;">
                Thank you for visiting the site. My name is Romario and I am a web developer based in Birmingham, UK. 
                My passion is web development and I really enjoy solving programming tasks.
                Apart from that, I am also a big fan of football.
                I come from Albania. However I grew up in Kardamyli, a small village south of Greece.
                For the past years I have been living in UK - reason being I moved here to complete my studies.
                This summer I am about to graduate from Aston University - BSC Computing with business.
                If you are interested in working together, do not hesitate to contact me.
            </p>
        </div>
    </div>
</div>
@endsection
@endif