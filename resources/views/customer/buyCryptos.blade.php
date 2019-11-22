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
<head>
    <title>Welcome to BitChest</title>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
</head>
<body>
<div class="container" style="margin-left:235px">
@include('customer.layouts.partials_customer.navbar-customer')

<h2 style="margin-left:3px">Buying Cryptos coins</h2>

            <form class="form-horizontal" method="POST" action="{{url('/buyCryptosAction')}}">
            
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
                
              
  @foreach($amount as $key => $value)
  <div class="input-group mb-3" style="margin-left:20px">
  
  <div><p style="font-weight:bold;font-size:15px">The contents of your wallets is : </p>{{$value->credit}} {{$value->symbol}}</div>
  <div class="input-group mb-3"><input class="form-control" id="quantity" name="quantity" type="hidden" value="{{$value->credit}}"placeholder="credit"></div>
  @endforeach
  <div class="form-group">
    <label style="margin-left:20px">Select the currency to buy: </label>
   
    <select for="crypto" name="crypto" id="crypto">
    @foreach($crypto as $key => $value)
      <option>{{$value->name}}</option>
  @endforeach
    </select>
  </div>
  <div class="form-group">
                    <div class="col-md-offset-4 ">
                     <button type="submit" name="submit" class="btn btn-success">Buy</button>
 
                    </div>
              </form>

