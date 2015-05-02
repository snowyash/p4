<?php

class PetController extends \BaseController {

	public function __construct() {

		$this->beforeFilter( 'csrf', array( 'on' => 'post' ));

        $this->beforeFilter( 'auth' ); 
    } 

	public function sendPetsInfo() {

	    $rules = array( 
            'email' => 'required|email'
            );

		$validator = Validator::make( Input::all(), $rules );

		if( $validator->fails()) {

		    return Redirect::to( '/pet' )
		        ->with( 'flash_message', 'Could not send email, please check your input.' )
		        ->withInput();
		}

        $email = Input::get( 'email' );

	    # Create an array of data, which will be passed/available in the view
	    $user = Auth::user();
		$pets = $user->pets;

	    $data = array( 'user' => $user, 'pets' => $pets, 'email' => $email );

		if( sizeof( $pets ) !== 0 ){

			Pet::email( $data );

	    	return Redirect::to( '/pet' )->with( 'confirm_message', "Your email is sent!" );

		} else {
			return Redirect::to( '/pet' )->with( 'flash_message', "Sorry, error sending email. Please try again later." );
		}

	}

    /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$user = Auth::user();
		$pets = $user->pets;

		if( $pets ){
			return View::make( 'pet_index' )
				->with( 'pets', $pets );
		} else {
			return Redirect::to( '/pet/create' )->with( 'flash_message', "Sorry, you don't have a pet. Why don't you add one?" );
		}
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make( 'add_pet', [ 'vet_list' => Vet::lists( 'name','id' )]);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$rules = Pet::makeRules();   

		$messages = Pet::makeMsgs();

		$validator = Validator::make( Input::all(), $rules, $messages );

		if( $validator->fails()) {

		    return Redirect::to( '/pet/create' )
		        ->with( 'flash_message', 'Add pet failed; please fix the errors listed below.' )
		        ->withInput()
		        ->withErrors( $validator );
		}

	    $pet = new Pet();

	    $pet = Pet::savePetInfo( $pet, $_POST[ "name" ], $_POST[ "breed" ], $_POST[ "birthday" ], $_POST[ "sex" ], $_POST[ "vet" ] );
	    
	    $user = Auth::user();
	    $pet->user()->associate( $user );

	    $pet->save();

	    $pet = Pet::saveVacData( $pet, $_POST[ "rabies" ], $_POST[ "bordetella" ], $_POST[ "parvo" ], $_POST[ "heartworm" ], $_POST[ "distemper" ], $_POST[ "flea" ]);

        return Redirect::to( '/' )->with( 'confirm_message', 'Your New Pet has been saved!' );
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit( $id )
	{
		try {
		    $pet    = Pet::findOrFail( $id );
		}
		catch( exception $e ) {
		    return Redirect::to( '/pet' )
		    	->with( 'flash_message', $e->getMessage());
		}

		return View::make( 'edit_pet', [ 'vet_list' => Vet::lists( 'name','id' )])->with( 'pet', $pet );
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update( $id )
	{
		$rules = Pet::makeRules();   

		$messages = Pet::makeMsgs();

		$validator = Validator::make( Input::all(), $rules, $messages );

		if( $validator->fails()) {

		    return Redirect::to( '/pet/'.$id.'/edit' )
		        ->with( 'flash_message', 'Edit pet failed; please fix the errors listed below.' )
		        ->withInput()
		        ->withErrors( $validator );
		}

		try {
	        $pet = Pet::findOrFail( Input::get( 'id' ));
	    }
	    catch( exception $e ) {
	        return Redirect::to( '/pet' )->with( 'flash_message', 'Error Editing Pet.' );
	    }
	    
	    $pet = Pet::savePetInfo( $pet, $_POST[ "name" ], $_POST[ "breed" ], $_POST[ "birthday" ], $_POST[ "sex" ], $_POST[ "vet" ] );

	    $pet->save();

    	$pet = Pet::saveVacData( $pet, $_POST[ "rabies" ], $_POST[ "bordetella" ], $_POST[ "parvo" ], $_POST[ "heartworm" ], $_POST[ "distemper" ], $_POST[ "flea" ]);

	   	return Redirect::to( '/pet' )->with( 'confirm_message','Your changes have been saved.' );
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy( $id )
	{
		try {
			$pet = Pet::findOrFail( $id );
		}
		catch( Exception $e ) {
			return Redirect::to( '/pet' )->with( 'flash_message', 'Pet not found' );
		}
		# Note there's a `deleting` Model event which makes sure book_tag entries are also destroyed
		# See Tag.php for more details
		try{
			Pet::destroy( $id );
		}
		catch( Exception $e ) {
			return Redirect::to( '/pet' )->with( 'flash_message', 'Error deleting pet' );
		}

		return Redirect::to( '/' )->with( 'confirm_message','This pet has been deleted.' );
	}
}
