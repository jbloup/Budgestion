@extends('layouts.app')

@section('content')
    <!--Form Car-->
    <section class="hero is-medium is-primary is-bold">
        <div class="hero-body">
            <div class="container">
                <h1 class="title">
                    Véhicule
                </h1>
                <h2 class="subtitle">
                    Créer un nouveau véhicule.
                </h2>
            </div>
        </div>
    </section>
    <section class="section is-small">
        <div class="container is-max-desktop">
        <form method="POST" action="{{ route('create_car') }}">
            @method('post')
            @csrf
                    <h1 class="title">Complétez les informations</h1>
                <div class="mb-5">
                    <label for="name" class="label">Nom du véhicule</label>
                    <input id="name" type="text" name="name" class="input" value="{{ old('name') }}"
                           placeholder="Nom véhicule" autofocus>
                    @error('name')
                    <span class="help is-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="fuel_type" class="label">Type de carburant</label>
                    <div class="control">
                        <div class="select">
                            <select class="select" id="fuel_type" name="fuel_type">
                                <option value="">carburant ...</option>
                                <option value="Essence 95">Essence 95</option>
                                <option value="Essence 98">Essence 98</option>
                                <option value="Diesel">Diesel</option>
                            </select>
                        </div>
                    </div>
                    @error('fuel_type')
                    <span class="help is-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="mileage" class="label">Kilométrage véhicule</label>
                    <input id="mileage" type="number" name="mileage" class="input" value="{{ old('mileage') }}"
                           placeholder="Kilométrage">
                    @error('mileage')
                    <span class="help is-danger">{{ $message }}</span>
                    @enderror
                </div>
                    <button type="submit" class="button is-primary ">
                        <span class="icon is-small">
                                <i class="fas fa-car"></i>
                                </span>
                        <span>Créer un véhicule</span></button>
            @if (session('create'))
                <span class="help is-success">{{ session('create') }}</span>
            @endif
        </form>
            <form style="border: 4px solid #a1a1a1;margin-top: 15px;padding: 10px;" action="{{ route('import_car') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
                @csrf
                <input type="file" name="import_file" />
                <button class="btn btn-primary">Import File</button>
            </form>
            @if (session('import'))
                    <span class="help is-success">{{ session('import') }}</span>
            @endif
        </div>
    </section>
    <!-- End Form Car -->
    <!-- Title Table -->
    <section class="hero is-light">
        <div class="hero-body">
            <div class="container">
                <h1 class="title">
                    Liste des véhicules
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
                <th>Carburant</th>
                <th>Kilométrage</th>
                <th>Modifier</th>
            </tr>
            </thead>
            <tbody>
            @foreach($cars as $car)
                <tr>
                    <td>{{ $car->name }}</td>
                    <td>{{ $car->fuel_type }}</td>
                    <td>{{ $car->mileage }}</td>
                    <th>
                        <button id="modalButton" class="button"
                                onclick="document.getElementById({{ $car->id }}).style.display='block'"
                                data-target="modal-ter" aria-haspopup="true"><span class="icon"><i
                                    class="fas fa-pen"></i></span></button>
                    </th>
                </tr>
                <!-- Modal Card -->
                <div id="{{ $car->id }}" class="modal">
                    <div class="modal-background"></div>
                    <footer class="modal-card">
                        <header class="modal-card-head">
                            <p class="modal-card-title">Modification {{ $car->name }}</p>
                            <button class="delete" aria-label="close"
                                    onclick="document.getElementById({{ $car->id }}).style.display='none'"></button>
                        </header>
                        <section class="modal-card-body">
                            <!-- Content ... -->
                            <form method="POST" action="{{ url('/car', ['id' => $car->id]) }}">
                                @method('put')
                                @csrf
                                <div class="card-content">
                                    <div class="mb-5">
                                        <label for="update_name" class="label">Nom du véhicule</label>
                                        <input id="update_name" type="text" name="update_name" class="input"
                                               value="{{ $car->name }}"
                                               placeholder="Nom véhicule" autofocus>
                                    </div>
                                    <div class="mb-5">
                                        <label for="update_fuel_type" class="label">Type de carburant</label>
                                        <div class="control">
                                            <div class="select">
                                                <select class="select" id="update_fuel_type" name="update_fuel_type">
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
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-5">
                                        <label for="update_mileage" class="label">Kilométrage véhicule</label>
                                        <input id="update_mileage" type="text" name="update_mileage" class="input"
                                               value="{{ $car->mileage }}" placeholder="Kilométrage">
                                    </div>
                                </div>


                                    <button type="submit" class="button is-primary">Enregistrer</button>
                            </form>
                            <footer class="modal-card-foot">
                                    @if($car->fuels->count() == 0)
                                        <form action="{{ url('/car', ['id' => $car->id]) }}" method="post">
                                            @method('delete')
                                            @csrf
                                            <button class=" button is-danger" type="submit"><span>Supprimer</span></button>
                                        </form>
                                    @endif
                                </footer>
                            <!-- Content ... -->
                        </section>
                    </div>

            @endforeach
            </tbody>
        </table>
    </div>
    </section>
    <!-- End Table -->
        @error('update_name')
        <div class="card-footer-item">
            <span class="help is-danger">{{ $message }}</span>
        </div>
        @enderror
        @error('update_fuel_type')
        <div class="card-footer-item">
            <span class="help is-danger">{{ $message }}</span>
        </div>
        @enderror
        @error('update_mileage')
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

