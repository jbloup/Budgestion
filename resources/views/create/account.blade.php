@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- Lateral nav -->
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky pt-3">
                    <h5 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                        <span>Création</span>
                    </h5>
                    <ul class="nav flex-column mb-2">
                        <li>
                            <a class="nav-link link-secondary" aria-current="page" href="{{ route('category') }}">
                                <span data-feather="package"></span>
                                Nomenclature
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link link-secondary" href="{{ route('car') }}">
                                <span data-feather="truck"></span>
                                Véhicule
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('account') }}">
                                <span data-feather="book-open"></span>
                                Compte
                            </a>
                        </li>
                    </ul>
                    <hr>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link link-secondary" href="{{ route('spent') }}">
                                <span data-feather="credit-card"></span>
                                Dépense
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link link-secondary" href="{{ route('fuel') }}">
                                <span data-feather="tool"></span>
                                Dépense carburant
                            </a>
                        </li>
                    </ul>
                    <hr>
                        <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link link-secondary" href="{{ route('earning') }}">
                                <span data-feather="dollar-sign"></span>
                                Revenu
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
            <!-- End lateral nav -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 id="account" class="h2">Compte bancaire</h1>
                </div>
                <!-- Car Form -->
                <div class="row">
                    <div class="col-md-6">
                        <form method="POST" action="{{route('create.account')}}" class="needs-validation form-control" novalidate>
                            @csrf
                            <div class="row pt-3 mb-3">
                                <div class="col">
                                    <label for="name" class="form-label">Nom du compte bancaire</label>
                                    <input id="name" type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="Nom du compte ..." aria-describedby="validationName" required>
                                    @error('name')
                                    <div id="validationName" class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="description" class="form-label">Description du compte bancaire</label>
                                    <textarea id="description" name="description" class="form-control" value="{{ old('description') }}" placeholder="Description ..." aria-describedby="validationDescription" required></textarea>
                                    @error('description')
                                    <div id="validationDescription" class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="number" class="form-label">Numéro de compte bancaire</label>
                                    <input id="number" type="number" name="number" class="form-control" value="{{ old('number') }}" placeholder="Numéro de compte ..." aria-describedby="validationNumber" required>
                                    @error('number')
                                    <div id="validationNumber" class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="amount" class="form-label">Montant du compte bancaire</label>
                                    <input id="amount" type="number" step=".01" name="amount" class="form-control" value="{{ old('amount') }}" placeholder="Montant du compte .." aria-describedby="validationAmount" required>
                                    @error('amount')
                                    <div id="validationAmount" class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label class="form-label">Compte principal</label>
                                    <div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="main" id="main1" value="1">
                                            <label class="form-check-label" for="main1">oui</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="main" id="main2" value="0" checked>
                                            <label class="form-check-label" for="main2">non</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <button class="btn btn-primary" type="submit">Créer compte bancaire</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- End Form -->
                    <div class="col-md-6">
                        <p>Ici vous pouvez créer et modifier vos différents comptes bancaire.
                            <br>
                            Les dépenses et les revenus peuvent être imputés dessus si vous le souhaitez</p>
                    </div>
                </div>
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h2 id="listCar">Liste des dépense de accountburants</h2>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group me-2">
                            <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
                            <button type="button" class="btn btn-sm btn-outline-secondary">Import</button>
                        </div>
                    </div>
                </div>
                <!-- Car Table -->
                <div class="table-responsive">
                    <table class="table table-hover table-sm">
                        <thead>
                        <tr>
                            <th>Numéro</th>
                            <th>Désignation</th>
                            <th>Description</th>
                            <th>Montant</th>
                            <th>Principal</th>
                            <th>Modifier</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($accounts as $account)
                            <tr id="{{ 'account' . $account->id . 'enabled' }}" @if($account->main == 1) class="table-info" @endif>
                                <td>{{ $account->number }}</td>
                                <td>{{ $account->name}}</td>
                                <td>{{ $account->description }}</td>
                                <td>{{ $account->amount }}</td>
                                <td>
                                    @if($account->main == 1)
                                        Oui
                                    @else
                                        Non
                                    @endif
                                </td>
                                <td><button class="btn" onclick="document.getElementById('{{  'account' . $account->id . 'disabled' }}').className =' '; document.getElementById('{{  'account' . $account->id . 'enabled' }}').className =' d-none'">
                                        <i class="fas fa-pen"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr id="{{  'account' . $account->id . 'disabled' }}" class="d-none">
                                <form id="{{ 'account' . $account->id . 'update' }}" method="POST" action="{{ url('/account', ['id' => $account->id]) }}">
                                    @method('put')
                                    @csrf
                                    <td><input id="update_number" type="number" name="update_number" class="form-control" value="{{ $account->number }}" placeholder="Numéro de compte" required></td>
                                    <td><input id="update_name" type="text" name="update_name" class="form-control" value="{{ $account->name }}" placeholder="Désignation du compte" required></td>
                                    <td><input id="update_description" type="text" name="update_description" class="form-control" value="{{ $account->description }}" placeholder="Description du compte" required></td>
                                    <td><input id="update_amount" type="number" step=".01" name="update_amount" class="form-control" value="{{ $account->amount }}" placeholder="Montant du compte .." required></td>
                                    <td><label class="radio">
                                            @if($account->main != 1)
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="update_main" id="update_main1" value="1">
                                                    <label class="form-check-label" for="main1">oui</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="update_main" id="update_main2" value="0" checked>
                                                    <label class="form-check-label" for="main2">non</label>
                                                </div>
                                            @else
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="update_main" id="update_main1" value="1" checked>
                                                    <label class="form-check-label" for="main1">oui</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="update_main" id="update_main2" value="0">
                                                    <label class="form-check-label" for="main2">non</label>
                                                </div>
                                        @endif</td>
                                </form>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button class="btn btn-outline-success" type="submit" onclick="document.getElementById('{{  'account' . $account->id . 'enabled' }}').className =' '; document.getElementById('{{  'account' . $account->id . 'disabled' }}').className =' d-none'; document.getElementById('{{ 'account' . $account->id . 'update' }}').submit();">
                                            <i class="far fa-check-circle"></i>
                                        </button>
                                        <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="{{ '#' . 'account' . $account->id . 'delete' }}" @if($account->spents->count() != 0) disabled @endif>
                                            <i class="far fa-trash-alt"></i>
                                        </button>
                                        <button type="button" class="btn btn-outline-secondary" onclick="document.getElementById('{{  'account' . $account->id . 'enabled' }}').className =' '; document.getElementById('{{  'account' . $account->id . 'disabled' }}').className =' d-none'">
                                            <i class="far fa-times-circle"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <!-- Modal -->
                            <div class="modal fade" id="{{ 'account' . $account->id . 'delete' }}" tabindex="-1" aria-labelledby="{{ '#' . 'account' . $account->id . 'label' }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <form action="{{ url('/account', ['id' => $account->id]) }}" method="post">
                                                @method('delete')
                                                @csrf
                                                <p class="border-bottom pb-3 mb-4">Voulez vous supprimer le dépense de le compte {{ $account->name }} ?</p>
                                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                                    <button class="btn btn-primary me-md-2" type="submit">
                                                        Oui
                                                    </button>
                                                    <button class="btn btn-light" data-bs-dismiss="modal" aria-label="Close">Annuler</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- End Table -->
            </main>
        </div>
    </div>
@endsection


