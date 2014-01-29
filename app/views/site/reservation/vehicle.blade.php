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
	<div class="panel-heading" id="dates">
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

<a class="btn btn-success pull-right" href="{{{ URL::to('reservation/payment') }}}">{{{ Lang::get('site.payment') }}}</a>
<div class="row">
	<div class="col-md-12" id="vehicles"><h2>{{{ Lang::get('renting.choose_car') }}}</h2></div>

              <div class="row">
              @foreach ( $vehicles as $vehicle)

              {{ Form::open(array('url' => 'reservation/car/select')) }}
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <input type="hidden" name="id" value="{{ $vehicle->id }}">
                <div class="col-md-4" class="cars">
                    <div class="well well-sm  {{ isset($gegevens['car']) && $gegevens['car'] == $vehicle->id ? 'selectedCar' : null }} ">
                      <a href="{{ URL::to('vehicle'). "/" .$vehicle->id }}"><h4>{{ $vehicle->brand . " " . $vehicle->type}}</h4></a>
                        {{ HTML::image('/assets/img/voertuigen/single-car.jpg', 'Voertuig', array('class' => 'img-responsive')) }}
                          <div class="input-group input-group-md">
                              <p>{{Lang::get('site.description')}}: {{ $vehicle->description }}</p>
                              <p>Airco {{ $vehicle->airco == 1 ? 'ja' : 'nee' }}</p>
                              <p>{{Lang::get('site.seats')}} {{ $vehicle->seats }}</p>
                          </div>
                          <div class="input-group input-group-sm">
                            <ul class="nav nav-tabs" id="myTab">
                              <li class="active"><a href="#inc{{ $vehicle->id }}" data-toggle="tab">Inc. {{Lang::get('site.btw')}}</a></li>
                              <li><a href="#exc{{$vehicle->id}}" data-toggle="tab">Exc. {{Lang::get('site.btw')}}</a></li>
                            </ul>
                            <div class="tab-content">
                              <div class="tab-pane fade in active" id="inc{{$vehicle->id}}">&euro; {{ $vehicle->hourly_rent }}</div>
                              <div class="tab-pane fade" id="exc{{$vehicle->id}}">&euro; {{ sprintf("%01.2f", $vehicle->hourly_rent = $vehicle->hourly_rent - $vehicle->hourly_rent/121 * 21) }}</div>
                            </div>
                          </div>
                            <hr>
                            <div class="row">
                              <div class="col-md-12">

                              
                              @for ($i=1; $i <= 5 ; $i++)
                                <span class="stars glyphicon glyphicon-star{{ ($i <= $vehicle->rating_cache) ? '' : '-empty'}}"></span>
                              @endfor

                              <p class="pull-right ratings">{{{ $vehicle->rating_count or '0' }}} reviews</p>
                              
                              </div>
                              <div class="col-md-12">
                                <span onClick="submit();" class="btn btn-default pull-right">{{ Lang::get('site.choose_car') }}</span>
                              </div>
                            </div>
                          
                        </div>
                </div>
                {{ Form::close() }}
                
              @endforeach
              </div>
              <a class="btn btn-success pull-right" href="{{{ URL::to('reservation/payment') }}}">{{{ Lang::get('site.payment') }}}</a>


              @if ( Session::get('error') )
              <div class="alert alert-danger">{{ Session::get('error') }}</div>
              @endif

              @if ( Session::get('notice') )
              <div class="alert">{{ Session::get('notice') }}</div>
              @endif

</div>
@stop