@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- Lateral nav -->
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#fuel">
                                Dépenses de carburant
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#ListFuel">
                                Liste dépenses de carburant
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
            <!-- End lateral nav -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 id="fuel" class="h2">Dépenses de carburant</h1>
                </div>
                <!-- Fuel Form -->
                <div class="row">
                    <div class="col-md-6">
                        <form method="POST" action="{{route('create.fuel')}}" class="needs-validation form-control" novalidate>
                            @csrf
                            <div class="row pt-3 mb-3">
                                <div class="col">
                                    <label for="liter" class="form-label">Litre de carburant</label>
                                    <input id="liter" type="number" step=".01" name="liter" class="form-control @error('liter') is-invalid @enderror" value="{{ old('liter') }}" placeholder="Litres ..." aria-describedby="validationLiter" required>
                                    @error('liter')
                                    <div id="validationLiter" class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="price" class="form-label">Montant de la dépense de carburant</label>
                                    <input id="price" type="number"  step=".01" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}" placeholder="Prix ..." aria-describedby="validationAmount" required>
                                    @error('price')
                                    <div id="validationAmount" class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="date" class="form-label">Date du dépense de carburant</label>
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
                                    <label for="mileage" class="form-label">Kilométrage de la voiture</label>
                                    <input id="mileage" type="number"  step=".01" name="mileage" class="form-control @error('mileage') is-invalid @enderror" value="{{ old('mileage') }}" placeholder="Kilomètres ..." aria-describedby="validationMileage" required>
                                    @error('mileage')
                                    <div id="validationMileage" class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="car_id" class="form-label">Compte bancaire</label>
                                    <select class="form-select @error('car_id') is-invalid @enderror" id="car_id" name="car_id" aria-describedby="validationAccount" required>
                                        <option value="">Véhicule ...</option>
                                        @foreach($cars as $car)
                                            <option value="{{$car->id}}">{{ $car->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('car_id')
                                    <div id="validationAccount" class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <button class="btn btn-primary" type="submit">Créer dépense de carburant</button>
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
                    <h2 id="ListFuel">Liste des dépense de carburants</h2>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group me-2">
                            <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
                            <button type="button" class="btn btn-sm btn-outline-secondary">Import</button>
                        </div>
                    </div>
                </div>
                <!-- Fuel Table -->
                <div class="table-responsive">
                    <table class="table table-hover table-sm">
                        <thead>
                        <tr>
                            <th>Véhicule</th>
                            <th>Litres</th>
                            <th>Prix</th>
                            <th>Date</th>
                            <th>Kilométrage</th>
                            <th>Modifier</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($fuels as $fuel)
                            <tr id="{{  str_replace(' ', '', $fuel->name) . $fuel->id . 'enabled' }}">
                                <td>{{ $fuel->car->name }}</td>
                                <td>{{ $fuel->liter }}</td>
                                <td>{{ $fuel->price . ' €' }}</td>
                                <td>{{ date('d-m-Y', strtotime($fuel->date)) }}</td>
                                <td>{{ $fuel->mileage }}</td>
                                <td><button class="btn" onclick="document.getElementById('{{  str_replace(' ', '', $fuel->name) . $fuel->id . 'disabled' }}').className =' '; document.getElementById('{{  str_replace(' ', '', $fuel->name) . $fuel->id . 'enabled' }}').className =' d-none'">
                                        <i class="fas fa-pen"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr id="{{  str_replace(' ', '', $fuel->name) . $fuel->id . 'disabled' }}" class="d-none">
                                <form id="{{ str_replace(' ', '', $fuel->name) . $fuel->id . 'update' }}" method="POST" action="{{ url('/fuel', ['id' => $fuel->id]) }}">
                                    @method('put')
                                    @csrf
                                    <td><select id="update_car_id" name="update_car_id" class="form-select">
                                            <option value="{{ $fuel->car->id }}">{{ $fuel->car->name }}</option>
                                            @foreach($cars as $car)
                                                <option value="{{$car->id}}">{{ $car->name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td><input id="update_fuel_liter" type="text" name="update_fuel_liter" class="form-control" value="{{ $fuel->liter }}" placeholder="Nom du dépense de carburant" required></td>
                                    <td><input id="update_fuel_price" type="number"  step=".01" name="update_fuel_price" class="form-control" value="{{ $fuel->price }}" placeholder="Prix ..." required></td>
                                    <td><input id="update_fuel_date" type="date" name="update_fuel_date" class="form-control" value="{{ date('d-m-Y', strtotime($fuel->date)) }}" required></td>
                                    <td><input id="update_fuel_mileage" type="number"  step=".01" name="update_fuel_mileage" class="form-control" value="{{ $fuel->mileage }}" placeholder="Kilomètres ..." required></td>
                                </form>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button class="btn btn-outline-success" type="submit" onclick="document.getElementById('{{  str_replace(' ', '', $fuel->name) . $fuel->id . 'enabled' }}').className =' '; document.getElementById('{{  str_replace(' ', '', $fuel->name) . $fuel->id . 'disabled' }}').className =' d-none'; document.getElementById('{{ str_replace(' ', '', $fuel->name) . $fuel->id . 'update' }}').submit();">
                                            <i class="far fa-check-circle"></i>
                                        </button>
                                        <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="{{ '#' . str_replace(' ', '', $fuel->name) . $fuel->id . 'delete' }}">
                                            <i class="far fa-trash-alt"></i>
                                        </button>
                                        <button type="button" class="btn btn-outline-secondary" onclick="document.getElementById('{{  str_replace(' ', '', $fuel->name) . $fuel->id . 'enabled' }}').className =' '; document.getElementById('{{  str_replace(' ', '', $fuel->name) . $fuel->id . 'disabled' }}').className =' d-none'">
                                            <i class="far fa-times-circle"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <!-- Modal -->
                            <div class="modal fade" id="{{ str_replace(' ', '', $fuel->name) . $fuel->id . 'delete' }}" tabindex="-1" aria-labelledby="{{ str_replace(' ', '', $fuel->name) . $fuel->id . 'label' }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <form action="{{ url('/fuel', ['id' => $fuel->id]) }}" method="post">
                                                @method('delete')
                                                @csrf
                                                <p class="border-bottom pb-3 mb-4">Voulez vous supprimer la dépense de carburant ?</p>
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

