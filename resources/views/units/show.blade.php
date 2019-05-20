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

<h1>Showing {{ $unit->name }}</h1>

    <div class="jumbotron text-center">
        <h2>{{ $unit->name }}</h2>
        <p>
            <strong>UUID:</strong> {{ $unit->uuid }}<br>
        </p>
    </div>

</div>
</body>
</html>