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

<div class="container">
    <div class="row">
        @foreach($vehicles as $vehicle)
        <div class="col-md-4">
            <div class="thumbnail">
<!--                <img src="http://placehold.it/820x320" alt="">-->
                {{ HTML::image('/assets/img/voertuigen/single-car.jpg', 'Voertuig') }}
                <div class="caption-full">
                    <h4 class="pull-right">Daily rent &euro; {{ $vehicle->hourly_rent }}</h4>
                    <a href="{{ URL::to('vehicle'). "/" .$vehicle->id }}"><h4>{{ $vehicle->brand . " " . $vehicle->type}}</h4></a>
                    <p>{{ $vehicle->description }}</p>
                </div>
                <div class="ratings">
                    <p class="pull-right ratings">{{{ $vehicle->rating_count or '0' }}} reviews</p>
                    <p>
                        @for ($i=1; $i <= 5 ; $i++)
                        <span class="stars glyphicon glyphicon-star{{ ($i <= $vehicle->rating_cache) ? '' : '-empty'}}"></span>
                        @endfor
                    </p>
                </div>
            </div>
        </div>
        @endforeach

    </div>


    @if ( Session::get('error') )
    <div class="alert alert-danger">{{ Session::get('error') }}</div>
    @endif

    @if ( Session::get('notice') )
    <div class="alert">{{ Session::get('notice') }}</div>
    @endif
</div>
@stop