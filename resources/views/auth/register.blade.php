@extends('layouts.app')

@section('content')
    <section class="section is-medium">
        <form method="POST" action="{{ route('register') }}" class="modal-card">
            <h1 class="title">Completez vos informations</h1>
            @csrf
            <div class="field">
                <label class="label">Nom d'utilisateur</label>
                <div class="control has-icons-left has-icons-right">
                    <input id="name" type="text" name="name" class="input" value="{{ old('name') }}" autocomplete="name"
                           placeholder="Nom d'utilisateur" autofocus>
                    <span class="icon is-small is-left">
                <i class="fas fa-user"></i>
                </span>
                </div>
                @error('name')
                <span class="help is-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="field">
                <label class="label">Adresse E-mail</label>
                <p class="control has-icons-left has-icons-right">
                    <input id="email" type="email" name="email" class="input" value="{{ old('email') }}"
                           autocomplete="email" placeholder="Votre email">
                    <span class="icon is-small is-left">
                        <i class="fas fa-envelope"></i>
                    </span>
                </p>
                @error('email')
                <span class="help is-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="field">
                <label for="password" class="label">Mot de passe</label>
                <input id="password" type="password" name="password" class="input" value="{{ old('password') }}"
                       autocomplete="password" placeholder="Votre mot de passe" autofocus>
                @error('password')
                <span class="help is-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="field">
                <label for="password_confirmation" class="label">Confirmation du mot de passe</label>
                <input id="password_confirmation" type="password" name="password_confirmation" class="input"
                       value="{{ old('password_confirmation') }}" autocomplete="password_confirmation"
                       placeholder="Retapez votre mot de passe" autofocus>
            </div>
            <button type="submit" class="button is-primary">Créer mon compte</button>
        </form>
    </section>
@endsection
