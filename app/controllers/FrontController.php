<?php

class FrontController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		return View::make('site/user/home');
	}

	public function getAbout() 
	{
		return View::make('site/user/about');
	}

	public function getContact()
	{
		return View::make('site/user/contact');
	}


}