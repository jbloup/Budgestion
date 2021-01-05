@extends('layouts.app')

@section('content')
    <!-- Form Type -->
    <div class="card mb-6">
        <form method="POST" action="{{ route('store_type') }}">
            @csrf
            <div class="card-content">
                <div class="mb-5">
                    <label for="type_name" class="label">Nom du type</label>
                    <input id="type_name" type="text" name="type_name" class="input mb-2" value="{{ old('type_name') }}"
                           autocomplete="name" placeholder="Nom type" autofocus>
                    @error('type_name')
                    <span class="help is-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <footer class="card-footer">
                <div class="card-footer-item column">
                    <button type="submit" class="button is-primary">Créer une type</button>
                    @if($message_success != "")
                        <span class="help is-success">{{ $message_success }}</span>
                    @endif
                </div>
            </footer>
        </form>
    </div>
    <!-- Form Family -->
    <div class="card mb-6">
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
                    <button type="submit" class="button is-primary">Créer un Sous-Type</button>
                    @if($message_success_family != "")
                        <span class="help is-success">{{ $message_success_family }}</span>
                    @endif
                </div>
            </footer>
        </form>
    </div>
    <!-- Table -->
    <div class="card">
        <table class="table-container table is-bordered is-striped is-narrow is-hoverable is-fullwidth">

    @foreach($types as $type)
                <tr>
                    <th>{{ $type->name }}</th>
                    <th>
                        <button id="modalButton" class="button is-primary"
                                onclick="document.getElementById({{ $type->id }}).style.display='block'"
                                data-target="modal-ter" aria-haspopup="true"><span class="icon"><i
                                    class="fas fa-pen"></i></span></button>
                    </th>
                    <th>
                        @if($type->families->count() == 0)
                        <button type="submit" id="delete" class="button is-danger"><a class="has-text-light" href="{{ url('/create/type_delete?type_id='. $type->id) }}" ><span class="icon"><i class="fas fa-trash-alt"></i></span></a></button>
                        @else
                            <button type="submit" id="delete" class="button is-danger"><a class="has-text-light" ><span class="icon"><i class="fas fa-times-circle"></i></span></a></button>
                        @endif
                    </th>
                </tr>
                <!-- Modal Card Type -->
                <div id="{{ $type->id }}" class="modal">
                    <div class="modal-background"></div>
                    <div class="modal-card">
                        <header class="modal-card-head">
                            <p class="modal-card-title">Modification {{ $type->name }}</p>
                            <button class="delete" aria-label="close"
                                    onclick="document.getElementById({{ $type->id }}).style.display='none'"></button>
                        </header>
                        <section class="modal-card-body">
                            <!-- Content ... -->
                            <form method="POST" action="{{route('update_type')}}">
                                @csrf
                                <div class="card-content">
                                    <div class="mb-5">
                                        <label for="update_name" class="label">Nom du type</label>
                                        <input id="type_id" name="type_id" class="is-hidden" value="{{ $type->id }}">
                                        <input id="update_name" type="text" name="update_name" class="input"
                                               value="{{ $type->name }}"
                                               placeholder="Nom du type" autofocus>
                                    </div>
                                </div>
                                <footer class="modal-card-foot">
                                    <button type="submit" class="button is-primary">Enregistrer</button>
                                    <button class="button">Cancel</button>
                                </footer>
                            </form>
                            <!-- Content ... -->
                        </section>
                    </div>
                </div>
                <!-- End Modal Card Type -->
            @foreach ($type->families as $family)
                <tr>
                <td>{{ $family->name }}</td>
                    <th>
                        <button id="modalButton" class="button is-danger"
                                onclick="document.getElementById({{ $family->id }}).style.display='block'"
                                data-target="modal-ter" aria-haspopup="true"><span class="icon"><i
                                    class="fas fa-pen"></i></span></button>
                    </th>
                    <th>
                        <button type="submit" id="delete" class="button is-danger"><a class="has-text-light" href="{{ url('/create/subtype_delete?family_id='. $family->id) }}" ><span class="icon"><i class="fas fa-trash-alt"></i></span></a></button>
                    </th>
                </tr>
                    <!-- Modal Card Family -->
                    <div id="{{ $family->id }}" class="modal">
                        <div class="modal-background"></div>
                        <div class="modal-card">
                            <header class="modal-card-head">
                                <p class="modal-card-title">Modification {{ $family->name }}</p>
                                <button class="delete" aria-label="close"
                                        onclick="document.getElementById({{ $family->id }}).style.display='none'"></button>
                            </header>
                            <section class="modal-card-body">
                                <!-- Content ... -->
                                <form method="POST" action="{{route('update_family')}}">
                                    @csrf
                                    <div class="card-content">
                                        <div class="mb-5">
                                            <label for="update_name" class="label">Nom du sous-type</label>
                                            <input id="family_id" name="family_id" class="is-hidden" value="{{ $family->id }}">
                                            <input id="update_family_name" type="text" name="family_update_name" class="input"
                                                   value="{{ $family->name }}"
                                                   placeholder="Nom du sous-type" autofocus>
                                        </div>
                                        <div class="mb-5">
                                            <div class="control">
                                                <label for="update_family_type_id" class="label">Type</label>
                                                <div class="select">
                                                    <select id="update_family_type_id" name="update_family_type_id">
                                                        @foreach($types as $type)
                                                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <footer class="modal-card-foot">
                                        <button type="submit" class="button is-primary">Enregistrer</button>
                                        <button class="button">Cancel</button>
                                    </footer>
                                </form>
                                <!-- Content ... -->
                            </section>
                        </div>
                    </div>
                    <!-- End Modal Card Family -->
            @endforeach
    @endforeach
        </table>
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
    </div>
@endsection
