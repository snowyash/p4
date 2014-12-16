@extends('_master')

@section('title')
	Sign a user up :)
@stop

@section('content')
<div class="text-center">
	<h2>Sign up</h2>

	<h3>
	    @if(Session::get('flash_message'))
	        <div class='flash-message'>{{ Session::get('flash_message') }}</div>
	    @elseif(Session::get('confirm_message'))
	    	<div class='confirm-message'>{{ Session::get('confirm_message') }}</div>
	    @endif
	</h3>
		@foreach($errors->all() as $message) 
		    <div class='error'>{{ $message }}</div>
		@endforeach
	<br>

	<div class="form-group col-lg-4 col-centered text-center">

		{{ Form::open(array('url' => '/user/signup')) }}

		    {{ Form::label( 'name', 'Name' ) }}<br>
		    {{ Form::text('name', '', array(
	              'class' => 'form-control',
	          )) }}

		    {{ Form::label( 'surname', 'Surname' ) }}<br>
		    {{ Form::text('surname', '', array(
	              'class' => 'form-control',
	          )) }}

		    {{ Form::label( 'email', 'Email' ) }}<br>
		    {{ Form::text('email', '', array(
	              'class' => 'form-control',
	          )) }}

		    {{ Form::label( 'password', 'Password' ) }}<br>
		    {{ Form::password('password', array(
	              'class' => 'form-control',
	          )) }}<br>

		    {{ Form::submit('Submit', array(
	              'class' => 'btn btn-primary',
	          )) }}

		{{ Form::close() }}
	</div>
</div>
@stop