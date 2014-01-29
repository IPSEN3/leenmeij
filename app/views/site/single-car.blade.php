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
          <a href="{{ URL::previous() }}" class="btn btn-default">{{Lang::get('site.back')}}</a>
        </div>
        <div class="col-md-9">
          <div class="thumbnail">
<!--            <img src="http://placehold.it/820x320" alt="">-->
              {{ HTML::image('/assets/img/voertuigen/single-car.jpg', 'Voertuig') }}
            <div class="caption-full">

                <a href="{{ URL::to('vehicle'). "/" .$vehicle->id }}"><h4>{{ $vehicle->brand . " " . $vehicle->type}}</h4></a>
                <p>{{ $vehicle->description }}</p>
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
                      <a class="btn btn-success btn-green" href="#reviews-anchor" id="open-review-box">{{ Lang::get('site.leave_review') }}</a>
                      @else 
                      <p>{{ Lang::get('site.login_review') }}</p>
                    @endif

                  </div>
              
                  <div class="row" id="post-review-box" style="display:none;">
                      <div class="col-md-12">
                          <form accept-charset="UTF-8" action="" method="post">
                              <input id="ratings-hidden" name="rating" type="hidden"> 
                              <textarea class="form-control animated" cols="50" id="new-review" name="comment" placeholder="{{Lang::get('site.review_text')}}" rows="5"></textarea>
              
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
         
            {{ $review->user ? $review->user->username : 'Anonymous'}} <span class="pull-right">{{$review->timeago}}</span> 
         


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
</div>
@stop