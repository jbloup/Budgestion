@extends('layouts.app')

@section('content')
    <form method="POST" class="modal-typed mb-6">
        <h1 class="title">Completez informations type</h1>
        @csrf
        <div class="mb-5">
            <label for="type_name" class="label">Nom du type</label>
            <input id="type_name" type="text" name="type_name" class="input mb-2" value="{{ old('type_name') }}" autocomplete="name" placeholder="Nom type" autofocus>
            @error('type_name')
            <span class="help is-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-5">
            <label for="type_description" class="label">Description</label>
            <textarea id="description" name="type_description" class="textarea mb-2" value="{{ old('type_description') }}" placeholder="description .."></textarea>
            @error('type_description')
            <span class="help is-danger">{{ $message }}</span>
            @enderror
        </div>
        @if($message_success != "")
            <span class="help is-success">{{ $message_success }}</span>
        @endif
        <button type="submit" class="button is-primary">Créer une type</button>
    </form>
    <form method="POST" class="modal-typed" action="{{ route('family') }}">
        <h1 class="title">Completez informations sous-type</h1>
        @csrf
        <div class="mb-5">
            <label for="family_name" class="label">Nom du sous-type</label>
            <input id="family_name" type="text" name="family_name" class="input mb-2" value="{{ old('family_name') }}" placeholder="Nom sous-type">
            @error('family_name')
            <span class="help is-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-5">
            <label for="family_description" class="label">Description</label>
            <textarea id="family_description" name="family_description" class="textarea mb-2" value="{{ old('family_description') }}" placeholder="description .."></textarea>
            @error('family_description')
            <span class="help is-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-5">
            <div class="control">
                <div class="select">

                    <select id="type_id" name="type_id" class="select">
                        <option value="">Type...</option>
                        @foreach($types as $type)
                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            @error('type_id')
            <span class="help is-danger">{{ $message }}</span>
            @enderror
        </div>
        <button type="submit" class="button is-primary">Créer un Sous-Type</button>
        @if($message_success_family != "")
            <span class="help is-success">{{ $message_success_family }}</span>
        @endif
    </form>
    <div class="container">
        @foreach($types as $type)
            <div>{{ $type->name }}</div>
            <div>{{ $type->description }}</div>
           @foreach($families as $family)
                <div>{{ $family->name }}</div>
        @endforeach
        @endforeach

    </div>
@endsection
