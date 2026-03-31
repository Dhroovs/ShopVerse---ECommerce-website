@extends('layouts.app')

@section('content')

<h2 class="mb-4">Orders</h2>

<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Total</th>
            <th>Status</th>
        </tr>
    </thead>

    <tbody>
        @foreach($orders as $order)
            <tr>
                <td>#{{ $order->id }}</td>
                <td>{{ $order->name }}</td>
                <td>₹{{ $order->total }}</td>
                <td>{{ $order->status }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection