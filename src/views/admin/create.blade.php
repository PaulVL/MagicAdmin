{{--*/
use PaulVL\MagicAdmin\MagicAdmin;

	$column_fields = $model['model_name']::getColumnFields();
	$columns_names = $model['model_name']::getDisplayColumnFields();
	$columns_properties = $model['model_name']::getColumnProperties();
	$columns_references = $model['model_name']::getColumnReferences();
	$all = $model['model_name']::all();

/*--}}
@extends('magicadmin::layouts.admin-base')

@section('title')
	Create new {{$model['friendly_name']}}
@stop

@section('main-content')
	<div class="row">
		<div class="col-md-6">
			<form action="{{ route('magic.store', $model['model_name']) }}" method="get">
				@foreach ($column_fields as $element)					
					<div class="form-group">
						<label>{{$element}}</label>
						<input class="form-control" name="{{$element}}">
					</div>
				@endforeach
				<a href="{{ route('magic.all', $model['model_name']) }}" class="btn btn-default btn-lg">Back</a>
				<input type="submit" name="" value="Create" class="btn  btn-success btn-lg">
			</form>
		</div>
	</div>
@stop