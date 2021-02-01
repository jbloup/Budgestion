@extends('layouts.app')

@section('content')
    <section class="section is-medium">
        <form method="POST" action="{{ route('forgot-password') }}" class="modal-card">
            @csrf
            @foreach($users as $user)
                <input class="is-hidden" name="email" value="{{ $user->email }}">
            @endforeach
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
            <button type="submit" class="button is-primary">Réinitialisé mot de passe</button>
        </form>
    </section>
@endsection

