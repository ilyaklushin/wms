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
        <li><a href="{{ URL::to('units/create') }}">Create a Unit</a>
    </ul>
</nav>

<h1>Edit {{ $unit->name }}</h1>

<!-- if there are creation errors, they will show here -->
{{ Html::ul($errors->all()) }}

{{ Form::model($unit, array('route' => array('units.update', $unit->id), 'method' => 'PUT')) }}

    <div class="form-group">
        {{ Form::label('name', 'Name') }}
        {{ Form::text('name', null, array('class' => 'form-control')) }}
    </div>

    {{ Form::submit('Edit the Unit!', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

</div>
</body>
</html>