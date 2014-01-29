<?php

class FrontController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{

		$review = Review::all();

		return View::make('site/user/home')->with('reviews', $review);
	}

	public function getAbout() 
	{
		return View::make('site/user/about');
	}

	public function getContact()
	{

		return View::make('site/user/contact');
	}

    public function getSomething()
    {

        if(Session::has('skin')) {
            Session::forget('skin');
        }
        else {
            Session::put('skin', 'summer');
        }

        return Redirect::back();
    }
}