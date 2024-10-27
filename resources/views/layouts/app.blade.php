<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2.0"/>
    <title>Chronus</title>
    @vite(['resources/css/app.css','resources/css/materialize.css','resources/js/app.js','resources/js/materialize.js','resources/js/init.js'])
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('images/Chronus.ico') }}" type="image/x-icon" />
</head>
<body>
<div id="app">

    @include('component.partials.navigation')

    @include('component.partials.banner')

    <div class="container">
        @yield('content')
    </div>

    @include('component.partials.features')

    @include('component.partials.footers')

</div>
</body>
<script src="{{ asset('js/vue.js') }}"></script>
<script src="{{ asset('js/jquery.js') }}"></script>
@yield('scripts')
</html>