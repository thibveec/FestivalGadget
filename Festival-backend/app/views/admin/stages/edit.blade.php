@extends('admin._layouts.default')

@section('main')

<h1>Edit Stage of {{ $festival }}</h1>

@include('admin._partials.notifications')

{{ Form::model($stage, array('method' => 'put', 'route' => array('admin.stages.update', $stage->id), 'files' => true, 'class' => 'form-horizontal')) }}

<div class="form-group">
    {{ Form::label('stagename', 'Stagename', array('class' => 'col-sm-4 control-label')); }}
    <div class="col-sm-8">
    {{ Form::text('stagename', Input::old('stagename'), array('class' => 'form-control')) }}
        </div>
</div>



<div class="form-actions">
    <div class="col-sm-offset-4 col-sm-8">
    {{ Form::submit('Save', array('class' => 'btn btn-success btn-save btn-large')) }}
    <a href="{{ URL::route('admin.stages.index') }}" class="btn btn-large">Cancel</a>
        </div>
</div>


{{ Form::close() }}

@stop