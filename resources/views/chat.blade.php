
@extends('layouts.app')

@section('content')
<div class="container">
    <chat-component v-bind:user="{{ Auth::user() }}"></chat-component>
</div>
@endsection 