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

<div class="col-md-12" id="titel">
    <h2>color - {{ $color->colorname }}</h2>
</div>



<div class="col-sm-6 detail colorvalue">
    <h2>Color value</h2>
    <span class="glyphicon glyphicon-play"></span> <span class="color">{{ $color->value }}</span>
</div>

<div class="col-sm-6 detail">
    <h2>Edit</h2>
    <a href="{{ URL::route('admin.colors.edit', $color->id) }}" class="btn btn-success">Edit</a>



</div>
<div class="col-sm-6 detail">
    <h2>Delete</h2>
    {{ Form::open(array('route' => array('admin.colors.destroy', $color->id), 'method' => 'delete', 'data-confirm' => 'Are you sure?')) }}
    <button type="submit" href="{{ URL::route('admin.colors.destroy', $color->id) }}" class="btn-danger" >Delete</button>
    {{ Form::close() }}

</div>




@stop