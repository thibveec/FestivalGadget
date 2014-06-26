@extends('admin._layouts.default')

@section('main')

<h1>
    Users <a href="{{ URL::route('admin.users.create') }}" class="btn btn-success"><i class="icon-plus-sign"></i> Add new user</a>
</h1>


<hr>


<table class="table table-striped">
    <thead>
    <tr>
         <th>Username</th>
        <th>Role</th>
        <th><i class="icon-cog"></i></th>
        <th><i class="glyphicon glyphicon-trash"></i></th>
    </tr>
    </thead>
    <tbody>
    @foreach ($users as $user)
    <tr>

        <td class="name"><a href="{{ URL::route('admin.users.show', $user->id) }}">{{ $user->username }}</a></td>
        <td>{{ $user->role_id}}</td>
        <td>
            <a href="{{ URL::route('admin.users.edit', $user->id) }}" class="btn btn-success btn-mini pull-left">Edit</a>
        </td>
        <td>
            {{ Form::open(array('route' => array('admin.users.destroy', $user->id), 'method' => 'delete', 'data-confirm' => 'Are you sure?')) }}
            <button type="submit" href="{{ URL::route('admin.users.destroy', $user->id) }}" class="btn-danger"  >Delete</button>
            {{ Form::close() }}
        </td>
    </tr>
    @endforeach
    </tbody>
</table>

@stop