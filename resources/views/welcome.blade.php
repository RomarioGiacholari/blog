@extends('layouts.app')
@section('title', $viewModel->pageTitle)
@section('content')
<div class="container">
    <div class="row text-center">
        <div class="col-md-12">
            <img class="img-thumbnail" id="thumbnail" src="https://romariogiacholari.github.io/static/images/gallery/me-posing.jpg" height="250" width="250" title="Romario Giacholari" alt="Romario Giacholari" />
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
</div>
@endsection
@section('scripts')
<script src="https://romariogiacholari.github.io/static/js/blog/photos/refreshPhoto.js" defer></script>
@endsection