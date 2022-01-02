@extends('vendor/forum/master')
@section('title', 'Profile')
@section('main')

<profile-component :auth_user='{{ $auth_user }}' :ratings='{{ $ratings }}' :average_grade='{{ $average_grade }}' :likes='{{ $likes }}' :forum_categories_liked='{{ $forum_categories_liked }}'></profile-component>

@endsection