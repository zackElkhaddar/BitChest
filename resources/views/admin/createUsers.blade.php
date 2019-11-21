@extends('layouts.app')

@section('content')

<head>
    <title>Create Users Form</title>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
</head>
<body>
<div class="container">

<nav class="navbar navbar-inverse">
    <div class="navbar-header">
        <a class="navbar-brand" href="#">User Alert</a>
    </div>
    <ul class="nav navbar-nav">
        <li><a href="{{ URL::to('homeAdmin') }}">View All Users</a></li>
        <li><a href="{{ URL::to('homeAdmin/create') }}">Create a User</a>
    </ul>
</nav>

<h1>Create a user</h1>

<!-- if there are creation errors, they will show here -->


{{ Form::open(array('url' => 'userManage')) }}

    <div class="form-group">
        {{ Form::label('name', 'Name') }}
        {{ Form::text('name', Input::old('name'), array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('email', 'Email') }}
        {{ Form::email('email', Input::old('email'), array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('is_admin', 'User Level') }}
        {{ Form::select('is_admin', array('0' => 'Client', '1' => 'Admin'), Input::old('is_admin'), array('class' => 'form-control')) }}
    </div>

    {{ Form::submit('Create the user!', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

</div>
</body>

@endsection