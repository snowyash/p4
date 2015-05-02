<?php
 
class VetTableSeeder extends Seeder {
 
  public function run()
  {
  	$vet = Vet::create(array(
	  'name' 	=> 'VCA Almaden',
	  'address' => 'Almaden Expwy, San Jose, 95123',
	  'phone' 	=> '555-000-8989',
	  'email' 	=> 'vca@almaden.com',
	  'website' => 'http://www.vcaalmaden.com'
	));

	$vet = Vet::create(array(
	  'name' 	=> 'VCA Los Gatos',
	  'address' => 'Saratoga Hwy, San Jose, 95111',
	  'phone' 	=> '434-222-8989',
	  'email' 	=> 'vca@losgatos.com',
	  'website' => 'http://www.vcalosgatos.com'
	));

	$vet = Vet::create(array(
	  'name' 	=> 'VCA San Jose',
	  'address' => 'Almaden Rd, San Jose, 95118',
	  'phone' 	=> '440-112-0000',
	  'email' 	=> 'vca@sanjose.com',
	  'website' => 'http://www.vcasanjose.com'
	));

	$vet = Vet::create(array(
	  'name' 	=> 'VCA Pacifica',
	  'address' => 'Prairie Dr, Pacifica, 91741',
	  'phone' 	=> '650-123-4444',
	  'email' 	=> 'vca@pacifica.com',
	  'website' => 'http://www.vcapacifica.com'
	));

	$vet = Vet::create(array(
	  'name' 	=> 'VCA Mountain View',
	  'address' => 'Shoreline Rd, San Jose, 95123',
	  'phone' 	=> '650-888-9999',
	  'email' 	=> 'vca@mountainview.com',
	  'website' => 'http://www.vcamountainview.com'
	));
  }
 
}