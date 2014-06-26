@extends('admin._layouts.default')

@section('main')

<h1>
    Lineups <a href="{{ URL::route('admin.lineups.create') }}" class="btn btn-success"><i class="icon-plus-sign"></i> Add new lineup</a>
</h1>

<hr>



<table class="table table-striped">
    <thead>
    <tr>

        <th>Artist</th>
        <th>Stage</th>
        <th>Festival</th>
        <th><i class="icon-cog"></i></th>
        <th><i class="glyphicon glyphicon-trash"></i></th>
    </tr>
    </thead>
    <tbody>
    @foreach ($lineups as $lineup)
    <tr>

        <td class="name"><a href="{{ URL::route('admin.lineups.show', $lineup->id) }}">{{ $lineup->artist }}</a></td>
        <td>{{ $lineup->stage_id }}</td>
        <td>{{ $lineup->festival_id }}</td>
        <td>
            <a href="{{ URL::route('admin.lineups.edit', $lineup->id) }}" class="btn btn-success btn-mini pull-left">Edit</a>
        </td>
        <td>
            {{ Form::open(array('route' => array('admin.lineups.destroy', $lineup->id), 'method' => 'delete', 'data-confirm' => 'Are you sure?')) }}
            <button type="submit" href="{{ URL::route('admin.lineups.destroy', $lineup->id) }}" class="btn-danger" >Delete</button>
            {{ Form::close() }}
        </td>
    </tr>
    @endforeach
    </tbody>
</table>

@stop