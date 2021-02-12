@extends('layouts.app')

@section('content')
    <!--Form Spent-->
    <section class="hero is-medium is-primary is-bold">
        <div class="hero-body">
            <div class="container">
                <h1 class="title">
                    Dépense carburant
                </h1>
                <h2 class="subtitle">
                    Créer une nouvelle dépense de carburant.
                </h2>
            </div>
        </div>
    </section>
    <section class="section is-small">
        <div class="container is-max-desktop">
            <form method="POST" action="{{ route('create_fuel') }}">
                @csrf
                <h1 class="title">Complétez les informations</h1>
                <div class="mb-5">
                    <label for="liter" class="label">Quantité en litre</label>
                    <input id="liter" type="number"  step=".01" name="liter" class="input" value="{{ old('liter') }}"
                           placeholder="Litres ...">
                    @error('liter')
                    <span class="help is-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="price" class="label">Montant de la dépense de carburant</label>
                    <input id="price" type="number"  step=".01" name="price" class="input" value="{{ old('price') }}"
                           placeholder="Prix ...">
                    @error('price')
                    <span class="help is-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="date" class="label">Date de la dépense de carburant</label>
                    <input id="date" type="date" name="date" class="input" value="{{ old('date') }}" placeholder="JJ/MM/YYYY">
                    @error('date')
                    <span class="help is-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="mileage" class="label">Actualisation kilométrage voiture</label>
                    <input id="mileage" type="number"  step=".01" name="mileage" class="input" value="{{ old('mileage') }}"
                           placeholder="kilomètres ...">
                    @error('mileage')
                    <span class="help is-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="field-body">
                    <div class="fied">
                        <div class="mb-5">
                            <label for="car_id" class="label">Véhicule</label>
                            <div class="control">
                                <div class="select">
                                    <select class="select" id="car_id" name="car_id">
                                        <option value="">Véhicule ...</option>
                                        @foreach($cars as $car)
                                            <option value="{{$car->id}}">{{ $car->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @error('car_id')
                            <span class="help is-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <button type="submit" class="button is-primary ">
                    <span class="icon is-small">
                                <i class="fas fa-gas-pump"></i>
                                </span>
                    <span>Créer une dépense de carburant</span></button>
                @if (session('create'))
                    <span class="help is-success">{{ session('create') }}</span>
                @endif
            </form>
        </div>
    </section>
    <!-- End Form Spent -->
    <!-- Title Table -->
    <section class="hero is-light">
        <div class="hero-body">
            <div class="container">
                <h1 class="title">
                    Liste des dépenses de carburant
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
                    <th>Véhicule</th>
                    <th>Litre</th>
                    <th>Prix</th>
                    <th>Date</th>
                    <th>Modifier</th>
                </tr>
                </thead>
                <tbody>
                @foreach($fuels as $fuel)
                    <tr>
                        <td>{{ $fuel->car->name }}</td>
                        <td>{{ $fuel->liter }}</td>
                        <td>{{ $fuel->price }}</td>
                        <td>{{ date('d-m-Y', strtotime($fuel->date)) }}</td>
                        <th>
                            <button id="modalButton" class="button"
                                    onclick="document.getElementById({{ $fuel->id }}).style.display='block'"
                                    data-target="modal-ter" aria-haspopup="true"><span class="icon"><i
                                        class="fas fa-pen"></i></span></button>
                        </th>
                    </tr>
                    <!-- Modal Card Spent -->
                    <div id="{{ $fuel->id }}" class="modal">
                        <div class="modal-background"></div>
                        <div class="modal-card">
                            <header class="modal-card-head">
                                <p class="modal-card-title">Modification {{ $fuel->name }}</p>
                                <button class="delete" aria-label="close"
                                        onclick="document.getElementById({{ $fuel->id }}).style.display='none'"></button>
                            </header>
                            <!-- Content ... -->
                            <div class="modal-card-body">
                                <form method="POST" action="{{ url('/fuel', ['id' => $fuel->id]) }}">
                                    @method('put')
                                    @csrf
                                    <div class="card-content">
                                        <div class="mb-5">
                                            <label for="update_fuel_liter" class="label">Quantité de carburant</label>
                                            <input id="update_fuel_liter" type="number"  step=".01" name="update_fuel_liter" class="input" value="{{ $fuel->liter }}"
                                                   placeholder="liter...">
                                        </div>
                                        <div class="mb-5">
                                            <label for="update_fuel_price" class="label">Montant de la dépense de carburant</label>
                                            <input id="update_fuel_price" type="number"  step=".01" name="update_fuel_price" class="input" value="{{ $fuel->price }}"
                                                   placeholder="Prix ...">
                                        </div>
                                        <div class="mb-5">
                                            <label for="update_fuel_date" class="label">Date de la dépense de carburant</label>
                                            <input id="update_fuel_date" type="date" name="update_fuel_date" class="input" value="{{ date('d-m-Y', strtotime($fuel->date)) }}">
                                        </div>
                                        <div class="mb-5">
                                            <div class="control">
                                                <label for="update_car_id" class="label">Véhicule</label>
                                                <div class="select">
                                                    <select id="update_car_id" name="update_car_id">
                                                        <option value="{{ $fuel->car->id }}">{{ $fuel->car->name}}</option>
                                                        @foreach($cars as $car_t)
                                                            @if($car_t->id != $fuel->car->id)
                                                                <option value="{{ $car_t->id }}">{{ $car_t->name }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="button is-primary">Enregistrer</button>
                                    </div>
                                </form>
                                <!-- Content ... -->
                            </div>
                            <footer class="modal-card-foot">
                                <form action="{{ url('/fuel', ['id' => $fuel->id]) }}" method="post">
                                    @method('delete')
                                    @csrf
                                    <button class=" button is-danger" type="submit"><span>Supprimer</span></button>
                                </form>
                            </footer>
                        </div>
                    </div>

                    <!-- End Modal Card Spent -->
                @endforeach
                </tbody>
            </table>
        </div>
    </section>
    <!-- End Table -->

    <!-- Message Success -->
    @error('update_liter')
    <div class="card-footer-item">
        <span class="help is-danger">{{ $message }}</span>
    </div>
    @enderror
    @error('update_price')
    <div class="card-footer-item">
        <span class="help is-danger">{{ $message }}</span>
    </div>
    @enderror
    @error('update_date')
    <div class="card-footer-item">
        <span class="help is-danger">{{ $message }}</span>
    </div>
    @enderror
    @error('update_car_id')
    <div class="card-footer-item">
        <span class="help is-danger">{{ $message }}</span>
    </div>
    @enderror
    @if (session('update'))
        <span class="help is-success">{{ session('update') }}</span>
    @endif
    @if (session('delete'))
        <span class="help is-success">{{ session('delete') }}</span>
    @endif
    <!-- End Message Success -->

@endsection

