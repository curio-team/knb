<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="google-site-verification" content="FSCUKOCngFG_EfSGlIBJSMBeKuLfP-zkde0wsk0ZeqA" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} | Dashboard </title>

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.4.0/css/bulma.min.css">
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
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

    <div class="columns">
        <aside class="column is-2 aside hero is-fullheight is-hidden-mobile">
            <div>
                <div class="main">
                    <figure>
                        <img src="{{asset('img/rc-fc.png')}}" alt="">
                    </figure>
                    <a href="" class="item active"><span class="icon"><i class="fa fa-home"></i></span><span class="name">Dashboard</span></a>
                    <a href="{{route('points')}}" class="item"><span class="icon"><i class="fa fa-thumbs-o-up"></i></span><span class="name">Points</span></a>
                    <a href="{{route('badges')}}" class="item"><span class="icon"><i class="fa fa-shield"></i></span><span class="name">Badges</span></a>
                    <a href="{{route('import')}}" class="item"><span class="icon"><i class="fa fa-folder-o"></i></span><span class="name">Import / Export</span></a>
                </div>
            </div>
        </aside>
        <div class="column is-10 admin-panel">
            <nav class="nav is-dark has-shadow" id="top">
                <div class="container">
                    <div class="nav-left">
                        <a class="nav-item" href="{{route('home')}}">
                            <img src="{{ asset('img/logo.png') }}" alt="">
                        </a>
                    </div>
                    <span class="nav-toggle">
                         <span></span>
                        <span></span>
                        <span></span>
                    </span>
                    <div class="nav-right nav-menu is-hidden-tablet">
                        <a href="#" class="nav-item is-active">
                            Dashboard
                        </a>
                        <a href="#" class="nav-item">
                            Activity
                        </a>
                        <a href="#" class="nav-item">
                            Timeline
                        </a>
                        <a href="#" class="nav-item">
                            Folders
                        </a>
                    </div>
                </div>
            </nav>

            @include('partials.minis._notifications')
            <section class="hero is-small">
                <!-- Hero content: will be in the middle -->
                <div class="hero-body">
                    <div class="container">
                        <h1 class="title">
                            Admin Dashboard
                        </h1>
                        <h3 class="is-3 is-subtitle">Welkom, {{ \Auth::user()->name }}</h3>
                    </div>
                </div>

                <!-- Hero footer: will stick at the bottom -->
                <div class="hero-foot">
                    <nav class="level">
                        <div class="level-item has-text-centered">
                            <p class="heading">Posts</p>
                            <p class="title">3,456</p>
                        </div>
                        <div class="level-item has-text-centered">
                            <p class="heading">Users</p>
                            <p class="title">123</p>
                        </div>
                        <div class="level-item has-text-centered">
                            <p class="heading">Total points</p>
                            <p class="title">456K</p>
                        </div>
                        <div class="level-item has-text-centered">
                            <p class="heading">Upvotes</p>
                            <p class="title">789</p>
                        </div>
                    </nav>
                </div>
            </section>
            <section class="section content dashboard-content">
               @yield('content')
            </section>
        </div>
    </div>
</div>



<script src="{{ asset('js/app.js') }}"></script>
<!-- Scripts -->
<script>
    (function() {
        var burger = document.querySelector('.nav-toggle');
        var menu = document.querySelector('.nav-menu');
        burger.addEventListener('click', function() {
            burger.classList.toggle('is-active');
            menu.classList.toggle('is-active');
        });
    })();
</script>
</body>
</html>
