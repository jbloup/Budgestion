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
    <div class="container mt-5">
        <h1 class="jumbotron-heading">Bienvenue {{ $user_name }}</h1>
        <p class="lead text-muted">{{ date('d-m-Y') }}</p>
    </div>
</section>
@endsection
