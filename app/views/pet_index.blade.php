@extends('_master')

@section('title')
	These are your pets!!!
@stop

@section('content')
	@if(sizeof($pets) == 0)
		<h2>Sorry, you don\'t have a pet. Why don\'t you <a href="/pet/creat">add one</a>?</h2>
	@else

		@foreach($pets as $pet)
			<div class='pet col-lg-6'>
				<ul class="pet_list">
					<li><h2 class="pet_name group_edit">{{ $pet['name']."&nbsp;" }}</h2>
						<a href='/pet/{{ $pet->id }}/edit' class="edit_link group_edit">Edit</a>
						<br /><br /><br /><br /></li>
		            <li><p>{{ $pet['breed'].", ".$pet['sex']."<br />" }}</p></li>
		            <li><p>{{ "Birthday: ".$pet['birthday']."<br />" }}</p></li>

	            	<li><h4>{{ $pet['vet']['name']."<br />" }}</h4></li>
	            	<li>{{ "Phone: ".$pet['vet']['phone']."<br />" }}</li>
	        	</ul>

				<ul class="pet_list">
		            <li class="vaccine_list"><h4>Vaccine Expiry Dates</h4>
		            	<table>
			            <?php 
			            	for($i = 1; $i < 7; $i++){
			            	echo "<tr>";
			                $vaccine = $pet->vaccines()->where('id', '=', $i)->first();
			                echo "<td>".$vaccine->name."&nbsp</td><td>&nbsp".$vaccine->pivot->expiry."</td>";
			                echo "</tr>";
			            	}
			            ?>
			            </table>
		            </li>	
	        	</ul>

	        	<ul class="pet_list">
	        		
				</ul>
			</div>
		@endforeach

	@endif
@stop