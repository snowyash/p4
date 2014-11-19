<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('welcome');
});

Route::get('/get-environment',function() {

    echo "Environment: ".App::environment();

});

Route::get('mysql-test', function() {

    # Print environment
    echo 'Environment: '.App::environment().'<br>';

    # Use the DB component to select all the databases
    $results = DB::select('SHOW DATABASES;');

    # If the "Pre" package is not installed, you should output using print_r instead
    echo Paste\Pre::render($results);

});

Route::get('/truncate', function() {

    # Clear the tables to a blank slate
    DB::statement('SET FOREIGN_KEY_CHECKS=0'); # Disable FK constraints so that all rows can be deleted, even if there's an associated FK
    DB::statement('TRUNCATE books');
    DB::statement('TRUNCATE authors');
    DB::statement('TRUNCATE tags');
    DB::statement('TRUNCATE book_tag');
});

Route::get('/user/{user_id}/edit', 'UserController@edit');
Route::controller('user', 'UserController');

Route::resource('pet', 'PetController');

/*Route::get('/add_pet', 
    array(
        'before' => 'auth', 
        function($format = 'html') {

            //$rabies = Vaccine::where('name', '=', 'Rabies')->first();
            $bordetella = Vaccine::where('name', '=', 'Bordetella')->first();
            $parvo = Vaccine::where('name', '=', 'Parvo')->first();
            $heartworm = Vaccine::where('name', '=', 'Heartworm Test')->first();
            $distemper = Vaccine::where('name', '=', 'Distemper')->first();
            $flea = Vaccine::where('name', '=', 'Flea Prevention')->first();

		    $pet = Pet::where('name', '=', 'Louis')->first();

            //$pet->vaccines()->attach($rabies);
            $pet->vaccines()->attach($bordetella);
            $pet->vaccines()->attach($parvo);
            $pet->vaccines()->attach($heartworm);
            $pet->vaccines()->attach($distemper);
            $pet->vaccines()->attach($flea);

            //$date = $pet->vaccines()->where('name', '=', 'Rabies')->first();
            //$date->pivot->expiry = "2014-12-30";
            //$date->pivot->save();

            $date = $pet->vaccines()->where('name', '=', 'Bordetella')->first();
            $date->pivot->expiry = "2015-05-09";
            $date->pivot->save();

            $date = $pet->vaccines()->where('name', '=', 'Parvo')->first();
            $date->pivot->expiry = "2015-10-05";
            $date->pivot->save();

            $date = $pet->vaccines()->where('name', '=', 'Heartworm Test')->first();
            $date->pivot->expiry = "2014-05-22";
            $date->pivot->save();

            $date = $pet->vaccines()->where('name', '=', 'Distemper')->first();
            $date->pivot->expiry = "2014-12-18";
            $date->pivot->save();

            $date = $pet->vaccines()->where('name', '=', 'Flea Prevention')->first();
            $date->pivot->expiry = "2015-03-20";
            $date->pivot->save();

            return "Success!";
        }
    )
);*/

/*Route::get('/get_pet', 
    array(
        'before' => 'auth', 
        function($format = 'html') {

            $pet = Pet::first();
            $user = $pet->user;
            $vet = $pet->vet;

            echo $pet->name."<br />";
            echo $pet->breed."<br />";
            echo $pet->sex."<br />";
            echo "<img src='".$pet->picture."'/><br />";
            
            for($i = 1; $i < 7; $i++){
                $vaccine = $pet->vaccines()->where('id', '=', $i)->first();
                echo $vaccine->name."'s expiry date is ".$vaccine->pivot->expiry."<br />";
            }

            echo "Owner's name is ".$user->name."<br />";
            echo "Vet: ".$vet->name."<br />";



        }
    )
);*/