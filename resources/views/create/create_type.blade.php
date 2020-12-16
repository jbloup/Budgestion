@extends('layouts.app')

@section('content')
    <form method="POST" class="modal-card mb-6 has-shadow">
        <h1 class="title">Completez informations type</h1>
        @csrf
        <div class="mb-5">
            <label for="name" class="label">Nom du type</label>
            <input id="name" type="text" name="name" class="input mb-2" value="{{ old('name') }}" autocomplete="name" placeholder="Nom voiture" autofocus>
            @error('name')
            <span class="help is-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-5">
            <label for="description" class="label">Description</label>
            <textarea id="description" name="description" class="textarea mb-2" value="{{ old('description') }}" placeholder="description .." autofocus></textarea>
            @error('description')
            <span class="help is-danger">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="button is-primary">Créer une type</button>
    </form>

    <form method="POST" class="modal-card">
        <h1 class="title">Completez informations sous-type</h1>
        @csrf
        <div class="mb-5">
            <label for="name" class="label">Nom du sous-type</label>
            <input id="name" type="text" name="name" class="input mb-2" value="{{ old('name') }}" placeholder="Nom voiture" autofocus>
            @error('name')
            <span class="help is-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-5">
            <label for="description" class="label">Description</label>
            <textarea id="description" name="description" class="textarea mb-2" value="{{ old('description') }}" placeholder="description .." autofocus></textarea>
            @error('description')
            <span class="help is-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-5">
            <div class="control">
                <div class="select is-primary">
                    <select>
                        <option>Select dropdown</option>
                        <option>With options</option>
                    </select>
                </div>
            </div>
        </div>

        <button type="submit" class="button is-primary">Créer un Sous-Type</button>
    </form>
@endsection
