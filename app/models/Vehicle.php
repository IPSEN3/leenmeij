<?php

class Vehicle extends Eloquent {

	protected $table = 'vehicle';

	public function getVehicles() {

		$vehicles = DB::table('vehicle')->get();

		foreach ($vehicles as $vehicle) {
			
			return $vehicles;

		}
	}

	public function getVehicle($startdate, $enddate) {


          // $vehicles = DB::select( DB::raw("select v.id, v.brand, v.type, v.description, v.airco, v.seats, v.hourly_rent from vehicle as v where v.id not in((select v.id from vehicle as v inner join reservation as r on r.`vehicle_id` = v.id where r.status_id in(3,4,5) AND (r.startdate >= :start AND r.enddate <= :eind ) group by v.id))"), 
		$vehicles = DB::select( DB::raw("
			SELECT v.id, v.brand, v.type, v.description, v.airco, v.seats, v.hourly_rent 
			FROM vehicle as v 
			WHERE v.id 
			NOT IN((SELECT v.id FROM vehicle as v INNER JOIN reservation as r on r.`vehicle_id` = v.id WHERE r.status_id in(3,4,5) 
			AND (
					(
						(:starta >= r.startdate AND :einda <= r.enddate )
						OR
						(:startb <= r.startdate AND :eindb >= r.enddate ) 
					) 
					OR
				 	(
						(:startc >= r.startdate AND :startd <= r.enddate)
						OR
						(:eindc >= r.startdate AND :eindd <= r.enddate)
					)
				)
			GROUP BY v.id
			))"), 
             array(
             	'starta' => $startdate, 
             	'einda' => $enddate,
             	'startb' => $startdate, 
             	'eindb' => $enddate,
             	'startc' => $startdate, 
             	'eindc' => $enddate,
             	'startd' => $startdate, 
             	'eindd' => $startdate, 
             )
        );

          		return $vehicles;

	}

}
