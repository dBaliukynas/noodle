@extends('vendor/forum/master')
@section('title', 'Group')
@section('main')
<div class="container">
    <group-component :group_users='{{ json_encode($group_users) }}' 
                     :all_students='{{ json_encode($all_students) }}' :group='{{ $group }}'
                     :auth_user='{{ $auth_user }}' :group_students='{{ json_encode($group_students) }}' :group_professors='{{ json_encode($group_professors) }}'
                     :group_admins='{{ json_encode($group_admins) }}' :forum_threads='{{ $forum_threads }}'></group-component>
</div>

@endsection