@extends('site.layouts.default')

{{-- Web site Title --}}
@section('title')
{{{ Lang::get('user/user.settings') }}} ::
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
	<h3>My Reservations</h3>
</div>
    <table id="reservations" class="table table-striped table-hover">
        <thead>
            <tr>
                <th class="col-md-2">{{{ Lang::get('user/table.id') }}}</th>
                <th class="col-md-2">{{{ Lang::get('user/table.reservationdate') }}}</th>
                <th class="col-md-2">{{{ Lang::get('user/table.reservation_start_date') }}}</th>
                <th class="col-md-2">{{{ Lang::get('user/table.reservation_end_date') }}}</th>
                <th class="col-md-2">{{{ Lang::get('user/table.carid') }}}</th>
                <th class="col-md-2">{{{ Lang::get('user/table.brand') }}}</th>
                <th class="col-md-2">{{{ Lang::get('user/table.status') }}}</th>
                <th class="col-md-2">{{{ Lang::get('user/table.actions') }}}</th>
            </tr>
            @if(!empty($reservations))
                @foreach ($reservations as $reservation => $v)
                <tr>
                        <td>{{ $v->id }}</td>
                        <td>{{ $v->date }}</td>
                        <td>{{ $v->startdate }}</td>
                        <td>{{ $v->enddate }}</td>
                        <td>{{ $v->vehicle_id }}</td>
                        <td>{{ $v->brand . '  ' . $v->type }}</td>
                        <td>{{ $v->value }}</td>
                        <td></td>
                </tr>
                @endforeach
                @else
                <td>{{ 'geen reserveringen' }}<td>
            @endif
        </thead>
        <tbody>
        </tbody>
    </table>
@stop