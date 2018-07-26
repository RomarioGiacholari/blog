@extends('layouts.app')
    @section('content')
            <div class="container">
                    <div class="row">
                        <div class="col-md-12 col-offset-0">
                            <div>
                                <h1>Hi! I am Mario.</h1>
                                <p>
                                 I am an ambitious student and an aspiring web developer. I completed my internship at <a href="https://beautifulcanoe.com/">Beautiful Canoe</a> as a web developer on a project using <a href="https://laravel.com/">Laravel</a> last year.
                                 At the moment I am experimenting with React.js, Vue.js and I do work as a full stack web developer at <a href="https://www.bootcampmedia.co.uk/">Bootcampmedia</a>.
                                 I am also happy to announce that I secured a placement with <a href="https://www.pinewood.co.uk/">Pinewood Technologies</a> for the year to come.
                                </p>
                                <!-- <h3><span class="label label-default">Skills & Projects</span></h3> -->
                                <p>Those are some of the skills and tools I use to build and monitor web apps.</p>
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
                                <span class="label label-info">Nginx</span>
                                </p>
                            </div>
                            <h3>Here are some of the projects I have contributed to ...</h3>
                            <section>
                                <project-list></project-list>
                           </section>
                        </div>
                    </div>
                </div>
            <div class="text-center">
            <small><b>&copy; Romario Giacholari 2018</b></small>
            </div>
            <hr>
            <div id="contact-links" class="text-center">
                <a href = 'https://github.com/RomarioGiacholari' target="_blank"><i class="fa fa-github" aria-hidden="true"></i></a> 
                <a href = 'https://twitter.com/giacholari' target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a> 
                <a href = 'https://www.linkedin.com/in/romario-giacholari-71130b11b?trk=hp-identity-name' target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a> 
            </div>
    @endsection
