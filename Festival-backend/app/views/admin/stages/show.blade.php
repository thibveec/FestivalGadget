@extends('admin._layouts.default')

@section('main')
<h1>{{ $stage->stagename }}</h1>

<div class="col-sm-6 detail">
    <h2>festival</h2>
    <span class="glyphicon glyphicon-headphones"></span> {{ $festival }}
</div>

<div class="col-sm-6 detail">
    <h2>edit</h2>
    <a href="{{ URL::route('admin.stages.edit', $stage->id) }}" class="btn btn-success btn-mini pull-left">Edit</a>
</div>

<div class="col-sm-6 detail">
    <h2>delete</h2>
    <button type="submit" href="{{ URL::route('admin.stages.destroy', $stage->id) }}" class="btn-danger" >Delete</button>
</div>




@stop