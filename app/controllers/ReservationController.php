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
		$reservation['pickuptime'] = Input::get( 'pickuptime' );
		$reservation['returndate'] = Input::get( 'returndate' );
		$reservation['returntime'] = Input::get( 'returntime' );

		$validation = Validator::make(
			Input::all(),
			array(
				'pickupdate' => 'required',
				'pickuptime' => 'required',
				'returndate' => 'required',
				'returntime' => 'required'
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

		return View::make('site/reservation/car')->with('datum', $value)->with('vehicles', $this->vehicles->getVehicles());

	}

	public function editDates() {

		$reservation['pickupdate'] = Input::get( 'pickupdate' );
		$reservation['pickuptime'] = Input::get( 'pickuptime' );
		$reservation['returndate'] = Input::get( 'returndate' );
		$reservation['returntime'] = Input::get( 'returntime' );

		$validation = Validator::make(
			Input::all(),
			array(
				'pickupdate' => 'required',
				'pickuptime' => 'required',
				'returndate' => 'required',
				'returntime' => 'required'
				)
		);


		if($validation->fails()) {

			return Redirect::back()
			->withErrors($validation)
			->withInput();

		}
		else {
			
			Session::put('reserveringen', $reservation);
			return Redirect::to('reservation/car')->with('success', Lang::get("site.saved"));

		}

	}

	public function selectCar() {

		$reservation['car'] = Input::get('id');	

		if (Session::has('car')) {
			Session::forget('car');
		}

		if (Input::has('id'))
		{
		    Session::push('reserveringen', $reservation['car']);
		}

		$data = Session::all();
		//return Redirect::to('reservation/payment');
		return Redirect::back()->with('success', 'Auto gekozen')->with('sessie', $data);

	}

}