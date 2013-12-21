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
    	<h3 class="panel-title">{{{ Lang::get('renting.date') }}}</h3>
    </div>
  <div class="panel-body">
      <form class="form-horizontal" method="POST" action="{{ URL::to('reservation/edit') }}" accept-charset="UTF-8">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <fieldset>
            <h4>{{ Lang::get('renting.pickup') }}</h4>
              <div class="form-group">
                  <div class="col-md-6">
                    {{ Form::text('pickupdate',  $gegevens['pickupdate'], array('class' => 'form-control js__datepicker', 'placeholder' => 'Datum', 'required' => 'required', 'name' => 'pickupdate')) }}
                      <p>{{ $errors->first('pickupdate') }}</p>
                  </div>
              </div>
              <h4>{{ Lang::get('renting.return') }}</h4>
              <div class="form-group">
                <div class="col-md-6">
                  {{ Form::text('returndate', $gegevens['returndate'], array('class' => 'form-control js__datepicker', 'placeholder' => 'Datum', 'required' => 'required', 'name' => 'returndate')) }}
                      <p>{{ $errors->first('returndate') }}</p>
                  </div>
              </div>

              @if ( Session::get('error') )
              <div class="alert alert-danger">{{ Session::get('error') }}</div>
              @endif

              @if ( Session::get('notice') )
              <div class="alert">{{ Session::get('notice') }}</div>
              @endif

              <div class="form-group">
                  <div class="col-md-3">
                      <button tabindex="3" type="submit" class="btn btn-primary">{{ Lang::get('renting.edit') }}</button>
                  </div>
              </div>
          </fieldset>
      </form>
  </div>
</div>

<div class="row">
	<div class="col-md-12"><h2>{{{ Lang::get('renting.choose_car') }}}</h2></div>

    
              <div class="row">
              @foreach ( $vehicles as $vehicle )
              {{ Form::open(array('url' => 'reservation/car/select')) }}
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <input type="hidden" name="id" value="{{ $vehicle->id }}">
                <div class="col-md-4" onClick="submit();" class="cars"> 
                    <div class="well well-sm  {{ isset($gegevens['car']) && $gegevens['car'] == $vehicle->id ? 'selectedCar' : null }} ">
                      <h4>{{ $vehicle->brand . " " . $vehicle->type}}</h4>
                          <div class="input-group input-group-md">
                              <p>Beschrijving: {{ $vehicle->description }}</p>
                              <p>Airco {{ $vehicle->airco == 1 ? 'ja' : 'nee' }}</p>
                              <p>Zitplaatsen {{ $vehicle->seats }}</p>
                          </div>
                          <div class="input-group input-group-sm">
                              <span class="input-group-addon">&euro;</span>
                              <input type="text" class="form-control" value="{{ $vehicle->hourly_rent }}" disabled>
                          </div>
                          <!-- <div class="input-group input-group-md">
                             <button tabindex="3" type="submit" class="btn btn-default">{{ Lang::get('renting.choose') }}</button>
                          </div> -->
                        </div>
                </div>
                {{ Form::close() }}
              @endforeach
              </div>
              <a class="btn btn-default" href="{{{ URL::to('reservation/payment') }}}">{{{ Lang::get('site.payment') }}}</a>


              @if ( Session::get('error') )
              <div class="alert alert-danger">{{ Session::get('error') }}</div>
              @endif

              @if ( Session::get('notice') )
              <div class="alert">{{ Session::get('notice') }}</div>
              @endif

</div>
@stop