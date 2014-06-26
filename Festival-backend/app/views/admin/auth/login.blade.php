@extends('admin._layouts.default')

@section('main')

<div class="row">
    <div class="col-md-7" id="info">


       <p id="wrench"><span class="glyphicon glyphicon-wrench"></span><br />
        <span style="font-size:16px">You need to login first to get in the backend!</span>
       </p>
        @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
            <li class="error">{{ $error }}</li>
            @endforeach
        </div>
        @endif

    </div>
    <div class="col-md-5" id="login">


    {{ Form::open(array('url' => 'admin/login')) }}



    <div class="col-md-12">
        <h2>Login</h2>

    <div class="form-group">
        {{ Form::label('email', 'Email'); }}
        {{ Form::text('email', Input::old('email'), array('class' => 'form-control', 'placeholder' => 'Your email')) }}
    </div>
    <div class="form-group">
        {{ Form::label('password', 'Password'); }}
        {{ Form::password('password', array('class' => 'form-control', 'placeholder' => 'Your password')) }}
    </div>
    {{ Form::submit('Login', array('class' => 'btn btn-success btn-block'))}}
        </div>
    {{ Form::close() }}

        </div>
</div>
@stop