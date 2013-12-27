@extends('site.layouts.default')

{{-- Web site Title --}}
@section('title')
{{{ Lang::get('user/user.register') }}} ::
@parent
@stop

{{-- Content --}}
@section('content')
<div class="page-header">
	<h1>{{{Lang::get('site.sign_up')}}}</h1>
</div>


  	{{ Confide::makeSignupForm()->render() }}


<!-- <ul class="nav nav-tabs">
  <li><a href="#particulier" data-toggle="tab">{{ Lang::get('site.particulier') }}</a></li>
  <li><a href="#zakelijk" data-toggle="tab">{{ Lang::get('site.zakelijk') }}</a></li>
</ul>

<div class="tab-content">
  <div class="tab-pane fade in active" id="particulier">
  	{{ Confide::makeSignupForm()->render() }}
  </div>
  <div class="tab-pane fade in" id="zakelijk">
  	nothing to see here mate
  </div>
</div> -->
@stop
