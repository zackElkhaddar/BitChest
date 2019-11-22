@extends('layouts.app')

@section('content')
@include('admin.layouts.partials_admin.sidebar-admin')

<!-- <div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">BitChest</div>
                <div class="panel-body"> -->
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                 <!--    <p>Evolution of cryptocurrency over 30 days</p>
                </div>
            </div>
        </div>
    </div>
</div> -->
<div class="container AdminContainer col-md-offset-2" style="margin-left:234px">
@include('admin.layouts.partials_admin.navbar-admin')

<h1 style="margin-left:20px">All the Users</h1>

<!-- will be used to show any messages -->
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <td>ID</td>
            <td>Name</td>
            <td>Email</td>
            <td>Status Level</td>
            <td>Actions</td>
        </tr>
    </thead>
    <tbody>
    @foreach($users->all() as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->is_admin }}</td>

            <!-- we will also add show, edit, and delete buttons -->
            <td>

                <!-- delete the nerd (uses the destroy method DESTROY /users/{id} -->
                <!-- we will add this later since its a little more complicated than the other two buttons -->
                {{ Form::open(array('url' => 'userManage/' . $user->id, 'class' => 'col-md-4')) }}
                    {{ Form::hidden('_method', 'DELETE') }}
                    {{ Form::submit('Delete this user', array('class' => 'btn btn-warning','onclick'=>"return confirm('Are you sure?')")) }}
                {{ Form::close() }}
                <!-- show the nerd (uses the show method found at GET /users/{id} -->
                <a class="btn btn-small btn-success" href='{{ url("/userManage/{$user->id}")}}'>Show this user</a>

                <!-- edit this nerd (uses the edit method found at GET /users/{id}/edit -->
                <a class="btn btn-small btn-info" href='{{ url("/userManage/{$user->id}/edit")}}'>Edit this user</a>

            </td>
        </tr>
    @endforeach
    </tbody>
</table>

</div>


@endsection