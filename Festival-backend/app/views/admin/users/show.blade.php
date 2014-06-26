@extends('admin._layouts.default')

@section('main')
<h1>FestivalGadet User</h1>

<div class="col-sm-6 detail">
    <h2>username</h2>
    <span class="glyphicon glyphicon-user"></span> {{ $user->username }}
</div>
<div class="col-sm-6 detail">
    <h2>email</h2>
    <span class="glyphicon glyphicon-send"></span> <span id="email">  {{ $user->email }} </span>
</div>
<div class="col-sm-6 detail">
    <h2>since</h2>
    <span class="glyphicon glyphicon-calendar"></span> {{$user->created_at }}
</div>
<div class="col-sm-6 detail">
    <h2>role</h2>
    <span class="glyphicon glyphicon-eye-open"></span> {{$role }}
</div>
<div class="col-sm-6 detail">
    <h2>edit</h2>
    <a href="{{ URL::route('admin.users.edit', $user->id) }}" class="btn btn-success btn-mini pull-left">Edit</a>
</div>
<div class="col-sm-6 detail">
    <h2>delete</h2>
    <button type="submit" href="{{ URL::route('admin.users.destroy', $user->id) }}" class="btn-danger"  >Delete</button>
</div>
@stop


