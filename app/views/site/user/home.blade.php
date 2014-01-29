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
		<h2>{{ Lang::get('renting.reservate_now') }}</h2>
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
		<h2>{{ Lang::get('site.renting') }}</h2>
		<p>{{ Lang::get('site.renting_text') }}.</p>
		<div class="da-img">{{ HTML::image('/assets/img/slider/logomeij.png') }}</div>
	</div>
	<div class="da-slide">
		<h2>{{ Lang::get('site.management') }}</h2>
		<p>{{ Lang::get('site.management_text') }}</p>
        <div class="da-img">{{ HTML::image('/assets/img/slider/logomeij.png') }}</div>
	</div>
	<nav class="da-arrows">
		<span class="da-arrows-prev"></span>
		<span class="da-arrows-next"></span>
	</nav>
</div>

<section id="quotes">
   <article class="boxed">
       <ul id="quote" class="nolist textcenter aligncenter">
       	@foreach($reviews as $review)
       		@if($review->approved)
           <li class="animated flipInX">
               <div class="quote"><p>{{$review->user->username}}</p></div>
               <div class="person">{{$review->comment}}</div>
           </li>
           @endif
        @endforeach
       </ul>
   </article>
</section>
@stop