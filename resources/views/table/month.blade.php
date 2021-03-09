@extends('layouts.app')

@section('content')
    <section class="hero is-medium is-primary is-bold">
        <div class="hero-body">
            <div class="container">
                <h1 class="title">
                    Dépenses Mensuelles
                </h1>
                <h2 class="subtitle">
                    Liste des dépenses du mois de {{ date('F Y', strtotime($date)) }}.
                </h2>
            </div>
        </div>
    </section>
    <section class="section is-small">
        <div class="container is-max-desktop">
        <div class="notification mb-5">
            <nav class="level">
                <!-- Left side -->
                <div class="level-left">
                    <div class="level-item">
        <h1 class="title is-1">{{ date('F Y', strtotime($date)) }}</h1>
                    </div>
                </div>
                <!-- Right side -->
                <div class="level-right is-success">
                    <p class="level-item subtitle"><span class="tag is-danger is-light is-large">{{ $total . ' €' }}</span></p>
                </div>
            </nav>
            <form method="post" action="{{ route('month') }}">
                @csrf
                @method('post')
                <div class="field is-grouped">
                <div class="control">
                <div class="select is-small">
                <select name="month" id="month">
                @for($i=1;$i<=12;$i++)
                        @if(date('m', mktime(0, 0, 0, $i, 10)) == date('m', strtotime($date)))
                            <option selected="selected" value="{{ date('m', mktime(0, 0, 0, $i, 10)) }}">{{ date('F', mktime(0, 0, 0, $i, 10)) }}</option>
                        @else
                            <option value="{{ date('m', mktime(0, 0, 0, $i, 10)) }}">{{ date('F', mktime(0, 0, 0, $i, 10)) }}</option>
                        @endif
                @endfor
                </select>
                </div>
                </div>
                <div class="control">
                    <div class="select is-small">
                <select name="year" id="year">
                    @for( $i=1980; $i < 2100; $i++ )
                        @if( date("Y", strtotime($date)) == $i)
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
        </div>
        <div class="container is-max-desktop">
    @foreach($categories as $category)
        @if($categoryTotals[$category->id] <= 0)
                <div class="is-hidden">
        @else
                <div class="notification">
        @endif
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
                    <p class="level-item subtitle"><span class="tag is-danger is-large is-light">{{  number_format($categoryTotals[$category->id], 2, ',', ' ') . ' €' }}</span></p>
                </div>
        </nav>
        @foreach($category->types as $type)
               @if($typeTotals[$type->id] <= 0)
                                    <div class="is-hidden">
                                @else
                                    <div class="table-container">
                                @endif
                    <table class="table is-hoverable is-fullwidth has-text-centered">
                <thead>
                <tr></tr>
                <tr>
                    <th class="is-selected" >{{ $type->name }}</th>
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Date</th>
                    <th>Prix</th>
                </tr>
                </thead>
            <tbody>
                        @foreach($type->families as $family)
                            <tr>
                            @foreach($family->spents as $spent)
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
            <tr>
                <th>Total</th>
                <th></th>
                <th></th>
                <th></th>
                <th>{{  number_format($typeTotals[$type->id], 2, ',', ' ') . ' €' }}</th>
            </tr>
            </tbody>
                    </table>
                </div>
                    @endforeach
                </div>
    @endforeach
                </div>
    </section>
@endsection
