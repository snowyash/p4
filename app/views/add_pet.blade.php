@extends('_master')

@section('title')
	Add your pet :)
@stop

@section('content')
<div class="text-center">
		
	<h1>Add a pet</h1>

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

		{{ Form::open(array('url' => '/pet')) }}

		<div class="form-group col-lg-12">

		    {{ Form::label( 'name', 'Name*' ) }}<br>
		    {{ Form::text('name', '', array(
	              'class' => 'form-control',
	              'placeholder' => 'ie. Buddy',
	          )) }}

		    {{ Form::label( 'breed', 'Breed*' ) }}<br>
		    {{ Form::text('breed', '', array(
	              'class' => 'form-control',
	              'placeholder' => 'ie. Boston Terrier',
	          )) }}

	        {{ Form::label( 'birthday', 'Birthday' ) }}
		    {{ Form::text('birthday', '', array(
	              'class' => 'form-control datepicker',
	              'placeholder' => 'click to pick a date',
	          )) }}

		    {{ Form::label( 'sex', 'Sex*' ) }}
	        {{ Form::select('sex', 
	        [
	           'Male' => 'Male',
	           'Female' => 'Female',
	        ], 'Male', 
	          array(
	            'id' => 'sex',
	            'class' => 'form-control',
	          )
	        ) }}

	        <br>

		    <!--vaccine, and vet selector-->

	        {{ Form::label( 'vet', 'Vet*' ) }}
	        {{ Form::select('vet', $vet_list, Input::old('genres'), 
	          array(
	            'class' => 'form-control',
	          )) }}

	        <br>
	    </div>

	    <div class="form-group col-lg-6">

	        {{ Form::label( 'rabies', 'Rabies' ) }}
		    {{ Form::text('rabies', '', array(
	              'class' => 'form-control datepicker',
	              'placeholder' => 'click to pick a date',
	          )) }}

	        {{ Form::label( 'bordetella', 'Bordetella' ) }}
		    {{ Form::text('bordetella', '', array(
	              'class' => 'form-control datepicker',
	              'placeholder' => 'click to pick a date',
	          )) }}

	        {{ Form::label( 'parvo', 'Parvo' ) }}
		    {{ Form::text('parvo', '', array(
	              'class' => 'form-control datepicker',
	              'placeholder' => 'click to pick a date',
	          )) }}
		</div>

	    <div class="form-group col-lg-6">

	        {{ Form::label( 'heartworm', 'Heartworm Test' ) }}
		    {{ Form::text('heartworm', '', array(
	              'class' => 'form-control datepicker',
	              'placeholder' => 'click to pick a date',
	          )) }}

	        {{ Form::label( 'distemper', 'Distemper' ) }}
		    {{ Form::text('distemper', '', array(
	              'class' => 'form-control datepicker',
	              'placeholder' => 'click to pick a date',
	          )) }}

	        {{ Form::label( 'flea', 'Flea Prevention' ) }}
		    {{ Form::text('flea', '', array(
	              'class' => 'form-control datepicker',
	              'placeholder' => 'click to pick a date',
	          )) }}

		</div>

	    <div class="form-group col-lg-12">

		    <br>

		    {{ Form::submit('Submit', array(
	              'class' => 'btn btn-primary',
	          )) }}

	    </div>

		{{ Form::close() }}

	</div>
</div>
@stop