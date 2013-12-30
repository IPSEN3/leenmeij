@extends('site.layouts.default')

{{-- Web site Title --}}
@section('title')
{{{ Lang::get('titles.homepage') }}} ::
@parent
@stop

{{-- New Laravel 4 Feature in use --}}
@section('styles')
@stop

{{-- Content --}}
@section('content')

<div class="jumbotron">
  	<div class="row">
	<div class="col-md-4">
		<div class="huren">
			<form class="form-horizontal" method="POST" action="{{ URL::to('reservation') }}" accept-charset="UTF-8">
			    <input type="hidden" name="_token" value="{{ csrf_token() }}">
			    <fieldset>
			    	<h4>{{ Lang::get('renting.pickup') }}</h4>
			        <div class="form-group">
			            <div class="col-md-6">
			            	<!-- {{ Form::text('pickupdate', $value=null, array('class' => 'form-control js__datepicker startdate', 'placeholder' => 'Datum', 'required' => 'required', 'name' => 'pickupdate')) }} -->
			            	<input type="text" class="form-control js__datepicker startdate {{ $err = $errors->first('pickupdate') ? 'err' : 'null' }}" placeholder="{{ Lang::get('site.date') }}" name="pickupdate" value="{{{ Input::old('pickupdate', '') }}}">
			            </div>
			        </div>
			        <h4>{{ Lang::get('renting.return') }}</h4>
			        <div class="form-group">
			        	<div class="col-md-6">
			        		<!-- {{ Form::text('returndate', $value=null, array('class' => 'form-control js__datepicker enddate', 'placeholder' => 'Datum', 'required' => 'required', 'name' => 'returndate')) }} -->
			        		<input type="text" class="form-control js__datepicker enddate {{ $err = $errors->first('returndate') ? 'err' : 'null' }}" placeholder="{{ Lang::get('site.date') }}" name="returndate" value="{{{ Input::old('returndate', '') }}}">
			            </div>
			        </div>

			        @if ( Session::get('error') )
			        <div class="alert alert-danger">{{ Session::get('error') }}</div>
			        @endif

			        @if ( Session::get('notice') )
			        <div class="alert">{{ Session::get('notice') }}</div>
			        @endif

			        <div class="form-group">
			            <div class="col-md-10">
			                <button tabindex="3" type="submit" class="btn btn-default zoek">{{ Lang::get('renting.pickcar') }}</button>
			            </div>
			        </div>
			    </fieldset>
			</form>
		</div>
	</div>
	<div class="col-md-8">
		<h2>Reserveer direct!</h2>
		<p class="help-block">{{ Lang::get('renting.startdateinfo') }}!!</p>
		<div class="arrowleft">
			<img class="img-responsive" src="">
			{{ HTML::image('/assets/img/bluearrow.png') }}
		</div>
	</div>
	<div class="col-md-4">
		<input type="button" value="{{ Lang::get('site.explain') }}" class="btn btn-custom btn-small uitleg">
	</div>
</div>
</div>

<!-- Slider -->
<div id="da-slider" class="da-slider">
	<div class="da-slide">
		<h2>Warm welcome</h2>
		<p>Wanneer u langs komt om uw reservering op te halen, kunt u onder het genot van een lekker kopje koffie wachten.</p>
		<!-- <div class="da-img">{{ HTML::image('/assets/img/slider/1.png') }}</div> -->
	</div>
	<div class="da-slide">
		<h2>Easy management</h2>
		<p>Wanneer u bij LeenMeij een auto huurt kunt u zelf gemakkelijk bijna al uw zaken regelen. Het enige wat nog overblijft is de auto ophalen!</p>
		<!-- <div class="da-img">{{ HTML::image('/assets/img/slider/2.png') }}</div> -->
	</div>
<!-- 	<div class="da-slide">
		<h2>Revolution</h2>
		<p>A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.</p>
		<div class="da-img">{{ HTML::image('/assets/img/slider/3.png') }}</div>
	</div>
	<div class="da-slide">
		<h2>Quality Control</h2>
		<p>Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World of Grammar.</p>
		<div class="da-img">{{ HTML::image('/assets/img/slider/4.png') }}</div>
	</div> -->
	<nav class="da-arrows">
		<span class="da-arrows-prev"></span>
		<span class="da-arrows-next"></span>
	</nav>
</div>

<section id="quotes">
   <article class="boxed">
       <ul id="quote" class="nolist textcenter aligncenter">
           <li class="animated flipInX">
               <div class="quote"><p>Leenmeij heeft een prima service geleverd en ik kom graag nog eens terug!</p></div>
               <div class="person">Reshad Farid</div>
           </li>
           <li class="animated flipInX">
               <div class="quote"><p>Snel, Uitstekend maar vooral klantvriendelijk.</p></div>
               <div class="person">David Fernandez</div>
           </li>
           <li class="animated flipInX">
               <div class="quote"><p>Uitermate behulpzaam en beschikken ook nog eens over de nieuwste auto's!</p></div>
               <div class="person">Reinier Koops</div>
           </li>
           <li class="animated flipInX">
               <div class="quote"><p>Prachtige website!</p></div>
               <div class="person">Deniz Erden</div>
           </li>
       </ul>
   </article>
</section>
@stop