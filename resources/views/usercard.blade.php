
@extends('layouts.app')

@section('content')
<div class="container">
    <user-card v-bind:user="{{ Auth::user() }}"></user-card>
</div>
@endsection 