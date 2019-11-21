@extends('layouts.app')

@section('content')
<div class="wrapper">

    <!-- Sidebar -->
    <nav id="sidebar">
    <div class="sidebar-header">
            <h3 class="title-sidebar">BitChest</h3>
        </div>

        <ul class="list-unstyled components">
            @if (!Auth::guest() && Auth::user()->is_admin)
                <p class="user-status">Administrateur</p>
            @else
                <p class="user-status">Client</p>
            @endif
            <li class="active">
            @if (!Auth::guest() && Auth::user()->is_admin)
                <a class="nav-link" style="color: #003366;" href="/homeAdmin">Home</a>
            @else
                <a class="nav-link" style="color: #003366;" href="/homeClient">HomeClient</a>
            @endif
            </li>
            <li>
                <a class="nav-link" style="color: #003366;" href="/profile">My profile</a>
            </li>
            <li>
            @if (!Auth::guest() && Auth::user()->is_admin)
                <a class="nav-link" style="color: #003366;" href="/userManage">User Manage</a>
            @else
                <a class="nav-link" style="color: #003366;" href="/wallet">My wallet</a>
            @endif
            </li>
            <li>
            <a class="nav-link" style="color: #003366;" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Déconnexion
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
            </li>
        </ul>
    </nav>
</div> 

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
<nav class="navbar navbar-inverse" style="height:93px">
    <div class="navbar-header">
        <a class="navbar-brand" href="#">User Alert</a>
    </div>
    <ul class="nav navbar-nav">
        <li><a href="#">View All Users</a></li>
        <li><a href="{{ URL::to('userManage/create') }}">Create a User</a>
    </ul>
</nav>

<h1 style="margin-left:20px">My profile</h1><span style="margin-left:4px">You can change your profile here if you want.</span>

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

                <!-- edit this nerd (uses the edit method found at GET /users/{id}/edit -->
                <a class="btn btn-small btn-info" href='{{ url("/userManage/{$user->id}/edit")}}'>Edit this user</a>

            </td>
        </tr>
    @endforeach
    </tbody>
</table>

</div>

@endsection