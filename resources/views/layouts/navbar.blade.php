<header>
<nav class="navbar" role="navigation" aria-label="main navigation">
    <div class="navbar-brand">
        <a class="navbar-item mx-3" href="{{ url('/') }}">
            <span class="icon has-text-primary"><i class="fas fa-3x fa-table"></i></span>
        </a>

        <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
        </a>
    </div>

    <div id="navbarBasicExample" class="navbar-menu">
        <div class="navbar-start">
            @guest
            <a href="{{ url('/') }}" class="navbar-item">
                Welcome
            </a>
            @else
                <a href="{{ route('home') }}" class="navbar-item">
                    Home
                </a>
            <a href="#" class="navbar-item">
                Dépense Annuelle
            </a>

            <a href="#" class="navbar-item">
                Dépense Mensuelle
            </a>

            <div class="navbar-item has-dropdown is-hoverable">
                <a href="#" class="navbar-link">
                    Création
                </a>

                <div class="navbar-dropdown">
                    <a href="{{ url('create/category') }}" class="navbar-item">
                        Créer catégorie
                    </a>
                    <a href="{{ url('create/type') }}" class="navbar-item">
                        Créer type / sous-Type
                    </a>
                    <a href="{{ route('car') }}" class="navbar-item">
                        Créer voiture
                    </a>
                    <hr class="navbar-divider">
                    <a href="#" class="navbar-item">
                        Créer Dépense
                    </a>
                </div>
            </div>
            @endguest
        </div>
        <div class="navbar-end">
            <div class="navbar-item">
                <div class="buttons">
                    @guest
                    <a href="{{ route('register') }}" class="button is-primary">
                        <strong>S'enregistrer</strong>
                    </a>
                    <a href="{{ route('login') }}" class="button is-light">
                        Se connecter
                    </a>
                    @else
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="button is-light">se déconnecter</a>
                        <form id="logout-form" method="POST" action="{{ route('logout') }}">
                            @csrf
                        </form>
                    @endguest
                </div>
            </div>
        </div>
    </div>
</nav>
</header>
