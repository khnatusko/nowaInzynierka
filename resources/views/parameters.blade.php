@extends('layouts.app')

@section('content')
<div class="container">
    <parameters-component v-bind:user="{{ Auth::user() }}"></parameters-component>
</div>
@endsection 