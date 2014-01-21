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
      <div class="col-md-3">
          <a href="{{{ URL::action('ReservationController@selectCar')}}}" class="btn btn-default">{{Lang::get('site.back')}}</a>
        </div>
        <div class="col-md-9">
          <div class="thumbnail">
            <img src="http://placehold.it/820x320" alt="">
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
      <div class="container">
        <div class="row" style="margin-top:40px;">
          <div class="col-md-9 pull-right">
            <div class="well well-sm">
                  <div class="text-right">
                    @if (Auth::check())
                      <a class="btn btn-success btn-green" href="#reviews-anchor" id="open-review-box">Leave a Review</a>
                      @else 
                      <p>{{ Lang::get('site.login_review') }}</p>
                    @endif

                  </div>
              
                  <div class="row" id="post-review-box" style="display:none;">
                      <div class="col-md-12">
                          <form accept-charset="UTF-8" action="" method="post">
                              <input id="ratings-hidden" name="rating" type="hidden"> 
                              <textarea class="form-control animated" cols="50" id="new-review" name="comment" placeholder="Enter your review here..." rows="5"></textarea>
              
                              <div class="text-right">
                                  <div class="stars starrr" data-rating="0"></div>
                                  <a class="btn btn-danger btn-sm" href="#" id="close-review-box" style="display:none; margin-right: 10px;">
                                  <span class="glyphicon glyphicon-remove"></span>Cancel</a>
                                  <button class="btn btn-success btn-lg" type="submit">Save</button>
                              </div>
                          </form>
                      </div>
                  </div>
              </div> 
               
          </div>
        </div>
      </div>
      @foreach($reviews as $review)
          <hr>
          <div class="row">
            <div class="col-md-12">
            @for ($i=1; $i <= 5 ; $i++)
              <span class="glyphicon glyphicon-star{{ ($i <= $review->rating) ? '' : '-empty'}}"></span>
            @endfor
         
            {{ $review->user ? $review->user->name : 'Anonymous'}} <span class="pull-right">{{$review->timeago}}</span> 
         
            <p>{{{$review->comment}}}</p>
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

@stop