@extends('layouts.app')

@section('content')
    <div class="card mb-6">
        <form method="POST" action="{{route('store_car')}}">
            @csrf
            <header class="card-header">
                <div class="card-header-title">
                    <h1 class="title">Complétez informations voiture</h1>
                </div>
            </header>
            <div class="card-content">
                <div class="mb-5">
                    <label for="name" class="label">Nom de la voiture</label>
                    <input id="name" type="text" name="name" class="input" value="{{ old('name') }}"
                           placeholder="Nom voiture" autofocus>
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
                    <label for="mileage" class="label">Kilométrage voiture</label>
                    <input id="mileage" type="number" name="mileage" class="input" value="{{ old('mileage') }}"
                           placeholder="Kilométrage">
                    @error('mileage')
                    <span class="help is-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <footer class="card-footer">
                <div class="card-footer-item column">
                    <button type="submit" class="button is-primary ">Créer une voiture</button>
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
                <th>Voiture</th>
                <th>Carburant</th>
                <th>Kilométrage</th>
                <th>Modifier</th>
                <th>Supprimer</th>
            </tr>
            </thead>
            <tbody>
            @foreach($cars as $car)
                <tr>
                    <td>{{ $car->name }}</td>
                    <td>{{ $car->fuel_type }}</td>
                    <td>{{ $car->mileage }}</td>
                    <th>
                        <button id="modalButton" class="button is-primary"
                                onclick="document.getElementById({{ $car->id }}).style.display='block'"
                                data-target="modal-ter" aria-haspopup="true"><span class="icon"><i
                                    class="fas fa-pen"></i></span></button>
                    </th>
                    <th>
                        <button type="submit" id="delete" class="button is-danger"><a class="has-text-light"
                                                                                      href="{{ url('/create/car_delete?car_id='. $car->id) }}"><span
                                    class="icon"><i class="fas fa-trash-alt"></i></span></a></button>
                    </th>
                </tr>
                <!-- Modal Card -->
                <div id="{{ $car->id }}" class="modal">
                    <div class="modal-background"></div>
                    <div class="modal-card">
                        <header class="modal-card-head">
                            <p class="modal-card-title">Modification {{ $car->name }}</p>
                            <button class="delete" aria-label="close"
                                    onclick="document.getElementById({{ $car->id }}).style.display='none'"></button>
                        </header>
                        <section class="modal-card-body">
                            <!-- Content ... -->
                            <form method="POST" action="{{route('update_car')}}">
                                @csrf
                                <div class="card-content">
                                    <div class="mb-5">
                                        <label for="update_name" class="label">Nom de la voiture</label>
                                        <input id="car_id" name="car_id" class="is-hidden" value="{{ $car->id }}">
                                        <input id="update_name" type="text" name="update_name" class="input"
                                               value="{{ $car->name }}"
                                               placeholder="Nom voiture" autofocus>
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
                                        <label for="update_mileage" class="label">Kilométrage voiture</label>
                                        <input id="update_mileage" type="text" name="update_mileage" class="input"
                                               value="{{ $car->mileage }}" placeholder="Kilométrage">
                                    </div>
                                </div>
                                <footer class="modal-card-foot">
                                    <button type="submit" class="button is-primary">Enregistrer</button>
                                </footer>
                            </form>
                            <!-- Content ... -->
                        </section>
                    </div>
                </div>
            @endforeach
            </tbody>
        </table>
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
        @if($message_updated != "")
            <div class="card-footer-item">
                <span class="help is-success">{{ $message_updated }}</span>
            </div>
        @endif
    </div>
@endsection

