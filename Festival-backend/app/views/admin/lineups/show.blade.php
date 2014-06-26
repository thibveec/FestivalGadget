@extends('admin._layouts.default')

@section('main')
<div class="col-md-12" id="titel">
<h1>Lineup - {{ $lineup->artist }}</h1>
</div>



<div class="col-sm-6 detail">
    <h2>Performance start</h2>
    <span class="icon-time"></span> {{ $lineup->performancestart }}
</div>
<div class="col-sm-6 detail">
    <h2>Performance end</h2>
    <span class="glyphicon glyphicon-time"></span> {{ $lineup->performanceend }}
</div>
<div class="col-sm-6 detail">
    <h2>Performance day</h2>
    <span class="glyphicon glyphicon-calendar"></span> {{ $lineup->performanceday }}
</div>
<div class="col-sm-6 detail">
    <h2>Festival</h2>
    <span class="glyphicon glyphicon-headphones"></span> {{ $festival }}
</div>
<div class="col-sm-6 detail">
    <h2>Stage</h2>
    <span class="glyphicon glyphicon-tower"></span> {{ $stage }}
</div>
<div class="col-sm-6 detail">
    <h2>Edit</h2>
    <a href="{{ URL::route('admin.lineups.edit', $lineup->id) }}" class="btn btn-success btn-mini pull-left">Edit</a>
</div>
<div class="col-sm-6 detail">
    <h2>delete</h2>
    {{ Form::open(array('route' => array('admin.lineups.destroy', $lineup->id), 'method' => 'delete', 'data-confirm' => 'Are you sure?')) }}
    <button type="submit" href="{{ URL::route('admin.lineups.destroy', $lineup->id) }}" class="btn-danger" >Delete</button>
    {{ Form::close() }}
</div>







<h5>{{ $lineup->created_at }}</h5>

@stop