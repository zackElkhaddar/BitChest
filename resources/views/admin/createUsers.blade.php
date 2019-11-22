@extends('layouts.app')

    @section('content')
        @include('admin.layouts.partials_admin.sidebar-admin')
            <head>
                <title>Create Users Form</title>
                <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
            </head>
            <body>
                <div class="container" style="margin-left:235px">
                    @include('admin.layouts.partials_admin.navbar-admin')
                        <h1>Create a user</h1>

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