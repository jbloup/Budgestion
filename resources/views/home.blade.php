@extends('layouts.app')

@section('content')
<section class="hero is-primary is-fullheight-with-navbar is-bold">
    <div class="hero-body">
        <p class="title">
            @foreach($users as $user)
            Bienvenue {{ $user->name }}
            @endforeach
        </p>
{{--        <a href="{{ url('/forgot-password') }}">réinitialiser mot de passe</a>--}}
    </div>
</section>
@endsection
