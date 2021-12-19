@extends('vendor/forum/master')
@section('title', 'Team')
@section('main')
<div class="container">
    <team-component :team_users='{{ json_encode($team_users) }}' :team_students='{{ json_encode($team_students) }}' 
                    :team_professors='{{ json_encode($team_professors) }}' :team_admins='{{ json_encode($team_admins) }}'
                    :all_students='{{ json_encode($all_students) }}' :team='{{ $team }}' 
                    :auth_user='{{ $auth_user }}' :ratings='{{ $ratings }}'
                    :forum_threads='{{ $forum_threads }}'
                    ></team-component>
</div>

@endsection