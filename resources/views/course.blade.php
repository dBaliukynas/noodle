@extends('vendor/forum/master')
@section('title', 'Course')
@section('main')
    <course-component :students='{{ json_encode($students) }}' :auth_user='{{ $auth_user }}'>
    </course-component>
@endsection