@extends('layouts.app')

@section('content')
<div class="container">
    <card-parameters v-bind:user="{{ Auth::user() }}"></card-parameters>
</div>
@endsection 