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
                            <a class="nav-link active" aria-current="page" href="{{ route('category') }}">
                                <span data-feather="package"></span>
                                Nomenclature
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link link-secondary" href="{{ route('car') }}">
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
                    <h1 id="nomenclature" class="h2">Nomenclature</h1>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <p class="has-text-justified">Les dépenses et les revenus sont classé par catégorie, type et sous-type.
                            <br>
                            Lors de l'enregistrement d'une dépense ou d'un revenu il sera obligatoire de choisir un sous-type.
                            <br>
                            <br>
                            Par exemple vous pouvez créer une catégorie de dépense <strong>Mensuelle</strong> puis un type <strong>Maison</strong> et enfin un sous-type <strong>Électricité</strong>. Vous pourrez alors enregistrer toutes vos dépenses mensuelle d'électricité dans ce sous-type</p>
                    </div>
                </div>
                <!-- Spent Category -->
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h2 id="listSpentCategory">Liste des catégorie de dépense</h2>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group me-2">
                            <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
                            <button type="button" class="btn btn-sm btn-outline-secondary">Import</button>
                        </div>
                    </div>
                </div>
                <!-- Spent Table -->
                <div class="table-responsive">
                    <table class="table table-hover table-sm">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Catégorie</th>
                            <th>Type</th>
                            <th>Sous-type</th>
                            <th class="text-center">
                                <div class="btn-group" role="group">
                                    <button class="btn" disabled>
                                        <i class="far fa-check-circle"></i>
                                    </button>
                                    <button type="button" class="btn" disabled>
                                        <i class="far fa-trash-alt"></i>
                                    </button>
                                    <button type="button" class="btn" disabled>
                                        <i class="far fa-times-circle"></i>
                                    </button>
                                </div>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($spentCategories as $category)
                            <!-- Spent Category Row -->
                            <tr class="table-danger" id="{{ 'spentCategory' . $category->id . 'disabled' }}">
                                <td>
                                    <select class="form-select" disabled>
                                        <option value="{{ $category->kind }}">Dépense</option>
                                    </select>
                                </td>
                                <td onclick="document.getElementById('{{  'spentCategory' . $category->id . 'enabled' }}').className =' table-danger'; document.getElementById('{{ 'spentCategory' . $category->id . 'disabled' }}').className =' d-none'">
                                    <input type="text" class="form-control" value="{{ $category->name }}" disabled>
                                </td>
                                <td class="text-center">
                                    <button id="{{  'spentTypeCreateButton' . $category->id . 'enabled' }}" class="btn text-secondary" onclick="document.getElementById('{{  'spentTypeCreate' . $category->id . 'disabled' }}').className =' table-info'; document.getElementById('{{  'spentTypeCreateButton' . $category->id . 'enabled' }}').className =' d-none'; document.getElementById('{{  'spentTypeCreateDelete' . $category->id . 'disabled' }}').className =' btn text-secondary'">
                                        <i class="far fa-plus-square"></i>
                                    </button>
                                    <button id="{{  'spentTypeCreateDelete' . $category->id . 'disabled' }}" class="d-none" onclick="document.getElementById('{{  'spentTypeCreate' . $category->id . 'disabled' }}').className =' d-none'; document.getElementById('{{  'spentTypeCreateButton' . $category->id . 'enabled' }}').className =' btn text-secondary'; document.getElementById('{{  'spentTypeCreateDelete' . $category->id . 'disabled' }}').className =' d-none'">
                                        <i class="far fa-times-circle"></i>
                                    </button>
                                </td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr id="{{ 'spentCategory' . $category->id . 'enabled'}}" class="d-none">
                                <form id="{{ 'spentCategory' . $category->id. 'update' }}" method="POST" action="{{ url('/category', ['id' => $category->id]) }}">
                                    @method('put')
                                    @csrf
                                    <td>
                                        <select id="update_category_kind" name="update_category_kind" class="form-select">
                                            <option value="{{ $category->kind }}">Dépense</option>
                                            @foreach($categories as $cat)
                                                @if($cat->kind != $category->kind)
                                                    <option
                                                        value="{{ $cat->kind }}">Revenu</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </td>
                                    <td><input id="update_category_name" type="text" name="update_category_name" class="form-control" value="{{ $category->name }}" placeholder="Nom catégorie" required></td>
                                </form>
                                <td></td>
                                <td></td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <button class="btn btn-outline-success" type="submit" onclick="document.getElementById('{{  'spentCategory' . $category->id . 'disabled' }}').className =' table-danger'; document.getElementById('{{  'spentCategory' . $category->id . 'enabled' }}').className =' d-none'; document.getElementById('{{ 'spentCategory' . $category->id . 'update' }}').submit();">
                                            <i class="far fa-check-circle"></i>
                                        </button>
                                        <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="{{ '#' . 'spentCategory' . $category->id }}" @if($category->types->count() != 0) disabled @endif>
                                            <i class="far fa-trash-alt"></i>
                                        </button>
                                        <button type="button" class="btn btn-outline-secondary" onclick="document.getElementById('{{  'spentCategory' . $category->id . 'disabled' }}').className =' table-danger'; document.getElementById('{{  'spentCategory' . $category->id . 'enabled' }}').className =' d-none'">
                                            <i class="far fa-times-circle"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <!-- End Spent Category Row -->
                            <!-- Spent Type Row -->
                            @foreach($category->types as $type)
                                <tr class="table-info" id="{{ 'spentType' . $type->id . 'enabled' }}">
                                    <td></td>
                                    <td></td>
                                    <td onclick="document.getElementById('{{  'spentType' . $type->id . 'disabled' }}').className =' table-info'; document.getElementById('{{  'spentType' . $type->id . 'enabled' }}').className =' d-none'">
                                        <input type="text" class="form-control" value="{{ $type->name }}" disabled></td>
                                    <td class="text-center">
                                        <button id="{{  'spentFamilyCreateButton' . $type->id . 'enabled' }}" class="btn text-secondary" onclick="document.getElementById('{{  'spentFamilyCreate' . $type->id . 'disabled' }}').className =' table-warning'; document.getElementById('{{  'spentFamilyCreateButton' . $type->id . 'enabled' }}').className =' d-none'; document.getElementById('{{  'spentFamilyCreateDelete' . $type->id . 'disabled' }}').className =' btn text-secondary'">
                                            <i class="far fa-plus-square"></i>
                                        </button>
                                        <button id="{{  'spentFamilyCreateDelete' . $type->id . 'disabled' }}" class="d-none" onclick="document.getElementById('{{  'spentFamilyCreate' . $type->id . 'disabled' }}').className =' d-none'; document.getElementById('{{  'spentFamilyCreateButton' . $type->id . 'enabled' }}').className =' btn text-secondary'; document.getElementById('{{  'spentFamilyCreateDelete' . $type->id . 'disabled' }}').className =' d-none'">
                                            <i class="far fa-times-circle"></i>
                                        </button>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr id="{{ 'spentType' . $type->id . 'disabled' }}" class="d-none">
                                    <form id="{{ 'spentType' . $type->id . 'update' }}" method="POST" action="{{ url('/type', ['id' => $type->id]) }}">
                                        @method('put')
                                        @csrf
                                        <td></td>
                                        <td><select id="update_type_category_id" name="update_type_category_id" class="form-select">
                                                <option value="{{ $category->id }}">{{ $category->name}}</option>
                                                @foreach($spentCategories as $cat)
                                                    @if($cat->id != $category->id)
                                                        <option
                                                            value="{{ $cat->id }}">{{ $cat->name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </td>
                                        <td><input id="update_type_name" type="text" name="update_type_name" class="form-control" value="{{ $type->name }}" placeholder="Nom type" required></td>
                                        <td></td>
                                    </form>
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            <button class="btn btn-outline-success" type="submit" onclick="document.getElementById('{{ 'spentType' . $type->id . 'enabled' }}').className =' table-info'; document.getElementById('{{ 'spentType' . $type->id . 'disabled' }}').className =' d-none'; document.getElementById('{{ 'spentType' . $type->id . 'update' }}').submit();">
                                                <i class="far fa-check-circle"></i>
                                            </button>
                                            <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="{{ '#' . 'spentType' . $type->name . $type->id . 'delete' }}" @if($type->families->count() != 0) disabled @endif>
                                                <i class="far fa-trash-alt"></i>
                                            </button>
                                            <button type="button" class="btn btn-outline-secondary" onclick="document.getElementById('{{ 'spentType' . $type->id . 'enabled' }}').className =' table-info'; document.getElementById('{{ 'spentType' . $type->id . 'disabled' }}').className =' d-none'">
                                                <i class="far fa-times-circle"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <!-- Type Delete Modal -->
                                <div class="modal fade" id="{{ 'spentType' . $type->id . 'delete' }}" tabindex="-1" aria-labelledby="{{ 'spentType' . $type->id . 'label' }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <form action="{{ url('/type', ['id' => $type->id]) }}" method="post">
                                                    @method('delete')
                                                    @csrf
                                                    <p class="border-bottom pb-3 mb-4">Êtes vous sur de vouloir supprimer le type {{ $type->name }} ?</p>
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
                                    <!-- End Type Delete Modal -->
                                @foreach($type->families as $family)
                                    <!-- End Spent Family Row -->
                                        <tr class="table-warning" id="{{ 'spentFamily' . $family->id . 'enabled' }}">
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td onclick="document.getElementById('{{  'spentFamily' . $family->id . 'disabled' }}').className =' table-warning'; document.getElementById('{{  'spentFamily' . $family->id . 'enabled' }}').className =' d-none'">
                                                <input type="text" class="form-control" value="{{ $family->name }}" disabled>
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr id="{{ 'spentFamily' . $family->id . 'disabled' }}" class="d-none">
                                            <form id="{{  'spentFamily' . $family->id . 'update' }}" method="POST" action="{{ url('/subtype', ['id' => $family->id]) }}">
                                                @method('put')
                                                @csrf
                                                <td></td>
                                                <td></td>
                                                <td>
                                                    <select id="update_family_type_id" name="update_family_type_id" class="form-select">
                                                        <option value="{{ $type->id }}">{{ $type->name}}</option>
                                                        @foreach($category->types as $typ)
                                                            @if($typ->id != $type->id)
                                                                <option value="{{ $typ->id }}">{{ $typ->name }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td><input id="update_family_name" type="text" name="update_family_name" class="form-control" value="{{ $family->name }}" placeholder="Nom family" required></td>
                                            </form>
                                            <td class="text-center">
                                                <div class="btn-group" role="group">
                                                    <button class="btn btn-outline-success" type="submit" onclick="document.getElementById('{{  'spentFamily' . $family->id . 'enabled' }}').className =' table-warning'; document.getElementById('{{  'spentFamily' . $family->id . 'disabled' }}').className =' d-none'; document.getElementById('{{ 'spentFamily' . $family->id . 'update' }}').submit();">
                                                        <i class="far fa-check-circle"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="{{ '#' . 'spentFamily' . $family->id . 'delete' }}" @if($family->spents->count() != 0) disabled @endif>
                                                        <i class="far fa-trash-alt"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-outline-secondary" onclick="document.getElementById('{{  'spentFamily' . $family->id . 'enabled' }}').className =' table-warning'; document.getElementById('{{  'spentFamily' . $family->id . 'disabled' }}').className =' d-none'">
                                                        <i class="far fa-times-circle"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        <!-- End Spent Family Row -->
                                        <!-- Family Delete Modal -->
                                        <div class="modal fade" id="{{ 'spentFamily' . $family->id . 'delete' }}" tabindex="-1" aria-labelledby="{{ str_replace(' ', '',$family->name) . $family->id . 'label' }}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <form action="{{ url('/subtype', ['id' => $family->id]) }}" method="post">
                                                            @method('delete')
                                                            @csrf
                                                            <p class="border-bottom pb-3 mb-4">Êtes vous sur de vouloir supprimer le sous-type {{ $family->name }} ?</p>
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
                                        </div>
                                        <!-- End Family Delete Modal -->
                                @endforeach
                                <!-- Spent Family Form -->
                                    <tr id="{{ 'spentFamilyCreate' . $type->id . 'disabled' }}" class="d-none">
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <form method="POST" action="{{ route('create.family') }}">
                                            @csrf
                                            @method('post')
                                            <td>
                                                <div class="input-group">
                                                    <input id="family_type_id" name="family_type_id" class="visually-hidden" value="{{ $type->id }}">
                                                    <input id="family_name" name="family_name"  type="text" class="form-control" value="{{ old('family_name') }}" placeholder="Nom sous-type" autofocus>
                                                    <button class="btn btn-success" type="submit" id="button-addon2"><i class="fas fa-plus"></i></button>
                                                </div>
                                            </td>
                                        </form>
                                        <td></td>
                                    </tr>
                                    <!-- End Spent Family Form -->
                                @endforeach
                                <!-- End Spent Type Row -->
                                    <!-- Spent Type Form -->
                                    <tr id="{{ 'spentTypeCreate' . $category->id . 'disabled' }}" class="d-none">
                                        <td></td>
                                        <td></td>
                                        <form method="POST" action="{{ route('create.type') }}">
                                            @csrf
                                            @method('post')
                                            <td>
                                                <div class="input-group">
                                                    <input id="type_category_id" name="type_category_id"  class="visually-hidden" value="{{ $category->id }}">
                                                    <input id="type_name" type="text" name="type_name" class="form-control" value="{{ old('type_name') }}" placeholder="Nom type" autofocus>
                                                    <button class="btn btn-success" type="submit"><i class="fas fa-plus"></i></button>
                                                </div>
                                            </td>
                                        </form>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <!-- End Spent Type Form -->
                                    <!-- Category Delete Modal -->
                                    <div class="modal fade" id="{{ 'spentCategory' . $category->id }}" tabindex="-1" aria-labelledby="{{ str_replace(' ', '',$category->name) . $category->id . 'label' }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <form action="{{ url('/category', ['id' => $category->id]) }}" method="post">
                                                        @method('delete')
                                                        @csrf
                                                        <p class="border-bottom pb-3 mb-4">Êtes vous sur de vouloir supprimer la catégorie {{ $category->name }} ?</p>
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
                                        <!-- End Category Delete Modal -->
                            @endforeach
                        </tbody>
                        <!-- Spent Category Form -->
                        <tfoot>
                        <tr class="table-danger">
                            <td class="text-center">
                                <button id="{{  'spentCategoryCreateButton' . 'spent' . 'enabled' }}" class="btn text-secondary" onclick="document.getElementById('{{  'spentCategoryCreate' . 'spent' . 'disabled' }}').className =' table-danger'; document.getElementById('{{  'spentCategoryCreateButton' . 'spent' . 'enabled' }}').className =' d-none'; document.getElementById('{{  'spentCategoryCreateDelete' . 'spent' . 'disabled' }}').className =' btn text-secondary'; document.getElementById('{{  'spentCategoryCreate' . 'spent' . 'enabled' }}').className =' d-none'">
                                    <i class="far fa-plus-square"></i>
                                </button>
                                <button id="{{  'spentCategoryCreateDelete' . 'spent' . 'disabled' }}" class="d-none" onclick="document.getElementById('{{  'spentCategoryCreate' . 'spent' . 'disabled' }}').className =' d-none'; document.getElementById('{{  'spentCategoryCreateButton' . 'spent' . 'enabled' }}').className =' btn text-secondary'; document.getElementById('{{  'spentCategoryCreateDelete' . 'spent' . 'disabled' }}').className =' d-none'; document.getElementById('{{  'spentCategoryCreate' . 'spent' . 'enabled' }}').className =' '">
                                    <i class="far fa-times-circle"></i>
                                </button>
                            </td>
                            <form method="POST" action="{{ route('create.category') }}">
                                @csrf
                                @method('post')
                                <td id="{{  'spentCategoryCreate' . 'spent' . 'disabled' }}" class="d-none">
                                    <div class="input-group">
                                        <input id="category_kind" type="text" name="category_kind" class="visually-hidden" value="spent">
                                        <input id="category_name" type="text" name="category_name" class="form-control" value="{{ old('category_name') }}" placeholder="Nom catégorie" autofocus>
                                        <button class="btn btn-success" type="submit"><i class="fas fa-plus"></i></button>
                                    </div>
                                </td>
                            </form>
                            <td id="{{  'spentCategoryCreate' . 'spent' . 'enabled' }}" class=""></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        </tfoot>
                        <!-- End Spent Category Form -->
                    </table>
                    <!-- End Spent Table -->
                </div>
                <!-- End Spent Category -->
                <!-- Earning Category -->
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h2 id="listEarningCategory">Liste des catégories de revenu</h2>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group me-2">
                            <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
                            <button type="button" class="btn btn-sm btn-outline-secondary">Import</button>
                        </div>
                    </div>
                </div>
                <!-- Earning Table -->
                <div class="table-responsive mb-4">
                    <table class="table table-hover table-sm">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Catégorie</th>
                            <th>Type</th>
                            <th>Sous-type</th>
                            <th class="text-center">
                                <div class="btn-group" role="group">
                                    <button class="btn" disabled>
                                        <i class="far fa-check-circle"></i>
                                    </button>
                                    <button type="button" class="btn" disabled>
                                        <i class="far fa-trash-alt"></i>
                                    </button>
                                    <button type="button" class="btn" disabled>
                                        <i class="far fa-times-circle"></i>
                                    </button>
                                </div>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($earningCategories as $category)
                            <!-- Earning Category Row -->
                            <tr class="table-success" id="{{ 'earningCategory' . $category->id . 'disabled' }}">
                                <td>
                                    <select class="form-select" disabled>
                                        <option value="{{ $category->kind }}">Revenu</option>
                                    </select>
                                </td>
                                <td onclick="document.getElementById('{{  'earningCategory' . $category->id . 'enabled' }}').className =' table-success'; document.getElementById('{{ 'earningCategory' . $category->id . 'disabled' }}').className =' d-none'">
                                    <input type="text" class="form-control" value="{{ $category->name }}" disabled>
                                </td>
                                <td class="text-center">
                                    <button id="{{  'earningTypeCreateButton' . $category->id . 'enabled' }}" class="btn text-secondary" onclick="document.getElementById('{{  'earningTypeCreate' . $category->id . 'disabled' }}').className =' table-info'; document.getElementById('{{  'earningTypeCreateButton' . $category->id . 'enabled' }}').className =' d-none'; document.getElementById('{{  'earningTypeCreateDelete' . $category->id . 'disabled' }}').className =' btn text-secondary'">
                                        <i class="far fa-plus-square"></i>
                                    </button>
                                    <button id="{{  'earningTypeCreateDelete' . $category->id . 'disabled' }}" class="d-none" onclick="document.getElementById('{{  'earningTypeCreate' . $category->id . 'disabled' }}').className =' d-none'; document.getElementById('{{  'earningTypeCreateButton' . $category->id . 'enabled' }}').className =' btn text-secondary'; document.getElementById('{{  'earningTypeCreateDelete' . $category->id . 'disabled' }}').className =' d-none'">
                                        <i class="far fa-times-circle"></i>
                                    </button>
                                </td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr id="{{ 'earningCategory' . $category->id . 'enabled'}}" class="d-none">
                                <form id="{{ 'earningCategory' . $category->id. 'update' }}" method="POST" action="{{ url('/category', ['id' => $category->id]) }}">
                                    @method('put')
                                    @csrf
                                    <td>
                                        <select id="update_category_kind" name="update_category_kind" class="form-select">
                                            <option value="{{ $category->kind }}">Dépense</option>
                                            @foreach($categories as $cat)
                                                @if($cat->kind != $category->kind)
                                                    <option
                                                        value="{{ $cat->kind }}">Revenu</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </td>
                                    <td><input id="update_category_name" type="text" name="update_category_name" class="form-control" value="{{ $category->name }}" placeholder="Nom catégorie" required></td>
                                </form>
                                <td></td>
                                <td></td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <button class="btn btn-outline-success" type="submit" onclick="document.getElementById('{{  'earningCategory' . $category->id . 'disabled' }}').className =' table-success'; document.getElementById('{{  'earningCategory' . $category->id . 'enabled' }}').className =' d-none'; document.getElementById('{{ 'earningCategory' . $category->id . 'update' }}').submit();">
                                            <i class="far fa-check-circle"></i>
                                        </button>
                                        <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="{{ '#' . 'earningCategory' . $category->id }}" @if($category->types->count() != 0) disabled @endif>
                                            <i class="far fa-trash-alt"></i>
                                        </button>
                                        <button type="button" class="btn btn-outline-secondary" onclick="document.getElementById('{{  'earningCategory' . $category->id . 'disabled' }}').className =' table-success'; document.getElementById('{{  'earningCategory' . $category->id . 'enabled' }}').className =' d-none'">
                                            <i class="far fa-times-circle"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <!-- End Earning Category Row -->
                            <!-- Earning Type Row -->
                            @foreach($category->types as $type)
                                <tr class="table-info" id="{{ 'earningType' . $type->id . 'enabled' }}">
                                    <td></td>
                                    <td></td>
                                    <td onclick="document.getElementById('{{  'earningType' . $type->id . 'disabled' }}').className =' table-info'; document.getElementById('{{  'earningType' . $type->id . 'enabled' }}').className =' d-none'">
                                        <input type="text" class="form-control" value="{{ $type->name }}" disabled></td>
                                    <td class="text-center">
                                        <button id="{{  'earningFamilyCreateButton' . $type->id . 'enabled' }}" class="btn text-secondary" onclick="document.getElementById('{{  'earningFamilyCreate' . $type->id . 'disabled' }}').className =' table-warning'; document.getElementById('{{  'earningFamilyCreateButton' . $type->id . 'enabled' }}').className =' d-none'; document.getElementById('{{  'earningFamilyCreateDelete' . $type->id . 'disabled' }}').className =' btn text-secondary'">
                                            <i class="far fa-plus-square"></i>
                                        </button>
                                        <button id="{{  'earningFamilyCreateDelete' . $type->id . 'disabled' }}" class="d-none" onclick="document.getElementById('{{  'earningFamilyCreate' . $type->id . 'disabled' }}').className =' d-none'; document.getElementById('{{  'earningFamilyCreateButton' . $type->id . 'enabled' }}').className =' btn text-secondary'; document.getElementById('{{  'earningFamilyCreateDelete' . $type->id . 'disabled' }}').className =' d-none'">
                                            <i class="far fa-times-circle"></i>
                                        </button>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr id="{{ 'earningType' . $type->id . 'disabled' }}" class="d-none">
                                    <form id="{{ 'earningType' . $type->id . 'update' }}" method="POST" action="{{ url('/type', ['id' => $type->id]) }}">
                                        @method('put')
                                        @csrf
                                        <td></td>
                                        <td><select id="update_type_category_id" name="update_type_category_id" class="form-select">
                                                <option value="{{ $category->id }}">{{ $category->name}}</option>
                                                @foreach($earningCategories as $cat)
                                                    @if($cat->id != $category->id)
                                                        <option
                                                            value="{{ $cat->id }}">{{ $cat->name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </td>
                                        <td><input id="update_type_name" type="text" name="update_type_name" class="form-control" value="{{ $type->name }}" placeholder="Nom type" required></td>
                                        <td></td>
                                    </form>
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            <button class="btn btn-outline-success" type="submit" onclick="document.getElementById('{{ 'earningType' . $type->id . 'enabled' }}').className =' table-info'; document.getElementById('{{ 'earningType' . $type->id . 'disabled' }}').className =' d-none'; document.getElementById('{{ 'earningType' . $type->id . 'update' }}').submit();">
                                                <i class="far fa-check-circle"></i>
                                            </button>
                                            <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="{{ '#' . 'earningType' . $type->name . $type->id . 'delete' }}" @if($type->families->count() != 0) disabled @endif>
                                                <i class="far fa-trash-alt"></i>
                                            </button>
                                            <button type="button" class="btn btn-outline-secondary" onclick="document.getElementById('{{ 'earningType' . $type->id . 'enabled' }}').className =' table-info'; document.getElementById('{{ 'earningType' . $type->id . 'disabled' }}').className =' d-none'">
                                                <i class="far fa-times-circle"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <!--  Earning Type Delete Modal -->
                                <div class="modal fade" id="{{ 'earningType' . $type->id . 'delete' }}" tabindex="-1" aria-labelledby="{{ 'earningType' . $type->id . 'label' }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <form action="{{ url('/type', ['id' => $type->id]) }}" method="post">
                                                    @method('delete')
                                                    @csrf
                                                    <p class="border-bottom pb-3 mb-4">Êtes vous sur de vouloir supprimer le type {{ $type->name }} ?</p>
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
                                    <!-- End Earning Type Delete Modal -->
                                @foreach($type->families as $family)
                                    <!-- End Earning Family Row -->
                                        <tr class="table-warning" id="{{ 'earningFamily' . $family->id . 'enabled' }}">
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td onclick="document.getElementById('{{  'earningFamily' . $family->id . 'disabled' }}').className =' table-warning'; document.getElementById('{{  'earningFamily' . $family->id . 'enabled' }}').className =' d-none'">
                                                <input type="text" class="form-control" value="{{ $family->name }}" disabled>
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr id="{{ 'earningFamily' . $family->id . 'disabled' }}" class="d-none">
                                            <form id="{{  'earningFamily' . $family->id . 'update' }}" method="POST" action="{{ url('/subtype', ['id' => $family->id]) }}">
                                                @method('put')
                                                @csrf
                                                <td></td>
                                                <td></td>
                                                <td>
                                                    <select id="update_family_type_id" name="update_family_type_id" class="form-select">
                                                        <option value="{{ $type->id }}">{{ $type->name}}</option>
                                                        @foreach($category->types as $typ)
                                                            @if($typ->id != $type->id)
                                                                <option value="{{ $typ->id }}">{{ $typ->name }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td><input id="update_family_name" type="text" name="update_family_name" class="form-control" value="{{ $family->name }}" placeholder="Nom family" required></td>
                                            </form>
                                            <td class="text-center">
                                                <div class="btn-group" role="group">
                                                    <button class="btn btn-outline-success" type="submit" onclick="document.getElementById('{{  'earningFamily' . $family->id . 'enabled' }}').className =' table-warning'; document.getElementById('{{  'earningFamily' . $family->id . 'disabled' }}').className =' d-none'; document.getElementById('{{ 'earningFamily' . $family->id . 'update' }}').submit();">
                                                        <i class="far fa-check-circle"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="{{ '#' . 'earningFamily' . $family->id . 'delete' }}" @if($family->earnings->count() != 0) disabled @endif>
                                                        <i class="far fa-trash-alt"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-outline-secondary" onclick="document.getElementById('{{  'earningFamily' . $family->id . 'enabled' }}').className =' table-warning'; document.getElementById('{{  'earningFamily' . $family->id . 'disabled' }}').className =' d-none'">
                                                        <i class="far fa-times-circle"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        <!-- End Earning Family Row -->
                                        <!-- Family Delete Modal -->
                                        <div class="modal fade" id="{{ 'earningFamily' . $family->id . 'delete' }}" tabindex="-1" aria-labelledby="{{ str_replace(' ', '',$family->name) . $family->id . 'label' }}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <form action="{{ url('/subtype', ['id' => $family->id]) }}" method="post">
                                                            @method('delete')
                                                            @csrf
                                                            <p class="border-bottom pb-3 mb-4">Êtes vous sur de vouloir supprimer le sous-type {{ $family->name }} ?</p>
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
                                        </div>
                                        <!-- End Family Delete Modal -->
                                @endforeach
                                <!-- Earning Family Form -->
                                    <tr id="{{ 'earningFamilyCreate' . $type->id . 'disabled' }}" class="d-none">
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <form method="POST" action="{{ route('create.family') }}">
                                            @csrf
                                            @method('post')
                                            <td>
                                                <div class="input-group">
                                                    <input id="family_type_id" name="family_type_id" class="visually-hidden" value="{{ $type->id }}">
                                                    <input id="family_name" name="family_name"  type="text" class="form-control" value="{{ old('family_name') }}" placeholder="Nom sous-type" autofocus>
                                                    <button class="btn btn-success" type="submit" id="button-addon2"><i class="fas fa-plus"></i></button>
                                                </div>
                                            </td>
                                        </form>
                                        <td></td>
                                    </tr>
                                    <!-- End Earning Family Form -->
                                @endforeach
                                <!-- End Earning Type Row -->
                                    <!-- Earning Type Form -->
                                    <tr id="{{ 'earningTypeCreate' . $category->id . 'disabled' }}" class="d-none">
                                        <td></td>
                                        <td></td>
                                        <form method="POST" action="{{ route('create.type') }}">
                                            @csrf
                                            @method('post')
                                            <td>
                                                <div class="input-group">
                                                    <input id="type_category_id" name="type_category_id"  class="visually-hidden" value="{{ $category->id }}">
                                                    <input id="type_name" type="text" name="type_name" class="form-control" value="{{ old('type_name') }}" placeholder="Nom type" autofocus>
                                                    <button class="btn btn-success" type="submit"><i class="fas fa-plus"></i></button>
                                                </div>
                                            </td>
                                        </form>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <!-- End Earning Type Form -->
                                    <!-- Category Delete Modal -->
                                    <div class="modal fade" id="{{ 'earningCategory' . $category->id }}" tabindex="-1" aria-labelledby="{{ 'earningCategory' . $category->id . 'label' }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <form action="{{ url('/category', ['id' => $category->id]) }}" method="post">
                                                        @method('delete')
                                                        @csrf
                                                        <p class="border-bottom pb-3 mb-4">Êtes vous sur de vouloir supprimer la catégorie {{ $category->name }} ?</p>
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
                                        <!-- End Category Delete Modal -->
                            @endforeach
                        </tbody>
                        <!-- Earning Category Form -->
                        <tfoot>
                        <tr class="table-success">
                            <td class="text-center">
                                <button id="{{  'earningCategoryCreateButton' . 'earning' . 'enabled' }}" class="btn text-secondary" onclick="document.getElementById('{{  'earningCategoryCreate' . 'earning' . 'disabled' }}').className =' table-success'; document.getElementById('{{  'earningCategoryCreateButton' . 'earning' . 'enabled' }}').className =' d-none'; document.getElementById('{{  'earningCategoryCreateDelete' . 'earning' . 'disabled' }}').className =' btn text-secondary'; document.getElementById('{{  'earningCategoryCreate' . 'earning' . 'enabled' }}').className =' d-none'">
                                    <i class="far fa-plus-square"></i>
                                </button>
                                <button id="{{  'earningCategoryCreateDelete' . 'earning' . 'disabled' }}" class="d-none" onclick="document.getElementById('{{  'earningCategoryCreate' . 'earning' . 'disabled' }}').className =' d-none'; document.getElementById('{{  'earningCategoryCreateButton' . 'earning' . 'enabled' }}').className =' btn text-secondary'; document.getElementById('{{  'earningCategoryCreateDelete' . 'earning' . 'disabled' }}').className =' d-none'; document.getElementById('{{  'earningCategoryCreate' . 'earning' . 'enabled' }}').className =' '">
                                    <i class="far fa-times-circle"></i>
                                </button>
                            </td>
                            <form method="POST" action="{{ route('create.category') }}">
                                @csrf
                                @method('post')
                                <td id="{{  'earningCategoryCreate' . 'earning' . 'disabled' }}" class="d-none">
                                    <div class="input-group">
                                        <input id="category_kind" type="text" name="category_kind" class="visually-hidden" value="earning">
                                        <input id="category_name" type="text" name="category_name" class="form-control" value="{{ old('category_name') }}" placeholder="Nom catégorie" autofocus>
                                        <button class="btn btn-success" type="submit"><i class="fas fa-plus"></i></button>
                                    </div>
                                </td>
                            </form>
                            <td id="{{  'earningCategoryCreate' . 'earning' . 'enabled' }}" class=""></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        </tfoot>
                        <!-- End Earning Category Form -->
                    </table>
                    <!-- End Earning Table -->
                </div>
                <!-- End Earning Category -->
            </main>
        </div>
    </div>
@endsection

