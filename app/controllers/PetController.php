<?php

class PetController extends \BaseController {

	public function __construct() {

		$this->beforeFilter('csrf', array('on' => 'post'));

        $this->beforeFilter('auth'); 
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

		if($pets){
			return View::make('pet_index')
				->with('pets', $pets);
		} else {
			return Redirect::to('/pet/create')->with('flash_message', "Sorry, you don't have a pet. Why don't you add one?");
		}
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('add_pet', ['vet_list' => Vet::lists('name','id')]);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$rules = array(
		    'name' => 'required|alpha|min:2',
		    //'breed' => 'required|alpha|min:2'
		);          

		$messages = array(
			'name.required' => 'Name field is required.',
			'name.alpha' => 'Please only use English alphabets in Name field.',
			//'breed.required' => 'Breed field is required.',
			//'breed.alpha' => 'Please only use English alphabets in Breed field.'
		);

		$validator = Validator::make(Input::all(), $rules, $messages);

		if($validator->fails()) {

		    return Redirect::to('/pet/create')
		        ->with('flash_message', 'Add pet failed; please fix the errors listed below.')
		        ->withInput()
		        ->withErrors($validator);
		}

	    $pet = new Pet();

	    $name = filter_var($_POST["name"], FILTER_SANITIZE_STRING);
	    $breed = filter_var($_POST["breed"], FILTER_SANITIZE_STRING);
	    $birthday = filter_var($_POST["birthday"], FILTER_SANITIZE_STRING);
	    $sex = filter_var($_POST["sex"], FILTER_SANITIZE_STRING);
	    $vet = filter_var($_POST["vet"], FILTER_SANITIZE_NUMBER_INT);

	    $pet->name = $name;
	    $pet->breed = $breed;
	    $pet->sex = $sex;
	    $pet->birthday = Pet::saveDateFmt($birthday);

	    $user = Auth::user();
	    $veterinarian = Vet::where('id', '=', $vet)->first();

	    $pet->user()->associate($user);
	    $pet->vet()->associate($veterinarian);

	    $pet->save();

	    Pet::saveVaccine($pet, filter_var($_POST["rabies"], FILTER_SANITIZE_STRING), 'Rabies');
    	Pet::saveVaccine($pet, filter_var($_POST["bordetella"], FILTER_SANITIZE_STRING), 'Bordetella');
    	Pet::saveVaccine($pet, filter_var($_POST["parvo"], FILTER_SANITIZE_STRING), 'Parvo');
    	Pet::saveVaccine($pet, filter_var($_POST["heartworm"], FILTER_SANITIZE_STRING), 'Heartworm Test');
    	Pet::saveVaccine($pet, filter_var($_POST["distemper"], FILTER_SANITIZE_STRING), 'Distemper');
    	Pet::saveVaccine($pet, filter_var($_POST["flea"], FILTER_SANITIZE_STRING), 'Flea Prevention');

        Redirect::to('/')->with('flash_message', 'Your New Pet has been saved!');
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		try {
		    $pet    = Pet::findOrFail($id);
		}
		catch(exception $e) {
		    return Redirect::to('/pet')->with('flash_message', 'Sorry, an error occurred. Please try again later.');
		}

		return View::make('edit_pet', ['vet_list' => Vet::lists('name','id')])->with('pet', $pet);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$rules = array(
		    'name' => 'required|alpha|min:2',
		    //'breed' => 'required|alpha|min:2'
		);          

		$messages = array(
			'name.required' => 'Name field is required.',
			'name.alpha' => 'Please only use English alphabets in Name field.',
			//'breed.required' => 'Breed field is required.',
			//'breed.alpha' => 'Please only use English alphabets in Breed field.'
		);

		$validator = Validator::make(Input::all(), $rules, $messages);

		if($validator->fails()) {

		    return Redirect::to('/pet/'.$id.'/edit')
		        ->with('flash_message', 'Edit pet failed; please fix the errors listed below.')
		        ->withInput()
		        ->withErrors($validator);
		}

		try {
	        $pet = Pet::findOrFail(Input::get('id'));
	    }
	    catch(exception $e) {
	        return Redirect::to('/pet')->with('flash_message', 'Error Editing Pet.');
	    }
	    # http://laravel.com/docs/4.2/eloquent#mass-assignment
	    $name = filter_var($_POST["name"], FILTER_SANITIZE_STRING);
	    $breed = filter_var($_POST["breed"], FILTER_SANITIZE_STRING);
	    $birthday = filter_var($_POST["birthday"], FILTER_SANITIZE_STRING);
	    $sex = filter_var($_POST["sex"], FILTER_SANITIZE_STRING);
	    $vet = filter_var($_POST["vet"], FILTER_SANITIZE_NUMBER_INT);

	    $pet->name = $name;
	    $pet->breed = $breed;
	    $pet->sex = $sex;
	    $pet->birthday = Pet::saveDateFmt($birthday);

	    $veterinarian = Vet::where('id', '=', $vet)->first();

	    $pet->vet()->associate($veterinarian);

	    $pet->save();

    	Pet::saveVaccine($pet, filter_var($_POST["rabies"], FILTER_SANITIZE_STRING), 'Rabies');
    	Pet::saveVaccine($pet, filter_var($_POST["bordetella"], FILTER_SANITIZE_STRING), 'Bordetella');
    	Pet::saveVaccine($pet, filter_var($_POST["parvo"], FILTER_SANITIZE_STRING), 'Parvo');
    	Pet::saveVaccine($pet, filter_var($_POST["heartworm"], FILTER_SANITIZE_STRING), 'Heartworm Test');
    	Pet::saveVaccine($pet, filter_var($_POST["distemper"], FILTER_SANITIZE_STRING), 'Distemper');
    	Pet::saveVaccine($pet, filter_var($_POST["flea"], FILTER_SANITIZE_STRING), 'Flea Prevention');

	   	return Redirect::to('/pet')->with('flash_message','Your changes have been saved.');
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
