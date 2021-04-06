@extends('layouts.app')

@section('content')
<section class="hero is-primary is-fullheight-with-navbar is-bold">
    <div class="hero-body">
        <div class="">
        <p class="title">

        </p>
        <p class="subtitle" ></p>
    </div>
    </div>
</section>
<section class="jumbotron text-center mt-5">
    <div class="container mt-5 border-bottom">
        <h1 class="jumbotron-heading">Bienvenue {{ $user_name }}</h1>
        <p class="lead text-muted">{{ date('d-m-Y') }}</p>
    </div>
    <div class="d-flex justify-content-center mt-5">
        <form method="POST" action="{{route('create.spent')}}" class="needs-validation" novalidate>
            @csrf
            <h1 class="h3 mb-3 fw-normal">Ajouter une dépense</h1>
            <label for="name" class="visually-hidden">Désignation du dépense</label>
            <input id="name" type="text" name="name" class="form-control mb-2 @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Nom dépense ..." aria-describedby="validationName" required>
            @error('name')
            <div id="validationName" class="invalid-feedback">{{ $message }}</div>
            @enderror
            <label for="description" class="visually-hidden">Description du dépense</label>
            <textarea id="description" name="description" class="form-control mb-2" value="{{ old('description') }}" placeholder="Description dépense ..."></textarea>
            <label for="price" class="visually-hidden">Montant du dépense</label>
            <input id="price" type="number"  step=".01" name="price" class="form-control mb-2 @error('price') is-invalid @enderror" value="{{ old('price') }}" placeholder="Prix ..." aria-describedby="validationPrice" required>
            @error('price')
            <div id="validationPrice" class="invalid-feedback">{{ $message }}</div>
            @enderror
            <label for="date" class="visually-hidden">Date du dépense</label>
            <input id="date" type="date" name="date" class="form-control mb-2 @error('date') is-invalid @enderror"
                   @if(old('date'))
                   value="{{ old('date') }}"
                   @else
                   value="{{ date('d-m-Y') }}"
                   @endif
                   placeholder="JJ-MM-YYYY" aria-describedby="validationDate" required>
            @error('date')
            <div id="validationDate" class="invalid-feedback">{{ $message }}</div>
            @enderror
            <label for="family_id" class="visually-hidden">Type de dépense</label>
            <select class="form-select mb-2 @error('family_id') is-invalid @enderror" id="family_id" name="family_id" aria-describedby="validationFamily" required>
                <option value="">type de dépense ...</option>
                @foreach($categories as $category)
                    @foreach($category->types as $type)
                        @foreach($type->families as $family)
                            <option value="{{ $family->id }}">{{ $category->name . ' / ' . $type->name . ' / ' . $family->name }}</option>
                        @endforeach
                    @endforeach
                @endforeach
            </select>
            @error('family_id')
            <div id="validationFamily" class="invalid-feedback">{{ $message }}</div>
            <p class="text-danger" >{{ $message }}</p>
            @enderror
            <label for="account_id" class="visually-hidden">Compte bancaire</label>
            <select class="form-select mb-2 @error('account_id') is-invalid @enderror" id="account_id" name="account_id" aria-describedby="validationAccount" required>
                @foreach($accounts as $account)
                    <option value="{{$account->id}}">{{$account->number . " : " . $account->name}}
                        @if($account->main == 1)
                            | principal
                        @endif
                    </option>
                @endforeach
            </select>
            @error('account_id')
            <div id="validationAccount" class="invalid-feedback">{{ $message }}</div>
            @enderror
            <button class="w-100 btn btn-lg btn-primary mt-3" type="submit">Créer dépense</button>
        </form>
    </div>
</section>
@endsection
