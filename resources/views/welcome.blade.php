@extends('layouts.app')
@section('title', 'Welcome')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">

            <h1>Welcome to the site!</h1>
            <p class="font-size-16">
                My name is Romario. I am an ambitious student and web enthusiast from Aston University (final year).
                See below my work experience, the tools/languages I use and the websites I have built. Feel free to drop me a <a href="{{ route('contact.create') }}">message</a> :))
            </p>

            <ul class="font-size-16">
                <li><a href="https://www.pinewood.co.uk/">Pinewood Technologies</a> - Software Development Placement Student - 2018/2019</li>
                <li><a href="https://www.bootcampmedia.co.uk/">Bootcampmedia</a> - Web developer - 2018</li>
                <li><a href="https://beautifulcanoe.com/">Beautiful Canoe</a> - Web developer intern - 2017</li>
            </ul>

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
            </p>

            <section>
                <project-list></project-list>
            </section>

        </div>
    </div>
</div>
@endsection