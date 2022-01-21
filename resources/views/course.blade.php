@extends('vendor/forum/master')
@section('title', 'Course')
@section('main')
<course-component :students='{{ json_encode($students) }}' :auth_user='{{ $auth_user }}' :professors='{{ $professors }}' :forum_threads='{{ $forum_threads }}' :project_members='{{ $project_members }}' :project_member_count='{{ $project_member_count }}' :course='{{ $course }}' :course_segments='{{ $course_segments }}'>
</course-component>
@endsection