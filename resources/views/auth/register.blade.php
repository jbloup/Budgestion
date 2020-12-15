@extends('layouts.app')

@section('content')
    <form method="POST" action="{{ route('register') }}" class="modal-card">
        <h1 class="title">Completez vos informations</h1>
        @csrf
        <div class="field">
            <label for="name" class="label">Nom d'utilisateur</label>
            <input id="name" type="text" name="name" class="input" value="{{ old('name') }}" autocomplete="name" placeholder="Nom d'utilisateur" autofocus>
            @error('name')
            <span class="help is-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="field">
            <label for="email" class="label">Email</label>
            <input id="email" type="email" name="email" class="input" value="{{ old('email') }}" autocomplete="email" placeholder="Votre email" autofocus>
            @error('email')
            <span class="help is-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="field">
            <label for="password" class="label">Mot de passe</label>
            <input id="password" type="password" name="password" class="input" value="{{ old('password') }}" autocomplete="password" placeholder="Votre mot de passe" autofocus>
            @error('password')
            <span class="help is-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="field">
            <label for="password_confirmation" class="label">Confirmation du mot de passe</label>
            <input id="password_confirmation" type="password" name="password_confirmation" class="input" value="{{ old('password_confirmation') }}" autocomplete="password_confirmation" placeholder="Retapez votre mot de passe" autofocus>
        </div>

        <button type="submit" class="button is-primary">Créer mon compte</button>
    </form>
@endsection
