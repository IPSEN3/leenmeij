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

@stop
