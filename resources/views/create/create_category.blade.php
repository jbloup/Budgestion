@extends('layouts.app')

@section('content')
    <form method="POST" class="modal-card">
        <h1 class="title">Completez informations catégorie</h1>
        @csrf
        <div class="mb-5">
            <label for="name" class="label">Nom de la catégorie</label>
            <input id="name" type="text" name="name" class="input" value="{{ old('name') }}" autocomplete="name" placeholder="Nom catégorie" autofocus>
            @error('name')
            <span class="help is-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-5">
            <label for="email" class="label">Description catégorie</label>
            <textarea id="email"  name="description" class="textarea" value="{{ old('description') }}" autocomplete="description" placeholder="Description"></textarea>
            @error('description')
            <span class="help is-danger">{{ $message }}</span>
            @enderror
        </div>
        <button type="submit" class="button is-primary">Créer une catégorie</button>
        @if($message_success != "")
            <span class="help is-success">{{ $message_success }}</span>
        @endif
    </form>
    <div class="container">
        @foreach($categories as $category)
            <div>{{ $category->name }}</div>
            <div>{{ $category->description }}</div>
        @endforeach
    </div>
@endsection
