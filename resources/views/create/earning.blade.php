@extends('layouts.app')

@section('content')
    <!--Form Spent-->
    <section class="hero is-medium is-primary is-bold">
        <div class="hero-body">
            <div class="container">
                <h1 class="title">
                    Dépense
                </h1>
                <h2 class="subtitle">
                    Créer une nouvelle revenu.
                </h2>
            </div>
        </div>
    </section>
    <section class="section is-small">
        <div class="container is-max-desktop">
            <form method="POST" action="{{route('create.earning')}}">
                @csrf
                <h1 class="title">Complétez les informations</h1>
                <div class="mb-5">
                    <label for="name" class="label">Désignation du revenu</label>
                    <input id="name" type="text" name="name" class="input" value="{{ old('name') }}"
                           placeholder="Nom revenu" autofocus>
                    @error('name')
                    <span class="help is-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="description" class="label">Description du revenu</label>
                    <textarea id="description" name="description" class="textarea" value="{{ old('description') }}"
                              placeholder="Description revenu ..."></textarea>
                    @error('description')
                    <span class="help is-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="amount" class="label">Montant du revenu</label>
                    <input id="amount" type="number"  step=".01" name="amount" class="input" value="{{ old('amount') }}"
                           placeholder="Prix ...">
                    @error('amount')
                    <span class="help is-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="date" class="label">Date du revenu</label>
                    <input id="date" type="date" name="date" class="input"
                           @if(old('date'))
                           value="{{ old('date') }}"
                           @else
                           value="{{ date('d-m-Y') }}"
                           @endif
                           placeholder="JJ-MM-YYYY">
                    @error('date')
                    <span class="help is-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="field-body">
                    <div class="fied">
                        <div class="mb-5">
                            <label for="kind_id" class="label">Type de revenu</label>
                            <div class="control">
                                <div class="select">
                                    <select class="select" id="kind_id" name="kind_id">
                                        <option value="">type de revenu ...</option>
                                        @foreach($kinds as $kind)
                                            <option value="{{ $kind->id }}">{{ $kind->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @error('kind_id')
                            <span class="help is-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="mb-5">
                    <label for="account_id" class="label">Compte bancaire</label>
                    <div class="control">
                        <div class="select">
                            <select class="select" id="account_id" name="account_id">
                                @foreach($accounts as $account)
                                    <option value="{{$account->id}}">{{$account->number . " : " . $account->name}}
                                        @if($account->main == 1)
                                            | principal
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @error('account_id')
                    <span class="help is-danger">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="button is-primary ">
                    <span class="icon is-small">
                                <i class="fas fa-money-bill-wave"></i>
                                </span>
                    <span>Créer une revenu</span></button>
                @if (session('create'))
                    <span class="help is-success">{{ session('create') }}</span>
                @endif
            </form>
        </div>
        </div>
    </section>
    <!-- End Form Spent -->
    <!-- Title Table -->
    <section class="hero is-light">
        <div class="hero-body">
            <div class="container">
                <h1 class="title">
                    Liste des revenus
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
            <table class="table-container table is-bordered is-striped is-narrow is-hoverable is-fullwidth has-text-centered">
                <thead>
                <tr class="is-selected">
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
                @foreach($earnings as $earning)
                    <tr>
                        <td>{{ $earning->name }}</td>
                        <td>{{ $earning->description }}</td>
                        <td>{{ $earning->amount }}</td>
                        <td>{{ date('d-m-Y', strtotime($earning->date)) }}</td>
                        <td>{{ $earning->kind->name }}</td>
                        <td>{{ $earning->account->name }}</td>
                        <th>
                            <button id="modalButton" class="button"
                                    onclick="document.getElementById({{ $earning->id }}).style.display='block'"
                                    data-target="modal-ter" aria-haspopup="true"><span class="icon"><i
                                        class="fas fa-pen"></i></span></button>
                        </th>
                    </tr>
                    <!-- Modal Card Spent -->
                    <div id="{{ $earning->id }}" class="modal">
                        <div class="modal-background"></div>
                        <div class="modal-card">
                            <header class="modal-card-head">
                                <p class="modal-card-title">Modification {{ $earning->name }}</p>
                                <button class="delete" aria-label="close"
                                        onclick="document.getElementById({{ $earning->id }}).style.display='none'"></button>
                            </header>
                            <!-- Content ... -->
                            <div class="modal-card-body">
                                <form method="POST" action="{{ url('/earning', ['id' => $earning->id]) }}">
                                    @method('put')
                                    @csrf
                                    <div class="card-content">
                                        <div class="mb-5">
                                            <label for="update_earning_name" class="label">Nom du revenu</label>
                                            <input id="earning_id" name="earning_id" class="is-hidden"
                                                   value="{{ $earning->id }}">
                                            <input id="update_earning_name" type="text" name="update_earning_name"
                                                   class="input"
                                                   value="{{ $earning->name }}"
                                                   placeholder="Nom du revenu" autofocus>
                                        </div>
                                        <div class="mb-5">
                                            <label for="update_earning_description" class="label">Description du revenu</label>
                                            <textarea id="update_earning_description" name="update_earning_description" class="textarea" value="{{ $earning->description }}"
                                                      placeholder="Description revenu ..."></textarea>
                                        </div>
                                        <div class="mb-5">
                                            <label for="update_earning_amount" class="label">Montant du revenu</label>
                                            <input id="update_earning_amount" type="number"  step=".01" name="update_earning_amount" class="input" value="{{ $earning->amount }}"
                                                   placeholder="Prix ...">
                                        </div>
                                        <div class="mb-5">
                                            <label for="update_earningdate" class="label">Date du revenu</label>
                                            <input id="update_earning_date" type="date" name="update_earning_date" class="input" value="{{ date('d-m-Y', strtotime($earning->date)) }}">
                                        </div>
                                        <div class="mb-5">
                                            <div class="control">
                                                <label for="update_kind_id" class="label">Type revenu</label>
                                                <div class="select">
                                                    <select id="update_kind_id" name="update_kind_id">
                                                        <option value="{{ $earning->kind->id }}">{{ $earning->kind->name}}</option>
                                                        @foreach($kinds as $kind)
                                                            @if($kind->id != $earning->kind->id)
                                                                <option value="{{ $kind->id }}">{{ $kind->name }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-5">
                                            <div class="control">
                                                <label for="update_account_id" class="label">Compte Bancaire</label>
                                                <div class="select">
                                                    <select id="update_account_id" name="update_account_id">
                                                        <option value="{{ $earning->account->id }}">{{ $earning->account->number . " : " . $earning->account->name}}
                                                            @if($earning->account->main == 1)
                                                                | principal
                                                            @endif
                                                        </option>
                                                        @foreach($accounts as $account)
                                                            @if($account->id != $earning->account->id)
                                                                <option value="{{$account->id}}">{{$account->number . " : " . $account->name}}
                                                                    @if($account->main == 1)
                                                                        | principal
                                                                    @endif
                                                                </option>
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
                                <form action="{{ url('/earning', ['id' => $earning->id]) }}" method="post">
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
    @error('update_name')
    <div class="card-footer-item">
        <span class="help is-danger">{{ $message }}</span>
    </div>
    @enderror
    @error('update_amount')
    <div class="card-footer-item">
        <span class="help is-danger">{{ $message }}</span>
    </div>
    @enderror
    @error('update_date')
    <div class="card-footer-item">
        <span class="help is-danger">{{ $message }}</span>
    </div>
    @enderror
    @error('update_kind')
    <div class="card-footer-item">
        <span class="help is-danger">{{ $message }}</span>
    </div>
    @enderror
    @error('update_account')
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

