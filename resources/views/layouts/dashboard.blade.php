<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

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

    @include('partials.minis._notifications')

    <div class="columns">
        <aside class="column is-2 aside hero is-fullheight is-hidden-mobile">
            <div>
                <div class="main">
                    <figure>
                        <img src="{{asset('img/rc-fc.png')}}" alt="">
                    </figure>
                    <a href="#" class="item active"><span class="icon"><i class="fa fa-home"></i></span><span class="name">Dashboard</span></a>
                    <a href="#" class="item"><span class="icon"><i class="fa fa-map-marker"></i></span><span class="name">Activity</span></a>
                    <a href="#" class="item"><span class="icon"><i class="fa fa-th-list"></i></span><span class="name">Timeline</span></a>
                    <a href="#" class="item"><span class="icon"><i class="fa fa-folder-o"></i></span><span class="name">Folders</span></a>
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
            <section class="section">
                <div class="columns is-mobile is-multiline">
                    <div class="column is-one-third-desktop is-full-mobile">
                        <section class="panel">
                            <p class="panel-heading">
                                Flagged posts
                            </p>
                            <div class="panel-block">

                            </div>

                        </section>
                    </div>
                    <div class="column is-one-third-desktop is-full-mobile">
                        <section class="panel">
                            <p class="panel-heading">
                                Sales
                            </p>
                            <div class="panel-block">
                                <div id="chart2" style="height: 280px;"><svg height="280" version="1.1" width="390" xmlns="http://www.w3.org/2000/svg" style="overflow: hidden; position: relative; left: -0.101563px;"><desc style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">Created with RaphaÃ«l 2.1.0</desc><defs style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></defs><path fill="none" stroke="#0b62a4" d="M194.96875,226.66666666666669A86.66666666666667,86.66666666666667,0,0,0,276.94325664112665,168.1299017427184" stroke-width="2" opacity="0" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); opacity: 0;"></path><path fill="#0b62a4" stroke="#ffffff" d="M194.96875,229.66666666666669A89.66666666666667,89.66666666666667,0,0,0,279.7808357171657,169.10362911073557L313.201211501625,180.57197366738228A125,125,0,0,1,194.96875,265Z" stroke-width="3" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><path fill="none" stroke="#3980b5" d="M276.94325664112665,168.1299017427184A86.66666666666667,86.66666666666667,0,0,0,117.23834453389671,101.67122259729263" stroke-width="2" opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); opacity: 1;"></path><path fill="#3980b5" stroke="#ffffff" d="M279.7808357171657,169.10362911073557A89.66666666666667,89.66666666666667,0,0,0,114.54767665237775,100.34445722566045L78.37314180084506,82.50683389593895A130,130,0,0,1,317.93050996169,182.19485261407758Z" stroke-width="3" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><path fill="none" stroke="#679dc6" d="M117.23834453389671,101.67122259729263A86.66666666666667,86.66666666666667,0,0,0,194.94152286411668,226.66666238983814" stroke-width="2" opacity="0" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); opacity: 0;"></path><path fill="#679dc6" stroke="#ffffff" d="M114.54767665237775,100.34445722566045A89.66666666666667,89.66666666666667,0,0,0,194.9405803863361,229.66666224179409L194.92948009247598,264.9999938314973A125,125,0,0,1,82.85758827004334,84.71810951532592Z" stroke-width="3" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="194.96875" y="130" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none" fill="#000000" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-style: normal; font-variant: normal; font-weight: 800; font-stretch: normal; font-size: 15px; line-height: normal; font-family: Arial;" font-size="15px" font-weight="800" transform="matrix(1.3538,0,0,1.3538,-68.9699,-49.7037)" stroke-width="0.738681891025641"><tspan style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);" dy="6">In-Store Sales</tspan></text><text x="194.96875" y="150" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none" fill="#000000" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 14px; line-height: normal; font-family: Arial;" font-size="14px" transform="matrix(1.8638,0,0,1.8638,-168.4004,-122.8754)" stroke-width="0.5365384615384615"><tspan style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);" dy="4.75">30</tspan></text></svg></div>
                            </div>
                            <div class="panel-block">
                                <button class="button is-default is-outlined is-fullwidth">
                                    View Data
                                </button>
                            </div>
                        </section>
                    </div>
                    <div class="column is-one-third-desktop is-full-mobile">
                        <section class="panel">
                            <p class="panel-heading">
                                YoY Comparison
                            </p>
                            <div class="panel-block">
                                <div id="chart3" style="height: 280px; position: relative; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);"><svg height="280" version="1.1" width="390" xmlns="http://www.w3.org/2000/svg" style="overflow: hidden; position: relative; left: -0.0390625px;"><desc style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">Created with RaphaÃ«l 2.1.0</desc><defs style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></defs><text x="32.515625" y="241.5" text-anchor="end" font="10px &quot;Arial&quot;" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal"><tspan style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);" dy="4.25">0</tspan></text><path fill="none" stroke="#aaaaaa" d="M45.015625,241.5H364.9375" stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="32.515625" y="187.375" text-anchor="end" font="10px &quot;Arial&quot;" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal"><tspan style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);" dy="4.25">50</tspan></text><path fill="none" stroke="#aaaaaa" d="M45.015625,187.375H364.9375" stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="32.515625" y="133.25" text-anchor="end" font="10px &quot;Arial&quot;" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal"><tspan style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);" dy="4.25">100</tspan></text><path fill="none" stroke="#aaaaaa" d="M45.015625,133.25H364.9375" stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="32.515625" y="79.125" text-anchor="end" font="10px &quot;Arial&quot;" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal"><tspan style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);" dy="4.25">150</tspan></text><path fill="none" stroke="#aaaaaa" d="M45.015625,79.125H364.9375" stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="32.515625" y="25" text-anchor="end" font="10px &quot;Arial&quot;" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal"><tspan style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);" dy="4.25">200</tspan></text><path fill="none" stroke="#aaaaaa" d="M45.015625,25H364.9375" stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="306.79884708737865" y="254" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal" transform="matrix(1,0,0,1,0,6.75)"><tspan style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);" dy="4.25">1910</tspan></text><path fill="#a7b3bc" stroke="none" d="M45.015625,69.3825C52.28295661407767,74.52437499999999,66.817619842233,80.61343749999999,74.08495145631068,89.94999999999999C81.35228307038835,99.28656249999999,95.88694629854368,143.263125,103.15427791262135,144.075C110.42160952669903,144.886875,124.95627275485438,93.74245212038304,132.22360436893206,96.445C139.51084648058253,99.15495212038303,154.08533070388353,163.4215406976744,161.372572815534,165.725C168.63990442961168,168.0221656976744,183.174567657767,122.2896875,190.44189927184468,114.8475C197.70923088592235,107.4053125,212.24389411407768,116.0653125,219.51122572815535,106.1875C226.77855734223303,96.3096875,241.31322057038835,29.068630300957587,248.58055218446603,35.82499999999999C255.86779429611653,42.59988030095759,270.4422785194175,141.34283515731872,277.729520631068,160.3125C284.99685224514565,179.23033515731873,299.531515473301,187.375,306.79884708737865,187.375C314.06617870145635,187.375,328.60084192961165,167.078125,335.86817354368935,160.3125C343.135505157767,153.546875,357.67016838592235,140.015625,364.9375,133.25L364.9375,241.5L45.015625,241.5Z" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></path><path fill="none" stroke="#7a92a3" d="M45.015625,69.3825C52.28295661407767,74.52437499999999,66.817619842233,80.61343749999999,74.08495145631068,89.94999999999999C81.35228307038835,99.28656249999999,95.88694629854368,143.263125,103.15427791262135,144.075C110.42160952669903,144.886875,124.95627275485438,93.74245212038304,132.22360436893206,96.445C139.51084648058253,99.15495212038303,154.08533070388353,163.4215406976744,161.372572815534,165.725C168.63990442961168,168.0221656976744,183.174567657767,122.2896875,190.44189927184468,114.8475C197.70923088592235,107.4053125,212.24389411407768,116.0653125,219.51122572815535,106.1875C226.77855734223303,96.3096875,241.31322057038835,29.068630300957587,248.58055218446603,35.82499999999999C255.86779429611653,42.59988030095759,270.4422785194175,141.34283515731872,277.729520631068,160.3125C284.99685224514565,179.23033515731873,299.531515473301,187.375,306.79884708737865,187.375C314.06617870145635,187.375,328.60084192961165,167.078125,335.86817354368935,160.3125C343.135505157767,153.546875,357.67016838592235,140.015625,364.9375,133.25" stroke-width="3" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><circle cx="45.015625" cy="69.3825" r="7" fill="#7a92a3" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="74.08495145631068" cy="89.94999999999999" r="4" fill="#7a92a3" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="103.15427791262135" cy="144.075" r="4" fill="#7a92a3" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="132.22360436893206" cy="96.445" r="4" fill="#7a92a3" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="161.372572815534" cy="165.725" r="4" fill="#7a92a3" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="190.44189927184468" cy="114.8475" r="4" fill="#7a92a3" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="219.51122572815535" cy="106.1875" r="4" fill="#7a92a3" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="248.58055218446603" cy="35.82499999999999" r="4" fill="#7a92a3" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="277.729520631068" cy="160.3125" r="4" fill="#7a92a3" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="306.79884708737865" cy="187.375" r="4" fill="#7a92a3" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="335.86817354368935" cy="160.3125" r="4" fill="#7a92a3" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="364.9375" cy="133.25" r="4" fill="#7a92a3" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><path fill="#2577b5" stroke="none" d="M45.015625,154.9C52.28295661407767,156.253125,66.817619842233,156.253125,74.08495145631068,160.3125C81.35228307038835,164.371875,95.88694629854368,187.375,103.15427791262135,187.375C110.42160952669903,187.375,124.95627275485438,160.3125,132.22360436893206,160.3125C139.51084648058253,160.3125,154.08533070388353,187.375,161.372572815534,187.375C168.63990442961168,187.375,183.174567657767,163.6953125,190.44189927184468,160.3125C197.70923088592235,156.9296875,212.24389411407768,156.9296875,219.51122572815535,160.3125C226.77855734223303,163.6953125,241.31322057038835,187.375,248.58055218446603,187.375C255.86779429611653,187.375,270.4422785194175,160.3125,277.729520631068,160.3125C284.99685224514565,160.3125,299.531515473301,187.375,306.79884708737865,187.375C314.06617870145635,187.375,328.60084192961165,167.078125,335.86817354368935,160.3125C343.135505157767,153.546875,357.67016838592235,140.015625,364.9375,133.25L364.9375,241.5L45.015625,241.5Z" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></path><path fill="none" stroke="#0b62a4" d="M45.015625,154.9C52.28295661407767,156.253125,66.817619842233,156.253125,74.08495145631068,160.3125C81.35228307038835,164.371875,95.88694629854368,187.375,103.15427791262135,187.375C110.42160952669903,187.375,124.95627275485438,160.3125,132.22360436893206,160.3125C139.51084648058253,160.3125,154.08533070388353,187.375,161.372572815534,187.375C168.63990442961168,187.375,183.174567657767,163.6953125,190.44189927184468,160.3125C197.70923088592235,156.9296875,212.24389411407768,156.9296875,219.51122572815535,160.3125C226.77855734223303,163.6953125,241.31322057038835,187.375,248.58055218446603,187.375C255.86779429611653,187.375,270.4422785194175,160.3125,277.729520631068,160.3125C284.99685224514565,160.3125,299.531515473301,187.375,306.79884708737865,187.375C314.06617870145635,187.375,328.60084192961165,167.078125,335.86817354368935,160.3125C343.135505157767,153.546875,357.67016838592235,140.015625,364.9375,133.25" stroke-width="3" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><circle cx="45.015625" cy="154.9" r="7" fill="#0b62a4" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="74.08495145631068" cy="160.3125" r="4" fill="#0b62a4" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="103.15427791262135" cy="187.375" r="4" fill="#0b62a4" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="132.22360436893206" cy="160.3125" r="4" fill="#0b62a4" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="161.372572815534" cy="187.375" r="4" fill="#0b62a4" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="190.44189927184468" cy="160.3125" r="4" fill="#0b62a4" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="219.51122572815535" cy="160.3125" r="4" fill="#0b62a4" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="248.58055218446603" cy="187.375" r="4" fill="#0b62a4" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="277.729520631068" cy="160.3125" r="4" fill="#0b62a4" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="306.79884708737865" cy="187.375" r="4" fill="#0b62a4" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="335.86817354368935" cy="160.3125" r="4" fill="#0b62a4" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="364.9375" cy="133.25" r="4" fill="#0b62a4" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle></svg><div class="morris-hover morris-default-style" style="left: 13.6602px; top: 72px;"><div class="morris-hover-row-label">1</div><div class="morris-hover-point" style="color: #0b62a4">
                                            2015:
                                            80
                                        </div><div class="morris-hover-point" style="color: #7A92A3">
                                            2016:
                                            79
                                        </div></div></div>
                            </div>
                            <div class="panel-block">
                                <button class="button is-default is-outlined is-fullwidth">
                                    View Data
                                </button>
                            </div>
                        </section>
                    </div>
                    <div class="column is-half-desktop is-full-mobile">
                        <section class="panel">
                            <p class="panel-heading">
                                Notifications
                            </p>
                            <div class="panel-block">
                                <div class="notification is-warning">
                                    <button class="delete" onclick="((this).parentNode.remove())"></button>
                                    <strong>Server 101a is at 90% disk capacity.</strong>
                                    <br>
                                    <small>1h ago | via: system</small>
                                </div>
                                <div class="notification">
                                    <button class="delete" onclick="((this).parentNode.remove())"></button>
                                    <strong>Cron job successfully completed.</strong>
                                    <br>
                                    <small>2h ago | via: system</small>
                                </div>
                                <div class="notification">
                                    <button class="delete" onclick="((this).parentNode.remove())"></button>
                                    <strong>Completed automated backup.</strong>
                                    <br>
                                    <small>1d ago | via: system</small>
                                </div>
                                <div class="notification">
                                    <button class="delete" onclick="((this).parentNode.remove())"></button>
                                    <strong>Security scan complete. 0 exceptions found.</strong>
                                    <br>
                                    <small>1d ago | via: system</small>
                                </div>
                            </div>
                        </section>
                    </div>
                    <div class="column is-half-desktop is-full-mobile">
                        <section class="panel">
                            <p class="panel-heading">
                                Forecast
                            </p>
                            <div class="panel-block">
                                <div id="chart5" style="height: 280px; position: relative; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);"><svg height="280" version="1.1" width="606" xmlns="http://www.w3.org/2000/svg" style="overflow: hidden; position: relative; left: -0.078125px;"><desc style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">Created with RaphaÃ«l 2.1.0</desc><defs style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></defs><text x="32.515625" y="241.5" text-anchor="end" font="10px &quot;Arial&quot;" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal"><tspan style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);" dy="4.25">0</tspan></text><path fill="none" stroke="#aaaaaa" d="M45.015625,241.5H580.9140625" stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="32.515625" y="187.375" text-anchor="end" font="10px &quot;Arial&quot;" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal"><tspan style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);" dy="4.25">25</tspan></text><path fill="none" stroke="#aaaaaa" d="M45.015625,187.375H580.9140625" stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="32.515625" y="133.25" text-anchor="end" font="10px &quot;Arial&quot;" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal"><tspan style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);" dy="4.25">50</tspan></text><path fill="none" stroke="#aaaaaa" d="M45.015625,133.25H580.9140625" stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="32.515625" y="79.125" text-anchor="end" font="10px &quot;Arial&quot;" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal"><tspan style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);" dy="4.25">75</tspan></text><path fill="none" stroke="#aaaaaa" d="M45.015625,79.125H580.9140625" stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="32.515625" y="25" text-anchor="end" font="10px &quot;Arial&quot;" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal"><tspan style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);" dy="4.25">100</tspan></text><path fill="none" stroke="#aaaaaa" d="M45.015625,25H580.9140625" stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="542.6356026785714" y="254" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal" transform="matrix(1,0,0,1,0,6.75)"><tspan style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);" dy="4.25">2012</tspan></text><text x="466.0786830357143" y="254" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal" transform="matrix(1,0,0,1,0,6.75)"><tspan style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);" dy="4.25">2011</tspan></text><text x="389.52176339285717" y="254" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal" transform="matrix(1,0,0,1,0,6.75)"><tspan style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);" dy="4.25">2010</tspan></text><text x="236.40792410714286" y="254" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal" transform="matrix(1,0,0,1,0,6.75)"><tspan style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);" dy="4.25">2008</tspan></text><text x="83.29408482142857" y="254" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal" transform="matrix(1,0,0,1,0,6.75)"><tspan style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);" dy="4.25">2006</tspan></text><rect x="54.58523995535714" y="25" width="27.208844866071427" height="216.5" r="0" rx="0" ry="0" fill="#0b62a4" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="84.79408482142857" y="46.650000000000006" width="27.208844866071427" height="194.85" r="0" rx="0" ry="0" fill="#7a92a3" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="131.14215959821428" y="79.125" width="27.208844866071427" height="162.375" r="0" rx="0" ry="0" fill="#0b62a4" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="161.3510044642857" y="100.775" width="27.208844866071427" height="140.725" r="0" rx="0" ry="0" fill="#7a92a3" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="207.69907924107142" y="133.25" width="27.208844866071427" height="108.25" r="0" rx="0" ry="0" fill="#0b62a4" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="237.90792410714283" y="154.9" width="27.208844866071427" height="86.6" r="0" rx="0" ry="0" fill="#7a92a3" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="284.2559988839286" y="79.125" width="27.208844866071427" height="162.375" r="0" rx="0" ry="0" fill="#0b62a4" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="314.46484375000006" y="100.775" width="27.208844866071427" height="140.725" r="0" rx="0" ry="0" fill="#7a92a3" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="360.8129185267857" y="133.25" width="27.208844866071427" height="108.25" r="0" rx="0" ry="0" fill="#0b62a4" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="391.02176339285717" y="154.9" width="27.208844866071427" height="86.6" r="0" rx="0" ry="0" fill="#7a92a3" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="437.36983816964283" y="79.125" width="27.208844866071427" height="162.375" r="0" rx="0" ry="0" fill="#0b62a4" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="467.5786830357143" y="100.775" width="27.208844866071427" height="140.725" r="0" rx="0" ry="0" fill="#7a92a3" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="513.9267578125" y="25" width="27.208844866071427" height="216.5" r="0" rx="0" ry="0" fill="#0b62a4" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="544.1356026785714" y="46.650000000000006" width="27.208844866071427" height="194.85" r="0" rx="0" ry="0" fill="#7a92a3" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect></svg><div class="morris-hover morris-default-style" style="left: 498.616px; top: 103px;"><div class="morris-hover-row-label">2012</div><div class="morris-hover-point" style="color: #0b62a4">
                                            Series A:
                                            100
                                        </div><div class="morris-hover-point" style="color: #7a92a3">
                                            Series B:
                                            90
                                        </div></div></div>
                            </div>
                        </section>
                    </div>
                    <div class="column is-half-desktop is-full-mobile">
                        <section class="panel">
                            <p class="panel-heading">
                                Popular Followers
                            </p>
                            <div class="panel-block">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Instrument</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>Name</th>
                                        <th>Instrument</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                    </tfoot>
                                    <tbody>
                                    <tr>
                                        <td>Misty Abbott</td>
                                        <td>Bass Guitar</td>
                                        <td class="is-icon">
                                            <a href="#">
                                                <i class="fa fa-twitter"></i>
                                            </a>
                                        </td>
                                        <td class="is-icon">
                                            <a href="#">
                                                <i class="fa fa-instagram"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>John Smith</td>
                                        <td>Rhythm Guitar</td>
                                        <td class="is-icon">
                                            <a href="#">
                                                <i class="fa fa-twitter"></i>
                                            </a>
                                        </td>
                                        <td class="is-icon">
                                            <a href="#">
                                                <i class="fa fa-instagram"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Robert Mikels</td>
                                        <td>Lead Guitar</td>
                                        <td class="is-icon">
                                            <a href="#">
                                                <i class="fa fa-twitter"></i>
                                            </a>
                                        </td>
                                        <td class="is-icon">
                                            <a href="#">
                                                <i class="fa fa-instagram"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Karyn Holmberg</td>
                                        <td>Drums</td>
                                        <td class="is-icon">
                                            <a href="#">
                                                <i class="fa fa-twitter"></i>
                                            </a>
                                        </td>
                                        <td class="is-icon">
                                            <a href="#">
                                                <i class="fa fa-instagram"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </section>
                    </div>
                    <div class="column">
                        <section class="panel">
                            <p class="panel-heading">
                                Message User
                            </p>
                            <div class="panel-block">
                                <label class="label">Name</label>
                                <p class="control">
                                    <input class="input" type="text" placeholder="Text input">
                                </p>
                                <label class="label">Username</label>
                                <p class="control has-icon has-icon-right">
                                    <input class="input is-success" type="text" placeholder="Text input" value="bulma">
                                    <i class="fa fa-check"></i>
                                    <span class="help is-success">This username is available</span>
                                </p>
                                <label class="label">Email</label>
                                <p class="control has-icon has-icon-right">
                                    <input class="input is-danger" type="text" placeholder="Email input" value="hello@">
                                    <i class="fa fa-warning"></i>
                                    <span class="help is-danger">This email is invalid</span>
                                </p>
                                <label class="label">Subject</label>
                                <p class="control">
              <span class="select">
                <select>
                  <option>Select dropdown</option>
                  <option>With options</option>
                </select>
              </span>
                                </p>
                                <label class="label">Message</label>
                                <p class="control">
                                    <textarea class="textarea" placeholder="Textarea"></textarea>
                                </p>
                                <p class="control">
                                    <label class="checkbox">
                                        <input type="checkbox">
                                        Remember me
                                    </label>
                                </p>
                                <p class="control">
                                    <label class="radio">
                                        <input type="radio" name="question">
                                        Yes
                                    </label>
                                    <label class="radio">
                                        <input type="radio" name="question">
                                        No
                                    </label>
                                </p>
                                <p class="control">
                                    <button class="button is-primary">Submit</button>
                                    <button class="button is-link">Cancel</button>
                                </p>
                            </div>
                        </section>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>



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
