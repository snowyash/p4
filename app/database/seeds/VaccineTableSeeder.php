<?php
 
class VaccineTableSeeder extends Seeder {
 
  public function run()
  {
  	$vaccine = Vaccine::create(array(
	  'name' => 'Rabies'
	));

	$vaccine = Vaccine::create(array(
	  'name' => 'Bordetella'
	));

	$vaccine = Vaccine::create(array(
	  'name' => 'Parvo'
	));

	$vaccine = Vaccine::create(array(
	  'name' => 'Heartworm Test'
	));

	$vaccine = Vaccine::create(array(
	  'name' => 'Distemper'
	));

	$vaccine = Vaccine::create(array(
	  'name' => 'Flea Prevention'
	));	
 	}
}