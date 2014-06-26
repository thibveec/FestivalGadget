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
        var performancestart = $('#currentperformancestart').val();
        console.log(performancestart);
        $('#newperformancestart').val(performancestart) ;

        var performanceend = $('#currentperformanceend').val();
        console.log(performanceend);
        $('#newperformanceend').val(performanceend) ;

        var performanceday = $('#currentperformaneday').val();
        console.log(performanceday);
        $('#newperformanceday').val(performanceday) ;

    });
</script>
<h1>Edit Lineup</h1>

@include('admin._partials.notifications')

{{ Form::model($lineup, array('method' => 'put', 'route' => array('admin.lineups.update', $lineup->id), 'files' => true,  'class' => 'form-horizontal')) }}

<div class="form-group">
    {{ Form::label('artist', 'Artist', array('class' => 'col-sm-4 control-label')); }}
    <div class="col-sm-8">
    {{ Form::text('artist', Input::old('artist'), array('class' => 'form-control')) }}
        </div>
</div>



<div class="currentdata">
    {{ Form::label('performancestart', 'Start Performance', array('class' => 'col-sm-4 control-label')); }}
    {{ Form::text('performancestart', Input::old('performancestart'), array('class' => 'form-control', 'id' => 'currentperformanceend')) }}
</div>

<div class="form-group">
<div class="input-append">
    {{ Form::label('performancestart', 'Start Performance', array('class' => 'col-sm-4 control-label')); }}
    <div class="col-sm-8">
    <input id="newperformanceend"  class="datetimepicker3" data-format="hh:mm" name="performancestart" type="text" placeholder="Artist Performance Start" value="{{ Input::old('performancestart') }}" />

        </div>
</div>
    </div>
<div class="currentdata">
    {{ Form::label('performanceend', 'End Performance', array('class' => 'col-sm-4 control-label')); }}
    {{ Form::text('performanceend', Input::old('performanceend'), array('class' => 'form-control', 'id' => 'currentperformancestart')) }}
</div>


<div class="form-group">
<div class="input-append">
    {{ Form::label('performanceend', 'End Performance', array('class' => 'col-sm-4 control-label')); }}
    <div class="col-sm-8">
    <input  class="datetimepicker2" id="newperformancestart" data-format="hh:mm" name="performanceend" type="text" placeholder="Artist Performance End" value="{{ Input::old('performanceend') }}" />

        </div>
</div>
</div>



<span class="currentdata" id="festival">{{ $festival }}</span>
<div class="form-group">
    {{ Form::label('festival', 'Festival', array('class' => 'col-sm-4 control-label')); }}
    <div class="col-sm-8">
    {{ Form::select('festival', $festivals, $festival ,  array('class' => 'form-control', 'id' => 'selectbox', 'value' => $festival)) }}
        </div>
</div>
<div></div>
<script>
    var myText = $('#festival').text();

    var val = $('#selectbox option').filter( function(){
        return ($(this).text() === myText || $(this).val() === myText );
    });
    $("#selectbox").val(val.val());

</script>
<div class="form-group">
    <div class="col-sm-offset-4 col-sm-8">
    {{ Form::submit('Save', array('class' => 'btn btn-success btn-save btn-large')) }}
    <a href="{{ URL::route('admin.lineups.index') }}" class="btn btn-large">Cancel</a>
</div>


{{ Form::close() }}

@stop