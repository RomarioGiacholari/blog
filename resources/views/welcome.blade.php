@extends('layouts.app')
    @section('content')
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-offset-0">
                        <div>
                            <h1>Hi! I am Mario.</h1>
                            <p>
                                I am an ambitious student and aspiring web developer from Aston University.
                            </p>
                            <p><b>Work experience</b></p>
                            <ul>
                                    <li><a href="https://www.pinewood.co.uk/">Pinewood Technologies</a> - Software Development Placement Student - 2018/2019</li>
                                    <li> <a href="https://www.bootcampmedia.co.uk/">Bootcampmedia</a> - Web developer - 2018</li>
                                    <li><a href="https://beautifulcanoe.com/">Beautiful Canoe</a> - Web developer intern - 2017</li>
                            </ul>
                            <!-- <h3><span class="label label-default">Skills & Projects</span></h3> -->
                            <p><b>Those are some of the skills and tools I use to build and monitor web apps.</b></p>
                            <p>
                                <span class="label label-info">PHP</span> <span class="label label-info">Laravel</span>
                                <span class="label label-info">Bootstrap</span> <span class="label label-info">HTML</span>
                                <span class="label label-info">CSS</span> <span class="label label-info">JavaScript</span>
                                <span class="label label-info">AWS</span> <span class="label label-info">Heroku</span>
                                <span class="label label-info">Java</span> <span class="label label-info">Testing</span>
                                <span class="label label-info">Git</span> <span class="label label-info">SQL</span>
                                <span class="label label-info">Ajax</span>  <span class="label label-info">React - basic</span>
                                <span class="label label-info">Vue</span> <span class="label label-info">Bash</span>
                                <span class="label label-info">MVC</span>  <span class="label label-info">Google Analytics</span>
                                <span class="label label-info">Python</span> <span class="label label-info">Digital Ocean</span>
                                <span class="label label-info">Nginx</span> <span class="label label-info">C#</span>
                            </p>
                        </div>
                        <p><b>Live projects</b></p>
                        <section>
                            <project-list></project-list>
                        </section>
                    </div>
                </div>
            </div>
            <div class="text-center">
                <small><b>&copy; Romario Giacholari 2019</b></small>
            </div>
    @endsection
