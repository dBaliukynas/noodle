@extends('vendor/forum/master')
@section('title', 'Room')
@section('main')
<div class="container">
    <div class="col-md-8 section offset-md-2">
        <file-upload-component :auth_user='{{ $auth_user }}'></file-upload-component>
    </div>
    <table-component :students='{{ json_encode($students) }}' context='room' :auth_user='{{ $auth_user }}' :forum_threads='{{ $forum_threads }}'>
        </table-cmponent>
</div>

@endsection