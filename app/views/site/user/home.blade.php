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

<div class="row">
	<div class="col-md-4">
		<div class="huren">
			<form class="form-horizontal" method="POST" action="{{ URL::to('reservation') }}" accept-charset="UTF-8">
			    <input type="hidden" name="_token" value="{{ csrf_token() }}">
			    <fieldset>
			    	<h4>{{ Lang::get('renting.pickup') }}</h4>
			        <div class="form-group">
			            <div class="col-md-6">
			                <input type="date" class="form-control js__datepicker" required = "required" placeholder="Datum" name="pickupdate">
                 			<p class="help-block">{{ Lang::get('renting.startdateinfo') }}</p>
			            </div>
			            <div class="col-md-4">
			                <input type="time" class="form-control js__timepicker" required = "required" placeholder="Tijd" name="pickuptime">
			            </div>
			        </div>
			        <h4>{{ Lang::get('renting.return') }}</h4>
			        <div class="form-group">
			        	<div class="col-md-6">
			                <input type="date" class="form-control js__datepicker" required = "required" placeholder="Datum" name="returndate">
			            </div>
			            <div class="col-md-4">
			                <input type="time" class="form-control js__timepicker" required = "required" placeholder="Tijd" name="returntime">
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
			                <button tabindex="3" type="submit" class="btn btn-primary">{{ Lang::get('renting.pickcar') }}</button>
			            </div>
			        </div>
			    </fieldset>
			</form>
		</div>
	</div>
</div>
@stop