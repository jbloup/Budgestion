@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-center mt-5 pt-5">
        <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate>
            @csrf
            <h1 class="h3 mb-3 fw-normal">Connexion</h1>
            <label for="email" class="visually-hidden">Adresse Email</label>
            <input id="email" type="email" name="email" class="form-control mb-2 @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Votre email" aria-describedby="validationEmail" autofocus required>
            @error('email')
            <div id="validationEmail" class="invalid-feedback">{{ $message }}</div>
            @enderror
            <label for="password" class="visually-hidden">Mot de passe</label>
            <input id="password" type="password" name="password" class="form-control mb-2 @error('password') is-invalid @enderror" value="{{ old('password') }}" placeholder="Votre mot de passe" aria-describedby="validationPassword" required>
            @error('password')
            <div id="validationPassword" class="invalid-feedback">{{ $message }}</div>
            @enderror
            <div class="checkbox mb-3">
                <label>
                    <input type="checkbox" value="remember-me"> Se souvenir de moi
                </label>
            </div>
            <button class="w-100 btn btn-lg btn-primary mb-2" type="submit">Se connecter</button>
            <a href="{{ route('password.email') }}" class="link-secondary">Mot de passe oublié ?</a>
        </form>
        @if (session('status'))
            <script>alert({{ session('status') }})</script>
        @endif
    </div>
@endsection
