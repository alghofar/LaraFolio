<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title') | trans('main.website.title')</title>
        <meta name="description" content="@yield('description', trans('main.website.description'))">
        <meta name="author" content="{{ trans('main.website.author') }}">
        
        <link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}">

        <!-- Bootstrap core CSS -->
        <link href="//netdna.bootstrapcdn.com/bootswatch/3.1.1/flatly/bootstrap.min.css" rel="stylesheet">
        {{ HTML::style('css/main.css') }}
        @yield('styles')

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>

    <body>
        <!-- Navbar -->
        <div class="navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">{{ trans('main.website.title') }}</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="#">{{ trans('pages.home.title') }}</a></li>
                        <li><a href="#about">{{ trans('pages.about.title') }}</a></li>
                        <li><a href="#contact">{{ trans('pages.contact.title') }}</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Navbar -->

        <!-- Container -->
        <div class="container">
            @yield('content')
        </div>
        <!-- /Container -->

        <!-- JS -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
        <!-- /JS -->
    </body>
</html>