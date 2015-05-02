@extends( '_master' )

@section( 'title' )
	Welcome to PawBook!!!
@stop

@section( 'content' )
	  <h1>
	    @if( Session::get( 'flash_message' ))
	    	  <div class='flash-message'>{{ Session::get( 'flash_message' ) }}</div>
      @elseif( Session::get( 'confirm_message' ))
          <div class='confirm-message'>{{ Session::get( 'confirm_message' ).'&nbsp;'.Auth::user()->name.'!' }}</div>
	    @endif
	  </h1>

    @if(Auth::check())
        <h3>What do you want to do today?</h3>
        <ul>
            <li><a href="/pet">See my pets</a></li>
            <li><a href="/pet/create">Add a pet</a></li>
        </ul>
    @else 
        <div class="jumbotron">
            <h1>Take him with you wherever you go!</h1>
        </div> 

        <div class="row">
            <div class="col-lg-4">
                <h2>Handsfree</h2>
                <p id="firstMsg1">No more carrying vaccination papers around with you when you are out with your pets.</p>
                <p id="secondMsg1" class="hide">We will keep the record for you. Safe and right in your smartphone.</p>
            </div>
            <div class="col-lg-4">
                <h2>Hasslefree</h2>
                <p id="firstMsg2">No more googling or trying to remember who their vets are or what's their vet's phone or contact number.</p>
                <p id="secondMsg2" class="hide">The vet and their contact information are right here by your finger tips.</p>
            </div>
            <div class="col-lg-4">
                <h2>Headachefree</h2>
                <p id="firstMsg3">Just be yourself and be on the go, wherever, whenever!</p>
                <p id="secondMsg3" class="hide">And when people ask to see your pet's info, just show them or email it to them!</p>
            </div>
        </div>

        <h2 class="text-center"><a href="/user/signup">Sign Up</a> to get started or <a href="/user/login">Login</a></h2>
            
        @endif
	@stop