@extends('admin._layouts.default')

@section('main')

<h1>Create new Color</h1>


{{ Form::open(array('route' => 'admin.colors.store', 'files' => true,  'class' => 'form-horizontal')) }}

<div class="form-group">
    {{ Form::label('colorname', 'Colorname', array('class' => 'col-sm-4 control-label')); }}
    <div class="col-sm-8">
    {{ Form::text('colorname', Input::old('colorname'), array('class' => 'form-control')) }}
        </div>
</div>

<div class="form-group">
    {{ Form::label('value', 'Value', array('class' => 'col-sm-4 control-label')); }}
    <div class="col-sm-8">
    {{ Form::text('value', Input::old('value'), array('class' => 'form-control')) }}
        </div>
</div>

<div class="form-group">
    <div class="col-sm-offset-4 col-sm-8">
    {{ Form::submit('Save', array('class' => 'btn btn-success btn-save btn-large')) }}
    <a href="{{ URL::route('admin.colors.index') }}" class="btn btn-large">Cancel</a>
        </div>
</div>

{{ Form::close() }}

@stop