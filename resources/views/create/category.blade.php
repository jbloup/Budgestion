@extends('layouts.app')

@section('content')
    <!--Form Nomenclature-->
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
    <!-- New version Table -->
    <section class="section is-small">
        <div class="container is-flex is-justify-content-center">
            <div class="table-container">
                <table class="table has-text-centered is-hoverable is-striped is-fullwidth">
                    <thead>
                    <tr class="is-selected">
                        <th>Catégorie</th>
                        <th>Type</th>
                        <th>Sous-type</th>
                    </tr>
                    </thead>
                    @foreach($categories as $category)
                        <tr>
                            <th>
                                <button class="button is-fullwidth is-small is-outlined" id="modalButton"
                                        onclick="document.getElementById({{ 1 . $category->id }}).style.display='block'"
                                        data-target="modal-ter" aria-haspopup="true">
                                    <span>{{$category->name}}</span>
                                </button>
                            </th>
                        </tr>
                        @foreach($category->types as $type)
                            <tr>
                                <td>
                                    <span class="icon is-small">
                                        <i class="fas fa-level-up-alt"></i>
                                    </span>
                                </td>
                                <td>
                                    <button class="button is-fullwidth is-small is-outlined" id="modalButton"
                                            onclick="document.getElementById({{ 2 . $type->id }}).style.display='block'"
                                            data-target="modal-ter" aria-haspopup="true">
                                        <span>{{ $type->name }}</span>
                                    </button>
                                </td>
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
                                    <!-- Content -->
                                    <div class="modal-card-body">
                                        <form action="{{ url('/type', ['id' => $type->id]) }}" method="post">
                                            @csrf
                                            @method('put')
                                            <div class="card-content">
                                                <div class="field mb-5">
                                                    <label for="update_type_name" class="label">Nom du
                                                        type</label>
                                                    <input id="update_type_name" type="text"
                                                           name="update_type_name" class="input"
                                                           value="{{ $type->name }}"
                                                           placeholder="Nom du type" autofocus>
                                                </div>
                                                <div class="field mb-5">
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
                                                <button type="submit" class="button is-primary">
                                                    Enregistrer
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- End Content ... -->
                                    <footer class="modal-card-foot">
                                        @if($type->families->count() == 0)
                                            <form action="{{ url('/type', ['id' => $type->id]) }}"
                                                  method="post">
                                                @method('delete')
                                                @csrf
                                                <button class="button is-danger" type="submit"><span>Supprimer</span>
                                                </button>
                                            </form>
                                        @endif
                                    </footer>
                                </div>
                            </div>
                            <!-- End Modal Card Type -->
                            @foreach($type->families as $family)
                                <tr>
                                    <td></td>
                                    <td>
                                        <span class="icon">
                                            <i class="fas fa-level-up-alt"></i>
                                        </span>
                                    </td>
                                    <td>
                                        <button class="button is-fullwidth is-small is-outlined" id="modalButton"
                                                onclick="document.getElementById({{ 3 . $family->id }}).style.display='block'"
                                                data-target="modal-ter" aria-haspopup="true">
                                            <span>{{ $family->name }}</span>
                                        </button>
                                    </td>
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
                                        <!-- Content -->
                                        <div class="modal-card-body">
                                            <form action="{{ url('/subtype', ['id' => $family->id]) }}" method="post">
                                                @csrf
                                                @method('put')
                                                <div class="card-content">
                                                    <div class="field mb-5">
                                                        <label for="update_name" class="label">Nom du
                                                            sous-type</label>
                                                        <input id="update_family_name" type="text"
                                                               name="update_family_name"
                                                               class="input"
                                                               value="{{ $family->name }}"
                                                               placeholder="Nom du sous-type" autofocus>
                                                    </div>
                                                    <div class="field mb-5">
                                                        <div class="control">
                                                            <label for="update_family_type_id"
                                                                   class="label">Type</label>
                                                            <div class="select">
                                                                <select id="update_family_type_id"
                                                                        name="update_family_type_id">
                                                                    <option
                                                                        value="{{ $type->id }}">{{ $type->name}}</option>
                                                                    @foreach($category->types as $typ)
                                                                        @if($typ->id != $type->id)
                                                                            <option
                                                                                value="{{ $typ->id }}">{{ $typ->name }}</option>
                                                                        @endif
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <button type="submit" class="button is-primary">
                                                        Enregistrer
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- End Content ... -->
                                        <footer class="modal-card-foot">
                                            @if($family->spents->count() == 0)
                                                <form action="{{ url('/subtype', ['id' => $family->id]) }}"
                                                      method="post">
                                                    @method('delete')
                                                    @csrf
                                                    <button class="button is-danger" type="submit"><span>Supprimer</span>
                                                    </button>
                                                </form>
                                            @endif
                                        </footer>
                                    </div>
                                </div>
                                <!-- End Modal Family Card -->
                            @endforeach
                            <tr>
                                <td></td>
                                <td>
                                    <span class="icon is-small">
                                        <i class="fas fa-level-up-alt"></i>
                                    </span>
                                </td>
                                <td>
                                    <form method="POST" action="{{ route('create.family') }}">
                                        @csrf
                                        @method('post')
                                        <div class="field has-addons">
                                            <div class="control">
                                                <input id="family_name" type="text" name="family_name" class="input is-small" value="{{ old('family_name') }}" placeholder="Nom sous-type">
                                                <input id="family_type_id" name="family_type_id" class="is-hidden" value="{{ $type->id }}">
                                            </div>
                                            <div class="control">
                                                <button type="submit" class="button is-small">
                                                    <span class="icon is-small">
                                                        <i class="fas fa-plus"></i>
                                                    </span>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td>
                                <span class="icon is-small">
                                    <i class="fas fa-level-up-alt"></i>
                                </span>
                            </td>
                            <td>
                                <form method="POST" action="{{ route('create.type') }}">
                                    @csrf
                                    @method('post')
                                    <div class="field has-addons">
                                        <div class="control">
                                            <input id="type_name" type="text" name="type_name" class="input is-small" value="{{ old('type_name') }}" placeholder="Nom type">
                                            <input id="type_category_id" name="type_category_id" class="is-hidden" value="{{ $category->id }}">
                                        </div>
                                        <div class="control">
                                            <button type="submit" class="button is-small">
                                                    <span class="icon is-small">
                                                        <i class="fas fa-plus"></i>
                                                    </span>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </td>
                        </tr>
                    <tr class="is-selected">
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                        <!-- Modal Category Card -->
                        <div id="{{ 1 . $category->id }}" class="modal">
                            <div class="modal-background"></div>
                            <div class="modal-card">
                                <header class="modal-card-head">
                                    <p class="modal-card-title">Modification {{ $category->name }}</p>
                                    <button class="delete" aria-label="close"
                                            onclick="document.getElementById({{ 1 . $category->id }}).style.display='none'"></button>
                                </header>
                                <!-- Content -->
                                <div class="modal-card-body">
                                    <form action="{{ url('/category', ['id' => $category->id]) }}" method="post">
                                        @csrf
                                        @method('put')
                                        <div class="card-content">
                                            <div class="field mb-5">
                                                <label for="update_name" class="label">Nom de la catégorie</label>
                                                <input id="update_name" type="text" name="update_name" class="input"
                                                       value="{{ $category->name }}"
                                                       placeholder="Nom catégorie" autofocus>
                                            </div>
                                            <div class="field mb-5">
                                                <label for="update_kind" class="label">Genre</label>
                                                <textarea id="update_kind" name="update_kind" class="textarea"
                                                          value="{{ $category->kind }}"
                                                          placeholder="Genre ...">{{ $category->kind }}</textarea>
                                            </div>

                                            <button type="submit" class="button is-primary">Enregistrer</button>
                                        </div>
                                    </form>
                                </div>
                                <!-- End Content ... -->
                                <footer class="modal-card-foot">
                                    @if($category->types->count() == 0)
                                        <form action="{{ url('/category', ['id' => $category->id]) }}" method="post">
                                            @method('delete')
                                            @csrf
                                            <button class="button is-danger" type="submit"><span>Supprimer</span></button>
                                        </form>
                                    @endif
                                </footer>
                            </div>
                        </div>
                        <!-- End Modal Category Card -->
                    @endforeach
                    <tr>
                        <td>
                            <form method="POST" action="{{ route('create.category') }}">
                                @csrf
                                @method('post')
                                <div class="field has-addons">
                                    <div class="control">
                                        <input id="name" type="text" name="name" class="input is-small" value="{{ old('name') }}" placeholder="Nom catégorie">
                                        <input id="kind" type="text" name="kind" class="is-hidden" value="spent">
                                    </div>
                                    <div class="control">
                                        <button type="submit" class="button is-small">
                                                    <span class="icon is-small">
                                                        <i class="fas fa-plus"></i>
                                                    </span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </section>
    <!-- End new version Table -->

    @error('name')
    <span class="help is-danger">{{ $message }}</span>
    @enderror

    @error('type_name')
    <span class="help is-danger">{{ $message }}</span>
    @enderror

    @error('family_name')
    <span class="help is-danger">{{ $message }}</span>
    @enderror

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
    @if (session('delete'))
        <span class="help is-success">{{ session('delete') }}</span>
    @endif
    @if (session('update'))
        <span class="help is-success">{{ session('update') }}</span>
    @endif
@endsection
