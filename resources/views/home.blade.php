@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                    <a href="{{ url('/chat') }}">Chat</a>
                    <a href="{{ url('/sessiongame') }}">SessionGame</a>
                    <a href="{{ url('/card') }}">Card</a>
                    <a href="{{ url('/profile') }}">Profile</a>
                    <a href="{{ url('/userlist') }}">Userlist</a>
                    <a href="{{ url('/game') }}">CreateGame</a>
                    <a href="{{ url('/parameters') }}">CreateParameters</a>
                    <a href="{{ url('/usercard') }}">UserCard</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
