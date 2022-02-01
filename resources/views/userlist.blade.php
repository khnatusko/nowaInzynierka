@extends('layouts.app')

@section('content')
<div class="container">
    <list-component v-bind:user="{{ Auth::user() }}"></list-component>
</div>
@endsection 