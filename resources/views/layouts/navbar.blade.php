<header>
<nav class="navbar" role="navigation" aria-label="main navigation">
    <div class="navbar-brand">
        <a class="navbar-item" href="https://bulma.io">
            <img src="https://bulma.io/images/bulma-logo.png" width="112" height="28">
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
            <a href="{{ route('home') }}" class="navbar-item">
                Home
            </a>
            @else
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
                    <a href="#" class="navbar-item">
                        Créer catégorie
                    </a>
                    <a href="#" class="navbar-item">
                        Créer Type / Sous-Type
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
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" >se déconnecter</a>
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