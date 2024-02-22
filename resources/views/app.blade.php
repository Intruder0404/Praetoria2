<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <link rel="icon" href="public/logo/praetoria-1-transparent.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Praetoria</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<div id="app"></div>
@vite('resources/js/main.ts')
</body>
</html>
