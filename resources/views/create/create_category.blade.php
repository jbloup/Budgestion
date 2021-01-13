@extends('layouts.app')

@section('content')
    <div class="card mb-6">
        <form method="POST" action="{{route('store_category')}}">
            @csrf
            <header class="card-header">
                <div class="card-header-title">
                    <h1 class="title">Complétez informations catégorie</h1>
                </div>
            </header>
            <div class="card-content">
                <div class="mb-5">
                    <label for="name" class="label">Nom de la catégorie</label>
                    <input id="name" type="text" name="name" class="input" value="{{ old('name') }}" autocomplete="name"
                           placeholder="Nom catégorie" autofocus>
                    @error('name')
                    <span class="help is-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="email" class="label">Description catégorie</label>
                    <textarea id="email" name="description" class="textarea" value="{{ old('description') }}"
                              autocomplete="description" placeholder="Description ..."></textarea>
                    @error('description')
                    <span class="help is-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <footer class="card-footer">
                <div class="card-footer-item column">
                    <button type="submit" class="button is-primary">Créer une catégorie</button>
                    @if($message_success != "")
                        <span class="help is-success">{{ $message_success }}</span>
                    @endif
                </div>
            </footer>
        </form>
    </div>
    <div class="card">
        <table class="table-container table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
            <thead>
            <tr class="is-selected">
                <th>Catégorie</th>
                <th>Description</th>
                <th>Modifier</th>
                <th>Supprimer</th>
            </tr>
            </thead>
            <tbody>
            @foreach($categories as $category)
                <tr>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->description }}</td>
                    <th>
                        <button id="modalButton" class="button is-primary"
                                onclick="document.getElementById({{ $category->id }}).style.display='block'"
                                data-target="modal-ter" aria-haspopup="true"><span class="icon"><i
                                    class="fas fa-pen"></i></span></button>
                    </th>
                    <th>
                        <button type="submit" id="delete" class="button is-danger"><a class="has-text-light"
                                                                                      href="{{ url('/create/category_delete?category_id='. $category->id) }}"><span
                                    class="icon"><i class="fas fa-trash-alt"></i></span></a></button>
                    </th>
                </tr>
                <!-- Modal Card -->
                <div id="{{ $category->id }}" class="modal">
                    <div class="modal-background"></div>
                    <div class="modal-card">
                        <header class="modal-card-head">
                            <p class="modal-card-title">Modification {{ $category->name }}</p>
                            <button class="delete" aria-label="close"
                                    onclick="document.getElementById({{ $category->id }}).style.display='none'"></button>
                        </header>
                        <section class="modal-card-body">
                            <!-- Content ... -->
                            <form method="POST" action="{{route('update_category')}}">
                                @csrf
                                <div class="card-content">
                                    <div class="mb-5">
                                        <label for="update_name" class="label">Nom de la catégorie</label>
                                        <input id="category_id" name="category_id" class="is-hidden"
                                               value="{{ $category->id }}">
                                        <input id="update_name" type="text" name="update_name" class="input"
                                               value="{{ $category->name }}"
                                               placeholder="Nom catégorie" autofocus>
                                    </div>
                                    <div class="mb-5">
                                        <label for="update_description" class="label">Description</label>
                                        <textarea id="update_description" name="update_description" class="textarea"
                                                  value="{{ $category->description }}"
                                                  placeholder="Description ...">{{ $category->description }}</textarea>
                                    </div>
                                </div>
                                <footer class="modal-card-foot">
                                    <button type="submit" class="button is-primary">Enregistrer</button>
                                </footer>
                            </form>
                            <!-- Content ... -->
                        </section>
                    </div>
                </div>
            @endforeach
            </tbody>
        </table>
        @error('name')
        <div class="card-footer-item">
            <span class="help is-danger">{{ $message }}</span>
        </div>
        @enderror
        @error('description')
        <div class="card-footer-item">
            <span class="help is-danger">{{ $message }}</span>
        </div>
        @enderror
        @if($message_updated != "")
            <div class="card-footer-item">
                <span class="help is-success">{{ $message_updated }}</span>
            </div>
        @endif
    </div>
@endsection
