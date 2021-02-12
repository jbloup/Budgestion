<header>
<nav class="navbar is-fixed-top has-shadow" role="navigation" aria-label="main navigation">
    <div class="navbar-brand">
        <div class="media">
                <figure class="image is-96x96">
                    <img src="{{ asset('img/undraw_Savings_re_eq4w.png') }}" alt="Placeholder image">
                </figure>

        </div>
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
            <a href="{{ route('year') }}" class="navbar-item">
                Dépense Annuelle
            </a>

            <a href="{{ route('month') }}" class="navbar-item">
                Dépense Mensuelle
            </a>

            <div class="navbar-item has-dropdown is-hoverable">
                <a href="#" class="navbar-link">
                    Création
                </a>

                <div class="navbar-dropdown">
                    <a href="{{ route('category') }}" class="navbar-item">
                        Nomenclature
                    </a>
                    <a href="{{ route('car') }}" class="navbar-item">
                        Véhicule
                    </a>
                    <a href="{{ route('account') }}" class="navbar-item">
                        Compte
                    </a>
                    <hr class="navbar-divider">
                    <a href="{{ route('spent') }}" class="navbar-item">
                        Dépense
                    </a>
                    <a href="{{ route('fuel') }}" class="navbar-item">
                        Dépense carburant
                    </a>
                    <hr class="navbar-divider">
                    <a href="#" class="navbar-item">
                        Revenu
                    </a>
                </div>
            </div>
            @endguest
        </div>
        <div class="navbar-end">
            <div class="navbar-item">
                <div class="buttons">
                    @guest
                        @else
                        <a href="{{ route('profil') }}" class="button is-light">
                            <span class="icon-text">
                            <span class="icon">
                           <i class="fas fa-users-cog"></i>
                            </span>
                            </span>
                        </a>
                    @endguest
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
