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
                <a class="nav-link" style="color: #003366;" href="{{ route('homeAdmin') }}">Home</a>
            @else
                <a class="nav-link" style="color: #003366;" href="{{ route('homeClient') }}">HomeClient</a>
            @endif
            </li>
            <li>
                <a class="nav-link" style="color: #003366;" href="{{ route('profile') }}">My profile</a>
            </li>
            <li>
            @if (!Auth::guest() && Auth::user()->is_admin)
                <a class="nav-link" style="color: #003366;" href="{{ route('userManage') }}">User Manage</a>
            @else
                <a class="nav-link" style="color: #003366;" href="{{ route('wallet') }}">My wallet</a>
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
                   <!--  <p>Evolution of cryptocurrency over 30 days</p>
                </div>
            </div>
        </div>
    </div>
</div> -->
 <div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-2">
            <div class="panel panel-default">
<div class="card text-center">
  <div class="card-header">
    <ul class="nav nav-tabs card-header-tabs">
      <li class="nav-item">
        <a class="nav-link active" href="{{route('homeClient')}}">Buy</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Sell</a>
      </li>
      <!-- <li class="nav-item">
        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
      </li> -->
    </ul>
  </div>
  
  <div class="card-body">
    <h5 class="card-title">Choose and buy your cryptocurrency online</h5>
    <div class="input-group mb-3">List of cryptocurrency</div><br>
     @foreach($cryptos as $crypto)  
    <option value="{{$crypto->name}}">{{$crypto->name}}</option> 
    <div class="input-group">
  <div class="input-group-prepend">
    <span class="input-group-text" id="">Enter the quantity of cryptos</span>
  </div>
  <input type="text" value="{{old('$crypto->crypto')}}" class="form-control">
</div><br>
    <!--  <option value="">One</option> -->
    <!--<option value="2">Two</option>
    <option value="3">Three</option>  -->
   @endforeach 
</div>

    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
    <a href="#" class="btn btn-primary">Go somewhere</a>
  </div>
</div>
</div>
    </div>
</div>
@endsection