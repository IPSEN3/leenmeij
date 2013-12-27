@extends('site.layouts.default')

{{-- Web site Title --}}
@section('title')
{{{ Lang::get('user/user.dashboard') }}} ::
@parent
@stop

{{-- New Laravel 4 Feature in use --}}
@section('styles')
@parent
body {
	background: #f2f2f2;
}
@stop

{{-- Content --}}
@section('content')
<div class="page-header">
	<h3>Customer Dashboard</h3>
</div>
<ul class="flex-container">
  <li class="flex-item"><a href="{{{ URL::to('user/settings') }}}"><img src="assets/img/icons/Gear.png"></a></li>
  <li class="flex-item"><a href="{{{ URL::to('user/reservations') }}}"><img src="assets/img/icons/iCal.png"></a></li>
  <li class="flex-item"><a href="{{{ URL::to('user/reviews') }}}"><img src="assets/img/icons/Emoticon.png"></a></li>
</ul>
@stop
