<header>
    <!-- Fixed navbar -->
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <div class="container-fluid">
            @guest
                <a class="navbar-brand" href="{{ url('/') }}">Budgestion</a>
            @else
                <a class="navbar-brand" href="{{ route('home') }}">Budgestion</a>
                <btn class="navbar-toggler" type="btn" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </btn>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav me-auto mb-2 mb-md-0">
                        <li class="nav-item">
                            <a href="{{ route('year') }}" class="nav-link">
                                Bilan annuel
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('month') }}" class="nav-link">
                                Bilan mensuel
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
                        <li>
                            <a href="#" class="nav-link">
                                Recherche
                            </a>
                        </li>
                        {{--<li>
                            <a href="{{ route('profil') }}" class="nav-link">
                                Profil
                            </a>
                        </li>--}}
                        @endguest
                    </ul>
                    <div class="d-flex">
                        @guest
                            <a class="btn btn-outline-light mx-3" href="{{ route('register') }}">
                                <strong>S'enregistrer</strong>
                            </a>
                            <a class="btn btn-outline-success" href="{{ route('login') }}">
                                Se connecter
                            </a>
                        @else
                            <a class="btn btn-outline-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                se déconnecter
                            </a>
                            <form id="logout-form" method="POST" action="{{ route('logout') }}">
                                @csrf
                            </form>
                        @endguest
                    </div>
                </div>
        </div>
    </nav>
</header>
