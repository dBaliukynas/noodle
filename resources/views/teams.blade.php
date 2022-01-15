@extends('vendor/forum/master')
@section('title', 'Teams')
@section('main')
<div class="container">
    <div class="col-md-8 section offset-md-2 teams-upper-wrapper">
        <teams-component :teams='{{ $teams }}' :all_team_users_count='{{ json_encode($all_team_users_count) }}'></teams-component>
    </div>
</div>

@endsection