@extends('layouts.app')

@section('content')
    <section class="section is-medium">
        <div class="columns">
            <div class="column"></div>
            <div class="column is-one-quarter">
                <div class="field">
        <form method="POST" action="{{ route('password.email') }}">
            <h1 class="title is-4">Compléter vos informations</h1>
            @csrf
            @method('post')
            <div class="field">
                <label for="email" class="label">Votre Email</label>
                <div class="control has-icons-left has-icons-right">
                    <input id="email" type="email" name="email" class="input" value="{{ old('email') }}" autocomplete="email" placeholder="Votre email" autofocus>
                    <span class="icon is-small is-left">
                <i class="fas fa-user"></i>
                </span>
                </div>
                @error('email')
                <span class="help is-danger">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="button is-primary is-fullwidth">Réinitialisé mot de passe</button>
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

