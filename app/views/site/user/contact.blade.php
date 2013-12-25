@extends('site.layouts.default')

{{-- Web site Title --}}
@section('title')
{{{ Lang::get('titles.contact') }}} ::
@parent
@stop

{{-- New Laravel 4 Feature in use --}}
@section('styles')
@stop

{{-- Content --}}
@section('content')


<div class="row">

	<div class="col-md-12">
		<div id="googleMap"></div>
	</div>

    <div class="col-md-6">
    	<h4>Contact gegevens</h4>
        <address>
		  <strong>Leenmeij Autoverhuur BV</strong><br>
		  Zijldijk 130, 2352 AB<br>
		  Leiderdorp<br>
		  <abbr title="Phone">P:</abbr> 071-7503299<br>
		  info@leenmeij.com<br>
		  KvK: 987654321

		</address>
			<div class="contact">
	    		<h4>Openingstijden</h4>
	    		<ul>
	    			<li>Monday-Friday: 10am to 8pm</li>
	    			<li>Saturday: 11am to 3pm</li>
	    			<li>Sunday: Closed</li>
	    		</ul>
	    	</div>
    	</div>
    </div>

    <div class="col-md-6">
    	<div class="car1"><img src="../assets/img/bg/car.png"></div>
    </div>
</div>

@stop