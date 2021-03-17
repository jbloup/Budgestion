@extends('layout.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- Lateral nav -->
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky pt-3 mt-5">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#earning">
                                Revenus
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#ListEarning">
                                Liste revenus
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
            <!-- End lateral nav -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 id="earning" class="h2 mt-5">Revenus</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group me-2">
                            <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
                            <button type="button" class="btn btn-sm btn-outline-secondary">Import</button>
                        </div>
                    </div>
                </div>
                <!-- Earning Form -->
                <div class="row">
                    <div class="col-md-6">
                        <form method="POST" action="{{route('create.earning')}}" class="needs-validation form-control" novalidate>
                            @csrf
                            <div class="row pt-3 mb-3">
                                <div class="col">
                                    <label for="name" class="form-label">Désignation du revenu</label>
                                    <input id="name" type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="Nom revenu" required>
                                    <div class="invalid-feedback">
                                        @error('name')
                                        {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="description" class="form-label">Description du revenu</label>
                                    <textarea id="description" name="description" class="form-control" value="{{ old('description') }}" placeholder="Description revenu ..."></textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="amount" class="form-label">Montant du revenu</label>
                                    <input id="amount" type="number"  step=".01" name="amount" class="form-control" value="{{ old('amount') }}" placeholder="Prix ..." required>
                                    @error('amount')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="date" class="form-label">Date du revenu</label>
                                    <input id="date" type="date" name="date" class="form-control"
                                           @if(old('date'))
                                           value="{{ old('date') }}"
                                           @else
                                           value="{{ date('d-m-Y') }}"
                                           @endif
                                           placeholder="JJ-MM-YYYY" required>
                                    @error('date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="family_id" class="form-label">Type de revenu</label>
                                    <select class="form-select" id="family_id" name="family_id" required>
                                        <option value="">type de revenu ...</option>
                                        @foreach($families as $family)
                                            <option value="{{ $family->id }}">{{ $family->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('family_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="account_id" class="form-label">Compte bancaire</label>
                                    <select class="form-select" id="account_id" name="account_id" required>
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
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <button class="btn btn-primary" type="submit">Créer revenu</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- End Form -->
                    <div class="col-md-6">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque porta ante metus, quis dictum ipsum cursus ac. Cras vel dapibus justo. Nam porttitor, lorem id tempus mollis, est nibh porttitor enim, vitae posuere magna massa ac nunc. Vestibulum sed ex et eros pharetra dignissim at aliquam turpis. Mauris facilisis sem odio, ac dictum justo pellentesque eget. Nunc erat sem, sagittis eu rhoncus sed, convallis sed erat. Aenean lobortis enim non sollicitudin rhoncus. Fusce pulvinar eleifend nibh quis pulvinar. In gravida nisi nunc, et feugiat metus pellentesque at. Duis pretium, quam eu convallis aliquam, quam est sollicitudin justo, sit amet molestie ipsum augue sed ante.

                            Mauris accumsan a quam quis sollicitudin. Duis posuere elit quam. Aliquam quam nibh, tincidunt vitae risus et, mollis convallis tellus. Integer eros est, commodo at bibendum at, facilisis ut mi. Praesent tortor ex, pharetra eu massa ullamcorper, dapibus lacinia lectus. Nullam interdum venenatis ipsum vitae pulvinar. Duis sodales nisl et augue varius, sed pretium dolor iaculis. Morbi tempus sollicitudin magna, ac condimentum orci porttitor non. Pellentesque convallis imperdiet urna, vitae tempor turpis convallis et. Duis eget odio elit. Nullam nec ullamcorper nisi, vel tincidunt ligula. Mauris semper mauris metus, et facilisis dui congue quis. Vestibulum tempor quam a enim ultrices, sit amet euismod nulla tempor.</p>
                    </div>
                </div>
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h2 id="ListEarning">Liste des revenus</h2>
                </div>
                <!-- Earning Table -->
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
                        @foreach($earnings as $earning)
                            <tr id="{{ 1 . $earning->id }}">
                                <td>{{ $earning->name }}</td>
                                <td>{{ $earning->description }}</td>
                                <td>{{ $earning->amount }}</td>
                                <td>{{ date('d-m-Y', strtotime($earning->date)) }}</td>
                                <td>{{ $earning->family->name }}</td>
                                <td>{{ $earning->account->name }}</td>
                                <td><button class="btn" onclick="document.getElementById({{  2 . $earning->id }}).className =' '; document.getElementById({{  1 . $earning->id }}).className =' d-none'">
                                        <i class="fas fa-pen"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr id="{{ 2 . $earning->id }}" class="d-none">
                                <form method="POST" action="{{ url('/earning', ['id' => $earning->id]) }}">
                                    @method('put')
                                    @csrf
                                    <td><input id="update_earning_name" type="text" name="update_earning_name" class="form-control" value="{{ $earning->name }}" placeholder="Nom du revenu" required></td>
                                    <td><input id="update_earning_description" name="update_earning_description" class="form-control" value="{{ $earning->description }}" placeholder="Description revenu ..."></td>
                                    <td><input id="update_earning_amount" type="number"  step=".01" name="update_earning_amount" class="form-control" value="{{ $earning->amount }}" placeholder="Prix ..." required></td>
                                    <td><input id="update_earning_date" type="date" name="update_earning_date" class="form-control" value="{{ date('d-m-Y', strtotime($earning->date)) }}" required></td>
                                    <td><select id="update_family_id" name="update_family_id" class="form-select">
                                            <option value="{{ $earning->family->id }}">{{ $earning->family->name}}</option>
                                            @foreach($families as $family)
                                                @if($family->id != $earning->family->id)
                                                    <option value="{{ $family->id }}">{{ $family->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select id="update_account_id" name="update_account_id" class="form-select">
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
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <button class="btn btn-success" type="submit" onclick="document.getElementById({{  1 . $earning->id }}).className =' '; document.getElementById({{  2 . $earning->id }}).className =' d-none'">
                                                <i class="far fa-check-circle"></i>
                                            </button>
                                            <form action="{{ url('/earning', ['id' => $earning->id]) }}" method="post">
                                                @method('delete')
                                                @csrf
                                                <button class="btn btn-danger" type="submit">
                                                    <i class="far fa-trash-alt"></i>
                                                </button>
                                            </form>
                                            <button type="button" class="btn btn-light" onclick="document.getElementById({{  1 . $earning->id }}).className =' '; document.getElementById({{  2 . $earning->id }}).className =' d-none'">
                                                <i class="far fa-times-circle"></i>
                                            </button>
                                        </div>
                                    </td>
                                </form>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- End Table -->
            </main>
        </div>
    </div>
    <!-- Message Success -->
    @error('update_name')
    <div class="card-footer-item">
        <div class="invalid-feedback">{{ $message }}</div>
    </div>
    @enderror
    @error('update_amount')
    <div class="card-footer-item">
        <div class="invalid-feedback">{{ $message }}</div>
    </div>
    @enderror
    @error('update_date')
    <div class="card-footer-item">
        <div class="invalid-feedback">{{ $message }}</div>
    </div>
    @enderror
    @error('update_family')
    <div class="card-footer-item">
        <div class="invalid-feedback">{{ $message }}</div>
    </div>
    @enderror
    @error('update_account')
    <div class="card-footer-item">
        <div class="invalid-feedback">{{ $message }}</div>
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

