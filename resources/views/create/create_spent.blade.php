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
                    <label for="category_id" class="label">Catégorie</label>
                    <div class="control">
                        <div class="select">
                            <select class="select" id="category_id" name="category_id">
                                <option value="">categorie ...</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @error('category')
                    <span class="help is-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="fied">
                <div class="mb-5">
                    <label for="family_id" class="label">Sous-Type</label>
                    <div class="control">
                        <div class="select">
                            <select class="select" id="select_family_id" name="family_id">
                                <option value="">sous-type ...</option>
                                @foreach($families as $family)
                                    <option value="{{$family->id}}">{{$family->name}}</option>
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
                        <option>compte ...</option>
                        @foreach($accounts as $account)
                            <option value="{{$account->id}}">{{$account->name}}</option>
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
                @if($e != "")
                    <span class="help is-success">{{ $e }}</span>
                @endif
            </div>
        </footer>
    </div>
        </form>
    </div>
    <div class="card">
        <table class="table-container table is-bordered is-striped is-narrow is-hoverable is-fullwidth">

            @foreach($select as $family)
                <div>{{ $family->name  }}</div>

            @endforeach

            @foreach($categories as $category)
                <thead>
                <tr>{{$category->name}}</tr>
                <tr class="is-selected">
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Prix</th>
                    <th>Date</th>
                    <th>Modifier</th>
                    <th>Supprimer</th>
                </tr>
                </thead>
                <tbody>
        @foreach($category->spents as $spent)

            <tr>
        <td>{{ $spent->name }}</td>
        <td>{{ $spent->description }}</td>
        <td>{{ $spent->price }}</td>
        <td>{{ $spent->date }}</td>
        <td>{{ $spent->family }}</td>
                <th>
                    <button id="modalButton" class="button is-primary"
                            onclick="document.getElementById({{ $spent->id }}).style.display='block'"
                            data-target="modal-ter" aria-haspopup="true"><span class="icon"><i
                                class="fas fa-pen"></i></span></button>
                </th>
                <th>
                    <button type="submit" id="delete" class="button is-danger"><a class="has-text-light"
                                                                                  href="{{ url('/create/spent_delete?spent_id='. $spent->id) }}"><span
                                class="icon"><i class="fas fa-trash-alt"></i></span></a></button>
                </th>
            </tr>

        @endforeach
        @endforeach
            </tbody>
        </table>
        @error('update_name')
        <div class="card-footer-item">
            <span class="help is-danger">{{ $message }}</span>
        </div>
        @enderror
        @error('update_description')
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
        @error('update_category')
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
    </div>
@endsection

