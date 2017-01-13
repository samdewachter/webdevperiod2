<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('slick/slick.css') }}"/>
        <!-- Add the new slick-theme.css if you want the default styling -->
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('slick/slick-theme.css') }}"/>
        <link href='http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/style.css') }}">
        

        
    </head>
    <body>
        <div class="container">

            @if(Cookie::get('firsttime') == null)

                <div class="cookie clearfix">
                    <a class="pull-right close-cookie">Close</a>
                    <div class="col-md-8 col-md-offset-2">

                        <img class="pull-left" src="{{ asset('/img/bone.png') }}">

                        <h2>Cookies</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                        <a href="{{ url('/cookie') }}" class="btn btn-primary">Ok, verder surfen</a>
                    </div>
                </div>

            @endif

            <aside>

                <div class="top">

                    <ul class="clearfix">

                        <li class="nav-normal"><a class="toggle-nav"><img src="{{ url('/img/hamburgerIcon.png') }}"></a></li>
                        <li class="nav-normal {{ (Request::is('search') ? 'active-search' : '') }}"><a class="nav-search" href="{{ url('/search') }}"><img src="{{ url('/img/searchIcon.png') }}"><strong class="nav-text">Search</strong></a></li>
                        <li class="nav-normal {{ (Request::is('FAQ') ? 'active-FAQ' : '') }}"><a class="nav-FAQ" href="{{ url('/FAQ') }}"><img src="{{ url('/img/FAQ.png') }}"><strong class="nav-text">FAQ</strong></a></li>
                    </ul>
                    <div class="horizontal-divider"></div>
                    <ul class="clearfix">
                        <li class="nav-normal"><a href="{{ url('categories/dog') }}"><img class="category-icon" src="@if(Request::is('../dog/..')) {{ url('/img/categories/dog.png') }} @else {{ url('/img/categories/white_dog.png') }} @endif"><strong class="nav-text">Dog</strong></a></li>
                        <li class="nav-normal"><a href="{{ url('categories/cat') }}"><img class="category-icon" src="@if(Request::is('categories/cat')) {{ url('/img/categories/cat.png') }} @else {{ url('/img/categories/white_cat.png') }} @endif"><strong class="nav-text">Cat</strong></a></li>
                        <li class="nav-normal"><a href="{{ url('categories/bird') }}"><img class="category-icon" src="@if(Request::is('categories/bird')) {{ url('/img/categories/bird.png') }} @else {{ url('/img/categories/white_bird.png') }} @endif"><strong class="nav-text">Bird</strong></a></li>
                        <li class="nav-normal"><a href="{{ url('categories/fish') }}"><img class="category-icon" src="@if(Request::is('categories/fish')) {{ url('/img/categories/fish.png') }} @else {{ url('/img/categories/white_fish.png') }} @endif"><strong class="nav-text">Fish</strong></a></li>
                        <li class="nav-normal"><a href="{{ url('categories/smallanimals') }}"><img class="category-icon" src="@if(Request::is('categories/smallanimals')) {{ url('/img/categories/hamster.png') }} @else {{ url('/img/categories/white_hamster.png') }} @endif"><strong class="nav-text">Small animals</strong></a></li>
                        <li class="nav-normal {{ (Request::is('categories/other') ? 'active-other' : '') }}"><a href="{{ url('categories/other') }}"><img class="category-other" src="{{ url('/img/categories/other.png') }}"><strong class="nav-text">Other</strong></a></li>
                    </ul>
                </div>

                <ul class="bottom">
                    @if(Auth::check() && Auth::user()->isAdmin())
                        <li class="nav-normal"><a href="{{ url('admindashboard') }}"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span><strong class="nav-text">Dashboard</strong></a></li>
                        <li class="nav-normal">
                            <a href="{{ url('/logout') }}"
                                onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                                <span class="glyphicon glyphicon-log-out" aria-hidden="true"></span><strong class="nav-text">Logout</strong>
                            </a>

                            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    @endif
                    <li class="nav-normal"><a href="{{ url('/language?lang=nl') }}"><strong class="language">NL</strong><strong class="nav-text">Nederlands</strong></a></li>
                    <li class="nav-normal"><a href="{{ url('/language?lang=en') }}"><strong class="language">EN</strong><strong class="nav-text">English</strong></a></li>
                    <li class="nav-normal"><a href="{{ url('/about') }}"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span><strong class="nav-text">About us</strong></a></li>
                    <li><a href="{{url('/')}}"><img class="logo-k" src="{{ url('/img/K.png') }}"><img class="logo-kowloon" src="{{ url('/img/Kowloon.png') }}"></a></li>
                </ul>

            </aside>

            <div class="wrapper">

                @yield('content')

            </div>

        </div>

        <script>
          (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
          (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
          m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
          })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

          ga('create', 'UA-90325820-1', 'auto');
          ga('send', 'pageview');

        </script>

        <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script type="text/javascript" src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script type="text/javascript" src="{{ URL::asset('slick/slick.min.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('js/script.js') }}"></script>
    </body>
</html>
