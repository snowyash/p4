@extends('_master')

@section('title')
	Add your pet :)
@stop

@section('content')
	<h1>Add a pet</h1>

	{{ Form::open(array('url' => '/add_pet')) }}

	    Name<br>
	    {{ Form::text('name') }}<br><br>

	    Breed<br>
	    {{ Form::text('breed') }}<br><br>

	    Sex<br>
	    {{ Form::text('sex') }}<br><br>

	    <!--picture, vaccine, user, and vet selector-->

	    {{ Form::submit('Submit') }}

	{{ Form::close() }}
@stop