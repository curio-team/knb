<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.6.0/css/bulma.min.css">
    <title>Document</title>
    <style>
        html {
            background: linear-gradient(to right, #71B280, #134E5E)
        }
    </style>
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=0s5ljyxk73uoispvgp9i23onutacx4fx2agrlzv6iglqw4zv"></script>
    <script src="{{ asset('js/prism.js') }}"></script>

    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
            'appUrl'    => config('app.url')
        ]) !!};


    </script>

</head>
<body>
    <div id="app">
        <statistics></statistics>
    </div>


        <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>