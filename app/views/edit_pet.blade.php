@extends('_master')

@section('title')
	Edit Pet Info
@stop

@section('content')
	<h1>This is the infor for {{{ $pet['name'] }}}</h1>

	{{ Form::open(array('url' => '/pet/edit')) }}

		{{ Form::hidden('id',$pet['id']); }}

		{{ Form::label('name','Name') }}
		{{ Form::text('name',$pet['name']); }}

		{{ Form::submit('Save'); }}

	{{ Form::close() }}

	{{ Form::open(['method' => 'DELETE', 'action' => ['PetController@destroy', $pet->id]]) }}
    	<a href='javascript:void(0)' onClick='parentNode.submit();return false;'>Delete</a>
	{{ Form::close() }}

@stop