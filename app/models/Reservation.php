<?php

class Reservation extends Eloquent {

	protected $table = 'reservations';

	public function getReservations() {

		$reservations = DB::table('reservation')->get();

		foreach ($reservations as $reservation) {
			
			return $reservation;

		}
	}

	public function getReservationByCustomerId($id) {

		$reservations = DB::table('reservation')
					->select('*', 'vehicle.brand', 'vehicle.type', 'status.value')
					->where('customer_id', '=', (int) $id)
					->leftJoin('vehicle', 'reservation.vehicle_id', '=', 'vehicle.id')
					->leftJoin('status', 'reservation.status_id', '=', 'status.id')
					->get();

				return $reservations;

	}

	public function makeReservation( $reservation) {

		$objDateTime = new DateTime('NOW');

		$id = DB::table('reservation')->insert(
		    array('date' => $objDateTime , 'startdate' => $reservation['pickupsub'], 'enddate' => $reservation['returnsub'], 'vehicle_id' => $reservation['car'], 'customer_id' => Auth::user()->id, 'payment_type_id' => 1, 'status_id' => 1, 'invoice_id' => 2)
		);

		return true;

	}

}

