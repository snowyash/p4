@extends('_master')

@section('title')
	Sign a user up :)
@stop

@section('content')
	<h1>Sign up</h1>

	@foreach($errors->all() as $message) 
	    <div class='error'>{{ $message }}</div>
	@endforeach
	<br />

	{{ Form::open(array('url' => '/user/signup')) }}

	    Name<br>
	    {{ Form::text('name') }}<br><br>

	    Surname<br>
	    {{ Form::text('surname') }}<br><br>

	    Email<br>
	    {{ Form::text('email') }}<br><br>

	    Password:<br>
	    {{ Form::password('password') }}<br><br>

	    {{ Form::submit('Submit') }}

	{{ Form::close() }}
@stop