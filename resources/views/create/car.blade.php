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
                            <a class="nav-link active" href="{{ route('car') }}">
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
                    <h1 id="car" class="h2">Véhicule</h1>
                </div>
                <!-- Car Form -->
                <div class="row">
                    <div class="col-md-6">
                        <form method="POST" action="{{route('create.car')}}" class="needs-validation form-control" novalidate>
                            @csrf
                            <div class="row pt-3 mb-3">
                                <div class="col">
                                    <label for="name" class="form-label">Désignation du véhicule</label>
                                    <input id="name" type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Nom du véhicule ..." aria-describedby="validationName" required>
                                    @error('name')
                                    <div id="validationName" class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="fuel_type" class="form-label">Compte bancaire</label>
                                    <select class="form-select @error('fuel_type') is-invalid @enderror" id="fuel_type" name="fuel_type" aria-describedby="validationFuelType" required>
                                        <option value="">carburant ...</option>
                                        <option value="Essence 95">Essence 95</option>
                                        <option value="Essence 98">Essence 98</option>
                                        <option value="Diesel">Diesel</option>
                                    </select>
                                    @error('fuel_type')
                                    <div id="validationFuelType" class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="mileage" class="form-label">Kilométrage de la voiture</label>
                                    <input id="mileage" type="number"  step=".01" name="mileage" class="form-control @error('mileage') is-invalid @enderror" value="{{ old('mileage') }}" placeholder="Kilomètres ..." aria-describedby="validationMileage" required>
                                    @error('mileage')
                                    <div id="validationMileage" class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <button class="btn btn-primary" type="submit">Créer véhicule</button>
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
                    <h2 id="listCar">Liste des véhicules</h2>
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
                            <th>Véhicule</th>
                            <th>Carburant</th>
                            <th>Kilométrage</th>
                            <th>Modifier</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($cars as $car)
                            <tr id="{{ 'car' . $car->id . 'enabled' }}">
                                <td>{{ $car->name }}</td>
                                <td>{{ $car->fuel_type}}</td>
                                <td>{{ $car->mileage }}</td>
                                <td><button class="btn" onclick="document.getElementById('{{  'car' . $car->id . 'disabled' }}').className =' '; document.getElementById('{{  'car' . $car->id . 'enabled' }}').className =' d-none'">
                                        <i class="fas fa-pen"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr id="{{  'car' . $car->id . 'disabled' }}" class="d-none">
                                <form id="{{ 'car' . $car->id . 'update' }}" method="POST" action="{{ url('/car', ['id' => $car->id]) }}">
                                    @method('put')
                                    @csrf
                                    <td><input id="update_name" type="text" name="update_name" class="form-control" value="{{ $car->name }}" placeholder="Nom du véhicule" required></td>
                                    <td>
                                        <select class="form-select @error('fuel_type') is-invalid @enderror" id="update_fuel_type" name="update_fuel_type" required>
                                            <option value="{{ $car->fuel_type }}">{{ $car->fuel_type }}</option>
                                            @switch($car->fuel_type)
                                                @case("Essence 95")
                                                <option value="Essence 98">Essence 98</option>
                                                <option value="Diesel">Diesel</option>
                                                @break
                                                @case("Essence 98")
                                                <option value="Essence 95">Essence 95</option>
                                                <option value="Diesel">Diesel</option>
                                                @break
                                                @case("Diesel")
                                                <option value="Essence 95">Essence 95</option>
                                                <option value="Essence 98">Essence 98</option>
                                                @break
                                            @endswitch
                                        </select>
                                    </td>
                                    <td><input id="update_mileage" type="number"  step=".01" name="update_mileage" class="form-control" value="{{ $car->mileage }}" placeholder="Kilomètres ..." required></td>
                                </form>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button class="btn btn-outline-success" type="submit" onclick="document.getElementById('{{  'car' . $car->id . 'enabled' }}').className =' '; document.getElementById('{{  'car' . $car->id . 'disabled' }}').className =' d-none'; document.getElementById('{{ 'car' . $car->id . 'update' }}').submit();">
                                            <i class="far fa-check-circle"></i>
                                        </button>
                                        <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="{{ '#' . 'car' . $car->id . 'delete' }}" @if($car->fuels->count() != 0) disabled @endif>
                                            <i class="far fa-trash-alt"></i>
                                        </button>
                                        <button type="button" class="btn btn-outline-secondary" onclick="document.getElementById('{{  'car' . $car->id . 'enabled' }}').className =' '; document.getElementById('{{  'car' . $car->id . 'disabled' }}').className =' d-none'">
                                            <i class="far fa-times-circle"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <!-- Modal -->
                            <div class="modal fade" id="{{ 'car' . $car->id . 'delete' }}" tabindex="-1" aria-labelledby="{{ '#' . 'car' . $car->id . 'label' }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <form action="{{ url('/car', ['id' => $car->id]) }}" method="post">
                                                @method('delete')
                                                @csrf
                                                <p class="border-bottom pb-3 mb-4">Voulez vous supprimer le véhicule {{ $car->name }} ?</p>
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


