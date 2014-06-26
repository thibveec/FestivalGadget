@extends('admin._layouts.default')

@section('main')

<h2>Create new User</h2>


{{ Form::open(array('route' => 'admin.users.store', 'files' => true)) }}

<div class="form-group">
    {{ Form::label('username', 'User', array('class' => 'sr-only')); }}
    {{ Form::text('username', Input::old('username'), array('class' => 'form-control')) }}
</div>
<div class="form-group">
    {{ Form::label('email', 'Email', array('class' => 'sr-only')); }}
    {{ Form::text('email', Input::old('email'), array('class' => 'form-control')) }}
</div>
<div class="form-group">
    {{ Form::label('password', 'Password', array('class' => 'sr-only')); }}
    {{ Form::password('password', Input::old('password'), array('class' => 'form-control')) }}
</div>

<div class="form-group">
    {{ Form::label('role', 'Roles', array('class' => '')); }}
    {{ Form::select('role', $roles, null ,  array('class' => 'form-control')) }}
</div>

<div class="form-actions">
    {{ Form::submit('Save', array('class' => 'btn btn-success btn-save btn-large')) }}
    <a href="{{ URL::route('admin.users.index') }}" class="btn btn-large">Cancel</a>
</div>

{{ Form::close() }}

@stop