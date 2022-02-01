@extends('layouts.app')

@section('content')
<div class="container">
    <game-component v-bind:user="{{ Auth::user() }}"></game-component>
</div>
@endsection 