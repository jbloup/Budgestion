<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.1/css/bulma.min.css">
    <link rel="shortcut icon" href="{{ asset('img/favicon.png') }}">
    <script defer src="https://use.fontawesome.com/releases/v5.14.0/js/all.js"></script>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>Budgestion</title>
</head>
<body style="min-height: 100vh">
@include('layouts.navbar')

@yield('content')
<footer class="footer">
    <div class="hero-foot">
    <div class="content has-text-centered">
        <p class="is-size-7">
            <strong>Budgestion</strong> by Jean-baptiste LOUP &copy; Copyright 2020 &middot
            <a href="https://www.jbloup.fr">About Me</a>
        </p>
    </div>
    </div>
</footer>
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
