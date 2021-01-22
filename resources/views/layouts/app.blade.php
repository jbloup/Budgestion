<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.1/css/bulma.min.css">
    <script defer src="https://use.fontawesome.com/releases/v5.14.0/js/all.js"></script>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>Gestion</title>
</head>
<body style="min-height: 100vh">
@include('layouts.navbar')
<section class="section mb-6 pb-6">
    @yield('content')
</section>
@yield('footer')
<footer class="footer mt-6 p-5">
    <div class="content has-text-centered">
        <p class="is-size-7">
            <strong>AppGestion</strong> by Jean-baptiste LOUP &copy; Copyright 2020 &middot
            <a href="#">About Me</a>
        </p>
    </div>
</footer>
</body>
</html>
