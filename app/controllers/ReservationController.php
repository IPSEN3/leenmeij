<?php 

class ReservationController extends BaseController {

	protected $vehicles = array();
	protected $reservation;
	protected $user;

	public function __construct(Vehicle $vehicles, Reservation $reservation, User $user)
    {
        parent::__construct();
        $this->vehicles = $vehicles;
        $this->reservation = $reservation;
        $this->user = $user;
    }

	public function postDates() {

		$reservation['pickupdate'] = Input::get( 'pickupdate' );
		$reservation['returndate'] = Input::get( 'returndate' );
		$reservation['pickupsub'] = Input::get( 'd__pickupdate__m' );
		$reservation['returnsub'] = Input::get( 'd__returndate__m' );


		$validation = Validator::make(
			Input::all(),
			array(
				'pickupdate' => 'required',
				'returndate' => 'required',
				)
		);


		if($validation->fails()) {

			return Redirect::to('/')
			->withErrors($validation)
			->withInput();

		}
		else {
			
			Session::put('reserveringen', $reservation);

			return Redirect::to('reservation/car');

		}

	}

	public function getDates() {

		$value = Session::get('reserveringen');
		$vehicleRev = Vehicle::all();

		return View::make('site/reservation/vehicle')
		->with('gegevens', $value)
		->with('reviews', $vehicleRev)
		->with('vehicles', $this->vehicles->getVehicleByDate($value['pickupsub'], $value['returnsub']));

	}

	public function editDates() {

		return View::make('site/user/home');

	}

	public function selectCar() {

		if (Session::has('car')) {
			Session::forget('car');
		}

		if (Input::has('id'))
		{
		    $reserveringen = Session::get('reserveringen');
			$reserveringen['car'] = Input::get('id');
			Session::put('reserveringen', $reserveringen);
		}

		$data = Session::get('reserveringen');
		return $this->getDates($data['pickupdate'], $data['returndate'])
		->with('gegevens', $data);

	}

	public function getPayment() {

        if(array_key_exists('car', Session::get('reserveringen'))) {

            $value = Session::get('reserveringen');

            $this->diff(strtotime($value['pickupsub']), strtotime($value['returnsub']));

            $totaal = $this->day;

            return View::make('site/reservation/payment')
                ->with('gegevens', $value)
                ->with('totaal', $totaal)
                ->with('vehicles', $this->vehicles->getVehicleById($value['car']));

        }
        else {

            return Redirect::back()
                ->with('error', Lang::get('renting.choose_car_first'));

        }

	}

	public function postReservation() {

		$value = Session::get('reserveringen');

		if($this->reservation->makeReservation($value, $this->user->getUserFromCustomerListByEmail()))
		{
			return Redirect::to('/')
			->with('success', Lang::get('site.reservation_complete') );
		}
		else {
			return Redirect::back()
			->with('error', Lang::get('site.reservation_error'));
		}


	}


	public function diff($start,$end = false) { 

	    if(!$end) { $end = time(); } 
	    if(!is_numeric($start) || !is_numeric($end)) { return false; } 
	    
	    $start  = date('Y-m-d',$start); 
	    $end    = date('Y-m-d',$end); 
	    $d_start    = new DateTime($start); 
	    $d_end      = new DateTime($end); 
	    $diff = $d_start->diff($d_end); 
	    
	    $this->year    = $diff->format('%y'); 
	    $this->month    = $diff->format('%m'); 
	    $this->day      = $diff->format('%d'); 
	    return true; 
	} 

}