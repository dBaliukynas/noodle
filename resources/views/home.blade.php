@extends('vendor/forum/master')
@section('title', 'Homepage')
@section('main')
<home-component :auth_user='{{ $auth_user }}'></home-component>
@endsection