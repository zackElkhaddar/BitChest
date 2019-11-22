@extends('layouts.app')

@section('content')
@include('admin.layouts.partials_admin.sidebar-admin')
<div class="container">
<section class="table-responsive-md">
@include('customer.layouts.partials_customer.navbar-customer')

@if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
<h2 style="margin-left:3px">Contents of my wallet</h2>
<table class="table table-striped table-bordered">

  <thead>
    <th scope="col">ID crpto</th>
    <th scope="col">Name of crypto</th>
    <th scope="col">Symbol of crypto</th>
    <th scope="col">Credit</th>
    <th scope="col">Rate</th>
  </thead>
  
  <tbody>
    @foreach($cryptos as $crypto)
    
    <tr>
      <th scope="col">{{$crypto->id}}</th>
      <th scope="col">{{$crypto->name}}</th>
      <th scope="col">{{$crypto->symbol}}</th>
      <th scope="col">{{$crypto->credit}} {{$crypto->symbol}}</th>
      <th scope="col">1 {{$crypto->symbol}} = {{ App\Http\Controllers\HomeController::getRate($crypto->symbol)}} €</th>

      @endforeach
    </tr>
    
   
  </tbody>
  
</table>
</section>

@endsection