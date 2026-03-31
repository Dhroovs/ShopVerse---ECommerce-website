@extends('layouts.app')

@section('content')

<h2 class="mb-4">Admin Dashboard</h2>

<div class="row">

    <div class="col-md-4">
        <div class="card p-4 text-center shadow-sm">
            <h5>Total Products</h5>
            <h3>{{ $totalProducts }}</h3>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card p-4 text-center shadow-sm">
            <h5>Total Orders</h5>
            <h3>{{ $totalOrders }}</h3>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card p-4 text-center shadow-sm">
            <h5>Pending Orders</h5>
            <h3>{{ $pendingOrders }}</h3>
        </div>
    </div>

</div>

@endsection