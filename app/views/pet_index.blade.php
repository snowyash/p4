@extends('_master')

@section('title')
	These are your pets!!!
@stop

@section('content')
	<h3>
	    @if(Session::get('flash_message'))
	        <div class='flash-message'>{{ Session::get('flash_message') }}</div>
	    @elseif(Session::get('confirm_message'))
	    	<div class='confirm-message'>{{ Session::get('confirm_message') }}</div>
	    @endif
	</h3>

	@if(sizeof($pets) == 0)
		<h2>Sorry, you don't have a pet. Why don't you <br /><a href="/pet/create">add one</a>?</h2>
	@else
		@for($i = 0; $i < sizeof($pets); $i++)
			@if($i % 2 === 0)
				<div class="row">
			@endif

			<div class='pet col-sm-6'>
				<div class="panel panel-warning">
		            <div class="panel-heading">
		              <h2 class="panel-title pet_name">{{ $pets[$i]['name']."&nbsp;" }}</h2>
		            </div>
		            <div class="panel-body">

						<ul class="pet_list">
							<?php $id = $pets[$i]->id; ?>
							<li><a href='/pet/{{ $id }}/edit' class="edit_link">Edit</a></li>
							<li>&nbsp;</li>
				            <li><p>{{ $pets[$i]['breed'].", ".$pets[$i]['sex']."<br />Birthday&#58; ".$pets[$i]['birthday']."<br />" }}</p></li>

			            	<li><h4>{{ $pets[$i]['vet']['name']."</h4>Phone&#58; ".$pets[$i]['vet']['phone'] }}</li>
			        		<li class="vaccine_list"><h4>Vaccine Expiry Dates</h4>
				            	<table class="table">
					            <?php 
					            	for($j = 1; $j < 7; $j++){
					            	echo "<tr>";
					            	$pet = $pets[$i];
					                $vaccine = $pet->vaccines()->where('id', '=', $j)->first();
					                echo "<td>".$vaccine->name."&nbsp;</td>";
					                if($vaccine->pivot->expiry === '0000-00-00'){
					                	echo "<td>&nbsp; No Data </td>";
					                } else
					                	echo "<td>&nbsp;".$vaccine->pivot->expiry."</td>";
					                echo "</tr>";
					            	}
					            ?>
					            </table>
				            </li>	
			        	</ul>
			        </div>
          		</div>
			</div>


			@if($i % 2 !== 0)
				</div>
			@endif
		@endfor

    	<div class="container col-lg-11 text-center">

    		{{ Form::open(array('action' => array('PetController@sendPetsInfo'), 'method' => 'get')) }}

			<div class="input-group">

    		{{ Form::text('email', 'Please input recipient email here...', array(
	              'class' => 'form-control float-left',
	          )) }}

	        <span class="input-group-btn">

	    		{{ Form::submit('Email Pets Info', array(
		              'class' => 'btn btn-primary float-left',
		          )) }}

	        </span>

			</div>

			{{ Form::close() }}
		</div>
	@endif
@stop