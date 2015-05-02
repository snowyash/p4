<?php

class UserController extends \BaseController {


	public function __construct() {

		$this->beforeFilter( 'csrf', array( 'on' => 'post' ));

        $this->beforeFilter( 'guest', 
            array( 'only' => array( 'getLogin', 'getSignup', 'getGenerateNewPassword' ))); 

        $this->beforeFilter( 'auth', 
            array( 'only' => array( 'anyLogout', 'show', 'edit', 'update', 'destroy' )));    
    } 

    # GET: http://localhost/user/signup
    public function getSignup() {
    	return View::make( 'signup' );
    }

    # POST: http://localhost/user/signup
    public function postSignup() {

    	$rules = array( 
		    'name' => 'required|alpha|min:2',
		    'surname' => 'required|alpha|min:2',
		    'email' => 'required|email|unique:users,email',
		    'password' => 'required|min:4'   
		 );          

		$messages = array( 
			'name.required' => 'Name field is required.',
			'name.alpha' => 'Please only use English alphabets.',
			'surname.required' => 'Surname field is required.',
			'surname.alpha' => 'Please only use English alphabets',
			'email.required' => 'Email field is required.',
			'email.email' => 'Please input a valid email',
			'email.unique' => 'Sorry, somebody already uses this email.',
			'password.required' => 'Password field is required.',
			'password.size' => 'Please enter more than :size characters for password.',
		 );

		$validator = Validator::make( Input::all(), $rules, $messages );

		if( $validator->fails()) {

		    return Redirect::to( '/user/signup' )
		        ->with( 'flash_message', 'Sign up failed; please fix the errors listed below.' )
		        ->withInput()
		        ->withErrors( $validator );
		}

    	$user = new User;
        $user->email    = Input::get( 'email' );
        $user->name 	= Input::get( 'name' );
        $user->surname	= Input::get( 'surname' );
        $user->password = Hash::make( Input::get( 'password' ));

        # Try to add the user 
        try {
            $user->save();
        }
        # Fail
        catch ( Exception $e ) {
            return Redirect::to( '/user/signup' )
	            ->with( 'flash_message', 'Sign up failed; please try again.' )
	            ->withInput();
        }

        # Log the user in
        Auth::login( $user );

        return Redirect::to( '/' )->with( 'confirm_message', 'Welcome to PawBook!' );
    }

    # GET: http://localhost/user/login
    public function getLogin() {
    	return View::make( 'login' );
    }

    # POST: http://localhost/user/login
    public function postLogin() {
    	$rules = array( 
		    'email' => 'required|email',
		    'password' => 'required|min:4'   
		 );          

		$messages = array( 
			'email.required' => 'Email field is required.',
			'email.email' => 'Please input a valid email',
			'email.unique' => 'Sorry, somebody already uses this email.',
			'password.required' => 'Password field is required.',
			'password.size' => 'Please enter more than :size characters for password.',
		 );

		$validator = Validator::make( Input::all(), $rules, $messages );

		if( $validator->fails()) {

		    return Redirect::to( '/user/login' )
		        ->with( 'flash_message', 'Log in failed; please fix the errors listed below.' )
		        ->withInput()
		        ->withErrors( $validator );
		}

		$credentials = Input::only( 'email', 'password' );

        if ( Auth::attempt( $credentials, $remember = true )) {
            return Redirect::intended( '/' )->with( 'confirm_message', 'Welcome Back,' );
        }
        else {
            return Redirect::to( '/user/login' )->with( 'flash_message', 'Log in failed; please check your email or password.' );
        }

        return Redirect::to( '/user/login' );
    }

    # ANY: http://localhost/user/logout
    public function anyLogout() {
    	# Log out
	    Auth::logout();

	    # Send them to the homepage
	    return Redirect::to( '/' );
    }
}
