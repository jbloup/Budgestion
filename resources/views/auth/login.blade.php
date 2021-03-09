
@extends('layouts.app')

@section('content')
    <section class="section is-medium">
        <div class="columns">
            <div class="column"></div>
    <div class="column is-one-quarter">
    <div class="field">
    <form method="POST" action="{{ route('login') }}">
        <h1 class="title is-4">Se connecter</h1>
        @csrf
        <div class="field mb-5">
            <label for="email" class="label">Email</label>
            <div class="control has-icons-left has-icons-right">
                <input id="email" type="email" name="email" class="input" value="{{ old('email') }}" autocomplete="email" placeholder="Votre email" autofocus>
                <span class="icon is-small is-left">
                <i class="fas fa-envelope"></i>
                </span>
            </div>
            @error('email')
            <span class="help is-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="field mb-5">
            <label for="password" class="label">Mot de passe</label>
            <div class="control has-icons-left has-icons-right">
                <input id="password" type="password" name="password" class="input" value="{{ old('password') }}" autocomplete="password" placeholder="Votre mot de passe">
                <span class="icon is-small is-left">
                <i class="fas fa-lock"></i>
                </span>
            </div>
            @error('password')
            <span class="help is-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="field mb-5">
        <button type="submit" class="button is-primary is-fullwidth">Se connecter</button>
            </div>
        <div class="field">
        <a href="{{ route('password.email') }}" class="button is-small is-light is-fullwidth">Mot de passe oublié ?</a>
        </div>
        </form>
        @if (session('status'))
            <span class="help is-success">{{ session('status') }}</span>
        @endif
    </div>
    </div>
            <div class="column"></div>
        </div>
    </section>
@endsection
