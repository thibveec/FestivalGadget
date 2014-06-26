@extends('admin._layouts.default')

@section('main')
<script>
    $(function()
    {
        $('.color').each(function(){
            var color = $(this).text();
            $(this).css('background-color', color);
            console.log(color);
        });

    });
</script>
<h1>
    Colors <a href="{{ URL::route('admin.colors.create') }}" class="btn btn-success"><i class="icon-plus-sign"></i> Add new color</a>
</h1>

<hr>


<table class="table table-striped">
    <thead>
    <tr>
        <th>Colorname</th>
        <th>Value</th>
        <th><i class="icon-cog"></i></th>
        <th><i class="glyphicon glyphicon-trash"></i></th>
    </tr>
    </thead>
    <tbody>
    @foreach ($colors as $color)

    <tr>
        <td class="name"><a href="{{ URL::route('admin.colors.show', $color->id) }}">{{ $color->colorname }}</a></td>
        <td ><span class="color">{{ $color->value }}</span></td>
        <td>
            <a href="{{ URL::route('admin.colors.edit', $color->id) }}" class="btn btn-success btn-mini pull-left">Edit</a>
        </td>
        <td>
            {{ Form::open(array('route' => array('admin.colors.destroy', $color->id), 'method' => 'delete', 'data-confirm' => 'Are you sure?')) }}
            <button type="submit" href="{{ URL::route('admin.colors.destroy', $color->id) }}" class="btn-danger" >Delete</button>
                {{ Form::close() }}
        </td>
    </tr>
    @endforeach
    </tbody>
</table>

@stop