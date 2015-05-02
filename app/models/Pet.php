<?php

class Pet extends Eloquent { 

    public function user() {
        return $this->belongsTo( 'User' );
    }

    public function vet() {
        return $this->belongsTo( 'Vet' );
    }

    public function vaccines() {
        return $this->belongsToMany( 'Vaccine' )->withPivot( 'expiry' );
    }

    public static function makeRules(){
        $rules = array( 
            'name'          => 'required|regex:/^[ a-zA-Z  ]+$/|min:2',
            'breed'         => 'required|regex:/^[ a-zA-Z  ]+$/|min:2',
            'birthday'      => array( 'required', 'date', 'regex:/^(([ 0 ][ 0-9 ])|([ 1 ][ 0-2 ]))[ \/ ](([ 0-2 ][ 0-9 ])|([ 3 ][ 0-1 ]))[ \/ ]([ 2 ][ 0 ][ 0-2 ][ 0-9 ])$/' ),
            'rabies'        => array( 'date', 'regex:/^(([ 0 ][ 0-9 ])|([ 1 ][ 0-2 ]))[ \/ ](([ 0-2 ][ 0-9 ])|([ 3 ][ 0-1 ]))[ \/ ]([ 2 ][ 0 ][ 0-2 ][ 0-9 ])$/' ),
            'bordetella'    => array( 'date', 'regex:/^(([ 0 ][ 0-9 ])|([ 1 ][ 0-2 ]))[ \/ ](([ 0-2 ][ 0-9 ])|([ 3 ][ 0-1 ]))[ \/ ]([ 2 ][ 0 ][ 0-2 ][ 0-9 ])$/' ),
            'parvo'         => array( 'date', 'regex:/^(([ 0 ][ 0-9 ])|([ 1 ][ 0-2 ]))[ \/ ](([ 0-2 ][ 0-9 ])|([ 3 ][ 0-1 ]))[ \/ ]([ 2 ][ 0 ][ 0-2 ][ 0-9 ])$/' ),
            'heartworm'     => array( 'date', 'regex:/^(([ 0 ][ 0-9 ])|([ 1 ][ 0-2 ]))[ \/ ](([ 0-2 ][ 0-9 ])|([ 3 ][ 0-1 ]))[ \/ ]([ 2 ][ 0 ][ 0-2 ][ 0-9 ])$/' ),
            'distemper'     => array( 'date', 'regex:/^(([ 0 ][ 0-9 ])|([ 1 ][ 0-2 ]))[ \/ ](([ 0-2 ][ 0-9 ])|([ 3 ][ 0-1 ]))[ \/ ]([ 2 ][ 0 ][ 0-2 ][ 0-9 ])$/' ),
            'flea'          => array( 'date', 'regex:/^(([ 0 ][ 0-9 ])|([ 1 ][ 0-2 ]))[ \/ ](([ 0-2 ][ 0-9 ])|([ 3 ][ 0-1 ]))[ \/ ]([ 2 ][ 0 ][ 0-2 ][ 0-9 ])$/' )
        );

        return $rules;
    }

    public static function makeMsgs(){
        $messages = array( 
            'name.required'     => 'Name field is required.',
            'name.regex'        => 'Please only use English alphabets in Name field.',
            'breed.required'    => 'Breed field is required.',
            'breed.regex'       => 'Please only use English alphabets in Breed field.',
            'birthday.required' => 'Please enter your pet\'s birthday.',
            'birthday.regex'    => 'Please double check birthday, or click to select date.',
            'rabies.regex'      => 'Please double check rabies vaccine entry, or click to select date.',
            'rabies.date'       => 'Please double check rabies vaccine entry, or click to select date.',
            'bordetella.regex'  => 'Please double check bordetella vaccine entry, or click to select date.',
            'parvo.regex'       => 'Please double check parvo vaccine entry, or click to select date.',
            'heartworm.regex'   => 'Please double check heartworm test entry, or click to select date.',
            'distemper.regex'   => 'Please double check distemper vaccine entry, or click to select date.',
            'flea.regex'        => 'Please double check flea prevention entry, or click to select date.'
        );

        return $messages;
    }    

    public static function saveDateFmt( $date ){

	    try{
            date_default_timezone_set( 'America/Los_Angeles' );
            
            //entered date format is mm/dd/yyyy, we wonna change it to yyyy-mm-dd
    		$new_date = substr( $date, 6, 4 ).'-'.substr( $date, 0, 2 ).'-'.substr( $date, 3, 2 );
    		$new_date = date_create( $new_date );
            return $new_date;
            
        } catch( Exception $ex ){
                throw $e;
        }
    }

    public static function savePetInfo( $pet, $name, $breed, $birthday, $sex, $vet_post ){
        $pet->name = filter_var( $name, FILTER_SANITIZE_STRING );
        $pet->breed = filter_var( $breed, FILTER_SANITIZE_STRING );
        $pet->birthday = Pet::saveDateFmt( filter_var( $birthday, FILTER_SANITIZE_STRING ));
        $pet->sex = filter_var( $sex, FILTER_SANITIZE_STRING );

        $vet = filter_var( $vet_post, FILTER_SANITIZE_NUMBER_INT );
        $veterinarian = Vet::where( 'id', '=', $vet )->first();
        $pet->vet()->associate( $veterinarian );

        return $pet;
    }

    public static function saveVaccine( $pet, $date, $name ){

        $vaccine = Vaccine::where( 'name', '=', $name )->first();
        $vaccine_date = Pet::saveDateFmt( $date );

        $pet->vaccines()->attach( $vaccine );
        $vaccine = $pet->vaccines()->where( 'name', '=', $name )->first();
        $vaccine->pivot->expiry = $vaccine_date;
        $vaccine->pivot->save();
    }

    public static function saveVacData($pet, $rabies, $bordetella, $parvo, $heartworm, $distemper, $flea){
        Pet::saveVaccine( $pet, filter_var( $rabies, FILTER_SANITIZE_STRING ), 'Rabies' );
        Pet::saveVaccine( $pet, filter_var( $bordetella, FILTER_SANITIZE_STRING ), 'Bordetella' );
        Pet::saveVaccine( $pet, filter_var( $parvo, FILTER_SANITIZE_STRING ), 'Parvo' );
        Pet::saveVaccine( $pet, filter_var( $heartworm, FILTER_SANITIZE_STRING ), 'Heartworm Test' );
        Pet::saveVaccine( $pet, filter_var( $distemper, FILTER_SANITIZE_STRING ), 'Distemper' );
        Pet::saveVaccine( $pet, filter_var( $flea, FILTER_SANITIZE_STRING ), 'Flea Prevention' );

    }

    public static function updateVaccine( $pet, $date, $name ){

        $vaccine_date = Pet::saveDateFmt( $date );
        $vaccine = $pet->vaccines()->where( 'name', '=', $name )->first();
        $vaccine->pivot->expiry = $vaccine_date;
        $vaccine->pivot->save();
    }

    public static function displayDateFmt( $date ){
        if( $date !== '0000-00-00' ){
            $new_date = substr( $date, 5, 2 ).'/'.substr( $date, 8, 2 ).'/'.substr( $date, 0, 4 );
            return $new_date;
        } else {
            $new_date = '';
            return $new_date;
        }
    }

    public static function boot() {
        parent::boot();
        static::deleting( function( $pet ) {
            DB::statement( 'DELETE FROM pet_vaccine WHERE pet_id = ?', array( $pet->id ));
        } );
    }

    public static function email( $data ){

        Mail::send( 'emails.petsInfo', $data, function( $message ) use ( $data ) {

            $subject  = 'Here are the pets info from '.$data[ 'user' ][ 'name' ].'!';

            $message->to( $data[ 'email' ], 'Whom this might concern' )->subject( $subject );
        } );
    }
}