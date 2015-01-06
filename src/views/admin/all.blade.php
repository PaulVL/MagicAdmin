{{--*/
use PaulVL\MagicAdmin\MagicAdmin;

	$display_columns = $model['model_name']::getDisplayColumnNames();
	$columns_names = $model['model_name']::getDisplayColumnFields();
	$columns_properties = $model['model_name']::getColumnProperties();
	$columns_references = $model['model_name']::getColumnReferences();
	$all = $model['model_name']::all();

/*--}}
@extends('magicadmin::layouts.admin-base')

@section('title')
	{{$model['friendly_name']}}
@stop

@section('main-content')
	<a href="" class="btn btn-success btn-xl">Create new</a>
	<table class="table table-striped table-bordered table-hover" id="datatable">
	    <thead>
	        <tr>
	        	@foreach ($display_columns as $column)
	            	<th>{{$column}}</th>
	        	@endforeach
	        	<th>Actions</th>
	        </tr>
	    </thead>
	    <tbody>
	        @foreach ($all as $element)
			    <tr>
		        	@foreach ($columns_names as $column)
		        		{{--*/
							$column_property = $columns_properties[$column];
							$column_reference = $columns_references[$column];
							$datatype = $column_property['data_type'];
							if(!is_null($column_reference))
							{
								$referenced_model = MagicAdmin::getMagicModelByTableName($column_reference['table_name']);
								$e = $referenced_model::find($element->$column)->name;
							}
							else{
								if($datatype == 'timestamp')
								{
									$e = (new Carbon($element->$column))->format(MagicAdmin::$date_format);
								}
								else{
									$e = $element->$column;
								}
							}
		        		/*--}}
				        <td>{{$e}}</td>
		        	@endforeach
		        	<td>
		        		<a href="" class="btn btn-info btn-xs">Edit</a>
		        		<a href="" class="btn btn-danger btn-xs">Delete</a>
		        	</td>
			    </tr>
	        @endforeach
	    </tbody>
	</table>
@stop