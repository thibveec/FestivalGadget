@extends('admin._layouts.default')

@section('main')
<script>
    $(function()
    {
        var startDate = new Date('01/01/2012');
        var FromEndDate = new Date();
        var ToEndDate = new Date();

        ToEndDate.setDate(ToEndDate.getDate()+365);

        $('.from_date').datepicker({

            weekStart: 1,
            startDate: '01/01/2012',
            endDate: '01/01/2015',
            autoclose: true
        })
            .on('changeDate', function(selected){
                startDate = new Date(selected.date.valueOf());
                startDate.setDate(startDate.getDate(new Date(selected.date.valueOf())));
                $('.to_date').datepicker('setStartDate', startDate);
            });
        $('.to_date')
            .datepicker({

                weekStart: 1,
                startDate: startDate,
                endDate: ToEndDate,
                autoclose: true
            })
            .on('changeDate', function(selected){
                FromEndDate = new Date(selected.date.valueOf());
                FromEndDate.setDate(FromEndDate.getDate(new Date(selected.date.valueOf())));
                $('.from_date').datepicker('setEndDate', FromEndDate);
            });

        var performanceday = $('#currentperformaneday').val();
        console.log(performanceday);
        $('#newperformanceday').val(performanceday) ;

        var festivalenddate = $('#festivalenddate').val();
        console.log(festivalenddate);
        $('#newfestivalenddate').val(festivalenddate) ;


    });
</script>
<h1>Edit Festival</h1>

@include('admin._partials.notifications')

{{ Form::model($festival, array('method' => 'put', 'route' => array('admin.festivals.update', $festival->id), 'files' => true, 'class' => 'form-horizontal')) }}

<div class="form-group">
    {{ Form::label('name', 'Name', array('class' => 'col-sm-4 control-label')); }}
    <div class="col-sm-8">
    {{ Form::text('name', Input::old('name'), array('class' => 'form-control')) }}
        </div>
</div>

<div class="form-group">
    {{ Form::label('genre', 'Genre', array('class' => 'col-sm-4 control-label')); }}
    <div class="col-sm-8">
    {{ Form::text('genre', Input::old('genre'), array('class' => 'form-control')) }}
        </div>
</div>

<!--<div class="control-group">-->
<!--    {{ Form::label('image', 'Image') }}-->
<!---->
<!--    <div class="fileupload fileupload-new" data-provides="fileupload">-->
<!--        <div class="fileupload-preview thumbnail" style="width: 200px; height: 150px;">-->
<!--            <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image">-->
<!--        </div>-->
<!--        <div>-->
<!--            <span class="btn btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span>{{ Form::file('image') }}</span>-->
<!--            <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->
<div class="currentdata">
    {{ Form::label('festivalstart', ' festivalstart day', array('class' => 'sr-only')); }}
    {{ Form::text('festivalstart', Input::old('festivalstart'), array('class' => 'form-control', 'id' => 'currentperformaneday')) }}
</div>
<div class="form-group">

    <label class="col-sm-4 control-label"><span><i class="icon-calendar"></i></span> Start Festival</label>
    <div class="col-sm-8">
        <input type="text" name="festivalstart" class="from_date" data-date-format="dd/mm/yyyy"  id="newperformanceday" placeholder="Festival Start date" value="{{ Input::old('festivalstart') }}"/>
    </div>
</div>
<div class="currentdata">
    {{ Form::label('festivalend', ' festivalend day', array('class' => 'sr-only')); }}
    {{ Form::text('festivalend', Input::old('festivalend'), array('class' => 'form-control', 'id' => 'festivalenddate')) }}
</div>
<div class="form-group">

    <label class="col-sm-4 control-label"><span><i class="icon-calendar"></i></span> End Festival</label>
    <div class="col-sm-8">
        <input type="text" name="festivalend" class="to_date" data-date-format="dd/mm/yyyy" id="newfestivalenddate" placeholder="Festival End date" value="{{ Input::old('festivalend') }}"/>
    </div>
</div>

<div class="form-group">
    <div class="col-sm-offset-4 col-sm-8">
    {{ Form::submit('Save', array('class' => 'btn btn-success btn-save btn-large')) }}
    <a href="{{ URL::route('admin.festivals.index') }}" class="btn btn-large">Cancel</a>
        </div>
</div>
    </div>


{{ Form::close() }}

@stop