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
			        	<div class="col-md-10"><p class="help-block">{{ Lang::get('renting.startdateinfo') }}</p></div>
			            <div class="col-md-6">
			            	{{ Form::text('pickupdate', $value=null, array('class' => 'form-control js__datepicker', 'placeholder' => 'Datum', 'required' => 'required', 'name' => 'pickupdate')) }}
                 			<p>{{ $errors->first('pickupdate') }}</p>
			            </div>
			            <div class="col-md-4">
			                {{ Form::text('pickuptime', $value=null, array('class' => 'form-control js__timepicker', 'placeholder' => 'Tijd', 'required' => 'required', 'name' => 'pickuptime')) }}
			                <p>{{ $errors->first('pickuptime') }}</p>
			            </div>
			        </div>
			        <h4>{{ Lang::get('renting.return') }}</h4>
			        <div class="form-group">
			        	<div class="col-md-6">
			        		{{ Form::text('returndate', $value=null, array('class' => 'form-control js__datepicker', 'placeholder' => 'Datum', 'required' => 'required', 'name' => 'returndate')) }}
			                <p>{{ $errors->first('returndate') }}</p>
			            </div>
			            <div class="col-md-4">
			                {{ Form::text('returntime', $value=null, array('class' => 'form-control js__timepicker', 'placeholder' => 'Tijd', 'required' => 'required', 'name' => 'returntime')) }}
			                <p>{{ $errors->first('returntime') }}</p>
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
			                <button tabindex="3" type="submit" class="btn btn-default">{{ Lang::get('renting.pickcar') }}</button>
			            </div>
			        </div>
			    </fieldset>
			</form>
		</div>
	</div>
</div>
@stop