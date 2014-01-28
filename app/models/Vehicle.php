<?php

class Vehicle extends Eloquent {

	protected $table = 'vehicle';

	public function getVehicleByDate($startdate, $enddate) {

		$vehicles = DB::select( DB::raw("
			SELECT v.id, v.brand, v.type, v.description, v.airco, v.seats, v.hourly_rent, v.rating_cache, v.rating_count
			FROM vehicle AS v
			LEFT JOIN reservation AS r
			  ON v.id = r.vehicle_id
			    AND r.startdate <= '" . $enddate . "'
			    AND r.enddate >= '" . $startdate . "'
			    AND r.status_id NOT IN (3,4,5)
			WHERE r.id IS NULL;")
        );

          		return $vehicles;

	}

	public function getVehicleById($id) {

		$vehicles = DB::table('vehicle')
					->select('*')
					->where('id', '=', (int) $id)
					->get();

				return $vehicles;

	}

	public function reviews()
	{
		return $this->hasMany('Review');
	}

	public function recalculateRating($rating)
	{
		$reviews = $this->reviews()->notSpam()->approved();
		$avgRating = $reviews->avg('rating');
		$this->rating_cache = round($avgRating,1);
		$this->rating_count = $reviews->count();
		$this->save();
	}


}

