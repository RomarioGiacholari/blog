@extends('layouts.app')
@section('title', $viewModel->pageTitle)
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="social">
                <a href="tel:+447587735380" title="call"><i class="fa fa-phone-square fa-2x"></i></a>
                <a href="mailto:giacholari@gmail.com" title="email"><i class="fa fa-envelope fa-2x"></i></a>
                <a href="https://www.instagram.com/am.giacholari/" title="instagram"><i class="fa fa-instagram fa-2x" aria-hidden="true"></i></a>
                <a href="https://github.com/RomarioGiacholari" title="github"><i class="fa fa-github fa-2x" aria-hidden="true"></i></a>
                <a href="https://uk.linkedin.com/in/romario-giacholari-71130b11b" title="linkedin"><i class="fa fa-linkedin-square fa-2x" aria-hidden="true"></i></a> 
                <a href="{{ route('privacy-policy.index') }}" title="privacy"><i class="fa fa-copyright fa-2x"></i></a>
            </div>
            <h2>Romario Giacholari</h2>
            <p class="font-size-16">
                My name is Romario. I am a graduate student and web developer from Aston University.
                See below my <b>work experience</b>, the <b>tools/languages</b> I use and the <b>websites</b> I have built.
            </p>

            <h4>Work experience</h4>
            <div class="font-size-16">
                <a href="https://tillo.io/">Tillo</a> - Software Developer 2020 |
                <a href="https://www.pinewood.co.uk/">Pinewood Technologies</a> - Software Development Placement Student 2018/2020 |
                <a href="https://www.bootcampmedia.co.uk/">Bootcampmedia</a> - Web developer 2018 |
                <a href="https://beautifulcanoe.com/">Beautiful Canoe</a> - Web developer intern 2017
            </div>

            <h4>Skills & Tools</h4>
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
                <span class="label label-info">Stripe</span> <span class="label label-info">Rollbar</span>
                <span class="label label-info">New Relic</span> <span class="label label-info">Papertrail</span>
            </p>

            <h4>Portfolio</h4>
            <section>
                <project-list></project-list>
            </section>
        </div>
    </div>
</div>
@endsection