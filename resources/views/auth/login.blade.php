
@extends('layouts.app')

@section('content')
    <form method="POST" action="{{ route('login') }}" class="modal-card">
        <h1 class="title">Se connecter</h1>
        @csrf
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
        <button type="submit" class="button is-primary">Se connecter</button>
    </form>
@endsection
