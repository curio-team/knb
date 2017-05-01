<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.4.0/css/bulma.min.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Scripts -->
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=0s5ljyxk73uoispvgp9i23onutacx4fx2agrlzv6iglqw4zv"></script>

    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
    <div id="app">

        <nav class="nav has-shadow">
            <div class="container">
                <div class="nav-left">
                    <a href="{{ route('home') }}" class="nav-item">
                        <img src="{{ asset('img/rc-fc.png') }}" alt="">
                    </a>
                    <a href="{{action('HomeController@index')}}" class="nav-item is-tab is-hidden-mobile {{ strpos(Request::path(), 'home') === true ? 'is-active' : ''}}">Forum</a>
                    <a href="{{action('HomeController@learn')}}" class="nav-item is-tab is-hidden-mobile {{ strpos(Request::path(), 'learn') === true ? 'is-active' : ''}} ">Learn</a>
                    <a class="nav-item is-tab is-hidden-mobile">About</a>
                </div>
    <span class="nav-toggle">
      <span></span>
      <span></span>
      <span></span>
    </span>
                <div class="nav-right nav-menu">
                    <a class="nav-item is-tab is-hidden-tablet is-active">Home</a>

                    <a class="nav-item is-tab is-hidden-tablet">About</a>
                    @if (Auth::guest())
                        <a href="{{ route('login') }}" class="nav-item is-tab">login</a>
                        <a href="{{ route('register') }}" class="nav-item is-tab">register</a>
                    @else
                        <a class="nav-item is-tab">
                            <figure class="image is-16x16" style="margin-right: 8px;">
                                <img src="http://bulma.io/images/jgthms.png">
                            </figure>
                            Profile
                        </a>
                        <a class="nav-item is-tab" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
                            Logout
                        </a>

                    @endif

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </div>
            </div>
        </nav>

        <section class="hero banner">
            <div class="hero-body">
                <div class="container">
                    <img src="{{asset('img/logo.png')}}" class="is-pulled-right" alt="">
                </div>
            </div>
        </section>

        @include('partials/minis/_notifications')

        @yield('content')
    </div>

    <footer class="main-footer">
        <div class="container">
            <div class="columns content">
                <div class="column">
                    <h3 class="is-3 is-title">Contribute to AmoHub!</h3>
                    <div class="level">
                        <img class="level-item" width="40%" src="{{asset('img/rc-fc.png')}}" alt="">
                        <img class="level-item" width="30%" src="{{asset('img/logo.png')}}" alt="">
                    </div>
                    <p>This is an open source project created for ROC West-Brabant. As a student, if you want to contribute, please check out the project on
                        <a href="http://www.github.com/Radiuscollege/knb"> github</a>.</p>
                </div>
                <div class="column"></div>
                <div class="column"></div>
                <div class="column"></div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
