@extends('layouts.app')
@section('content')
    <main role="main">

        <!-- Main jumbotron for a primary marketing message or call to action -->
        <div class="jumbotron mt-5">
            <div class="container mt-5">
                <h1 class="display-3">Bienvenu sur Budgestion !</h1>
                <p>L'application de gestion de budget.</p>
                <p><a class="btn btn-primary btn-lg" href="#" role="button">Lire plus &raquo;</a></p>
            </div>
        </div>

        <div class="container">
            <!-- Example row of columns -->
            <div class="row">
                <div class="col-md-3">
                    <h2>Dépenses</h2>
                    <p>Après avoir créer vos catégories, type et sous-type, enregistrez et classez vos dépenses.</p>
                    <p><a class="btn btn-secondary" href="#" role="button">Détails &raquo;</a></p>
                </div>
                <div class="col-md-3">
                    <h2>Revenus</h2>
                    <p>Enregistrez également vos différents revenus, qui seront eux aussi classés par catégorie, type et sous-type.</p>
                    <p><a class="btn btn-secondary" href="#" role="button">Détails &raquo;</a></p>
                </div>
                <div class="col-md-3">
                    <h2>Bilans</h2>
                    <p>Consultez les bilans annuels et mensuels de vos dépenses et de vos revenus.</p>
                    <p><a class="btn btn-secondary" href="#" role="button">Détails &raquo;</a></p>
                </div>
                <div class="col-md-3">
                    <h2>Véhicules</h2>
                    <p>Créez des véhicules avec leur kilométrage, mis à jour lors de l'enregistrement des dépenses de carburant.</p>
                    <p><a class="btn btn-secondary" href="#" role="button">Détails &raquo;</a></p>
                </div>

            </div>

            <hr>

        </div> <!-- /container -->

    </main>
@endsection
