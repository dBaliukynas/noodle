@extends('vendor/forum/master')
@section('title', 'Groups')
@section('main')
<div class="container">
    <div class="col-md-8 section offset-md-2">
        <groups-component :groups='{{ $groups }}' :auth_user='{{ $auth_user }}' :all_group_users_count='{{ json_encode($all_group_users_count) }}'></groups-component>
    </div>
</div>

@endsection