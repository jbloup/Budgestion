@extends('layouts.app')
@section('content')
    <main role="main">
        <!-- Main jumbotron for a primary marketing message or call to action -->
        <div class="jumbotron mt-5">
            <div class="container mt-5">
                <h1 class="display-3">Bienvenu sur Budgestion !</h1>
                <p>L'application de gestion de budget.</p>
                <p><a class="btn btn-primary btn-lg" href="{{ route('register') }}" role="button">Commencer &raquo;</a></p>
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
        </div>
        <!-- /container -->
        {{--
        <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
            <h1 class="display-4 fw-normal">Pricing</h1>
            <p class="fs-5 text-muted">Quickly build an effective pricing table for your potential customers with this Bootstrap example. It’s built with default Bootstrap components and utilities with little customization.</p>
        </div>

        <main>
            <div class="row row-cols-1 row-cols-md-3 mb-3 text-center">
                <div class="col">
                    <div class="card mb-4 rounded-3 shadow-sm">
                        <div class="card-header py-3">
                            <h4 class="my-0 fw-normal">Free</h4>
                        </div>
                        <div class="card-body">
                            <h1 class="card-title pricing-card-title">$0<small class="text-muted fw-light">/mo</small></h1>
                            <ul class="list-unstyled mt-3 mb-4">
                                <li>10 users included</li>
                                <li>2 GB of storage</li>
                                <li>Email support</li>
                                <li>Help center access</li>
                            </ul>
                            <button type="button" class="w-100 btn btn-lg btn-outline-primary">Sign up for free</button>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card mb-4 rounded-3 shadow-sm">
                        <div class="card-header py-3">
                            <h4 class="my-0 fw-normal">Pro</h4>
                        </div>
                        <div class="card-body">
                            <h1 class="card-title pricing-card-title">$15<small class="text-muted fw-light">/mo</small></h1>
                            <ul class="list-unstyled mt-3 mb-4">
                                <li>20 users included</li>
                                <li>10 GB of storage</li>
                                <li>Priority email support</li>
                                <li>Help center access</li>
                            </ul>
                            <button type="button" class="w-100 btn btn-lg btn-primary">Get started</button>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card mb-4 rounded-3 shadow-sm border-primary">
                        <div class="card-header py-3 text-white bg-primary border-primary">
                            <h4 class="my-0 fw-normal">Enterprise</h4>
                        </div>
                        <div class="card-body">
                            <h1 class="card-title pricing-card-title">$29<small class="text-muted fw-light">/mo</small></h1>
                            <ul class="list-unstyled mt-3 mb-4">
                                <li>30 users included</li>
                                <li>15 GB of storage</li>
                                <li>Phone and email support</li>
                                <li>Help center access</li>
                            </ul>
                            <button type="button" class="w-100 btn btn-lg btn-primary">Contact us</button>
                        </div>
                    </div>
                </div>
            </div>

            <h2 class="display-6 text-center mb-4">Compare plans</h2>

            <div class="table-responsive">
                <table class="table text-center">
                    <thead>
                    <tr>
                        <th style="width: 34%;"></th>
                        <th style="width: 22%;">Free</th>
                        <th style="width: 22%;">Pro</th>
                        <th style="width: 22%;">Enterprise</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row" class="text-start">Public</th>
                        <td><svg class="bi" width="24" height="24"><use xlink:href="#check"/></svg></td>
                        <td><svg class="bi" width="24" height="24"><use xlink:href="#check"/></svg></td>
                        <td><svg class="bi" width="24" height="24"><use xlink:href="#check"/></svg></td>
                    </tr>
                    <tr>
                        <th scope="row" class="text-start">Private</th>
                        <td></td>
                        <td><svg class="bi" width="24" height="24"><use xlink:href="#check"/></svg></td>
                        <td><svg class="bi" width="24" height="24"><use xlink:href="#check"/></svg></td>
                    </tr>
                    </tbody>

                    <tbody>
                    <tr>
                        <th scope="row" class="text-start">Permissions</th>
                        <td><svg class="bi" width="24" height="24"><use xlink:href="#check"/></svg></td>
                        <td><svg class="bi" width="24" height="24"><use xlink:href="#check"/></svg></td>
                        <td><svg class="bi" width="24" height="24"><use xlink:href="#check"/></svg></td>
                    </tr>
                    <tr>
                        <th scope="row" class="text-start">Sharing</th>
                        <td></td>
                        <td><svg class="bi" width="24" height="24"><use xlink:href="#check"/></svg></td>
                        <td><svg class="bi" width="24" height="24"><use xlink:href="#check"/></svg></td>
                    </tr>
                    <tr>
                        <th scope="row" class="text-start">Unlimited members</th>
                        <td></td>
                        <td><svg class="bi" width="24" height="24"><use xlink:href="#check"/></svg></td>
                        <td><svg class="bi" width="24" height="24"><use xlink:href="#check"/></svg></td>
                    </tr>
                    <tr>
                        <th scope="row" class="text-start">Extra security</th>
                        <td></td>
                        <td></td>
                        <td><svg class="bi" width="24" height="24"><use xlink:href="#check"/></svg></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </main>--}}

    </main>
@endsection
