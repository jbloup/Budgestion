@extends('layouts.app')

@section('content')
    <div class="card mb-6">
        <form method="POST" action="{{route('store_account')}}">
            @csrf
            <header class="card-header">
                <div class="card-header-title">
                    <h1 class="title">Complétez informations</h1>
                </div>
            </header>
            <div class="card-content">
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
            </div>
            <footer class="card-footer">
                <div class="card-footer-item column">
                    <button type="submit" class="button is-primary">
                    <span class="icon is-small">
                    <i class="fas fa-file-invoice-dollar"></i>
                    </span>
                        <span>Créer un compte bancaire</span>
                    </button>
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
                        <button id="modalButton" class="button is-primary"
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
                        <!-- Content ... -->
                            <section class="modal-card-body">
                                <div class="card-content">
                                    <form method="POST" action="{{route('update_account')}}">
                                        @csrf
                                        <div class="mb-5">
                                        <label for="update_number" class="label">Numéro de compte bancaire</label>
                                         <input id="update_number" type="text" name="update_number" class="input" value="{{$account->number }}" placeholder="Numéro de compte">
                                        </div>
                                    <div class="mb-5">
                                        <label for="update_name" class="label">Nom du compte bancaire</label>
                                        <input id="account_id" name="account_id" class="is-hidden" value="{{ $account->id }}">
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
                                    <footer class="modal-card-foot">
                                        <button type="submit" class="button is-success">
                                        <span class="icon">
                                            <i class="fas fa-check"></i></span>
                                            <span>Enregistrer</span>
                                        </button>
                                        <button type="submit" id="delete" class="button is-danger">
                                            <a class="has-text-light" href="{{ url('/create/account_delete?account_id='. $account->id) }}">Supprimer</a>
                                        </button>
                                    </footer>
                        </form>
                                </div>
                            </section>
                        <!-- Content ... -->
                    </div>
                </div>
            @endforeach
            </tbody>
        </table>
    </div>
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
    @if($message_updated != "")
        <div class="card-footer-item">
            <span class="help is-success">{{ $message_updated }}</span>
        </div>
    @endif
    <!-- end message -->
@endsection



