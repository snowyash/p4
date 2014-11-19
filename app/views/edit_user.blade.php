@extends('_master')

@section('title')
	Edit User Info
@stop

@section('content')
	<h1>Hi, {{{ $user['name'] }}}</h1>

	{{ Form::open(array('url' => '/user/edit')) }}

		{{ Form::hidden('id',$user['id']); }}

		{{ Form::label('name','First Name') }}
		{{ Form::text('name',$user['name']); }}

		{{ Form::label('surname','Surname') }}
		{{ Form::text('surname',$user['surname']); }}

		{{ Form::label('email','Email') }}
		{{ Form::text('email',$user['email']); }}

		{{ Form::label('password','Password') }}
		{{ Form::text('password'); }}

		{{ Form::submit('Save'); }}

	{{ Form::close() }}

@stop