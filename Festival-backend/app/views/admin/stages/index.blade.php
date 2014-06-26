@extends('admin._layouts.default')

@section('main')

<h1>
    Stages <a href="{{ URL::route('admin.stages.create') }}" class="btn btn-success"><i class="icon-plus-sign"></i> Add new stage</a>
</h1>

<hr>



<table class="table table-striped">
    <thead>
    <tr>
        <th>Stagename</th>
        <th>Festival</th>
        <th><i class="icon-cog"></i></th>
        <th><i class="glyphicon glyphicon-trash"></i></th>
    </tr>
    </thead>
    <tbody>
    @foreach ($stages as $stage)
    <tr>

        <td class="name"><a href="{{ URL::route('admin.stages.show', $stage->id) }}">{{ $stage->stagename }}</a></td>
        <td>{{ $stage->festival_id}}</td>
        <td>
            <a href="{{ URL::route('admin.stages.edit', $stage->id) }}" class="btn btn-success btn-mini pull-left">Edit</a>
        </td>
        <td>
            {{ Form::open(array('route' => array('admin.stages.destroy', $stage->id), 'method' => 'delete', 'data-confirm' => 'Are you sure?')) }}
            <button type="submit" href="{{ URL::route('admin.stages.destroy', $stage->id) }}" class="btn-danger" >Delete</button>
            {{ Form::close() }}
        </td>
    </tr>
    @endforeach
    </tbody>
</table>

@stop