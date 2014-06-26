@extends('admin._layouts.default')

@section('main')
<script>
    $(function()
    {

        $('.datetimepicker3').timepicker({
            minuteStep: 15,
            showInputs: false,
            disableFocus: true,
            showMeridian: false
        });
        $('.datetimepicker2').timepicker({
            minuteStep: 15,
            showInputs: false,
            disableFocus: true,
            showMeridian: false
        });
    });
</script>
<h1>Create new Lineup</h1>


{{ Form::open(array('route' => 'admin.lineups.store', 'files' => true, 'class' => 'form-horizontal')) }}

<div class="form-group">
    {{ Form::label('artist', 'Artist', array('class' => 'col-sm-4 control-label')); }}
    <div class="col-sm-8">
    {{ Form::text('artist', Input::old('artist'), array('class' => 'form-control')) }}
        </div>
</div>

<!--<div class="control-group">-->
<!--    {{ Form::label('image', 'Image') }}-->
<!---->
<!--    <div class="fileupload fileupload-new" data-provides="fileupload">-->
<!--        <div class="fileupload-preview thumbnail" style="width: 200px; height: 150px;">-->
<!--            <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image">-->
<!--        </div>-->
<!--        <div>-->
<!--            <span class="btn btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span>{{ Form::file('image') }}</span>-->
<!--            <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->





<div class="form-group">
    <div class="input-append">
        {{ Form::label('performancestart', 'Start Performance', array('class' => 'col-sm-4 control-label')); }}
        <div class="col-sm-8">
            <input id="newperformanceend"  class="datetimepicker3" data-format="hh:mm" name="performancestart" type="text" placeholder="Artist Performance Start" value="{{ Input::old('performancestart') }}" />

        </div>
    </div>
</div>

<div class="form-group">
    <div class="input-append">
        {{ Form::label('performanceend', 'End Performance', array('class' => 'col-sm-4 control-label')); }}
        <div class="col-sm-8">
            <input  class="datetimepicker2" id="newperformancestart" data-format="hh:mm" name="performanceend" type="text" placeholder="Artist Performance End" value="{{ Input::old('performanceend') }}" />

        </div>
    </div>
</div>

<div class="form-group">
    {{ Form::label('festival', 'Festival', array('class' => 'col-sm-4 control-label')); }}
    <div class="col-sm-8">
    {{ Form::select('festival', $festivals, null ,  array('class' => 'form-control', 'id' => 'chosenfestival')) }}
        </div>
</div>

 <div>

    </div>

<div class="form-group">
    <div class="col-sm-offset-4 col-sm-8">
    {{ Form::submit('Save', array('class' => 'btn btn-success btn-save btn-large')) }}
    <a href="{{ URL::route('admin.lineups.index') }}" class="btn btn-large">Cancel</a>
</div>
    </div>

{{ Form::close() }}

@stop