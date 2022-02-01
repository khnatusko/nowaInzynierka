@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <sessiongame-component v-bind:user="{{ Auth::user() }}"></sessiongame-component>
</div>
@endsection 