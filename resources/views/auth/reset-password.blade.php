@extends('layouts.app')

@section('content')
    <section class="section is-medium">
        <div class="columns">
            <div class="column"></div>
            <div class="column is-one-quarter">
                <div class="field mb-5">
        <form method="POST" action="{{ route('password.update') }}">
            <h1 class="title is-4">Entrez votre adresse email</h1>
            @csrf
            <input name="token" class="is-hidden" value="{{ $token }}">
            <div class="field mb-5">
                <label class="label">Adresse E-mail</label>
                <p class="control has-icons-left has-icons-right">
                    <input id="email" type="email" name="email" class="input" value="{{ old('email') }}"
                           autocomplete="email" placeholder="Votre email" autofocus>
                    <span class="icon is-small is-left">
                        <i class="fas fa-envelope"></i>
                    </span>
                </p>
                @error('email')
                <span class="help is-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="field mb-5">
                <label for="password" class="label">Mot de passe</label>
                <p class="control has-icons-left">
                <input id="password" type="password" name="password" class="input" value="{{ old('password') }}"
                       autocomplete="password" placeholder="Votre mot de passe">
                <span class="icon is-small is-left">
                <i class="fas fa-lock"></i>
                </span>
                </p>
                @error('password')
                <span class="help is-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="field mb-5">
                <label for="password_confirmation" class="label">Confirmation du mot de passe</label>
                <p class="control has-icons-left">
                <input id="password_confirmation" type="password" name="password_confirmation" class="input"
                       value="{{ old('password_confirmation') }}" autocomplete="password_confirmation"
                       placeholder="Retapez votre mot de passe">
                <span class="icon is-small is-left">
                <i class="fas fa-lock"></i>
                </span>
                </p>
            </div>
            <button type="submit" class="button is-primary is-fullwidth">Réinitialiser mot de passe</button>
        </form>
                </div>
            </div>
            <div class="column"></div>
        </div>
    </section>
@endsection
