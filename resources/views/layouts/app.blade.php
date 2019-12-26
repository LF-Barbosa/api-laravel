<html>
<head>
    <title>@yield('title')</title>
    {{Html::style('dist/css/bootstrap.min.css')}}
    {{Html::style('dist/css/bootstrap-theme.min.css')}}
</head>
<body>
    <div class="container">
        @yield('content')
    </div>
    {{Html::script('js/jquery-3.1.1.min.js')}}
    {{Html::script('dist/js/bootstrap.min.js')}}
    {{Html::script('https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js')}}
    </body>
</html>