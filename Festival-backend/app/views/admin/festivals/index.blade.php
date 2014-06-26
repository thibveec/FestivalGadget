@extends('admin._layouts.default')

@section('main')

<h1>
    Festivals <a href="{{ URL::route('admin.festivals.create') }}" class="btn btn-success"><i class="icon-plus-sign"></i> Add new festival</a>
</h1>

<hr>


<table class="table table-striped">
    <thead>
    <tr>
        <th>Festivalname</th>
        <th>Genre</th>
        <th><i class="icon-cog"></i></th>
        <th><i class="glyphicon glyphicon-trash"></i></th>
    </tr>
    </thead>
    <tbody>
    @foreach ($festivals as $festival)
    <tr>
        <td class="name"><a href="{{ URL::route('admin.festivals.show', $festival->id) }}">{{ $festival->name }}</a></td>
        <td>{{ $festival->genre }}</td>
        <td>
            <a href="{{ URL::route('admin.festivals.edit', $festival->id) }}" class="btn btn-success btn-mini pull-left">Edit</a>
        </td>
        <td>
            {{ Form::open(array('route' => array('admin.festivals.destroy', $festival->id), 'method' => 'delete', 'data-confirm' => 'Are you sure?')) }}
            <button type="submit" href="{{ URL::route('admin.festivals.destroy', $festival->id) }}" class="btn-danger" >Delete</button>
                {{ Form::close() }}
        </td>
    </tr>
    @endforeach
    </tbody>
</table>

@stop