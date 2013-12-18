<?php

class Vehicle extends Eloquent {

	protected $table = 'vehicle';

	public function getVehicles() {

		$vehicles = DB::table('vehicle')->get();

		foreach ($vehicles as $vehicle) {
			
			return $vehicles;

		}
	}
}