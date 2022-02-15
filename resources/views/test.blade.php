@extends('layouts.app')

@section('content')
<div class="container">
    <test-map v-bind:user="{{ Auth::user() }}"></test-map>
</div>
@endsection 