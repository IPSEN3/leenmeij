@extends('site.layouts.default')

{{-- Web site Title --}}
@section('title')
{{{ Lang::get('titles.reservation') }}} ::
@parent
@stop

{{-- New Laravel 4 Feature in use --}}
@section('styles')
@stop

{{-- Content --}}
@section('content')

<h1>{{{ Lang::get('renting.overview') }}}</h1>

<div class="panel panel-default">
	<div class="panel-heading">
    	<h3 class="panel-title">{{{ Lang::get('renting.date') }}}</h3>
    </div>
  <div class="panel-body">
        {{ Lang::get('renting.pickup') }}
        <p>{{{ $gegevens['pickupdate'] }}}</p>
    	{{ Lang::get('renting.return') }}
    	<p>{{{ $gegevens['returndate'] }}}</p>
    	<p>Aantal dagen: {{ $totaal }} </p>
      <a class="btn btn-primary" href="{{{ URL::action('ReservationController@selectCar') . '#dates' }}}">{{Lang::get('reservation.edit')}}</a>
  </div>
</div>

<div class="panel panel-default">
	<div class="panel-heading">
    	<h3 class="panel-title">{{{ Lang::get('renting.car') }}}</h3>
    </div>
  <div class="panel-body">
        @foreach ($vehicles as $vehicle)
        	{{ '<p>' . $vehicle->brand . " " . $vehicle->type . '</p>' }}
        @endforeach
        <p>Kosten totaal: &euro;{{ $totaal * $vehicle->hourly_rent }}</p>
        <p>ex. BTW: {{ $totaal * (int)$vehicle->hourly_rent -= $vehicle->hourly_rent/121 * 21 }}</p>
        <a class="btn btn-primary" href="{{{ URL::action('ReservationController@selectCar') . '#vehicles' }}}">{{Lang::get('reservation.edit')}}</a>
  </div>
</div>

<div class="row">
	<div class="col-md-12"><h2>{{{ Lang::get('renting.payment') }}}</h2></div>

  

        <div class="col-md-12">
        	  @if (! Auth::check())
              <p>{{ Lang::get('renting.login') }}.</p>
              <a class="btn btn-default" href="{{{ URL::to('user/login') }}}">Login</a>
              @else
              <a class="btn btn-default" href="{{{ URL::to('reservation/confirm') }}}">{{{ Lang::get('site.confirm') }}}</a>
            @endif
        </div>


              @if ( Session::get('error') )
              <div class="alert alert-danger">{{ Session::get('error') }}</div>
              @endif

              @if ( Session::get('notice') )
              <div class="alert">{{ Session::get('notice') }}</div>
              @endif

</div>
@stop