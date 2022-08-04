<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }}</title>
    @livewireStyles
</head>
<body>
    <h3>{{ config('app.name') }}</h3>
    <h3>Under Constract</h3>
    @yield('content')
    @isset($slot) {{ $slot }} @endisset
    @livewireScripts
</body>
</html>
