<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('img/favicon.png') }}">
    <script defer src="https://use.fontawesome.com/releases/v5.14.0/js/all.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>Budgestion</title>
</head>
<body style="min-height: 100vh">
<header>
    <!-- Fixed navbar -->
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Budgestion</a>
            <btn class="navbar-toggler" type="btn" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </btn>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    @guest
                    <li class="nav-item">
                            <a href="{{ url('/') }}" class="nav-link">
                                Welcome
                            </a>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">
                            Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('year') }}" class="nav-link">
                            Dépense Annuelle
                        </a>
                    </li>
                        <li>
                            <a href="{{ route('month') }}" class="nav-link">
                                Dépense Mensuelle
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="btn" data-bs-toggle="dropdown" aria-expanded="false">
                                Création
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{ route('category') }}">Nomenclature</a></li>
                                <li><a class="dropdown-item" href="{{ route('car') }}">Véhicule</a></li>
                                <li><a class="dropdown-item" href="{{ route('account') }}">Compte</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="{{ route('spent') }}">Dépense</a></li>
                                <li><a class="dropdown-item" href="{{ route('fuel') }}">Dépense carburant</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="{{ route('earning') }}">Revenu</a></li>
                            </ul>
                        </li>
                    @endguest
                </ul>
                <form class="d-flex">
                    @guest
                    @else
                        <a class="btn btn-outline-secondary" href="{{ route('profil') }}">
                           <i class="fas fa-users-cog"></i>
                        </a>
                    @endguest
                    @guest
                        <a class="btn btn-outline-secondary" href="{{ route('register') }}">
                            <strong>S'enregistrer</strong>
                        </a>
                        <a class="btn btn-outline-secondary" href="{{ route('login') }}">
                            Se connecter
                        </a>
                    @else
                        <a class="btn btn-outline-secondary" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            se déconnecter
                        </a>
                        <form id="logout-form" method="POST" action="{{ route('logout') }}">
                            @csrf
                        </form>
                    @endguest
                </form>
            </div>
        </div>
    </nav>
</header>

@yield('content')
<footer class="footer mt-auto py-3 bg-light">
    <div class="container">
        <p>
            <strong>Budgestion</strong> by Jean-baptiste LOUP &copy; Copyright 2020 &middot
            <a href="https://www.jbloup.fr">About Me</a>
        </p>
    </div>
</footer>
<script src="{{ asset('js/app.js') }}"></script>
<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function () {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
    })()
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>
</html>
