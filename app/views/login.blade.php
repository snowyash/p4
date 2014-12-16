@extends('_master')

@section('title')
	Log an user in :)
@stop

@section('content')
<div class="text-center">
	<h2>Log in</h2>

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

	<div class="form-group col-lg-4 col-centered">
		{{ Form::open(array('url' => '/user/login')) }}

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