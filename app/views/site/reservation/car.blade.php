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
      <form class="form-horizontal" method="POST" action="{{ URL::to('reservation/edit') }}" accept-charset="UTF-8">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <fieldset>
            <h4>{{ Lang::get('renting.pickup') }}</h4>
              <div class="form-group">
                  <div class="col-md-6">
                    {{ Form::text('pickupdate',  $datum['pickupdate'], array('class' => 'form-control js__datepicker', 'placeholder' => 'Datum', 'required' => 'required', 'name' => 'pickupdate')) }}
                      <p>{{ $errors->first('pickupdate') }}</p>
                  </div>
                  <div class="col-md-4">
                      {{ Form::text('pickuptime', $datum['pickuptime'], array('class' => 'form-control js__timepicker', 'placeholder' => 'Tijd', 'required' => 'required', 'name' => 'pickuptime')) }}
                      <p>{{ $errors->first('pickuptime') }}</p>
                  </div>
              </div>
              <h4>{{ Lang::get('renting.return') }}</h4>
              <div class="form-group">
                <div class="col-md-6">
                  {{ Form::text('returndate', $datum['returndate'], array('class' => 'form-control js__datepicker', 'placeholder' => 'Datum', 'required' => 'required', 'name' => 'returndate')) }}
                      <p>{{ $errors->first('returndate') }}</p>
                  </div>
                  <div class="col-md-4">
                      {{ Form::text('returntime', $datum['returntime'], array('class' => 'form-control js__timepicker', 'placeholder' => 'Tijd', 'required' => 'required', 'name' => 'returntime')) }}
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
                  <div class="col-md-3">
                      <button tabindex="3" type="submit" class="btn btn-primary">{{ Lang::get('renting.edit') }}</button>
                  </div>
              </div>
          </fieldset>
      </form>
  </div>
</div>

<div class="row">
	<div class="col-md-12"><h2>{{{ Lang::get('reservation.choose_car') }}}</h2></div>

    {{ Form::open(array('url' => 'reservation')) }}
    <input type="hidden" name="_token" value="{{ csrf_token() }}">

              {{ '<pre>' }}
              {{ $vehicles }}

              <!-- <div class="form-group">
                  <div class="col-md-3">
                    <h4>Auto</h4>
                    {{ Form::radio('car', 'car1') }}
                  </div>
              </div> -->

              @if ( Session::get('error') )
              <div class="alert alert-danger">{{ Session::get('error') }}</div>
              @endif

              @if ( Session::get('notice') )
              <div class="alert">{{ Session::get('notice') }}</div>
              @endif
      </form>

</div>
@stop