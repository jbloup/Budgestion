@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-center mt-5 pt-5">
        <form method="POST" action="{{ route('register') }}" class="needs-validation" novalidate>
            @csrf
            <h1 class="h3 mb-3 fw-normal">Complétez vos informations</h1>
            <label for="name" class="form-label">Nom utilisateur</label>
            <input id="name" type="text" name="name" class="form-control mb-2 @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Nom Utilisateur" aria-describedby="validationName" autofocus required>
            @error('name')
            <div id="validationName" class="invalid-feedback">{{ $message }}</div>
            @enderror
            <label for="email" class="form-label">Adresse Email</label>
            <input id="email" type="email" name="email" class="form-control mb-2 @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Votre email" autofocus required>
            @error('email')
            <div id="validationEmail" class="invalid-feedback">{{ $message }}</div>
            @enderror
            <label for="password" class="form-label">Mot de passe</label>
            <input id="password" type="password" name="password" class="form-control mb-2 @error('password') is-invalid @enderror" value="{{ old('password') }}" placeholder="Votre mot de passe" required>
            @error('password')
            <div id="validationPassword" class="invalid-feedback">{{ $message }}</div>
            @enderror
            <label for="password_confirmation" class="form-label">Confirmation du mot de passe</label>
            <input id="password_confirmation" type="password" name="password_confirmation" class="form-control mb-2 @error('password_confirmation') is-invalid @enderror" value="{{ old('password_confirmation') }}" placeholder="Retapez votre mot de passe" aria-describedby="validationPasswordConfirmation" required>
            @error('password_confirmation')
            <div id="validationPasswordConfirmation" class="invalid-feedback">{{ $message }}</div>
            @enderror
            <button class="w-100 btn btn-lg btn-primary mt-3" type="submit">S'enregistrer</button>
            @if (session('status'))
                <div class="text-danger">{{ session('status') }}</div>
            @endif
        </form>
    </div>
@endsection
