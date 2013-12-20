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

    <div class="col-md-12">
        <ul class="cbp_tmtimeline">
            <li>
                <time class="cbp_tmtime" datetime="2013-04-10 18:30"><span>1/1/12</span> <span>10:30</span></time>
                <div class="cbp_tmicon cbp_tmicon-phone"></div>
                <div class="cbp_tmlabel">
                    <h2>Oprichting LeenMeij</h2>
                    <p>Ons bedrijf is van de grond...</p>
                </div>
            </li>
            <li>
                <time class="cbp_tmtime" datetime="2013-04-11T12:04"><span>15/1/14</span> <span>12:04</span></time>
                <div class="cbp_tmicon cbp_tmicon-screen"></div>
                <div class="cbp_tmlabel">
                    <h2>Website gelanceerd!</h2>
                    <p>Vandaag hebben we met trots onze nieuwe website gelanceerd!</p>
                </div>
            </li>
        </ul>
    </div>

</div>

@stop