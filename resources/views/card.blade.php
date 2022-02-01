@extends('layouts.app')

@section('content')
<div class="container">
    <card-component v-bind:user="{{ Auth::user() }}"></card-component>
</div>
@endsection 