<h1>
    Please see the below pets info from {{{ $user[ 'name' ] }}}!
</h1>

<div>
    @foreach($pets as $pet)
		<br />
		<h2 class="pet_name">{{ $pet[ 'name' ]." " }}</h2>
        <p>{{ $pet[ 'breed' ].", ".$pet[ 'sex' ]."<br />" }}</p>
        <p>{{ "Birthday: ".$pet[ 'birthday' ]."<br />" }}</p>

    	<h4>{{ $pet[ 'vet' ][ 'name' ]."<br />" }}</h4>
    	<p>{{ "Phone: ".$pet[ 'vet' ][ 'phone' ]."<br />" }}</p>

	    <h4>Vaccine Expiry Dates</h4>
        	<table>
            <?php 
            	for( $i = 1; $i < 7; $i++ ){
	            	echo "<tr>";
	                $vaccine = $pet->vaccines()->where( 'id', '=', $i )->first();
	                echo "<td>".$vaccine->name."</td>";
	                if( $vaccine->pivot->expiry === '0000-00-00' ){
	                	echo "<td>No Data </td>";
	                } else
	                	echo "<td>".$vaccine->pivot->expiry."</td>";
	                echo "</tr>";
            	}
            ?>
            </table>
	@endforeach
</div>

<br />
<p>
    - Team Pawbooks
</p>