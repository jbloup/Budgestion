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
                    Créer une nouvelle dépense.
                </h2>
            </div>
        </div>
    </section>
    <section class="section is-small">
        <div class="container is-max-desktop">
        <form method="POST" action="{{route('create_spent')}}">
            @csrf
            <h1 class="title">Complétez les informations</h1>
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
            <input id="date" type="date" name="date" class="input" value="{{ old('date') }}" placeholder="JJ-MM-YYYY">
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
                    @error('family_id')
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
                    <span>Créer une dépense</span></button>
            @if (session('create'))
                <span class="help is-success">{{ session('create') }}</span>
            @endif
        </form>
            <form style="border: 4px solid #a1a1a1;margin-top: 15px;padding: 10px;" action="{{ route('import_spent') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
                @csrf
                <div class="file has-name is-fullwidth">
                    <label class="file-label">
                        <span class="file-cta">
                                <span class="file-icon">
                                    <i class="fas fa-upload"></i>
                                </span>
                                <span class="file-label">Choisissez un fichier</span>
                            </span>
                        <span class="file-name"></span>
                        <input type="file" name="import_file">

                    </label>
                </div>
                <button class="btn btn-primary">Import File</button>
            </form>
            @if (session('import'))
                <span class="help is-success">{{ session('import') }}</span>
            @endif
        </div>
    </div>
    </section>
    <!-- End Form Spent -->
    <!-- Title Table -->
    <section class="hero is-light">
        <div class="hero-body">
            <div class="container">
                <h1 class="title">
                    Liste des dépenses
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
                <td>{{ date('d-m-Y', strtotime($spent->date)) }}</td>
                <td>{{ $spent->family->name }}</td>
                <td>{{ $spent->family->type->name }}</td>
                <td>{{ $spent->family->type->category->name }}</td>
                <td>{{ $spent->account->name }}</td>
                <th>
                    <button id="modalButton" class="button"
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
                        <form method="POST" action="{{ url('/spent', ['id' => $spent->id]) }}">
                            @method('put')
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
                                    <input id="update_spent_date" type="date" name="update_spent_date" class="input" value="{{ date('d-m-Y', strtotime($spent->date)) }}">
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
                            <button type="submit" class="button is-primary">Enregistrer</button>
                        </form>
                            <footer class="modal-card-foot">
                                <form action="{{ url('/spent', ['id' => $spent->id]) }}" method="post">
                                    @method('delete')
                                    @csrf
                                    <button class=" button is-danger" type="submit"><span>Supprimer</span></button>
                                </form>
                            </footer>
                        <!-- Content ... -->
                    </section>
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
    @if (session('update'))
        <span class="help is-success">{{ session('update') }}</span>
    @endif
    @if (session('delete'))
        <span class="help is-success">{{ session('delete') }}</span>
    @endif
    <!-- End Message Success -->
    <div>
        <input id="uploadInput" type="file" name="myFiles" multiple>
        selected files: <span id="fileNum">0</span>;
        total size: <span id="fileSize">0</span>
    </div>
    <div><input type="submit" value="Send file"></div>
    <script>
        function updateSize() {
            let file_name = "",
                oFiles = this.files,
                nFiles = oFiles.length;
            for (let nFileId = 0; nFileId < nFiles; nFileId++) {
                nBytes += oFiles[nFileId].name;
            }
            let sOutput = nBytes + " bytes";
            // optional code for multiples approximation
            const aMultiples = ["KiB", "MiB", "GiB", "TiB", "PiB", "EiB", "ZiB", "YiB"];
            for (nMultiple = 0, nApprox = nBytes / 1024; nApprox > 1; nApprox /= 1024, nMultiple++) {
                sOutput = nApprox.toFixed(3) + " " + aMultiples[nMultiple] + " (" + nBytes + " bytes)";
            }
            // end of optional code
            document.getElementById("fileName").innerHTML = file_name;
        }

        document.getElementById("uploadInput").addEventListener("change", updateSize, false);
    </script>
@endsection

