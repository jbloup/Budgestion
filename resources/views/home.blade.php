@extends('layouts.app')

@section('content')
<section class="hero is-primary is-fullheight-with-navbar is-bold">
    <div class="hero-body">
        <p class="title">
            Bienvenue {{ $user_name }}

        </p>
        <p>{{ date('d-m-Y') }}</p>
{{--        <a href="{{ url('/forgot-password') }}">réinitialiser mot de passe</a>--}}
    </div>
</section>
@endsection
