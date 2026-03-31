@extends('layouts.app')

@section('content')

<h2 class="mb-4">Products</h2>

<a href="/admin/products/create" class="btn btn-primary mb-3">Add Product</a>

<table class="table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Price</th>
            <th>Stock</th>
        </tr>
    </thead>

    <tbody>
        @foreach($products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>₹{{ $product->price }}</td>
                <td>{{ $product->stock }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection