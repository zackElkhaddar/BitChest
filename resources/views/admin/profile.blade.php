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
    <th scope="col">ID user</th>
    <th scope="col">Nom de l'utilisateur</th>
    <th scope="col">Adresse email de l'utilisateur</th>
  </thead>
  
  <tbody>
    @foreach($users as $user)
    <tr>
      <th scope="col">{{$user->id}}</th>
      <th scope="col">{{$user->name}}</th>
      <th scope="col">{{$user->email}}</th>
    </tr>
    @endforeach
  </tbody>
  
</table>
</section>

@endsection