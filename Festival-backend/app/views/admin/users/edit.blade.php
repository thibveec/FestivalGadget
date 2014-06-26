@extends('admin._layouts.default')

@section('main')

<h1>Edit User</h1>

@include('admin._partials.notifications')

{{ Form::model($user, array('method' => 'put', 'route' => array('admin.users.update', $user->id), 'files' => true, 'class' => 'form-horizontal')) }}

<div class="form-group">
    {{ Form::label('username', 'User', array('class' => 'col-sm-4 control-label')); }}
    <div class="col-sm-8">
    {{ Form::text('username', Input::old('username'), array('class' => 'form-control')) }}
        </div>
</div>
<div class="form-group">
    {{ Form::label('email', 'Email', array('class' => 'col-sm-4 control-label')); }}
    <div class="col-sm-8">
    {{ Form::text('email', Input::old('email'), array('class' => 'form-control')) }}
        </div>
</div>

<div class="currentdata">
<span id="role">{{ $role }}</span>
    </div>
<div class="form-group">
    {{ Form::label('role', 'Role', array('class' => 'col-sm-4 control-label')); }}
    <div class="col-sm-8">
    {{ Form::select('role', $roles, '' ,  array('class' => 'form-control', 'id' => 'selectbox', 'value' => $role)) }}
        </div>
</div>
<div></div>
<script>
    var myText = $('#role').text();

    var val = $('#selectbox option').filter( function(){
        return ($(this).text() === myText || $(this).val() === myText );
    });
    $("#selectbox").val(val.val());

</script>
<div class="form-actions">
    <div class="col-sm-offset-4 col-sm-8">
    {{ Form::submit('Save', array('class' => 'btn btn-success btn-save btn-large')) }}
    <a href="{{ URL::route('admin.users.index') }}" class="btn btn-large">Cancel</a>
</div>


{{ Form::close() }}

@stop