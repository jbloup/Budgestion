@extends('layouts.app')

@section('content')
    <section class="hero is-medium is-primary is-bold">
        <div class="hero-body">
            <div class="container">
                <h1 class="title">
                    Dépenses annuelles
                </h1>
                <h2 class="subtitle">
                    Liste des dépenses de l'année {{ $year }}.
                </h2>
            </div>
        </div>
    </section>
    <section class="section is-small">
    </section>
@endsection
