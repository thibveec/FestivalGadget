@extends('admin._layouts.default')

@section('main')
<script>
    $(function()
    {
        var startfestival = $('#festivalstart').text();
        var endfestival = $('#festivalend').text();
        $('#newperformanceday').datepicker({

            weekStart: 1,
            startDate: startfestival,
            endDate: endfestival,
            autoclose: true
        });
        var performanceday = $('#currentperformaneday').val();
        console.log(performanceday);
        $('#newperformanceday').val(performanceday) ;
    });
</script>
<h1>Edit Lineup Stage & day</h1>

<hr>



<div class="currentdata">
<p>Performance start: {{ $lineup->performancestart }}</p>
<p>Performance end: {{ $lineup->performanceend }}</p>

{{ $festival }}
<span id="festivalstart">{{  $festivalstart }}</span>
<span id="festivalend">{{  $festivalend }}</span>
</div>

{{ Form::model($lineup, array('method' => 'put', 'route' => array('admin.lineups.updatestage', $lineup->id),  'class' => 'form-horizontal')) }}

<div class="currentdata">
    {{ Form::label('performanceday', ' Performance day', array('class' => 'col-sm-4 control-label')); }}
    {{ Form::text('performanceday', Input::old('performanceday'), array('class' => 'form-control', 'id' => 'currentperformaneday')) }}
</div>

<div class="form-group">

    <label class="col-sm-4 control-label"><span><i class="icon-calendar"></i></span> Performanceday Lineup</label>
    <div class="col-sm-8">
        <input type="text" name="performanceday" class="datepicker" data-date-format="dd/mm/yyyy" id="newperformanceday" placeholder="Festival Start date" value="{{ Input::old('performanceday') }}"/>
    </div>
</div>
<div class="currentdata">
<span id="stage">{{ $stage }}</span>
</div>

<div class="form-group">
    {{ Form::label('stage', 'Stage', array('class' => 'col-sm-4 control-label')); }}
    <div class="col-sm-8">
    {{ Form::select('stage', $stages, null ,  array('class' => 'form-control', 'id' => 'chosenstage')) }}
        </div>
</div>
<script>
    var myText = $('#stage').text();

    var val = $('#chosenstage option').filter( function(){
        return ($(this).text() === myText || $(this).val() === myText );
    });
    $("#chosenstage").val(val.val());

</script>
<div class="form-group">
    <div class="col-sm-offset-4 col-sm-8">
    {{ Form::submit('Save', array('class' => 'btn btn-success btn-save btn-large')) }}
    <a href="{{ URL::route('admin.lineups.index') }}" class="btn btn-large">Cancel</a>
        </div>
</div>

{{ Form::close() }}

@stop