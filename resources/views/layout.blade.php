<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Tautikartta</title>

    <link rel="stylesheet" href="{{asset('css/app.css?v=2')}}">
</head>
<body>

<div id="app" class="columns">
    <div class="column">
        @yield('content')
    </div>
</div>

@yield('scripts')
</body>
</html>
