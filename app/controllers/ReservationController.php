<?php 

class ReservationController extends BaseController {

	protected $vehicles = array();

	public function __construct(Vehicle $vehicles)
    {
        parent::__construct();
        $this->vehicles = $vehicles;
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

		return View::make('site/reservation/car')
		->with('gegevens', $value)
		->with('vehicles', $this->vehicles->getVehicleByDate($value['pickupsub'], $value['returnsub']));

	}

	public function editDates() {

		return $this->postDates()
		->with('success', Lang::get('site.saved'));

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

		$value = Session::get('reserveringen');

		$this->diff(strtotime($value['pickupsub']), strtotime($value['returnsub']));

		$totaal = $this->day;

		return View::make('site/reservation/payment')
		->with('gegevens', $value)
		->with('totaal', $totaal)
		->with('vehicles', $this->vehicles->getVehicleById($value['car']));

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