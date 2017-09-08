<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="google-site-verification" content="FSCUKOCngFG_EfSGlIBJSMBeKuLfP-zkde0wsk0ZeqA" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.4.0/css/bulma.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/prism.css') }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Scripts -->
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=0s5ljyxk73uoispvgp9i23onutacx4fx2agrlzv6iglqw4zv"></script>
    <script src="{{ asset('js/prism.js') }}"></script>

    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
            'appUrl'    => config('app.url')
        ]) !!};


    </script>

    <!-- Hotjar Tracking Code for hub.amo.rocks -->
    <script>
        (function(h,o,t,j,a,r){
            h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
            h._hjSettings={hjid:546726,hjsv:5};
            a=o.getElementsByTagName('head')[0];
            r=o.createElement('script');r.async=1;
            r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
            a.appendChild(r);
        })(window,document,'//static.hotjar.com/c/hotjar-','.js?sv=');
    </script>

</head>

    <div id="app">


        <div class="header">
          <div class="container">
            <div class="header-left">
              <!-- Logo -->
              <a href="{{ route('home') }}" class="nav-item">
                  <img src="{{ asset('img/rc-fc.png') }}" alt="">
              </a>
              <!-- Hamburger menu -->
              <a class="nav-item toggle-header-nav is-hidden-tablet">
                <span class="icon">
                  <i class="fa fa-bars"></i>
                </span>
              </a>
              <!-- Nav menu -->
              @if (Auth::guest())
                <ul class="header-nav is-pulled-right">
                  <li><a href="{{ route('login') }}" class="nav-item is-tab">login</a></li>
                  <li><a href="{{ route('register') }}" class="nav-item is-tab">register</a></li>
                </ul>
              @else
                <ul class="header-nav">
                  <li><a href="{{ action('HomeController@index') }}" class="nav-item is-tab {{ strpos(Request::path(), 'home') !== false ? "is-active" : "" }}">Knowledgebase</a></li>
                  <li><a href="{{ action('HomeController@learn') }}" class="nav-item is-tab {{ strpos(Request::path(), 'learn') !== false ? 'is-active' : ''}} ">Learn</a></li>
                    <li><a href="{{ action('HomeController@gameInfo')}}" class="nav-item is-tab {{ strpos(Request::path(), 'game-info') !== false ? "is-active" : "" }}">Game Info</a></li>
                    <li><a href="{{ action('HomeController@about') }}" class="nav-item is-tab {{ strpos(Request::path(), 'about') !== false ? 'is-active' : ''}}">Story</a></li>
                </ul>
              @endif
            </div>

            @if (Auth::guest())
            @else

              <div class="header-right">
                <!-- Search bar -->

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>

                <div class="field has-addons header-search-field is-hidden-mobile nav-item">
                  <form action="{{action('PostController@search')}}">
                      {{csrf_field()}}
                    <p class="control header-search-control">
                      <input class="input" name="query" type="text" placeholder="Search the forum...">
                    </p>
                    <p class="control">
                      <button type="submit" class="button">
                        <span class="icon">
                          <i class="fa fa-search"></i>
                        </span>
                      </button>
                    </p>
                  </form>
                </div>
                <a href="{{ route('message.index') }}" class="nav-item is-tab is-hidden-mobile">
                  @if (\Auth::user()->newMessageCount())
                    <span class="tag is-progress is-notification">{{\Auth::user()->newMessageCount()}}</span>
                  @endif
                    <span class="icon is-marginless"><i class="fa fa-bell"></i></span>
                </a>
                <!-- Options button -->
                <a class="nav-item toggle-options">
                  <span class="icon"><i class="fa fa-cog"></i></span>
                </a>
                <!-- Options menu/dropdown -->
                <ul class="options-dropdown">
                  <!-- Mobile search bar -->
                  <li class="is-hidden-tablet">
                    <a class="nav-item">
                      <div class="field has-addons header-search-field">
                        <form action="{{action('PostController@search')}}">
                            {{csrf_field()}}
                          <p class="control header-search-control">
                            <input class="input" name="query" type="text" placeholder="Search the forum...">
                          </p>
                          <p class="control">
                            <button type="submit" class="button">
                              <span class="icon">
                                <i class="fa fa-search"></i>
                              </span>
                            </button>
                          </p>
                        </form>
                      </div>
                    </a>
                  </li>
                  <!-- Options nav -->
                  <li><a class="nav-item is-tab is-hidden-tablet"><span class="icon"><i class="fa fa-home"></i></span>Home</a></li>
                  {{-- <li><a class="nav-item is-tab">About</a></li> --}}

                  @if (\Auth::user()->isHeadMaster())
                    <li><a  href="{{ route('dashboard') }}" class="nav-item is-tab"><span class="icon"><i class="fa fa-bar-chart"></i></span> Dashboard</a></li>
                  @else
                    <li><a href="{{ route('profile', \Auth::id()) }}" class="nav-item is-tab"><span class="icon"><i class="fa fa-user"></i></span> Profile</a></li>
                  @endif
                  <li><a onclick="event.preventDefault(), document.getElementById('logout-form').submit()" class="nav-item is-tab"><span class="icon"><i class="fa fa-sign-out"></i></span> Logout</a></li>
                </ul>

              </div>
            @endif
          </div>

        </div>

        @include('partials.minis._notifications')
        <section class="hero banner">
            <div class="hero-body">
                <div class="container">
                    <img src="{{ asset('img/logo.png') }}" class="is-pulled-right" alt="Logo AmoHUB" style="width:300px">
                </div>
            </div>
        </section>


        @yield('content')
    </div>

    <footer class="main-footer">
        <div class="container">
            <div class="columns content">
                <div class="column">
                    <h3 class="is-3 is-title">Contribute to AmoHub!</h3>
                    <div class="level">
                        <img class="level-item" width="40%" src="{{ asset('img/rc-fc.png') }}" alt="">
                        <img class="level-item" width="30%" src="{{ asset('img/logo.png') }}" alt="">
                    </div>
                    <p>
                        This is an open source project created for ROC West-Brabant. As a student, if you want to contribute, please check out the project on
                        <a href="https://github.com/Radiuscollege/knb">GitHub</a>.
                    </p>
                </div>

                <div class="column"></div>
                <div class="column"></div>
                <div class="column"></div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->

<script src="{{ asset('js/app.js') }}"></script>
    <script src="https://cdn.rawgit.com/google/code-prettify/master/loader/run_prettify.js"></script>

@if ( strpos(Request::path(), 'house-selection') !== false )
<script src="{{ asset('js/house-selection.js') }}"></script>
@endif

</body>
</html>
