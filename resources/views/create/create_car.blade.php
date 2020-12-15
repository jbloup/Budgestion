@extends('layouts.app')

@section('content')
    <form method="POST" class="modal-card">
        <h1 class="title">Completez informations voiture</h1>
        @csrf
        <div class="">
            <label for="name" class="label">Nom de la voiture</label>
            <input id="name" type="text" name="name" class="input" value="{{ old('name') }}" autocomplete="name" placeholder="Nom voiture" autofocus>
            @error('name')
            <span class="help is-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label for="email" class="label">Type de carburant</label>
            <input id="email" type="text" name="fuel" class="input" value="{{ old('fuel') }}" autocomplete="fueltype" placeholder="Carburant" autofocus>
            @error('fuel')
            <span class="help is-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label for="password" class="label">Kilométrage voiture</label>
            <input id="password" type="text" name="mileage" class="input" value="{{ old('mileage') }}" autocomplete="mileage" placeholder="Kilométrage" autofocus>
            @error('mileage')
            <span class="help is-danger">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="button is-primary">Créer une voiture</button>
    </form>
@endsection
