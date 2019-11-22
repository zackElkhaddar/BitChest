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

<h2 style="margin-left:3px">Selling Cryptos coins</h2>
<table class="table table-striped table-bordered"style="margin-left:3px"> 
    <thead>
        <tr>
           
            <td>Credit</td>
            <td>Action</td>
        </tr>
    </thead>
    <tbody>
@foreach($amount as $key => $value)

            <form class="form-horizontal" method="POST" action="{{url('/sellCryptosAction')}}">
                
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
                      <input class="form-control" id="currency_id" name="currency_id" type="hidden" value="{{$value->symbol}}"placeholder="symbol"><br>
                    </div>
                    <div class="col-md-6">
                      <input class="form-control" id="iud" name="iud" type="hidden" value="{{$value->iud}}"placeholder="iud"><br>
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