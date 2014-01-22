<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Basic Page Needs
		================================================== -->
		<meta charset="utf-8" />
		<title>
			@section('title')
			Leenmeij
			@show
		</title>
		<meta name="keywords" content="Leenmeij, autoverhuur" />
		<meta name="author" content="Koekietrommel" />
		<meta name="description" content="Dit is de klanten reserveringssysteem van Leenmeij." />

		<!-- Mobile Specific Metas
		================================================== -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<!-- CSS
		================================================== -->
        {{ Basset::show('public.css') }}

		<style>
		@section('styles')
		@show
		</style>

		<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
		<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->

		<!-- Favicons
		================================================== -->
		<link rel="shortcut icon" href="{{{ asset('assets/ico/favicon.png') }}}">
	</head>

	<body>
		<!-- To make sticky footer need to wrap in a div -->
		<div id="wrap">
		<!-- Navbar -->
		<div class="navbar">
			 <div class="container">
                <div class="navbar-header">
                <a class="navbar-brand visible-xs" href="#">Menu</a>
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav">
						<li {{ (Request::is('/') ? ' class="active"' : '') }}><a href="{{{ URL::to('') }}}">Home</a></li>
						<li {{ (Request::is('about/leenmeij') ? ' class="active"' : '') }}><a href="{{{ URL::to('about/leenmeij') }}}">{{{Lang::get('site.about')}}}</a></li>
						<li {{ (Request::is('contact/leenmeij') ? ' class="active"' : '') }}><a href="{{{ URL::to('contact/leenmeij') }}}">Contact</a></li>
					</ul>

                    <ul class="nav navbar-nav pull-right">
                        @if (Auth::check())
                        @if (Auth::user()->hasRole('admin'))
                        <li><a href="{{{ URL::to('admin') }}}">Admin Panel</a></li>
                        @endif
                        @if (Session::has('reserveringen') && !Auth::user()->hasRole('admin'))
                        <li><a href="{{{ URL::action('ReservationController@selectCar') }}}"> {{Lang::get('reservation.continue')}} </a></li>
                        @endif
                        @if (Auth::user()->hasRole('admin'))
                        <li><a href="#">{{{ Lang::get('site.logged_in') }}} {{{ Auth::user()->username }}}</a></li>
                        @else
                        <li><a href="{{{ URL::to('user') }}}">{{{ Lang::get('site.logged_in') }}} {{{ Auth::user()->username }}}</a></li>
                        @endif
                        <li><a href="{{{ URL::to('user/logout') }}}">{{{ Lang::get('site.logout') }}}</a></li>
                        @else
                        <li {{ (Request::is('user/login') ? ' class="active"' : '') }}><a href="{{{ URL::to('user/login') }}}">Login</a></li>
                        <li {{ (Request::is('user/register') ? ' class="active"' : '') }}><a href="{{{ URL::to('user/create') }}}">{{{ Lang::get('site.sign_up') }}}</a></li>
                        @endif
    					<li class="dropdown taal">
				        <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{{Lang::get('site.choose_language')}}} <b class="caret"></b></a>
				        <ul class="dropdown-menu">
				          <li>{{link_to_route('language.select', 'English', array('en'))}}</li>
    					  <li>{{link_to_route('language.select', 'Dutch', array('nl'))}}</li>
				        </ul>
				        </li>
                    </ul>
					<!-- ./ nav-collapse -->
				</div>
			</div>
		</div>
		<!-- ./ navbar -->
		<!-- Container -->
		<div class="container">
			<div class="innerpage">
				<!-- Notifications -->
				@include('notifications')
				<!-- ./ notifications -->

				<!-- Content -->
				@yield('content')
				<!-- ./ content -->
			</div>
		</div>
		<!-- ./ container -->

		<!-- sticky footer -->
		<div id="push"></div>
		</div>
		<!-- ./wrap -->


	    <div id="footer">
	      <div class="container">
	      	<div class="row">
	      		<div class="col-md-4">
	        	<p class="muted credit">&copy; Koekietrommel</p>
	        	</div>
	        	<div class="col-md-4"
	        		
	        	</div>
	        </div>
	        <a href="#" class="back-to-top">Back to Top &hearts;</a>
	      </div>
	    </div>

		<!-- Javascripts
		================================================== -->
        {{ Basset::show('public.js') }}
	</body>
</html>
