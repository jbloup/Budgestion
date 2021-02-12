@extends('layouts.app')

@section('content')
    <section class="hero is-medium is-primary is-bold">
        <div class="hero-body">
            <div class="container">
                <h1 class="title">
                    Dépenses Mensuelles
                </h1>
                <h2 class="subtitle">
                    Liste des dépenses du mois de {{ $month }}.
                </h2>
            </div>
        </div>
    </section>
    <section class="section is-small">
    @foreach($categories as $category)
        <h1>   {{ $category->name }}</h1>
    <div class="table-container">
        <table class="table-container table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
            <thead>
            <tr class="is-selected">
                <th>Type / Sous-type</th>
                <th>Nom</th>
                <th>Description</th>
                <th>Prix</th>
                <th>Date</th>
                <th>Compte Bancaire</th>
                <th>Total</th>
            </tr>
            </thead>
                    @foreach($category->types as $type)
                <tr>
                    <th>{{ $type->name }}</th>

                </tr>
                        @foreach($type->families as $family)
                            <tr>
                            @foreach($family->spents as $spent)
                                    @if( $spent->date >= date('Y-m') )
                                    <td>{{ $family->name }}</td>
                                    <td>{{ $spent->name }}</td>
                                    <td>{{ $spent->description }}</td>
                                    <td>{{ $spent->price }}</td>
                                    <td>{{ date('d-m-Y', strtotime($spent->date)) }}</td>
                                    <td>{{ $spent->account->name }}</td>
                                    <td>{{ $spent->account->name }}</td>
                                    @endif
                            </tr>
                            @endforeach

{{--                    <td>{{ $category->type->family->spent->description }}</td>
                    <td>{{ $category->type->family->spent->price }}</td>
                    <td>{{ date('d-m-Y', strtotime($category->type->family->spent->date)) }}</td>
                    <td>{{ $category->type->family->name }}</td>
                    <td>{{ $category->type->name }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->type->family->spent->account->name }}</td>--}}


                        @endforeach

                    @endforeach



        </table>
    </div>
    @endforeach
    </section>
@endsection
