@extends('layouts.app')

@section('content')
    <!--Form Category-->
    <section class="hero is-medium is-primary is-bold">
        <div class="hero-body">
            <div class="container">
                <h1 class="title">
                    Nomenclature
                </h1>
                <h2 class="subtitle">
                    Créer de nouvelles catégories, types ou sous-type de dépense.
                </h2>
            </div>
        </div>
    </section>
    <section class="section is-small">
        <div class="container">
            <div class="columns">
                <div class="column">
                    <div class="card mb-3">
                        <header class="card-header">
                            <p class="card-header-title">
                                Catégorie
                            </p>
                        </header>
                        <form method="POST" action="{{route('store_category')}}">
                            @csrf
                            <div class="card-content">
                                <div class="mb-5">
                                    <label for="name" class="label">Nom de la catégorie</label>
                                    <input id="name" type="text" name="name" class="input" value="{{ old('name') }}"
                                           autocomplete="name"
                                           placeholder="Nom catégorie" autofocus>
                                    @error('name')
                                    <span class="help is-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-5">
                                    <label for="description" class="label">Description catégorie</label>
                                    <textarea id="description" name="description" class="textarea"
                                              value="{{ old('description') }}"
                                              autocomplete="description" placeholder="Description ..."></textarea>
                                    @error('description')
                                    <span class="help is-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <footer class="card-footer">
                                <div class="card-footer-item column">
                                    <button type="submit" class="button is-primary">
                                    <span class="icon is-small">
                                <i class="fas fa-sitemap"></i>
                                </span>
                                        <span>Créer une catégorie</span>
                                    </button>
                                    @if($message_success_category != "")
                                        <span class="help is-success">{{ $message_success_category }}</span>
                                    @endif
                                </div>
                            </footer>
                        </form>
                    </div>
                </div>
                <!-- Form Type -->
                <div class="column">
                    <div class="card mb-6">
                        <header class="card-header">
                            <p class="card-header-title">
                                Type
                            </p>
                        </header>
                        <form method="POST" action="{{ route('store_type') }}">
                            @csrf
                            <div class="card-content">
                                <div class="mb-5">
                                    <label for="type_name" class="label">Nom du type</label>
                                    <input id="type_name" type="text" name="type_name" class="input mb-2"
                                           value="{{ old('type_name') }}"
                                           autocomplete="name" placeholder="Nom type">
                                    @error('type_name')
                                    <span class="help is-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-5">
                                    <div class="control">
                                        <label for="type_category_id" class="label">Catégorie</label>
                                        <div class="select">
                                            <select id="type_category_id" name="type_category_id">
                                                <option value="">Catégorie...</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('type_category_id')
                                        <span class="help is-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <footer class="card-footer">
                                <div class="card-footer-item column">
                                    <button type="submit" class="button is-primary">
                                    <span class="icon is-small">
                                    <i class="fas fa-sitemap"></i>
                                </span>
                                        <span>Créer une type</span>
                                    </button>
                                    @if($message_success_type != "")
                                        <span class="help is-success">{{ $message_success_type }}</span>
                                    @endif
                                </div>
                            </footer>
                        </form>
                    </div>
                </div>
                <div class="column">
                    <!-- Form Family -->
                    <div class="card mb-6">
                        <header class="card-header">
                            <p class="card-header-title">
                                Sous-type
                            </p>
                        </header>
                        <form method="POST" action="{{ route('store_family') }}">
                            @csrf
                            <div class="card-content">
                                <div class="mb-5">
                                    <label for="family_name" class="label">Nom du sous-type</label>
                                    <input id="family_name" type="text" name="family_name" class="input mb-2"
                                           value="{{ old('family_name') }}" placeholder="Nom sous-type">
                                    @error('family_name')
                                    <span class="help is-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-5">
                                    <div class="control">
                                        <label for="family_type_id" class="label">Type</label>
                                        <div class="select">
                                            <select id="family_type_id" name="family_type_id">
                                                <option value="">Type...</option>
                                                @foreach($types as $type)
                                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    @error('family_type_id')
                                    <span class="help is-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <footer class="card-footer">
                                <div class="card-footer-item column">
                                    <button type="submit" class="button is-primary">
                                        <span class="icon is-small">
                                            <i class="fas fa-sitemap"></i>
                                        </span>
                                        <span>Créer un Sous-Type</span>
                                    </button>
                                    @if($message_success_family != "")
                                        <span class="help is-success">{{ $message_success_family }}</span>
                                    @endif
                                </div>
                            </footer>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Title Table -->
    </section>
    <section class="hero is-light">
        <div class="hero-body">
            <div class="container">
                <h1 class="title">
                    Nomenclature actuelle
                </h1>
                <h2 class="subtitle">
                </h2>
            </div>
        </div>
    </section>
    <!-- End Title Table -->
    <!-- Table -->
    <section class="section">
        <div class="container">
            <div class="columns is-multiline">
                @foreach($categories as $category)
                    <div class="column is-one-quarter">
                        <div class="card">
                            <header class="card-header">
                                <div class="container p-3">
                                    <div class="level">
                                        <div class="level-left">
                                            <div class="level-item">
                                                <h1 class="title is-4">{{ $category->name }}<br><span
                                                        class="content is-size-6 has-text-weight-light">{{ $category->description }}</span>
                                                </h1>
                                            </div>
                                        </div>
                                        <div class="level-right">
                                            <div class="level-item">
                                                <button id="modalButton" class="button"
                                                        onclick="document.getElementById({{ 1 . $category->id }}).style.display='block'"
                                                        data-target="modal-ter" aria-haspopup="true">
                                            <span class="icon-text is-small ">
                                                <span class="icon"><i class="fas fa-pen"></i>
                                                </span>
                                            </span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </header>
                            <div class="card-content">
                                <table
                                    class="table-container table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
                                    <thead>
                                    <tr class="is-selected">
                                        <th>Type / Sous-Type</th>
                                        <th>Modifier</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($category->types as $type)
                                        <tr>
                                            <th>{{$type->name}}</th>
                                            <th>
                                                <button id="modalButton" class="button"
                                                        onclick="document.getElementById({{ 2 . $type->id }}).style.display='block'"
                                                        data-target="modal-ter" aria-haspopup="true"><span
                                                        class="icon-text is-small "><span class="icon"><i
                                                                class="fas fa-pen"></i></span></span></button>
                                            </th>
                                        </tr>
                                        <!-- Modal Card Type -->
                                        <div id="{{ 2 . $type->id }}" class="modal">
                                            <div class="modal-background"></div>
                                            <div class="modal-card">
                                                <header class="modal-card-head">
                                                    <p class="modal-card-title">Modification {{ $type->name }}</p>
                                                    <button class="delete" aria-label="close"
                                                            onclick="document.getElementById({{ 2 . $type->id }}).style.display='none'"></button>
                                                </header>
                                                <!-- Modal Form Type -->
                                                <form method="POST" action="{{route('update_type')}}">
                                                    @csrf
                                                    <section class="modal-card-body">
                                                        <!-- Content ... -->
                                                        <div class="card-content">
                                                            <div class="mb-5">
                                                                <label for="update_type_name" class="label">Nom du
                                                                    type</label>
                                                                <input id="type_id" name="type_id" class="is-hidden"
                                                                       value="{{ $type->id }}">
                                                                <input id="update_type_name" type="text"
                                                                       name="update_type_name" class="input"
                                                                       value="{{ $type->name }}"
                                                                       placeholder="Nom du type" autofocus>
                                                            </div>
                                                        </div>
                                                        <div class="mb-5">
                                                            <div class="control">
                                                                <label for="update_type_category_id" class="label">Sous-type</label>
                                                                <div class="select">
                                                                    <select id="update_type_category_id"
                                                                            name="update_type_category_id">
                                                                        <option
                                                                            value="{{ $category->id }}">{{ $category->name}}</option>
                                                                        @foreach($categories as $cat)
                                                                            @if($cat->id != $category->id)
                                                                                <option
                                                                                    value="{{ $cat->id }}">{{ $cat->name }}</option>
                                                                            @endif
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- End Content ... -->
                                                    </section>
                                                    <footer class="modal-card-foot">
                                                        <button type="submit" class="button is-primary">Enregistrer
                                                        </button>
                                                        @if($type->families->count() == 0)
                                                                <a class="has-text-white button is-danger" href="{{ url('/create/type_delete?type_id='. $type->id) }}">Supprimer</a>
                                                        @endif
                                                    </footer>
                                                </form>
                                                <!-- End Modal Form Type -->
                                            </div>
                                        </div>
                                        <!-- End Modal Card Type -->
                                        @foreach($type->families as $family)
                                            <tr>
                                                <td>{{ $family->name }}</td>
                                                <th>
                                                    <button id="modalButton" class="button"
                                                            onclick="document.getElementById({{ 3 . $family->id }}).style.display='block'"
                                                            data-target="modal-ter" aria-haspopup="true"><span
                                                            class="icon-text is-small "><span class="icon"><i
                                                                    class="fas fa-pen"></i></span></span></button>
                                                </th>
                                            </tr>
                                            <!-- Modal Card Family -->
                                            <div id="{{ 3 . $family->id }}" class="modal">
                                                <div class="modal-background"></div>
                                                <div class="modal-card">
                                                    <header class="modal-card-head">
                                                        <p class="modal-card-title">Modification {{ $family->name }}</p>
                                                        <button class="delete" aria-label="close"
                                                                onclick="document.getElementById({{ 3 . $family->id }}).style.display='none'"></button>
                                                    </header>
                                                    <section class="modal-card-body">
                                                        <!-- Content ... -->
                                                        <form method="POST" action="{{ route('update_family') }}">
                                                            @csrf
                                                            <div class="card-content">
                                                                <div class="mb-5">
                                                                    <label for="update_name" class="label">Nom du
                                                                        sous-type</label>
                                                                    <input id="family_id" name="family_id"
                                                                           class="is-hidden"
                                                                           value="{{ $family->id }}">
                                                                    <input id="update_family_name" type="text"
                                                                           name="update_family_name"
                                                                           class="input"
                                                                           value="{{ $family->name }}"
                                                                           placeholder="Nom du sous-type" autofocus>
                                                                </div>
                                                                <div class="mb-5">
                                                                    <div class="control">
                                                                        <label for="update_family_type_id"
                                                                               class="label">Type</label>
                                                                        <div class="select">
                                                                            <select id="update_family_type_id"
                                                                                    name="update_family_type_id">
                                                                                <option value="{{ $type->id }}">{{ $type->name}}</option>
                                                                                @foreach($types as $typ)
                                                                                    @if($typ->id != $type->id)
                                                                                        <option
                                                                                            value="{{ $typ->id }}">{{ $typ->name }}</option>
                                                                                    @endif
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <footer class="modal-card-foot">
                                                                <button type="submit" class="button is-primary">
                                                                    Enregistrer
                                                                </button>
                                                                @if($family->spents->count() == 0)
                                                                    <a class="has-text-white button is-danger"
                                                                           href="{{ url('/create/subtype_delete?delete_family_id='. $family->id) }}">Supprimer</a>
                                                                @endif
                                                            </footer>
                                                        </form>
                                                        <!-- Content ... -->
                                                    </section>
                                                </div>
                                            </div>
                                            <!-- End Modal Card Family -->
                                        @endforeach
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- Modal Card Category -->
                    <div id="{{ 1 . $category->id }}" class="modal">
                        <div class="modal-background"></div>
                        <div class="modal-card">
                            <header class="modal-card-head">
                                <p class="modal-card-title">Modification {{ $category->name }}</p>
                                <button class="delete" aria-label="close"
                                        onclick="document.getElementById({{ 1 . $category->id }}).style.display='none'"></button>
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
                                        @if($category->types->count() == 0)
                                                <a class="has-text-white button is-danger" href="{{ url('/create/category_delete?category_id='. $category->id) }}">Supprimer</a>
                                        @endif
                                    </footer>
                                </form>
                                <!-- Content ... -->
                            </section>
                        </div>
                    </div>
                    <!-- End Modal Card Category -->
                @endforeach
            </div>
        </div>
    </section>
    <!-- End Table -->

    @error('update_name')
    <div class="card-footer-item">
        <span class="help is-danger">{{ $message }}</span>
    </div>
    @enderror
    @error('update_family_name')
    <div class="card-footer-item">
        <span class="help is-danger">{{ $message }}</span>
    </div>
    @enderror
    @error('update_family_type_id')
    <div class="card-footer-item">
        <span class="help is-danger">{{ $message }}</span>
    </div>
    @enderror
    @if($message_updated != "")
        <div class="card-footer-item">
            <span class="help is-success">{{ $message_updated }}</span>
        </div>
    @endif

@endsection
