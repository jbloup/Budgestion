@extends('layouts.app')

@section('content')
    <form method="POST" class="modal-card">
        <h1 class="title">Completez informations catégorie</h1>
        @csrf
        <div class="">
            <label for="name" class="label">Nom de la catégorie</label>
            <input id="name" type="text" name="name" class="input" value="{{ old('name') }}" autocomplete="name" placeholder="Nom catégorie" autofocus>
            @error('name')
            <span class="help is-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-4">
            <label for="email" class="label">Description catégorie</label>
            <input id="email" type="text" name="description" class="input" value="{{ old('description') }}" autocomplete="description" placeholder="Description" autofocus>
            @error('description')
            <span class="help is-danger">{{ $message }}</span>
            @enderror
        </div>
        <button type="submit" class="button is-primary">Créer une catégorie</button>
    </form>
@endsection
