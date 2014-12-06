@extends('_master')

@section('title')
	Edit Pet Info
@stop

@section('content')
<div class="text-center">

	<h1>Editing {{ $pet['name'] }}'s information.</h1>

	<h3>
	    @if(Session::get('flash_message'))
	        <div class='flash-message'>{{ Session::get('flash_message') }}</div>
	    @endif
	</h3>
		@foreach($errors->all() as $message) 
		    <div class='error'>{{ $message }}</div>
		@endforeach
	<br>

	<div class="container col-centered text-center">

		{{ Form::open(array('url' => '/pet/$pet->id', 'method' => 'put')) }}

			{{ Form::hidden('id',$pet['id']); }}


	    <div class="form-group col-lg-12">

			{{ Form::label('name','Name') }}
			{{ Form::text('name', $pet['name'], array(
	              'class' => 'form-control',
	          )) }}

	        {{ Form::label( 'breed', 'Breed' ) }}<br>
		    {{ Form::text('breed', $pet['breed'], array(
	              'class' => 'form-control',
	          )) }}

	        {{ Form::label( 'birthday', 'Birthday' ) }}
		    {{ Form::text('birthday', $pet['birthday'], array(
	              'class' => 'form-control datepicker',
	          )) }}

		    {{ Form::label( 'sex', 'Sex' ) }}
	        {{ Form::select('sex', 
	        [
	           'Male' => 'Male',
	           'Female' => 'Female',
	        ], $pet['sex'], 
	          array(
	            'id' => 'sex',
	            'class' => 'form-control',
	          )
	        ) }}

	        <br>
	        
		    <!--vaccine, and vet selector-->

	        {{ Form::label( 'vet', 'Vet' ) }}
	        {{ Form::select('vet', $vet_list, $pet['vet']['id'], 
	          array(
	            'class' => 'form-control',
	          )) }}

	        <br>

	        <div class="form-group col-lg-6">

	        {{ Form::label( 'rabies', 'Rabies' ) }}
		    {{ Form::text('rabies', Pet::displayDateFmt($pet, 1), array(
	              'class' => 'form-control datepicker',
	          )) }}

	        {{ Form::label( 'bordetella', 'Bordetella' ) }}
		    {{ Form::text('bordetella', Pet::displayDateFmt($pet, 2), array(
	              'class' => 'form-control datepicker',
	          )) }}

	        {{ Form::label( 'parvo', 'Parvo' ) }}
		    {{ Form::text('parvo', Pet::displayDateFmt($pet, 3), array(
	              'class' => 'form-control datepicker',
	          )) }}
		</div>

		<div class="form-group col-lg-6">

	        {{ Form::label( 'heartworm', 'Heartworm Test' ) }}
		    {{ Form::text('heartworm', Pet::displayDateFmt($pet, 4), array(
	              'class' => 'form-control datepicker',
	          )) }}

	        {{ Form::label( 'distemper', 'Distemper' ) }}
		    {{ Form::text('distemper', Pet::displayDateFmt($pet, 5), array(
	              'class' => 'form-control datepicker',
	          )) }}

	        {{ Form::label( 'flea', 'Flea Prevention' ) }}
		    {{ Form::text('flea', Pet::displayDateFmt($pet, 6), array(
	              'class' => 'form-control datepicker',
	          )) }}

		</div>

		<div>&nbsp;</div>
		
	    <div class="form-group col-lg-3 col-centered">

			{{ Form::submit('Save', array(
	              'class' => 'btn btn-primary float-left',
	          )) }}

			{{ Form::close() }}


			{{ Form::open(['method' => 'DELETE', 'action' => ['PetController@destroy', $pet->id]]) }}
		    <div class="form-group float-left delete-btn">
		    	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='javascript:void(0)' onClick='parentNode.submit();return false;'>Delete</a>
			</div>
			{{ Form::close() }}

		</div>
		
		</div>
	</div>
</div>

@stop