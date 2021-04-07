@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky pt-3">
                    <div class="form-control mb-3">
                        <h6>Totaux</h6>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between"><p>Revenu</p><p><span class="badge bg-success">{{ $earningTotal . ' €' }}</span></p></li>
                            <li class="list-group-item d-flex justify-content-between"><p>Dépense</p><p><span class="badge bg-danger">- {{ $spentFuelTotal . ' €' }}</span></p></li>
                            <li class="list-group-item d-flex justify-content-between"><p>Total</p><p>@if($total >= 0)<span class="badge bg-primary">+ {{ $total . ' €' }}</span> @else <span class="badge bg-danger ">{{ $total . ' €' }}</span>@endif</p></li>
                        </ul>
                    </div>
                    @if($cars->count() > 0)
                        <div class="form-control">
                            <h6>Kilométres parcourus</h6>
                            <ul class="list-group list-group-flush">
                                @foreach($cars as $car)
                                    <li class="list-group-item d-flex justify-content-between"><p>{{ $car->name }}</p><p>{{ $mileageMonthTab[$car->id] . ' km' }}</p></li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </nav>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Bilan mensuel {{ date('F Y', strtotime($date)) }}</h1>
                    <!-- Month form -->
                    <form method="post" action="{{ route('month') }}">
                        @csrf
                        @method('post')
                        <div class="row g-1">
                            <div class="col-4">
                                <select class="form-select form-select-sm" name="month" id="month">
                                    @for($i=1;$i<=12;$i++)
                                        @if(date('m', mktime(0, 0, 0, $i, 10)) == date('m', strtotime($date)))
                                            <option selected="selected" value="{{ date('m', mktime(0, 0, 0, $i, 10)) }}">{{ date('F', mktime(0, 0, 0, $i, 10)) }}</option>
                                        @else
                                            <option value="{{ date('m', mktime(0, 0, 0, $i, 10)) }}">{{ date('F', mktime(0, 0, 0, $i, 10)) }}</option>
                                        @endif
                                    @endfor
                                </select>
                            </div>
                            <div class="col-4">
                                <select class="form-select form-select-sm"  name="year" id="year">
                                    @for( $i=1980; $i < 2100; $i++ )
                                        @if( date("Y", strtotime($date)) == $i)
                                            <option selected="selected" value="{{ $i }}">{{ $i }}</option>
                                        @else
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endif
                                    @endfor
                                </select>
                            </div>
                            <div class="col-4">
                                <button class="btn btn-primary btn-sm" type="submit">valider</button>
                            </div>
                        </div>
                    </form>
                    <!-- End Month form -->
                </div>
                <!-- Chart -->

                <!-- End Chart -->
                <!-- Spent Month table -->
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Dépenses</h1>
                    <span class="badge bg-danger">- {{ $spentTotal . ' €' }}</span>
                </div>
                @foreach($spentCategories as $category)
                    @if($categoryTotals[$category->id] > 0)
                        <div class="form-control mb-3">
                            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
                                <h3>{{ $category->name }}</h3>
                                <span class="badge bg-danger">- {{  number_format($categoryTotals[$category->id], 2, ',', ' ') . ' €' }}</span>
                            </div>
                            @foreach($category->types as $type)
                                @if($typeTotals[$type->id] > 0)
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-sm">
                                            <thead>
                                            <tr class="table-danger">
                                                <th>{{ $type->name }}</th>
                                                <th>Nom</th>
                                                <th>Description</th>
                                                <th>Date</th>
                                                <th>Prix</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($type->families as $family)
                                                @foreach($family->spents as $spent)
                                                    <tr class="table-warning">
                                                        @if( $spent->date >= $date && $spent->date < $date2 )
                                                            <td>{{ $family->name }}</td>
                                                            <td>{{ $spent->name }}</td>
                                                            <td>{{ $spent->description }}</td>
                                                            <td>{{ date('d-m-Y', strtotime($spent->date)) }}</td>
                                                            <td>{{ $spent->price . ' €' }}</td>
                                                        @endif
                                                    </tr>
                                                @endforeach
                                            @endforeach
                                            </tbody>
                                            <tfoot>
                                            <tr class="table-info">
                                                <th>Total</th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th>{{  number_format($typeTotals[$type->id], 2, ',', ' ') . ' €' }}</th>
                                            </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endif
                @endforeach
            <!-- End Spent Month table -->
                <!-- Fuel Month table -->
                @if($cars->count() > 0)
                    <div class="form-control mb-3">
                        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
                            <h3>Carburant</h3>
                            <span class="badge bg-danger">- {{ $fuelTotal . ' €' }} </span>
                        </div>
                        @if($fuelTotal > 0 || $fuelTotalLiter > 0)
                            <div class="table-responsive">
                                <table class="table table-bordered table-sm">
                                    <thead>
                                    <tr class="table-danger">
                                        <th>Véhicule</th>
                                        <th>Date</th>
                                        <th>Kilométrage</th>
                                        <th>Litres</th>
                                        <th>Prix</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($fuels as $fuel)
                                        <tr class="table-warning">
                                            @if( $fuel->date >= $date && $fuel->date < $date2 )
                                                <td>{{ $fuel->car->name }}</td>
                                                <td>{{ date('d-m-Y', strtotime($fuel->date)) }}</td>
                                                <td>{{ $fuel->mileage }}</td>
                                                <td>{{ $fuel->liter }}</td>
                                                <td>{{ $fuel->price . ' €' }}</td>
                                            @endif
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr class="table-info">
                                        <th>Total</th>
                                        <th></th>
                                        <th></th>
                                        <th>{{ $fuelTotalLiter . ' L' }}</th>
                                        <th>{{ $fuelTotal . ' €' }}</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        @endif
                    </div>
                @endif
            <!-- End Fuel Month table -->
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Revenus</h1>
                    <span class="badge bg-success">{{ $earningTotal . ' €' }}</span>
                </div>
                <!-- Earning Month table -->
                @foreach($earningCategories as $category)
                    @if($categoryTotals[$category->id] > 0)
                        <div class="form-control mb-3">
                            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
                                <h3>{{ $category->name }}</h3>
                                <span class="badge bg-success">{{  number_format($categoryTotals[$category->id], 2, ',', ' ') . ' €' }}</span>
                            </div>
                            @foreach($category->types as $type)
                                @if($typeTotals[$type->id] > 0)
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-sm">
                                            <thead>
                                            <tr class="table-success">
                                                <th>{{ $type->name }}</th>
                                                <th>Nom</th>
                                                <th>Description</th>
                                                <th>Date</th>
                                                <th>Prix</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($type->families as $family)
                                                @foreach($family->earnings as $earning)
                                                    <tr class="table-warning">
                                                        @if( $earning->date >= $date && $earning->date < $date2 )
                                                            <td>{{ $family->name }}</td>
                                                            <td>{{ $earning->name }}</td>
                                                            <td>{{ $earning->description }}</td>
                                                            <td>{{ date('d-m-Y', strtotime($earning->date)) }}</td>
                                                            <td>{{ $earning->amount . ' €' }}</td>
                                                        @endif
                                                    </tr>
                                                @endforeach
                                            @endforeach
                                            <tr class="table-info">
                                                <th>Total</th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th>{{  number_format($typeTotals[$type->id], 2, ',', ' ') . ' €' }}</th>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                @endif
                            @endforeach
                        </div>
            @endif
            @endforeach
        </div>
        <!-- End Earning Month table -->
        </main>
    </div>
    </div>
@endsection
