@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-center mt-5 pt-5">
        <form method="POST" action="{{ route('password.email') }}" class="needs-validation" novalidate>
            @csrf
            <h1 class="h3 mb-3 fw-normal">Complétez vos informations</h1>
            <label for="email" class="form-label">Votre adresse Email</label>
            <input id="email" type="email" name="email" class="form-control mb-3 @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Votre email" aria-describedby="validationEmail" autofocus required>
            @error('email')
            <div id="validationEmail" class="invalid-feedback">{{ $message }}</div>
            @enderror
            <button class="w-100 btn btn-lg btn-primary mb-2" type="submit">Réinitialiser le mot de passe</button>
            @if (session('status'))
                <div class="text-danger">{{ session('status') }}</div>
            @endif
        </form>
    </div>
@endsection

