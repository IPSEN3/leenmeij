<?php

class Reservation extends Eloquent {

	protected $table = 'reservations';

	    /**
     * Laravel application
     *
     * @var Illuminate\Foundation\Application
     */
    public static $app;

    public function __construct() 
    {
    	  if ( ! static::$app )
            static::$app = app();
    }

	public function getReservations() {

		$reservations = DB::table('reservation')->get();

		foreach ($reservations as $reservation) {
			
			return $reservation;

		}
	}

	public function getReservationByCustomerId($id) {

		$reservations = DB::table('reservation')
					->select('*', 'reservation.id', 'vehicle.brand', 'vehicle.type', 'status.value')
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

		$view = 'emails/reservation';

		$this->sendEmail( 'email.reservation_complete', $view, array('user'=>Auth::User()) );

		Session::forget('reserveringen');

		return true;

	}

	protected function sendEmail( $subject_translation, $view_name, $params = array() )
    {
        if ( static::$app['config']->getEnvironment() == 'testing' )
            return;

        $user = Auth::User();

        static::$app['mailer']->send($view_name, $params, function($m) use ($subject_translation, $user)
        {
            $m->to( Auth::User()->email )
                ->subject( Lang::get($subject_translation) );
        });
    }

}

