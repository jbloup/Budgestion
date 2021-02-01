
@extends('layouts.app')

@section('content')
    <section class="section is-medium">
    <form method="POST" action="{{ route('login') }}" class="modal-card">
        <h1 class="title">Se connecter</h1>
        @csrf
        <div class="field">
            <label for="email" class="label">Email</label>
            <div class="control has-icons-left has-icons-right">
                <input id="email" type="email" name="email" class="input" value="{{ old('email') }}" autocomplete="email" placeholder="Votre email" autofocus>
                <span class="icon is-small is-left">
                <i class="fas fa-user"></i>
                </span>
            </div>
            @error('name')
            <span class="help is-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="field">
            <label for="password" class="label">Mot de passe</label>
            <div class="control has-icons-left has-icons-right">
                <input id="password" type="password" name="password" class="input" value="{{ old('password') }}" autocomplete="password" placeholder="Votre mot de passe">
                <span class="icon is-small is-left">
                <i class="fas fa-user"></i>
                </span>
            </div>
            @error('name')
            <span class="help is-danger">{{ $message }}</span>
            @enderror
        </div>
        <button type="submit" class="button is-primary">Se connecter</button>
    </form>
    </section>
@endsection
