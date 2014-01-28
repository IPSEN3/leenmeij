@extends('admin.layouts.default')

{{-- Web site Title --}}
@section('title')
	{{{ $title }}} :: @parent
@stop

{{-- Content --}}
@section('content')
	<div class="page-header">
		<h3>
			{{{ $title }}}
		</h3>
	</div>

	<table id="reviews" class="table table-striped table-hover">
		<thead>
			<tr>
				<th class="col-md-1">{{{ Lang::get('admin/reviews/table.review_id') }}}</th>
				<th class="col-md-2">{{{ Lang::get('admin/reviews/table.vehicle_brand') }}}</th>
				<th class="col-md-2">{{{ Lang::get('admin/reviews/table.vehicle_type') }}}</th>
				<th class="col-md-2">{{{ Lang::get('admin/reviews/table.customer') }}}</th>
				<th class="col-md-2">{{{ Lang::get('admin/reviews/table.created_at') }}}</th>
				<th class="col-md-1">{{{ Lang::get('admin/reviews/table.visible') }}}</th>
				<th class="col-md-2">{{{ Lang::get('table.actions') }}}</th>
			</tr>
		</thead>
	</table>
@stop

{{-- Scripts --}}
@section('scripts')
	<script type="text/javascript">
		var oTable;
		$(document).ready(function() {
			oTable = $('#reviews').dataTable( {
				"sDom": "<'row'<'col-md-6'l><'col-md-6'f>r>t<'row'<'col-md-6'i><'col-md-6'p>>",
				"sPaginationType": "bootstrap",
				"oLanguage": {
					"sLengthMenu": "_MENU_ records per page"
				},
				"bProcessing": true,
		        "bServerSide": true,
		        "sAjaxSource": "{{ URL::to('admin/reviews/data') }}",
		        "fnDrawCallback": function ( oSettings ) {
	           		$(".iframe").colorbox({iframe:true, width:"80%", height:"80%"});
	     		}
			});
		});
	</script>
@stop