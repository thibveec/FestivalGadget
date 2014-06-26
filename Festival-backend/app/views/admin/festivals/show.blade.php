@extends('admin._layouts.default')

@section('main')
<div class="col-md-12" id="titel">
    <h2>festival - {{ $festival->name }}</h2>
</div>



<div class="col-sm-6 detail">
    <h2>Start festival</h2>
    <span class="glyphicon glyphicon-play"></span> {{ $festival->festivalstart }}
</div>
<div class="col-sm-6 detail">
    <h2>End festival</h2>
    <span class="glyphicon glyphicon-stop"></span> {{ $festival->festivalend }}
</div>

<div class="col-sm-6 detail">
    <h2>Genre</h2>
    <span class="icon-star-empty"></span>  {{ $festival->genre }}
</div>
<div class="col-sm-6 detail">
    <h2>Edit</h2>
    <a href="{{ URL::route('admin.festivals.edit', $festival->id) }}" class="btn btn-success">Edit</a>



</div>
<div class="col-sm-6 detail">
    <h2>Delete</h2>
    {{ Form::open(array('route' => array('admin.festivals.destroy', $festival->id), 'method' => 'delete', 'data-confirm' => 'Are you sure?')) }}
    <button type="submit" href="{{ URL::route('admin.festivals.destroy', $festival->id) }}" class="btn-danger" >Delete</button>
    {{ Form::close() }}

</div>

<div class="col-md-12">
    <p>{{ $festival->created_at }}</p>
</div>



@stop