<?php
define('FACTUREN_DIR', public_path('uploads/facturen'));

class Reservation extends Eloquent {

	protected $table = 'reservations';

	    /**
     * Laravel application
     *
     * @var Illuminate\Foundation\Application
     */
    public static $app;

    protected $user;

    public function __construct(User $user) 
    {
    	  if ( ! static::$app )
            static::$app = app();
        $this->user = $user;
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

	public function makeReservation($reservation, $user) {

		$objDateTime = new DateTime('NOW');

		$id = DB::table('reservation')->insert(
		    array('date' => $objDateTime , 'startdate' => $reservation['pickupsub'], 'enddate' => $reservation['returnsub'], 'vehicle_id' => $reservation['car'], 'customer_id' => $user, 'payment_type_id' => 1, 'status_id' => 1, 'invoice_id' => 2)
		);

		$view = 'emails/reservation';

		$this->sendEmail( 'email.succes', $view, array('user'=>$user, 'reservation'=>$reservation) );

		Session::forget('reserveringen');

		return true;

	}

	protected function sendEmail( $subject_translation, $view_name, $params = array() )
    {
        if ( static::$app['config']->getEnvironment() == 'testing' )
            return;
        if (!is_dir(FACTUREN_DIR)){
		    mkdir(FACTUREN_DIR, 0777, true);
		}

		$user = Auth::User();
        $reservation = $params['reservation'];
        $customer = $params['user'];
        $customernaw = $this->user->getSettings(Auth::User()->email);
        // echo '<pre>';
        // dd($);

		$outputName = str_random(10);
        $pdfPath = FACTUREN_DIR.'/'.$outputName.'.pdf';
        File::put($pdfPath, PDF::load(View::make('emails/invoice')->with('user', $customer)->with('reservation', $reservation)->with('naw', $customernaw)->render(), 'A4', 'portrait')->output());

        static::$app['mailer']->send($view_name, $params, function($m) use ($subject_translation, $user, $pdfPath)
        {
            $m->to( Auth::User()->email )
                ->subject( Lang::get($subject_translation)
            );

            $m->attach($pdfPath, array('as' => Lang::get('email.invoice'), 'mime' => 'application/pdf'));
        });
    }

}

