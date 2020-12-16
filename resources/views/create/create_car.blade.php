@extends('layouts.app')

@section('content')
    <form method="POST" class="modal-card">
        <h1 class="title">Completez informations voiture</h1>
        @csrf
        <div class="mb-5">
            <label for="name" class="label">Nom de la voiture</label>
            <input id="name" type="text" name="name" class="input" value="{{ old('name') }}" placeholder="Nom voiture" autofocus>
            @error('name')
            <span class="help is-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-5">
            <label for="fuel_type" class="label">Type de carburant</label>
            <input id="fuel_type" type="text" name="fuel_type" class="input" value="{{ old('fuel_type') }}" placeholder="Carburant" autofocus>
            @error('fuel_type')
            <span class="help is-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-5">
            <label for="mileage" class="label">Kilométrage voiture</label>
            <input id="mileage" type="text" name="mileage" class="input" value="{{ old('mileage') }}" placeholder="Kilométrage" autofocus>
            @error('mileage')
            <span class="help is-danger">{{ $message }}</span>
            @enderror
        </div>
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        <button type="submit" class="button is-primary">Créer une voiture</button>
    </form>
@endsection
