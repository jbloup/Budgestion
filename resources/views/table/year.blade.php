@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky pt-3">
                    <div class="form-control mb-3">
                        <h6>Totaux</h6>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between"><p>Revenu</p><p><span class="badge bg-success">{{ number_format($earningTotalYear, 2, ',', ' ') . ' €' }}</span></p></li>
                            <li class="list-group-item d-flex justify-content-between"><p>Dépense</p><p><span class="badge bg-danger">@if($fuels->count() > 0)- {{ number_format($totalFuelAndCategoryYear, 2, ',', ' ') . ' €' }} @else - {{ number_format($spentTotalYear, 2, ',', ' ') . ' €' }} @endif</span></p></li>
                            <li class="list-group-item d-flex justify-content-between"><p>Total</p><p>@if($totalYear >= 0)<span class="badge bg-primary">+ {{ number_format($totalYear, 2, ',', ' ') . ' €' }} @else <span class="badge bg-danger">{{ number_format($totalYear, 2, ',', ' ') . ' €' }}</span> @endif</p></li>
                        </ul>
                    </div>
                    @if($cars->count() > 0)
                        <div class="form-control">
                            <h6>Kilométres parcourus</h6>
                            <ul class="list-group list-group-flush">
                                @foreach($cars as $car)
                                    <li class="list-group-item d-flex justify-content-between"><p>{{ $car->name }}</p><p>{{ $mileageYearTab[$car->id] . ' km' }}</p></li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </nav>
            <!-- Chart -->

            <!-- End Chart -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Bilan annuel {{ date('Y', mktime(0, 0, 0, 1, 1, $year)) }}</h1>
                    <!-- Year form -->
                    <form method="post" action="{{ route('year') }}">
                        @csrf
                        @method('post')
                        <div class="row g-1">
                            <div class="col-7">
                                <select class="form-select form-select-sm" name="year" id="year">
                                        @for( $i=1980; $i < 2100; $i++ )
                                            @if( $year == $i)
                                                <option selected="selected" value="{{ $i }}">{{ $i }}</option>
                                            @else
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endif
                                        @endfor
                                </select>
                            </div>
                            <div class="col-5">
                                <button class="btn btn-primary btn-sm" type="submit">valider</button>
                            </div>
                        </div>
                    </form>
                    <!-- End Year form -->
                </div>
                <!-- End Chart -->

                <!-- Year table -->
                @if($totalYear > 0)
                <div class="table-container">
                    <div class="form-control mb-3">
                        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
                            <h3>Total</h3>
                            @if($totalYear >= 0)
                                <span class="badge bg-primary">+ {{ number_format($totalYear, 2, ',', ' ') . ' €' }}</span>
                            @else
                                <span class="badge bg-danger">{{ number_format($totalYear, 2, ',', ' ') . ' €' }}</span>
                            @endif
                        </div>
                        <table class="table table-bordered table-sm table-hover">
                            <thead>
                            <tr class="table-primary">
                                <th>Catégorie</th>
                                @for($i=1;$i<=12;$i++)
                                    @if(date('m', mktime(0, 0, 0, $i, 1, $year)) == date('m'))
                                        <th>{{ date('F', mktime(0, 0, 0, $i, 1, $year)) }}</th>
                                    @else
                                        <th>{{ date('F', mktime(0, 0, 0, $i, 1, $year)) }}</th>
                                    @endif
                                @endfor
                                <th>Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($spentCategories->count() > 0)
                            @foreach($spentCategories as $category)
                                @if($tabTotalCategoryYear[$category->id] > 0)
                                <tr class="table-danger">
                                    <td>{{ $category->name }}</td>
                                    @for($i=1;$i<=12;$i++)
                                        @foreach($tabTotalCategoryMonth[$i] as $id => $totalCategoryMonth)
                                            @if($id == $category->id)
                                                <td>{{ number_format($totalCategoryMonth, 2, ',', ' ') . ' €' }}</td>
                                            @endif
                                        @endforeach
                                    @endfor
                                    <td>{{ number_format($tabTotalCategoryYear[$category->id], 2, ',', ' ') . ' €' }}</td>
                                </tr>
                                @endif
                            @endforeach
                            @endif
                            @if($fuels->count() > 0)
                                <tr class="table-danger">
                                    <td>Carburant</td>
                                    @for($i=1;$i<=12;$i++)
                                        <td>{{ number_format($tabTotalVehicleMonth[$i], 2, ',', ' ') . ' €' }}</td>
                                    @endfor
                                    <td>{{ number_format($totalVehicleYear, 2, ',', ' ') . ' €' }}</td>
                                </tr>
                                <tr class="table-info">
                                    <th>Total</th>
                                    @for($i=1;$i<=12;$i++)
                                        <th>{{ number_format($tabTotalFuelAndCategoryMonth[$i], 2, ',', ' ') . ' €' }}</th>
                                    @endfor
                                    <th>{{ number_format($totalFuelAndCategoryYear, 2, ',', ' ') . ' €' }}</th>
                                </tr>
                            @else
                            <tr class="table-info">
                                <th>Total</th>
                                @for($i=1;$i<=12;$i++)
                                    <th>{{ number_format($tabSpentTotalMonth[$i], 2, ',', ' ') . ' €' }}</th>
                                @endfor
                                <th>{{ number_format($spentTotalYear, 2, ',', ' ') . ' €' }}</th>
                            </tr>
                            @endif
                            @if($earningCategories->count() > 0)
                            @foreach($earningCategories as $category)
                                @if($tabTotalCategoryYear[$category->id] > 0)
                                <tr class="table-success">
                                    <td>{{ $category->name }}</td>
                                    @for($i=1;$i<=12;$i++)
                                        @foreach($tabTotalCategoryMonth[$i] as $id => $totalCategoryMonth)
                                            @if($id == $category->id)
                                                <td>{{ number_format($totalCategoryMonth, 2, ',', ' ') . ' €' }}</td>
                                            @endif
                                        @endforeach
                                    @endfor
                                    <td>{{ number_format($tabTotalCategoryYear[$category->id], 2, ',', ' ') . ' €' }}</td>
                                </tr>
                                @endif
                            @endforeach
                            <tr class="table-info">
                                <th>Total</th>
                                @for($i=1;$i<=12;$i++)
                                    <th>{{ number_format($tabEarningTotalMonth[$i], 2, ',', ' ') . ' €' }}</th>
                                @endfor
                                <th>{{ number_format($earningTotalYear, 2, ',', ' ') . ' €' }}</th>
                            </tr>
                                @endif
                            </tbody>
                        </table>
                        </div>
                    </div>
                @endif
            <!-- End Year table -->
            <!-- Spent Category Year table -->
                @if($spentCategories->count() > 0)
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Dépenses</h1>
                    <span class="badge bg-danger">- {{ number_format($totalFuelAndCategoryYear, 2, ',', ' ') . ' €' }}</span>
                </div>
                    @foreach($spentCategories as $category)
                        @if($tabTotalCategoryYear[$category->id] > 0)
                            <div class="table-container">
                                <div class="form-control mb-3">
                                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
                                        <h3>{{ $category->name }}</h3>
                                        <span class="badge bg-danger">- {{  number_format($tabTotalCategoryYear[$category->id], 2, ',', ' ') . ' €' }}</span>
                                    </div>
                                @foreach($category->types as $type)
                                    <table class="table table-bordered table-sm table-hover">
                                        <thead>
                                        <tr class="table-danger">
                                            <th>{{ $type->name }}</th>
                                            @for($i=1;$i<=12;$i++)
                                                @if(date('m', mktime(0, 0, 0, $i, 1, $year)) == date('m'))
                                                    <th>{{ date('F', mktime(0, 0, 0, $i, 1, $year)) }}</th>
                                                @else
                                                    <th>{{ date('F', mktime(0, 0, 0, $i, 1, $year)) }}</th>
                                                @endif
                                            @endfor
                                            <th>Total</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($type->families as $family)
                                            @if($tabTotalFamilyYear[$family->id] > 0)
                                            <tr class="table-warning">
                                                <td>{{ $family->name }}</td>
                                                @for($i=1;$i<=12;$i++)
                                                    @foreach($tabTotalFamilyMonth[$i] as $id => $totalFamilyMonth)
                                                        @if($id == $family->id)
                                                            <td>{{ number_format($totalFamilyMonth, 2, ',', ' ') . ' €' }}</td>
                                                        @endif
                                                    @endforeach
                                                @endfor
                                                <td>{{ number_format($tabTotalFamilyYear[$family->id], 2, ',', ' ') . ' €' }}</td>
                                            </tr>
                                            @endif
                                        </tbody>
                                        @endforeach
                                        <tfoot>
                                        <tr class="table-info">
                                            <th>Total</th>
                                            @for($i=1;$i<=12;$i++)
                                                @foreach($tabTotalTypeMonth[$i] as $id => $tabTotalType)
                                                    @if($id == $type->id)
                                                        <th>{{ number_format($tabTotalType, 2, ',', ' ') . ' €' }}</th>
                                                    @endif
                                                @endforeach
                                            @endfor
                                            <th>{{ number_format($tabTotalTypeYear[$type->id], 2, ',', ' ') . ' €' }}</th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                @endforeach
                            </div>
                        </div>
                        @endif
                    @endforeach
                @endif
                <!-- Fuel Year table -->
                @if($fuels->count() > 0)
                <div class="table-container">
                    <div class="form-control mb-3">
                        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
                            <h3>Carburant</h3>
                            <span class="badge bg-danger">- {{  number_format($totalVehicleYear, 2, ',', ' ') . ' €' }}</span>
                        </div>
                    <table class="table table-bordered table-sm table-hover">
                        <thead>
                        <tr class="table-danger">
                            <th>Carburant €</th>
                            @for($i=1;$i<=12;$i++)
                                @if(date('m', mktime(0, 0, 0, $i, 1, $year)) == date('m'))
                                    <th>{{ date('F', mktime(0, 0, 0, $i, 1, $year)) }}</th>
                                @else
                                    <th>{{ date('F', mktime(0, 0, 0, $i, 1, $year)) }}</th>
                                @endif
                            @endfor
                            <th>Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($cars as $car)
                            @if($tabTotalCarYear[$car->id] > 0)
                            <tr class="table-warning">
                                <td>{{ $car->name }}</td>
                                @for($i=1;$i<=12;$i++)
                                    @foreach($tabTotalCarMonth[$i] as $id => $totalCarMonth)
                                        @if($id == $car->id)
                                            <td>{{ number_format($totalCarMonth, 2, ',', ' ') . ' €' }}</td>
                                        @endif
                                    @endforeach
                                @endfor
                                <td>{{ number_format($tabTotalCarYear[$car->id], 2, ',', ' ') . ' €' }}</td>
                            </tr>
                            @endif
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr class="table-info">
                            <th>Total</th>
                            @for($i=1;$i<=12;$i++)
                                <th>{{ number_format($tabTotalVehicleMonth[$i], 2, ',', ' ') . ' €' }}</th>
                            @endfor
                            <th>{{ number_format($totalVehicleYear, 2, ',', ' ') . ' €' }}</th>
                        </tr>
                        </tfoot>
                    </table>
                        <table class="table table-bordered table-sm table-hover">
                            <thead>
                            <tr class="table-primary">
                                <th>Carburant L</th>
                                @for($i=1;$i<=12;$i++)
                                    @if(date('m', mktime(0, 0, 0, $i, 1, $year)) == date('m'))
                                        <th class="is-selected">{{ date('F', mktime(0, 0, 0, $i, 1, $year)) }}</th>
                                    @else
                                        <th>{{ date('F', mktime(0, 0, 0, $i, 1, $year)) }}</th>
                                    @endif
                                @endfor
                                <th>Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($cars as $car)
                                @if($tabTotalLiterCarYear[$car->id] > 0)
                                <tr class="table-warning">
                                    <td>{{ $car->name }}</td>
                                    @for($i=1;$i<=12;$i++)
                                        @foreach($tabTotalLiterCarMonth[$i] as $id => $totalLiterCarMonth)
                                            @if($id == $car->id)
                                                <td>{{ number_format($totalLiterCarMonth, 2, ',', ' '). ' L' }}</td>
                                            @endif
                                        @endforeach
                                    @endfor
                                    <td>{{ number_format($tabTotalLiterCarYear[$car->id], 2, ',', ' '). ' L' }}</td>
                                </tr>
                                @endif
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr class="table-info">
                                <th>Total</th>
                                @for($i=1;$i<=12;$i++)
                                    <th>{{ number_format($tabTotalLiterVehicleMonth[$i], 2, ',', ' '). ' L' }}</th>
                                @endfor
                                <th>{{ number_format($totalLiterVehicleYear, 2, ',', ' '). ' L' }}</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                @endif
                <!-- End Fuel Year table -->
                <!-- End Spent Category Year table -->
                <!-- Earning Category Year table -->
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Revenus</h1>
                    <span class="badge bg-success">{{ number_format($earningTotalYear, 2, ',', ' ') . ' €' }}</span>
                </div>
                @foreach($earningCategories as $category)
                        @if($tabTotalCategoryYear[$category->id] > 0)
                    <div class="table-container">
                        <div class="form-control mb-3">
                            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
                                <h3>{{ $category->name }}</h3>
                                <span class="badge bg-success">{{  number_format($tabTotalCategoryYear[$category->id], 2, ',', ' ') . ' €' }}</span>
                            </div>
                            @foreach($category->types as $type)
                                @if($tabTotalTypeYear[$type->id] > 0)
                                <table class="table table-bordered table-sm table-hover">
                                    <thead>
                                    <tr class="table-success">
                                        <th>{{ $type->name }}</th>
                                        @for($i=1;$i<=12;$i++)
                                            @if(date('m', mktime(0, 0, 0, $i, 1, $year)) == date('m'))
                                                <th>{{ date('F', mktime(0, 0, 0, $i, 1, $year)) }}</th>
                                            @else
                                                <th>{{ date('F', mktime(0, 0, 0, $i, 1, $year)) }}</th>
                                            @endif
                                        @endfor
                                        <th>Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($type->families as $family)
                                        @if($tabTotalFamilyYear[$family->id] > 0)
                                            <tr class="table-warning">
                                                <td>{{ $family->name }}</td>
                                                @for($i=1;$i<=12;$i++)
                                                    @foreach($tabTotalFamilyMonth[$i] as $id => $totalFamilyMonth)
                                                        @if($id == $family->id)
                                                            <td>{{ number_format($totalFamilyMonth, 2, ',', ' ') . ' €' }}</td>
                                                        @endif
                                                    @endforeach
                                                @endfor
                                                <td>{{ number_format($tabTotalFamilyYear[$family->id], 2, ',', ' ') . ' €' }}</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                    @endforeach
                                    <tfoot>
                                    <tr class="table-info">
                                        <th>Total</th>
                                        @for($i=1;$i<=12;$i++)
                                            @foreach($tabTotalTypeMonth[$i] as $id => $tabTotalType)
                                                @if($id == $type->id)
                                                    <th>{{ number_format($tabTotalType, 2, ',', ' ') . ' €' }}</th>
                                                @endif
                                            @endforeach
                                        @endfor
                                        <th>{{ number_format($tabTotalTypeYear[$type->id], 2, ',', ' ') . ' €' }}</th>
                                    </tr>
                                    </tfoot>
                                </table>
                                @endif
                            @endforeach
                        </div>
                    </div>
                        @endif
                @endforeach

                <!-- End Earning Category Year table -->
            </main>
        </div>
    </div>
@endsection
