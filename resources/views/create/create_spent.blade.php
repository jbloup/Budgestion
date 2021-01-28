@extends('layouts.app')

@section('content')
    <div class="spentd mb-6">
        <form method="POST" action="{{route('store_spent')}}">
            @csrf
    <header class="spentd-header">
        <div class="spentd-header-title">
            <h1 class="title">Complétez informations dépense</h1>
        </div>
    </header>
    <div class="spentd-content">
        <div class="mb-5">
            <label for="name" class="label">Désignation de la dépense</label>
            <input id="name" type="text" name="name" class="input" value="{{ old('name') }}"
                   placeholder="Nom dépense" autofocus>
            @error('name')
            <span class="help is-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-5">
            <label for="description" class="label">Description de la dépense</label>
            <textarea id="description" name="description" class="textarea" value="{{ old('description') }}"
                      placeholder="Description dépense ..."></textarea>
            @error('description')
            <span class="help is-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-5">
            <label for="price" class="label">Montant de la dépense</label>
            <input id="price" type="number"  step=".01" name="price" class="input" value="{{ old('price') }}"
                   placeholder="Prix ...">
            @error('price')
            <span class="help is-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-5">
            <label for="date" class="label">Date de la dépense</label>
            <input id="date" type="date" name="date" class="input" value="{{ old('date') }}">
            @error('date')
            <span class="help is-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="field-body">
            <div class="fied">
                <div class="mb-5">
                    <label for="family_id" class="label">Sous-Type</label>
                    <div class="control">
                        <div class="select">
                            <select class="select" id="family_id" name="family_id">
                                <option value="">sous-type ...</option>
                                @foreach($families as $family)
                                    <option value="{{$family->id}}">{{$family->type->category->name . " / " . $family->type->name . " / " . $family->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @error('family')
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
            @error('account')
            <span class="help is-danger">{{ $message }}</span>
            @enderror
        </div>
        <footer class="spentd-footer">
            <div class="spentd-footer-item column">
                <button type="submit" class="button is-primary ">Créer une dépense</button>
                @if($message_success != "")
                    <span class="help is-success">{{ $message_success }}</span>
                @endif
            </div>
        </footer>
    </div>
        </form>
    </div>
    <div class="card">
        <table class="table-container table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
                <thead>
                <tr class="is-selected">
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Prix</th>
                    <th>Date</th>
                    <th>Categorie</th>
                    <th>Type</th>
                    <th>Tous-type</th>
                    <th>Compte Bancaire</th>
                    <th>Modifier</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($spents as $spent)
            <tr>
                <td>{{ $spent->name }}</td>
                <td>{{ $spent->description }}</td>
                <td>{{ $spent->price }}</td>
                <td>{{ $spent->date }}</td>
                <td>{{ $spent->family->name }}</td>
                <td>{{ $spent->family->type->name }}</td>
                <td>{{ $spent->family->type->category->name }}</td>
                <td>{{ $spent->account->name }}</td>
                <th>
                    <button id="modalButton" class="button is-primary"
                            onclick="document.getElementById({{ $spent->id }}).style.display='block'"
                            data-target="modal-ter" aria-haspopup="true"><span class="icon"><i
                                class="fas fa-pen"></i></span></button>
                </th>
            </tr>
            <!-- Modal Card Spent -->
            <div id="{{ $spent->id }}" class="modal">
                <div class="modal-background"></div>
                <div class="modal-card">
                    <header class="modal-card-head">
                        <p class="modal-card-title">Modification {{ $spent->name }}</p>
                        <button class="delete" aria-label="close"
                                onclick="document.getElementById({{ $spent->id }}).style.display='none'"></button>
                    </header>
                    <section class="modal-card-body">
                        <!-- Content ... -->
                        <form method="POST" action="{{ route('update_spent') }}">
                            @csrf
                            <div class="card-content">
                                <div class="mb-5">
                                    <label for="update_spent_name" class="label">Nom de la dépense</label>
                                    <input id="spent_id" name="spent_id" class="is-hidden"
                                           value="{{ $spent->id }}">
                                    <input id="update_spent_name" type="text" name="update_spent_name"
                                           class="input"
                                           value="{{ $spent->name }}"
                                           placeholder="Nom du sous-type" autofocus>
                                </div>
                                <div class="mb-5">
                                    <label for="update_spent_description" class="label">Description de la dépense</label>
                                    <textarea id="update_spent_description" name="update_spent_description" class="textarea" value="{{ $spent->description }}"
                                              placeholder="Description dépense ..."></textarea>
                                </div>
                                <div class="mb-5">
                                    <label for="update_spent_price" class="label">Montant de la dépense</label>
                                    <input id="update_spent_price" type="number"  step=".01" name="update_spent_price" class="input" value="{{ $spent->price }}"
                                           placeholder="Prix ...">
                                </div>
                                <div class="mb-5">
                                    <label for="update_spentdate" class="label">Date de la dépense</label>
                                    <input id="update_spent_date" type="date" name="update_spent_date" class="input" value="{{ $spent->date }}">
                                </div>
                                <div class="mb-5">
                                    <div class="control">
                                        <label for="update_family_id" class="label">Sous-type</label>
                                        <div class="select">
                                            <select id="update_family_id" name="update_family_id">
                                                <option value="{{ $spent->family->id }}">{{ $spent->family->name}}</option>
                                                @foreach($families as $family)
                                                    @if($family->id != $spent->family->id)
                                                    <option value="{{ $family->id }}">{{ $family->name }}</option>
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
                                                <option value="{{ $spent->account->id }}">{{ $spent->account->name}}</option>
                                                @foreach($accounts as $account)
                                                    @if($account->id != $spent->account->id)
                                                    <option value="{{ $account->id }}">{{ $account->name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <footer class="modal-card-foot">
                                <button type="submit" class="button is-primary">Enregistrer</button>
                                <!-- if fuels -->
                                <button type="submit" id="delete" class="button is-danger">
                                    <a class="has-text-white" href="{{ url('/create/spent_delete?spent_id='. $spent->id) }}">Supprimer</a></button>
                                <!-- endif fuels -->
                            </footer>
                        </form>
                        <!-- Content ... -->
                    </section>
                </div>
            </div>
            <!-- End Modal Card Spent -->
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Message Success -->
        @error('update_name')
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
        @error('update_family')
        <div class="card-footer-item">
            <span class="help is-danger">{{ $message }}</span>
        </div>
        @enderror
        @error('update_account')
        <div class="card-footer-item">
            <span class="help is-danger">{{ $message }}</span>
        </div>
        @enderror
        @if($message_updated != "")
            <div class="card-footer-item">
                <span class="help is-success">{{ $message_updated }}</span>
            </div>
        @endif
    <!-- End Message Success -->

@endsection

