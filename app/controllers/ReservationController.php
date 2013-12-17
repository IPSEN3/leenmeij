<?php 

class ReservationController extends BaseController {

	protected $reservation = array();

	public function __construct()
    {
        parent::__construct();
        
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

		return View::make('site/reservation/car')->with('datum', $value);

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

}