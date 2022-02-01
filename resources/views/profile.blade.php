@extends('layouts.app')

@section('content')
<div class="container">
    <profile-component v-bind:user="{{ Auth::user() }}"></profile-component>
</div>
@endsection 