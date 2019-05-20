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
		<a class="navbar-brand" href="{{ URL::to('products') }}">Product Alert</a>
	</div>
	<ul class="nav navbar-nav">
		<li><a href="{{ URL::to('products') }}">View All Products</a></li>
		<li><a href="{{ URL::to('products/create') }}">Create a product</a>
	</ul>
</nav>

<h1>All the Products</h1>

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
	@foreach($products as $key => $value)
		<tr>
			<td>{{ $value->id }}</td>
			<td>{{ $value->name }}</td>
			<td>{{ $value->uuid }}</td>
			
			<!-- we will also add show, edit, and delete buttons -->
			<td>

				<!-- delete the Product (uses the destroy method DESTROY /Products/{id} -->
				<!-- we will add this later since its a little more complicated than the other two buttons -->

				{{ Form::open(array('url' => 'units/' . $value->id, 'class' => 'pull-right')) }}
                    {{ Form::hidden('_method', 'DELETE') }}
                    {{ Form::submit('Delete this unit', array('class' => 'btn btn-warning')) }}
                {{ Form::close() }}
                
				<!-- show the Product (uses the show method found at GET /Products/{id} -->
				<a class="btn btn-small btn-success" href="{{ URL::to('products/' . $value->id) }}">Show this Product</a>

				<!-- edit this Product (uses the edit method found at GET /Products/{id}/edit -->
				<a class="btn btn-small btn-info" href="{{ URL::to('products/' . $value->id . '/edit') }}">Edit this Product</a>

			</td>
		</tr>
	@endforeach
	</tbody>
</table>

</div>
</body>
</html>