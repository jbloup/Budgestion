@extends('layouts.app')

@section('content')
    <section class="hero is-primary is-fullheight is-bold">
        <div class="hero-body">
            <div class="container is-centered">
                <div class="box">
                    <article class="media">
                        <div class="media-left">
                            <figure class="image is-64x64">
                                <img class="is-rounded" src="https://bulma.io/images/placeholders/96x96.png" alt="Placeholder image">
                            </figure>
                        </div>
                        <div class="media-content">
                            <p class="title is-4 has-text-dark">{{ $user->name }}</p>
                            <p class="subtitle is-6 has-text-grey-dark">{{ $user->email }}</p>
                            <nav class="level">
                                <div class="level-left">
                                    <div class="level-item">
                                        <button id="modalButton" class="button is-light"
                                                onclick="document.getElementById({{ $user->id }}).style.display='block'"
                                                data-target="modal-ter" aria-haspopup="true">Éditer profil</button>
                                    </div>
                                </div>
                            </nav>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </section>
    <!-- Modal Card -->
    <div id="{{ $user->id }}" class="modal">
        <div class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">Modification {{ $user->name }}</p>
                <button class="delete" aria-label="close"
                        onclick="document.getElementById({{ $user->id }}).style.display='none'"></button>
            </header>
            <!-- Content ... -->
            <div class="modal-card-body">
                <form method="POST" action="{{ url('/user', ['id' => $user->id]) }}">
                    @method('put')
                    @csrf
                    <div class="card-content">
                        <div class="mb-5">
                            <label class="label">Nom d'utilisateur</label>
                            <div class="control has-icons-left has-icons-right">
                                <input id="name" type="text" name="name" class="input" value="{{ $user->name }}" autocomplete="name"
                                       placeholder="Nom d'utilisateur" autofocus>
                                <span class="icon is-small is-left">
                                <i class="fas fa-user"></i>
                                </span>
                            </div>
                            @error('name')
                            <span class="help is-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-5">
                            <label class="label">Adresse E-mail</label>
                            <p class="control has-icons-left has-icons-right">
                                <input id="email" type="email" name="email" class="input" value="{{ $user->email }}"
                                       autocomplete="email" placeholder="Votre email">
                                <span class="icon is-small is-left">
                        <i class="fas fa-envelope"></i>
                        </span>
                            </p>
                            @error('email')
                            <span class="help is-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                <!-- Content ... -->
                </div>
            <div class="modal-card-foot">
                <button type="submit" class="button is-success">Enregistrer</button>
            </div>
            </form>

        </div>
    </div>
    <!-- End Modal Card -->
@endsection


