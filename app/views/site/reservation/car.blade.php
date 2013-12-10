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

<div class="panel panel-default">
	<div class="panel-heading">
    	<h3 class="panel-title">{{{ Lang::get('reservation.date') }}}</h3>
    </div>
  <div class="panel-body">
    <p>{{{ Lang::get('reservation.pickupon') }}}: {{ $datum['pickupdate'] }} {{{ Lang::get('reservation.at') }}} {{ $datum['pickuptime'] }}</p> 
    <p>{{{ Lang::get('reservation.returnat') }}}: {{ $datum['returndate'] }} {{{ Lang::get('reservation.at') }}} {{ $datum['returntime'] }}</p> 
    <a href="{{{ URL::to('/') }}}">{{{ Lang::get('reservation.edit') }}}</a>
  </div>
</div>

<div class="row">
	<div class="col-md-12"><h2>{{{ Lang::get('reservation.choose_car') }}}</h2></div>
	<div class="col-md-3">Car 1</div>
	<div class="col-md-3">Car 2</div>
	<div class="col-md-3">Car 3</div>
</div>
@stop