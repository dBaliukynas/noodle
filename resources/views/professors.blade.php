@extends('vendor/forum/master')
@section('title', 'Professors')
@section('main')
<div class="container">

    <professors-component :professors='{{ $professors }}' :auth_user='{{ $auth_user }}'>
    </professors-component>
</div>

@endsection