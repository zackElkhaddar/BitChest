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
<section class="table-responsive-md">
<table class="table table-striped table-bordered">

  <thead>
    <th scope="col">ID crpto</th>
    <th scope="col">Nom de crypto</th>
    <th scope="col">Symbol de crypto</th>
    <th  scope="col">Credit</th>
    <th scope="col">Rate</th>
  </thead>
  
  <tbody>
    @foreach($cryptos as $crypto)
    
    <tr>
      <th scope="col">{{$crypto->id}}</th>
      <th scope="col">{{$crypto->name}}</th>
      <th scope="col">{{$crypto->symbol}}</th>
      <th scope="col">{{$crypto->credit}}</th>
      <th scope="col">{{ App\Http\Controllers\HomeController::getRate($crypto->symbol)}} €</th>

      @endforeach
    </tr>
    
   
  </tbody>
  
</table>
</section>

@endsection