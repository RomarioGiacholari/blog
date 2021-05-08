@extends('layouts.app')
@section('title', $viewModel->pageTitle)
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Hi, I am Romario, a web enthusiast!</h1>
            <hr />

            <div class="font-size-16">
                I am a graduate student and web developer from Aston University.
                See below my <b>work experience</b>, the <b>tools/languages</b> I use and the <b>websites</b> I have built.
                Find here <a href="{{ route('cv') }}">(cv)</a> a copy of my curriculum vitae.
            </div>
            <hr />

            <h4>Employment</h4>
            <div class="font-size-16">
                <a href="https://tillo.io/">Tillo</a> - Software developer 2020/present |
                <a href="https://www.pinewood.co.uk/">Pinewood Technologies</a> - Placement student 2018/2020 |
                <a href="https://www.bootcampmedia.co.uk/">Bootcampmedia</a> - Web developer 2018 |
                <a href="https://beautifulcanoe.com/">Beautiful Canoe</a> - Web developer intern 2017
            </div>
            <hr />

            <h4>Technologies</h4>
            <div class="font-size-16">
                <span class="label label-success">Python</span>
                <span class="label label-primary">PHP</span> <span class="label label-primary">Laravel</span>
                <span class="label label-success">JavaScript</span> <span class="label label-primary">Ajax</span>
                <span class="label label-primary">HTML</span> <span class="label label-primary">CSS</span>
                <span class="label label-primary">Bootstrap</span> <span class="label label-success">Vue</span>
                <span class="label label-primary">SQL</span> <span class="label label-primary">PhpStorm</span>
                <span class="label label-primary">GitLab</span> <span class="label label-primary">Azure DevOps</span>
                <span class="label label-success">Bash</span> <span class="label label-success">Git</span>
                <span class="label label-primary">PHP-Unit</span> <span class="label label-primary">MOQ</span>
                <span class="label label-primary">MVC</span> <span class="label label-primary">Visual Studio</span>
                <span class="label label-primary">Asp.NET</span> <span class="label label-primary">C#</span>
                <span class="label label-primary">Heroku</span> <span class="label label-primary">Digital Ocean</span>
                <span class="label label-primary">Google Analytics</span> <span class="label label-primary">Cloudflare</span>
                <span class="label label-primary">Stripe</span> <span class="label label-primary">Rollbar</span>
                <span class="label label-primary">New Relic</span> <span class="label label-primary">Papertrail</span>
            </div>
            <hr />

            <h4>Portfolio</h4>
            <section>
                <project-list></project-list>
            </section>
        </div>
    </div>
</div>
@endsection
