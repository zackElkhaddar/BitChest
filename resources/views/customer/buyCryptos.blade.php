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
<head>
    <title>Welcome to BitChest</title>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
</head>
<body>
<div class="container" style="margin-left:235px">
<nav class="navbar navbar-inverse" style="height:92px">
    <div class="navbar-header">
        <a class="navbar-brand" href="#">Cryptos Alert</a>
    </div>
    <ul class="nav navbar-nav">
        <li><a href="#">View All Cryptos</a></li>
        <li><a href="#">Consult a crypto</a>
    </ul>
</nav>

<h2 style="margin-left:3px">Buying Cryptos coins</h2>
