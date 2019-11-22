@extends('layouts.app')

    @section('content')
    
        @include('admin.layouts.partials_admin.sidebar-admin')
        <head>
            <title>Show User</title>
            <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
        </head>
        <body>
            <div class="container">
             @include('admin.layouts.partials_admin.navbar-admin')
                <h1>Showing {{ $user->name }}</h1>
                    <div class="jumbotron text-center">
                        <h2>{{ $user->name }}</h2>
                            <p>
                                <strong>Email:</strong> {{ $user->email }}<br>
                                <strong>Status Level:</strong> {{ $user->is_admin }}
                            </p>
                    </div>
            </div>
        </body>
    @endsection