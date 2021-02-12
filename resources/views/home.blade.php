@extends('layouts.app')

@section('content')
<section class="hero is-primary is-fullheight-with-navbar is-bold">
    <div class="hero-body">
        <div class="">
        <p class="title">
            Bienvenue {{ $user_name }}
        </p>
        <p class="subtitle" >{{ date('d-m-Y') }}</p>
{{--        <a href="{{ url('/forgot-password') }}">réinitialiser mot de passe</a>--}}
    </div>
    </div>
</section>
@endsection
