{{-- This file provides the base view structure --}}
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield("title") | Notes App</title>
        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
        <script   src="https://code.jquery.com/jquery-2.2.4.min.js"   integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
        <script src='//cdn.tinymce.com/4/tinymce.min.js'></script>
        <link rel="stylesheet" type="text/css" href="{{ url("css/app.css") }}">
        <script src="{{ url("js/all.js") }}"></script>
        <script>
            tinymce.init({
                selector: '.tinymce'
            });
        </script>
        @yield("head_extras")
    </head>
    <body>
        {{-- Check for any flash messages --}}
        @if (Session::has('flash_notification.message'))
            <div class="alert alert-{{ Session::get('flash_notification.level') }} text-center  flash">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

                {{ Session::get('flash_notification.message') }}
            </div>
        @endif

        {{-- If logged in, show the navigation bar --}}
        @if (\Auth::check())
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="{{ url("") }}">Notes App</a>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">
                            <li><a href="{{ url("") }}" @if(\Request::is('/')) class="active" @endif>Overview</a></li>
                        </ul>

                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="{{ url("profile") }}">My Profile</a></li>
                            <li><a href="{{ url("logout") }}">Logout</a></li>
                        </ul>
                    </div><!-- /.navbar-collapse -->
                </div><!-- /.container-fluid -->
            </nav>
        @endif
        <div class="container">
            @yield("content")
        </div>
    </body>
</html>
