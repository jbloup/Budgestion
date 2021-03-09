@extends('layouts.app')

@section('content')
    <section class="hero is-medium is-primary is-bold">
        <div class="hero-body">
            <div class="container">
                <h1 class="title">
                    Dépenses annuelles
                </h1>
                <h2 class="subtitle">
                    Liste des dépenses de l'année {{ date('Y', mktime(0, 0, 0, 1, 1, $year)) }}.
                </h2>
            </div>
        </div>
    </section>
    <section class="section is-small">
        <div class="container is-fluid">
            <div class="notification">
                <nav class="level">
                    <!-- Left side -->
                    <div class="level-left">
                        <div class="level-item">
                            <h1 class="title is-1">{{ $year }}</h1>
                        </div>
                    </div>
                    <!-- Right side -->
                    <div class="level-right is-success">
                        <p class="level-item subtitle"><span class="tag is-danger is-light is-large">{{ number_format($totalFuelAndCategoryYear, 2, ',', ' ') . ' €' }}</span></p>
                    </div>
                </nav>
                <div class="field">
                    <form method="post" action="{{ route('year') }}">
                        @csrf
                        @method('post')
                        <div class="field is-grouped">
                            <div class="control">
                                <div class="select is-small">
                                    <select name="year" id="year">
                                        @for( $i=1980; $i < 2100; $i++ )
                                            @if( $year == $i)
                                                <option selected="selected" value="{{ $i }}">{{ $i }}</option>
                                            @else
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endif
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <button class="button is-small" type="submit">valider</button>
                        </div>
                    </form>
                </div>
                <div class="table-container">
                    <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth has-text-centered">
                        <thead>
                        <tr>
                            <th>Catégorie</th>
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
                        @foreach($categories as $category)
                            <tr>
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
                        @endforeach
                        </tbody>

                        <tr>
                            <th>Total</th>
                            @for($i=1;$i<=12;$i++)
                                <th>{{ number_format($tabTotalMonth[$i], 2, ',', ' ') . ' €' }}</th>
                            @endfor
                            <th>{{ number_format($totalYear, 2, ',', ' ') . ' €' }}</th>
                        </tr>

                        <tr>
                            <td>Carburant</td>
                            @for($i=1;$i<=12;$i++)
                                <td>{{ number_format($tabTotalVehicleMonth[$i], 2, ',', ' ') . ' €' }}</td>
                            @endfor
                            <td>{{ number_format($totalVehicleYear, 2, ',', ' ') . ' €' }}</td>
                        </tr>
                        <tfoot>
                        <tr>
                            <th>Total Cat+Carb</th>
                            @for($i=1;$i<=12;$i++)
                                <th>{{ number_format($tabTotalFuelAndCategoryMonth[$i], 2, ',', ' ') . ' €' }}</th>
                            @endfor
                            <th>{{ number_format($totalFuelAndCategoryYear, 2, ',', ' ') . ' €' }}</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <section class="section is-small">
        <div class="container is-fluid">
            @foreach($categories as $category)
                <div class="notification">
                    <nav class="level">
                        <!-- Left side -->
                        <div class="level-left">
                            <div class="level-item">
                                <p class="title">{{ $category->name }}
                                </p>
                            </div>
                        </div>
                        <!-- Right side -->
                        <div class="level-right">
                            <p class="level-item subtitle"><span class="tag is-danger is-large is-light">{{  number_format($tabTotalCategoryYear[$category->id], 2, ',', ' ') . ' €' }}</span></p>
                        </div>
                    </nav>
                    <div class="table-container">
                        @foreach($category->types as $type)
                            <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth has-text-centered">
                                <thead>
                                <tr>
                                    <th class="is-selected">{{ $type->name }}</th>
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
                                @foreach($type->families as $family)
                                    <tr>
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
                                </tbody>
                                @endforeach
                                <tfoot>
                                <tr>
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
            @endforeach
        </div>
    </section>
    <section class="section is-small">
        <div class="container is-fluid">
            <div class="notification">
                <nav class="level">
                    <!-- Left side -->
                    <div class="level-left">
                        <div class="level-item">
                            <p class="title">Carburant
                            </p>
                        </div>
                    </div>
                    <!-- Right side -->
                    <div class="level-right">
                        <p class="level-item subtitle">
                            <span class="tag is-link is-large is-light mr-1">{{  number_format($totalLiterVehicleYear, 2, ',', ' ') . ' L' }}</span>
                            <span class="tag is-danger is-large is-light">{{  number_format($totalVehicleYear, 2, ',', ' ') . ' €' }}</span>
                        </p>
                    </div>
                </nav>
                <div class="table-container">
                    <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth has-text-centered">
                        <thead>
                        <tr>
                            <th>Carburant</th>
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
                            <tr>
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
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Total</th>
                            @for($i=1;$i<=12;$i++)
                                <th>{{ number_format($tabTotalVehicleMonth[$i], 2, ',', ' ') . ' €' }}</th>
                            @endfor
                            <th>{{ number_format($totalVehicleYear, 2, ',', ' ') . ' €' }}</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>



                <div class="table-container">
                    <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth has-text-centered">
                        <thead>
                        <tr>
                            <th>Carburant</th>
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
                            <tr>
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
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
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
        </div>
    </section>
@endsection
