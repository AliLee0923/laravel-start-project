@extends('admin/layouts.default')

{{-- Web site Title --}}
@section('title')
Blog Management ::
@parent
@stop

{{-- Content --}}
@section('content')
<div class="page-header">
	<h3>
		Blog Management

		<div class="pull-right">
			<a href="{{{ URL::to('admin/blogs/create') }}}" class="btn btn-small btn-info iframe"><i class="icon-plus-sign icon-white"></i> Create</a>
		</div>
	</h3>
</div>

<table id="blogs" class="table table-bordered table-hover">
	<thead>
		<tr>
			<th class="span1">ID</th>
			<th class="span4">{{{ Lang::get('admin/blogs/table.title') }}}</th>
			<th class="span2">{{{ Lang::get('admin/blogs/table.created_at') }}}</th>
			<th class="span2">{{{ Lang::get('admin/blogs/table.comments') }}}</th>
			<th class="span2">{{{ Lang::get('table.actions') }}}</th>
		</tr>
	</thead>
	<tbody>

	</tbody>

</table>

@stop

{{-- Scripts --}}
@section('scripts')
<script type="text/javascript">
	$(document).ready(function() {
		$('#blogs').dataTable( {
			"sDom": "<'row'<'span6'l><'span6'f>r>t<'row'<'span6'i><'span6'p>>",
			"sPaginationType": "bootstrap",
			"oLanguage": {
				"sLengthMenu": "_MENU_ records per page"
			},
			"bProcessing": true,
	        "bServerSide": true,
	        "sAjaxSource": "/admin/blogs/data",
	        "fnDrawCallback": function ( oSettings ) {
           		$(".iframe").colorbox({iframe:true, width:"80%", height:"80%"});
     		}
		});
	});
</script>

@stop