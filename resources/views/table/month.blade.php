@extends('layouts.app')

@section('content')
    <section class="hero is-medium is-primary is-bold">
        <div class="hero-body">
            <div class="container">
                <h1 class="title">
                    Dépenses Mensuelles
                </h1>
                <h2 class="subtitle">
                    Liste des dépenses par mois et par catégorie.
                </h2>
            </div>
        </div>
    </section>
    <section class="section is-small">
@foreach($spents as $spent)


    <h1>{{ $spent->family->type->category->name }}</h1>
    <h2>{{ $spent->name }}</h2>
    <h2>{{ date('d/m/Y', strtotime(str_replace('-', '/',$spent->date)) )}}</h2>


        @endforeach


    </section>
@endsection
