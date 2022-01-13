@extends('vendor/forum/master')
@section('title', 'Homepage')
@section('main')
<home-component :auth_user='{{ $auth_user }}' :courses='{{ $courses }}'></home-component>
@endsection