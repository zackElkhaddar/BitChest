@extends('layouts.app')

@section('content')
<head>
    <title>Edit User</title>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
</head>
<body>
<div class="container">

<nav class="navbar navbar-inverse">
    <div class="navbar-header">
        <a class="navbar-brand" href="#">User Alert</a>
    </div>
    <ul class="nav navbar-nav">
        <li><a href="#">View All Users</a></li>
        <li><a href="#">Create a User</a>
    </ul>
</nav>

<h1>Edit {{ $user->name }}</h1>

<!-- if there are creation errors, they will show here -->


{{ Form::model($user, array('route' => array('profile.update', $user->id), 'method' => 'PUT')) }}

    <div class="form-group">
        {{ Form::label('name', 'Name') }}
        {{ Form::text('name', null, array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('email', 'Email') }}
        {{ Form::email('email', null, array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('is_status', 'Status user Level') }}
        {{ Form::select('is_status', array('0' => 'Client', '1' => 'Admin'), null, array('class' => 'form-control')) }}
    </div>

    {{ Form::submit('Edit the user!', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

</div>
</body>



@endsection