@extends('vendor/forum/master')
@section('title', 'Project')
@section('main')

<project-component :auth_user='{{ $auth_user }}' :forum_threads='{{ $forum_threads }}' :project_members='{{ $project_members }}' :project_member_count='{{ $project_member_count }}'></project-component>

@endsection