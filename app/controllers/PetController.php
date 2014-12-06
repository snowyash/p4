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
			return Redirect::to('/pet/create')->with('flash_message', 'Sorry, you don\'t have a pet. Why don\'t you add one?');
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
			'breed.required' => 'Breed field is required.',
			//'breed.alpha' => 'Please only use English alphabets in Breed field.'
		);

		$validator = Validator::make(Input::all(), $rules, $messages);

		if($validator->fails()) {

		    return Redirect::to('/pet/create')
		        ->with('flash_message', 'Add pet failed; please fix the errors listed below.')
		        ->withInput()
		        ->withErrors($validator);
		}

    	$rabies = Vaccine::where('name', '=', 'Rabies')->first();
        $bordetella = Vaccine::where('name', '=', 'Bordetella')->first();
        $parvo = Vaccine::where('name', '=', 'Parvo')->first();
        $heartworm = Vaccine::where('name', '=', 'Heartworm Test')->first();
        $distemper = Vaccine::where('name', '=', 'Distemper')->first();
        $flea = Vaccine::where('name', '=', 'Flea Prevention')->first();

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
	    
	    $rabies_date = filter_var($_POST["rabies"], FILTER_SANITIZE_STRING);
	    $bordetella_date = filter_var($_POST["bordetella"], FILTER_SANITIZE_STRING);
	    $parvo_date = filter_var($_POST["parvo"], FILTER_SANITIZE_STRING);
	    $heartworm_date = filter_var($_POST["heartworm"], FILTER_SANITIZE_STRING);
	    $distemper_date = filter_var($_POST["distemper"], FILTER_SANITIZE_STRING);
	    $flea_date = filter_var($_POST["flea"], FILTER_SANITIZE_STRING);

	    $rabies_date = Pet::saveDateFmt($rabies_date);
	    $bordetella_date = Pet::saveDateFmt($bordetella_date);
	    $parvo_date = Pet::saveDateFmt($parvo_date);
	    $heartworm_date = Pet::saveDateFmt($heartworm_date);
	    $distemper_date = Pet::saveDateFmt($distemper_date);
	    $flea_date = Pet::saveDateFmt($flea_date);
		
        $pet->vaccines()->attach($rabies);
        $pet->vaccines()->attach($bordetella);
        $pet->vaccines()->attach($parvo);
        $pet->vaccines()->attach($heartworm);
        $pet->vaccines()->attach($distemper);
        $pet->vaccines()->attach($flea);
		
        $date = $pet->vaccines()->where('name', '=', 'Rabies')->first();
        $date->pivot->expiry = $rabies_date;
        $date->pivot->save();

	    $date = $pet->vaccines()->where('name', '=', 'Bordetella')->first();
        $date->pivot->expiry = $bordetella_date;
        $date->pivot->save();

        $date = $pet->vaccines()->where('name', '=', 'Parvo')->first();
        $date->pivot->expiry = $parvo_date;
        $date->pivot->save();

        $date = $pet->vaccines()->where('name', '=', 'Heartworm Test')->first();
        $date->pivot->expiry = $heartworm_date;
        $date->pivot->save();

        $date = $pet->vaccines()->where('name', '=', 'Distemper')->first();
        $date->pivot->expiry = $distemper_date;
        $date->pivot->save();

        $date = $pet->vaccines()->where('name', '=', 'Flea Prevention')->first();
        $date->pivot->expiry = $flea_date;
        $date->pivot->save();

        Redirect::to('/')->with('flash_message', 'Welcome to PawBook!');
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
		//
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
