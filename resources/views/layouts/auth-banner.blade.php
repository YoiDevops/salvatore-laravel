<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ __('Iniciar sesión') }} - {{ config('app.name', 'Laravel') }}</title>

    <link rel="icon" href="/images/logopequeno.ico" sizes="any">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    {{ $slot }}

    @fluxScripts
</body>
</html>