<?php

class Pet extends Eloquent { 

    public function user() {
        return $this->belongsTo('User');
    }

    public function vet() {
        return $this->belongsTo('Vet');
    }

    public function vaccines() {
        return $this->belongsToMany('Vaccine')->withPivot('expiry');
    }

    public static function saveDateFmt($date){
    	//entered date format is mm/dd/yyyy, we wonna change it to yyyy-mm-dd

    	//first check if date input is valid
    	if (checkdate(substr($date, 0, 2), substr($date, 3, 2), substr($date, 6, 4))) {

    		//then try to create date object
	    	try {
			    date_default_timezone_set('America/Los_Angeles');

				$new_date = substr($date, 6, 4).'-'.substr($date, 0, 2).'-'.substr($date, 3, 2);

				$new_date = date_create($new_date);

			} catch (Exception $e) {
			    return Redirect::to('/pet/create')->with('flash_message', $e->getMessage());
			}
			
		} else {
			return Redirect::to('/pet/create')->with('flash_message', 'invalid date input');
		}
    	
    	return $new_date;
    }

    public static function displayDateFmt($date){
        $new_date = substr($date, 5, 2).'/'.substr($date, 8, 2).'/'.substr($date, 0, 4);
        return $new_date;
    }

    public static function saveVaccine($pet, $date, $name){

        $vaccine = Vaccine::where('name', '=', $name)->first();
        $vaccine_date = Pet::saveDateFmt($date);
        $pet->vaccines()->attach($vaccine);
        $vaccine = $pet->vaccines()->where('name', '=', $name)->first();
        $vaccine->pivot->expiry = $vaccine_date;
        $vaccine->pivot->save();
    }
}