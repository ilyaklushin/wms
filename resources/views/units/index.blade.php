<!DOCTYPE html>
<html>
<head>
	<title>Look! I'm CRUDding</title>
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
</head>
<body>
<div class="container">

<nav class="navbar navbar-inverse">
	<div class="navbar-header">
		<a class="navbar-brand" href="{{ URL::to('units') }}">Unit Alert</a>
	</div>
	<ul class="nav navbar-nav">
		<li><a href="{{ URL::to('units') }}">View All Units</a></li>
		<li><a href="{{ URL::to('units/create') }}">Create a unit</a>
	</ul>
</nav>

<h1>All the Units</h1>

<!-- will be used to show any messages -->
@if (Session::has('message'))
	<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<td>ID</td>
			<td>Name</td>
			<td>UUID</td>
			<td>Actions</td>
		</tr>
	</thead>
	<tbody>
	@foreach($units as $key => $value)
		<tr>
			<td>{{ $value->id }}</td>
			<td>{{ $value->name }}</td>
			<td>{{ $value->uuid }}</td>
			
			<!-- we will also add show, edit, and delete buttons -->
			<td>

				<!-- delete the Unit (uses the destroy method DESTROY /Units/{id} -->
				<!-- we will add this later since its a little more complicated than the other two buttons -->

				{{ Form::open(array('url' => 'units/' . $value->id, 'class' => 'pull-right')) }}
                    {{ Form::hidden('_method', 'DELETE') }}
                    {{ Form::submit('Delete this unit', array('class' => 'btn btn-warning')) }}
                {{ Form::close() }}

				<!-- show the Unit (uses the show method found at GET /Units/{id} -->
				<a class="btn btn-small btn-success" href="{{ URL::to('units/' . $value->id) }}">Show this Unit</a>

				<!-- edit this Unit (uses the edit method found at GET /Units/{id}/edit -->
				<a class="btn btn-small btn-info" href="{{ URL::to('units/' . $value->id . '/edit') }}">Edit this Unit</a>

			</td>
		</tr>
	@endforeach
	</tbody>
</table>

</div>
</body>
</html>