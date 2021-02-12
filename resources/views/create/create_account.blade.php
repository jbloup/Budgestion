@extends('layouts.app')

@section('content')
    <section class="hero is-medium is-primary is-bold">
        <div class="hero-body">
            <div class="container">
                <h1 class="title">
                    Compte bancaire
                </h1>
                <h2 class="subtitle">
                    Créer un nouveau compte bancaire.
                </h2>
            </div>
        </div>
    </section>
    <section class="section is-small">
        <div class="container is-max-desktop">
        <form method="POST" action="{{ route('create_account') }}">
            @csrf
            @method('post')
                    <h1 class="title">Complétez les informations</h1>
            <div class="mb-5">
                <label for="number" class="label">Numéro de compte bancaire</label>
                <input id="number" type="text" name="number" class="input" value="{{ old('number') }}"
                       placeholder="Numéro de compte" autofocus>
                @error('number')
                <span class="help is-danger">{{ $message }}</span>
                @enderror
            </div>
                <div class="mb-5">
                    <label for="name" class="label">Nom du compte bancaire</label>
                    <input id="name" type="text" name="name" class="input" value="{{ old('name') }}"
                           placeholder="Nom du compte">
                    @error('name')
                    <span class="help is-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="description" class="label">Description du compte bancaire</label>
                    <textarea id="description" name="description" class="textarea" value="{{ old('description') }}"
                              autocomplete="description" placeholder="Description ..."></textarea>
                    @error('description')
                    <span class="help is-danger">{{ $message }}</span>
                    @enderror
                </div>
            <div class="mb-5">
                <label for="amount" class="label">Montant du compte bancaire</label>
                <input id="amount" type="number" step=".01" name="amount" class="input" value="{{ old('amount') }}"
                       placeholder="Montant du compte ..">
                @error('amount')
                <span class="help is-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-5">
            <label for="main" class="label">Compte principal <span class="tag is-warning is-small">
                            <span class="icon is-small has-text-white"><i class="fa fa-star"></i></span>
                            </span></label>
            <div class="control" id="main">
                <label class="radio">
                    <input type="radio" name="main" value="1">
                    Oui
                </label>
                <label class="radio">
                    <input type="radio" name="main" value="0">
                    Non
                </label>
                @error('main')
                <span class="help is-danger">{{ $message }}</span>
                @enderror
            </div>
            </div>
                    <button type="submit" class="button is-primary">
                    <span class="icon is-small">
                    <i class="fas fa-file-invoice-dollar"></i>
                    </span>
                        <span>Créer un compte bancaire</span>
                    </button>
            </form>
            @if (session('create'))
                <span class="help is-success">{{ session('create') }}</span>
            @endif
    </div>
    </section>
    <!-- End Form Account -->
    <!-- Title Table -->
    <section class="hero is-light">
        <div class="hero-body">
            <div class="container">
                <h1 class="title">
                    Liste des comptes bancaires
                </h1>
                <h2 class="subtitle">

                </h2>
            </div>
        </div>
    </section>
    <!-- End Title Table -->
    <!-- Table -->
    <section class="section">
        <div class="table-container">
        <table class="table-container table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
            <thead>
            <tr class="is-selected">
                <th>Numéro</th>
                <th>Nom</th>
                <th>Description</th>
                <th>Montant</th>
                <th>Modifier</th>
            </tr>
            </thead>
            <tbody>
            @foreach($accounts as $account)
                <tr>
                    <td>{{ $account->number }}</td>
                    <td>{{ $account->name }}
                        @if($account->main == 1)
                            <span class="tag is-warning is-small">
                            <span class="icon is-small has-text-white"><i class="fa fa-star"></i></span>
                            </span>
                        @endif
                    </td>
                    <td>{{ $account->description }}</td>
                    <td>{{ $account->amount }}</td>
                    <th>
                        <button id="modalButton" class="button"
                                onclick="document.getElementById({{ $account->id }}).style.display='block'"
                                data-target="modal-ter" aria-haspopup="true"><span class="icon"><i
                                    class="fas fa-pen"></i></span></button>
                    </th>
                </tr>
                <!-- Modal Card -->
                <div id="{{ $account->id }}" class="modal">
                    <div class="modal-background"></div>
                    <div class="modal-card">
                        <header class="modal-card-head">
                            @if($account->main == 1)
                                <span class="tag is-warning is-small mr-2">
                            <span class="icon is-small has-text-white"><i class="fa fa-star"></i></span>
                            </span>
                            @endif
                            <p class="modal-card-title">Modification {{ $account->name }}</p>
                            <button class="delete" aria-label="close"
                                    onclick="document.getElementById({{ $account->id }}).style.display='none'"></button>
                        </header>
                        <!-- Content  -->
                            <div class="modal-card-body">
                                <div class="card-content">
                                    <form method="POST" action="{{ url('/account', ['id' => $account->id]) }}">
                                        @method('put')
                                        @csrf
                                        <div class="mb-5">
                                        <label for="update_number" class="label">Numéro de compte bancaire</label>
                                         <input id="update_number" type="text" name="update_number" class="input" value="{{$account->number }}" placeholder="Numéro de compte">
                                        </div>
                                    <div class="mb-5">
                                        <label for="update_name" class="label">Nom du compte bancaire</label>
                                        <input id="update_name" type="text" name="update_name" class="input" value="{{ $account->name }}" placeholder="Nom compte bancaire" autofocus>
                                    </div>
                                    <div class="mb-5">
                                        <label for="update_description" class="label">Description du compte bancaire</label>
                                        <textarea id="update_description" name="update_description" class="textarea" placeholder="Description ...">{{ $account->description }}</textarea>
                                    </div>
                                    <div class="mb-5">
                                        <label for="update_amount" class="label">Montant du compte bancaire</label>
                                        <input id="update_amount" type="number" step=".01" name="update_amount" class="input" value="{{ $account->amount }}"
                                               placeholder="Montant du compte ..">
                                    </div>
                                    <div class="mb-5">
                                        <label for="main" class="label">Compte principal</label>
                                        <div class="control" id="main">
                                            <label class="radio">
                                                @if($account->main != 1)
                                                <input type="radio" name="update_main" value="1">
                                                Oui
                                            </label>
                                            <label class="radio">
                                                <input type="radio" name="update_main" value="0" checked>
                                                Non
                                            </label>
                                            @else
                                                <input type="radio" name="update_main" value="1" checked>
                                                Oui
                                                </label>
                                                <label class="radio">
                                                    <input type="radio" name="update_main" value="0">
                                                    Non
                                                </label>
                                                @endif
                                        </div>
                                    </div>
                                <button type="submit" class="button is-primary">Enregistrer</button>
                            </form>
                                </div>
                                <!-- Content ... -->
                            </div>
                                    <footer class="modal-card-foot">
                                    @if($account->spents->count() == 0)
                                        <form action="{{ url('/account', ['id' => $account->id]) }}" method="post">
                                            @method('delete')
                                            @csrf
                                            <button class=" button is-danger" type="submit"><span>Supprimer</span></button>
                                        </form>
                                    @endif
                                    </footer>
                        <!-- End Content -->
                    </div>
                <!-- End Modal Card -->
            @endforeach
            </tbody>
        </table>
        </div>
    </section>
    <!-- End Table -->
    <!-- message -->
    @error('update_name')
    <div class="card-footer-item">
        <span class="help is-danger">{{ $message }}</span>
    </div>
    @enderror
    @error('update_number')
    <div class="card-footer-item">
        <span class="help is-danger">{{ $message }}</span>
    </div>
    @enderror
    @error('update_amount')
    <div class="card-footer-item">
        <span class="help is-danger">{{ $message }}</span>
    </div>
    @enderror
    @error('update_main')
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
    <!-- end message -->
@endsection



