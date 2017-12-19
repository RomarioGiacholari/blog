<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
         <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="author" content="Romario Giacholari">
        <meta name="description" content="Personal website of Romario Giacholari. Web Developer and Student in Birmingham, UK.">
        <meta name="keywords" content="HTML,CSS,JavaScript,Laravel,Romario Giacholari">
        <title>Romario Giacholari</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
        @include('partials.navbar')
        <div id="app">
            <div class="container">
                    <div class="row">
                        <div class="col-md-12 col-offset-0">
                            <div>
                                <div><b>#Web Developer & Student At Aston University. Birmingham UK.</b></div>
                                <hr>
                                <!-- <h3><span class="label label-default">About me</span></h3> -->
                                <p>
                                I am an ambitious student and an aspiring web developer. I've just completed my internship at <a href="https://beautifulcanoe.com/">Beautiful Canoe</a> as a web developer on a project using <a href="https://laravel.com/">Laravel</a>.
                                At the moment I am experimenting with React.js and Vue.js. I am also actively looking for a placement in the tech industry, starting on Summer 2018.
                                </p>
                                <!-- <h3><span class="label label-default">Skills & Projects</span></h3> -->
                                <p>
                                <span class="label label-info">PHP</span> <span class="label label-info">Laravel</span>
                                <span class="label label-info">Bootstrap</span> <span class="label label-info">HTML</span>
                                <span class="label label-info">CSS</span> <span class="label label-info">JavaScript</span>
                                <span class="label label-info">AWS</span> <span class="label label-info">Heroku</span>
                                <span class="label label-info">Java</span> <span class="label label-info">Testing</span>
                                <span class="label label-info">Git</span> <span class="label label-info">SQL</span>
                                <span class="label label-info">Ajax</span> <span class="label label-info">JQuery</span>
                                <span class="label label-info">React - basic</span> <span class="label label-info">Vue</span>
                                <span class="label label-info">Bash</span> <span class="label label-info">MVC</span>  <span class="label label-info">Google Analytics</span>
                                </p>
                            </div>
                            <hr>
                            <section>
                                <project-list></project-list>
                           </section>
                        </div>
                    </div>
                </div>
            <div class="text-center">
            <small><b>&copy; Romario Giacholari 2017</b></small>
            </div>
            <hr>
            <div id="contact-links" class="text-center">
                <a href = 'https://github.com/RomarioGiacholari' target="_blank"><i class="fa fa-github" aria-hidden="true"></i></a> 
                <a href = 'https://twitter.com/giacholari' target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a> 
                <a href = 'https://www.instagram.com/alex.giacholari/?hl=en' target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a> 
                <a href = 'https://www.linkedin.com/in/romario-giacholari-71130b11b?trk=hp-identity-name' target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a> 
            </div>
         </div>
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}"></script>
        <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-90120268-3', 'auto');
        ga('send', 'pageview');
        </script>
    </body>
</html>
