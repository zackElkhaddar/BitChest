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

<h2 style="margin-left:3px">Selling Cryptos coins</h2>
<table class="table table-striped table-bordered"style="margin-left:3px"> 
    <thead>
        <tr>
           
            <td>Credit</td>
            <td></td>
        </tr>
    </thead>
    <tbody>
@foreach($amount as $key => $value)

            <form class="form-horizontal" method="POST" action="{{url('/sellCryptos2')}}">
                
                {{csrf_field()}}
                <!--requet pour dire que tous les champs doivent etre rempli-->
                @if(count($errors ) > 0)
                @foreach($errors->all() as $error )
                <div class="alert alert-danger">
                  {{$error}}
                </div>
                @endforeach
                @endif
                <!--fin-->
                
                <fieldset>
                  <!-- <legend>We fashion</legend> -->
                  <div class="form-group">
                  <tr>
            <td>{{ $value->credit }} {{ $value->symbol }} </td>
                    <div class="col-md-6">
                      <input class="form-control" id="credit" name="credit" type="hidden" value="{{$value->credit}}"placeholder="credit"><br>
                    </div>
                    <div class="col-md-6">
                      <input class="form-control" id="currency_id" name="currency_id" type="hidden" value="{{$value->symbol}}"placeholder="credit"><br>
                    </div>
                    <div class="col-md-6">
                      <input class="form-control" id="iud" name="iud" type="hidden" value="{{$value->iud}}"placeholder="credit"><br>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-offset-4 ">
                    <td>  <button type="submit" name="submit" class="btn btn-success">Sell</button></td>
 
                    </div>
                  </div>
                </fieldset>
              </form>
            
        </tr>
@endforeach