@extends('layouts.app')

@section('content')
@include('admin.layouts.partials_admin.sidebar-admin')
<head>
    <title>Edit User</title>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
</head>
<body>
<div class="container">

@include('admin.layouts.partials_admin.navbar-admin')
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