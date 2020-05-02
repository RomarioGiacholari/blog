@extends('layouts.app')
@section('title', $viewModel->pageTitle)
@section('content')
<div class="container">
    <div class="row text-center">
        <div class="col-md-12">
            @if(app()->env = 'local')
            <img class="img-circle" id="thumbnail" src="{{ asset('me-posing.jpg') }}" height="250" width="250" title="Romario Giacholari" alt="Romario Giacholari" />
            @else
            <img class="img-circle" id="thumbnail" src="{{ secure_asset('me-posing.jpg') }}" height="250" width="250" title="Romario Giacholari" alt="Romario Giacholari" />
            @endif
        </div>
    </div>
    <div class="row text-center">
        <h2>Romario Giacholari</h2>
        <div class="col-md-12">
            <p class="font-size-16">
                My name is Romario. I am a student and web developer from Aston University (final year).
                See below my <b>work experience</b>, the <b>tools/languages</b> I use and the <b>websites</b> I have built.
            </p>
        </div>
    </div>

    <div class="row text-center">
        <h4>- Work experience</h4>
        <div class="col-md-12">
            <div class="font-size-16">
                <a href="https://www.pinewood.co.uk/">Pinewood Technologies</a> - Software Development Placement Student 2018/2019 |
                <a href="https://www.bootcampmedia.co.uk/">Bootcampmedia</a> - Web developer 2018 |
                <a href="https://beautifulcanoe.com/">Beautiful Canoe</a> - Web developer intern 2017
            </div>
        </div>
    </div>

    <div class="row text-center">
        <h4>- Skills & Tools</h4>
        <div class="col-md-12">
            <p class="font-size-16">
                <span class="label label-info">PHP</span> <span class="label label-info">Laravel</span>
                <span class="label label-info">JavaScript</span> <span class="label label-info">Ajax</span>
                <span class="label label-info">HTML</span> <span class="label label-info">CSS</span>
                <span class="label label-info">Bootstrap</span> <span class="label label-info">Vue</span>
                <span class="label label-info">SQL</span> <span class="label label-info">PhpStorm</span>
                <span class="label label-info">GitLab</span> <span class="label label-info">Azure DevOps</span>
                <span class="label label-info">Bash</span> <span class="label label-info">Git</span>
                <span class="label label-info">PHP-Unit</span> <span class="label label-info">MOQ</span>
                <span class="label label-info">MVC</span> <span class="label label-info">Visual Studio</span>
                <span class="label label-info">Asp.NET</span> <span class="label label-info">C#</span>
                <span class="label label-info">Heroku</span> <span class="label label-info">Digital Ocean</span>
                <span class="label label-info">Google Analytics</span> <span class="label label-info">Cloudflare</span>
                <span class="label label-info">Stripe</span>
            </p>
        </div>
    </div>

    <div class="row text-center">
        <h4>- Portfolio</h4>
        <div class="col-md-12">
            <section>
                <project-list></project-list>
            </section>
        </div>
    </div>
<!-- 
    <div class="row text-center" style="margin-top:50px;">
        <h4>- Testimonials</h4>
        @if($viewModel != null && $viewModel->testimonials != null && count($viewModel->testimonials) > 0)
        @foreach($viewModel->testimonials as $name => $data)
        <div class="col-md-4 col-sm-6 col-xs-6">
            <a href="{{ $data['link'] }}">
                <img class="img-circle" id="thumbnail" src="{{ $data['imageUrl'] }}" height="150" width="150" title="{{ $name }}" alt="{{ $name }}" />
            </a>
            <p>{{ $data['testimonial'] }}</p>
        </div>
        @endforeach
        @endif
    </div> -->

</div>
@endsection
@section('scripts')
@if(app()->env == 'local')
<script src="{{ asset('js/photos/refreshPhoto.js') }}" defer></script>
@else
<script src="{{ secure_asset('js/photos/refreshPhoto.js') }}" defer></script>
@endif
@endsection