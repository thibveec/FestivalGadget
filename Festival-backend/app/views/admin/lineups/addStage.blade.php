@extends('admin._layouts.default')

@section('main')
<script>
    $(function()
    {
        var startfestival = $('#festivalstart').text();
        var endfestival = $('#festivalend').text();
        $('.lineupdate').datepicker({

            weekStart: 1,
            startDate: startfestival,
            endDate: endfestival,
            autoclose: true
        });
    });
</script>
<h2>Display Lineup</h2>

<hr>

<h3>{{ $lineup->artist }}</h3>
<h5>{{ $lineup->created_at }}</h5>


<p>Performance start: {{ $lineup->performancestart }}</p>
<p>Performance end: {{ $lineup->performanceend }}</p>

<p>{{ $festival }}</p>
<span id="festivalstart">{{  $festivalstart }}</span>
<span id="festivalend">{{  $festivalend }}</span>

Add stage and performanceday to your lineup

{{ Form::model($lineup, array('method' => 'put', 'route' => array('admin.lineups.addstage', $lineup->id))) }}

<div class="input-append date ">
    <p>
        <label><span><i class="icon-calendar"></i></span> Performanceday Lineup</label>
        <input type="text" name="performanceday" class="lineupdate" data-date-format="dd/mm/yyyy" id="checkin" placeholder="Festival Start date" value="{{ Input::old('performanceday') }}"/>
    </p>
</div>

<div class="form-group">
    {{ Form::label('stage', 'Stage', array('class' => '')); }}
    {{ Form::select('stage', $stages, null ,  array('class' => 'form-control', 'id' => 'chosenfestival')) }}
</div>

<div class="form-group">
    <div class="col-sm-offset-4 col-sm-8">
    {{ Form::submit('Save', array('class' => 'btn btn-success btn-save btn-large')) }}
    <a href="{{ URL::route('admin.lineups.index') }}" class="btn btn-large">Cancel</a>
</div>
    </div>

{{ Form::close() }}

@stop

