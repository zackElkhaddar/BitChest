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
@if (!Auth::guest() && Auth::user()->is_admin)
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
<div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-heading"><h1>BitChest</h1></div>

                    <div class="panel-body">
                        <div class="col-md-12 ">
                            @foreach($users as $user)

                                
                                <legend>Modification des données</legend>

                                 <div class="form-group">
                                    <label class="col-md-4 control-label" for="name">Name</label>
                                    <div class="col-md-5">
                                        <input id="name" name="name" class="form-control input-md" type="text" value="{{ $user->name }}">
                                        @if ($errors->has('Name'))
                                            <p class="help-block">{{ $errors->first('Name') }}</p>
                                        @endif
                                    </div>
                                </div>

                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="email">Email</label>
                                            <div class="col-md-5">
                                                <input id="email" name="email" class="form-control input-md" type="email" value="{{ $user->email }}">
                                                 @if ($errors->has('Email'))
                                                    <p class="help-block">{{ $errors->first('Email') }}</p>
                                                @endif

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="selectbasic">Statut</label>
                                            <div class="col-md-5">
                                                <select id="selectbasic" name="is_admin" class="form-control">
                                                    <option selected> 
                                                       
                                                    </option>
                                                    <option value="1"></option>
                                                    <option value="0"></option>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Actions -->
                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="validation"></label>
                                            <div class="col-md-8">
                                                <button id="validation" type="submit" name="validation" class="btn btn-success">Validate</button>
                                                <button id="cancel" name="cancel" class="btn btn-danger">Cancel</button>
                                  

                                            </div>
                                        </div>
                                @endforeach
                    

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endif
@endsection