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
                            <a class="nav-link link-secondary" href="{{ route('account') }}">
                                <span data-feather="book-open"></span>
                                Compte
                            </a>
                        </li>
                    </ul>
                    <hr>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('spent') }}">
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
                    <h1 id="spent" class="h2">Dépenses</h1>
                </div>
                <!-- Spent Form -->
                <div class="row">
                    <div class="col-md-6">
                        <form method="POST" action="{{route('create.spent')}}" class="needs-validation form-control" novalidate>
                            @csrf
                            <div class="row pt-3 mb-3">
                                <div class="col">
                                    <label for="name" class="form-label">Désignation du dépense</label>
                                    <input id="name" type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Nom dépense ..." aria-describedby="validationName" required>
                                    @error('name')
                                    <div id="validationName" class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="description" class="form-label">Description du dépense</label>
                                    <textarea id="description" name="description" class="form-control" value="{{ old('description') }}" placeholder="Description dépense ..."></textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="price" class="form-label">Montant du dépense</label>
                                    <input id="price" type="number"  step=".01" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}" placeholder="Prix ..." aria-describedby="validationPrice" required>
                                    @error('price')
                                    <div id="validationPrice" class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="date" class="form-label">Date du dépense</label>
                                    <input id="date" type="date" name="date" class="form-control @error('date') is-invalid @enderror"
                                           @if(old('date'))
                                           value="{{ old('date') }}"
                                           @else
                                           value="{{ date('d-m-Y') }}"
                                           @endif
                                           placeholder="JJ-MM-YYYY" aria-describedby="validationDate" required>
                                    @error('date')
                                    <div id="validationDate" class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="family_id" class="form-label">Type de dépense</label>
                                    <select class="form-select @error('family_id') is-invalid @enderror" id="family_id" name="family_id" aria-describedby="validationFamily" required>
                                        <option value="">type de dépense ...</option>
                                        @foreach($categories as $category)
                                            @foreach($category->types as $type)
                                                @foreach($type->families as $family)
                                                    <option value="{{ $family->id }}">{{ $category->name . ' / ' . $type->name . ' / ' . $family->name }}</option>
                                                @endforeach
                                            @endforeach
                                        @endforeach
                                    </select>
                                    @error('family_id')
                                    <div id="validationFamily" class="invalid-feedback">{{ $message }}</div>
                                    <p class="text-danger" >{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="account_id" class="form-label">Compte bancaire</label>
                                    <select class="form-select @error('account_id') is-invalid @enderror" id="account_id" name="account_id" aria-describedby="validationAccount" required>
                                        @foreach($accounts as $account)
                                            <option value="{{$account->id}}">{{$account->number . " : " . $account->name}}
                                                @if($account->main == 1)
                                                    | principal
                                                @endif
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('account_id')
                                    <div id="validationAccount" class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <button class="btn btn-primary" type="submit">Créer dépense</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- End Form -->
                    <div class="col-md-6">
                        <p>Aliquam quam nibh, tincidunt vitae risus et, mollis convallis tellus. Integer eros est, commodo at bibendum at, facilisis ut mi. Praesent tortor ex, pharetra eu massa ullamcorper, dapibus lacinia lectus. Nullam interdum venenatis ipsum vitae pulvinar. Duis sodales nisl et augue varius, sed pretium dolor iaculis. Morbi tempus sollicitudin magna, ac condimentum orci porttitor non. Pellentesque convallis imperdiet urna, vitae tempor turpis convallis et. Duis eget odio elit. Nullam nec ullamcorper nisi, vel tincidunt ligula. Mauris semper mauris metus, et facilisis dui congue quis. Vestibulum tempor quam a enim ultrices, sit amet euismod nulla tempor.</p>
                    </div>
                </div>
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h2 id="ListSpent">Liste des dépenses</h2>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group me-2">
                            <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
                            <button type="button" class="btn btn-sm btn-outline-secondary">Import</button>
                        </div>
                    </div>
                </div>
                <!-- Spent Table -->
                <div class="table-responsive">
                    <table class="table table-hover table-sm">
                        <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Description</th>
                            <th>Montant</th>
                            <th>Date</th>
                            <th>Type</th>
                            <th>Compte Bancaire</th>
                            <th>Modifier</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($spents as $spent)
                            <tr id="{{ str_replace(' ', '', $spent->name) . $spent->id . 'enabled' }}">
                                <td>{{ $spent->name }}</td>
                                <td>{{ $spent->description }}</td>
                                <td>{{ $spent->price . ' €' }}</td>
                                <td>{{ date('d-m-Y', strtotime($spent->date)) }}</td>
                                <td>{{ $spent->family->name }}</td>
                                <td>{{ $spent->account->name }}</td>
                                <td><button class="btn" onclick="document.getElementById('{{  str_replace(' ', '', $spent->name) . $spent->id . 'disabled' }}').className =' '; document.getElementById('{{ str_replace(' ', '', $spent->name) . $spent->id . 'enabled' }}').className =' d-none'">
                                        <i class="fas fa-pen"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr id="{{  str_replace(' ', '', $spent->name) . $spent->id . 'disabled' }}" class="d-none">
                                <form id="form-update-spent" method="POST" action="{{ url('/spent', ['id' => $spent->id]) }}">
                                    @method('put')
                                    @csrf
                                    <td><input id="update_spent_name" type="text" name="update_spent_name" class="form-control" value="{{ $spent->name }}" placeholder="Nom du dépense" required></td>
                                    <td><input id="update_spent_description" name="update_spent_description" class="form-control" value="{{ $spent->description }}" placeholder="Description dépense ..."></td>
                                    <td><input id="update_spent_price" type="number"  step=".01" name="update_spent_price" class="form-control" value="{{ $spent->price }}" placeholder="Prix ..." required></td>
                                    <td><input id="update_spent_date" type="date" name="update_spent_date" class="form-control" value="{{ date('d-m-Y', strtotime($spent->date)) }}" required></td>
                                    <td><select id="update_family_id" name="update_family_id" class="form-select">
                                            <option value="{{ $spent->family->id }}">{{ $category->name . ' / ' . $type->name . ' / ' . $spent->family->name}}</option>
                                            @foreach($categories as $category)
                                                @foreach($category->types as $type)
                                                    @foreach($type->families as $family)
                                                        @if($family->id != $spent->family->id)
                                                            <option value="{{ $family->id }}">{{ $category->name . ' / ' . $type->name . ' / ' . $family->name }}</option>
                                                        @endif
                                                    @endforeach
                                                @endforeach
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select id="update_account_id" name="update_account_id" class="form-select">
                                            <option value="{{ $spent->account->id }}">{{ $spent->account->name}}
                                                @if($spent->account->main == 1)
                                                    | principal
                                                @endif
                                            </option>
                                            @foreach($accounts as $account)
                                                @if($account->id != $spent->account->id)
                                                    <option value="{{$account->id}}">{{$account->name}}
                                                        @if($account->main == 1)
                                                            | principal
                                                        @endif
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </td>
                                </form>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button class="btn btn-outline-success" type="submit" onclick="document.getElementById('{{ str_replace(' ', '', $spent->name) . $spent->id . 'enabled' }}').className =' '; document.getElementById('{{  str_replace(' ', '', $spent->name) . $spent->id . 'disabled' }}').className =' d-none'; document.getElementById('form-update-spent').submit();">
                                            <i class="far fa-check-circle"></i>
                                        </button>
                                        <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="{{ '#' . str_replace(' ', '', $spent->name) . $spent->id . 'delete' }}">
                                            <i class="far fa-trash-alt"></i>
                                        </button>
                                        <button type="button" class="btn btn-outline-secondary" onclick="document.getElementById('{{ str_replace(' ', '', $spent->name) . $spent->id . 'enabled' }}').className =' '; document.getElementById('{{  str_replace(' ', '', $spent->name) . $spent->id . 'disabled' }}').className =' d-none'">
                                            <i class="far fa-times-circle"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <!-- Modal -->
                            <div class="modal fade" id="{{ 'spent' . $spent->id . 'delete' }}" tabindex="-1" aria-labelledby="{{ 'spent' . $spent->id . 'label' }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <form action="{{ url('/spent', ['id' => $spent->id]) }}" method="post">
                                                @method('delete')
                                                @csrf
                                                <p class="border-bottom pb-3 mb-4">Voulez vous supprimer le dépense : {{ $spent->name }} ?</p>
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
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- End Table -->
            </main>
        </div>
    </div>
@endsection

