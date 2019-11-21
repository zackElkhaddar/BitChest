@extends('layouts.app')

@section('content')

<head>
    <title>Show User</title>
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
        <li><a href="{{ URL::to('userManage/create') }}">Create a User</a>
    </ul>
</nav>

<h1>Showing {{ $user->name }}</h1>

    <div class="jumbotron text-center">
        <h2>{{ $user->name }}</h2>
        <p>
            <strong>Email:</strong> {{ $user->email }}<br>
            <strong>Status Level:</strong> {{ $user->is_admin }}
        </p>
    </div>

</div>
@endsection