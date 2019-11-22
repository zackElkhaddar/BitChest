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

<h2 style="margin-left:3px">All Cryptos coins and rates for buying and selling</h2>

<!-- will be used to show any messages -->
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<table class="table table-striped table-bordered"style="margin-left:3px"> 
    <thead>
        <tr>
            <td>ID</td>
            <td>Name</td>
            <td>Rate</td>
            <td>Actions</td>
        </tr>
    </thead>
    <tbody>
    @foreach($cryptos as $key => $value)
        <tr>
            <td>{{ $value->id }}</td>
            <td>{{ $value->name }}</td>
            <td>{{ App\Http\Controllers\HomeController::getRate($value->symbol)}} €</td>
            <td>
                <a class="btn btn-small btn-success" href="/buyCryptos">Buy this cryptos</a>
                <a class="btn btn-small btn-info" href="/sellCryptos">Sell this cryptos</a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

</div>
</body>

@endsection