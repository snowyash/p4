<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function($table) {

	        $table->increments('id')->unsigned();

	        $table->timestamps();

	        $table->string('name');
	        $table->string('surname');
	        $table->string('email')->unique();
		    $table->string('remember_token',100); 
		    $table->string('password');

		});

		Schema::create('vets', function($table) {

	        $table->increments('id')->unsigned();

	        $table->timestamps();

	        $table->string('name');
	        $table->string('address');
	        $table->string('phone');
	        $table->string('email')->nullable();
	        $table->integer('website')->nullable();
		});

		Schema::create('pets', function($table) {

	        $table->increments('id')->unsigned();

	        $table->timestamps();

	        $table->string('name');
	        $table->string('breed');
	        $table->string('sex');
	        $table->string('picture')->nullable();
	        $table->integer('user_id')->unsigned();
	        $table->integer('vet_id')->unsigned();

	        $table->foreign('user_id')->references('id')->on('users');
	        $table->foreign('vet_id')->references('id')->on('vets');
		});

		Schema::create('vaccines', function($table) {

	        $table->increments('id')->unsigned();

	        $table->timestamps();

	        $table->string('name');
	        
		});

		Schema::create('pet_vaccine', function($table) {

	        # AI, PK
			# none needed
 
			# General data...
			$table->integer('pet_id')->unsigned();
			$table->integer('vaccine_id')->unsigned();
			$table->date('expiry');
			
			# Define foreign keys...
			$table->foreign('pet_id')->references('id')->on('pets');
			$table->foreign('vaccine_id')->references('id')->on('vaccines');
	        
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
		Schema::drop('pets');
		Schema::drop('vets');
		Schema::drop('vaccines');
		Schema::drop('pet_vaccine');
	}

}
