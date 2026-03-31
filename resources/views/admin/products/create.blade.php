@extends('layouts.app')

@section('content')

<h2 class="mb-4">Add Product</h2>

<form method="POST" action="/admin/products">
    @csrf

    <div class="mb-3">
        <label>Name</label>
        <input type="text" name="name" class="form-control">
    </div>

    <div class="mb-3">
        <label>Description</label>
        <textarea name="description" class="form-control"></textarea>
    </div>

    <div class="mb-3">
        <label>Price</label>
        <input type="number" name="price" class="form-control">
    </div>

    <div class="mb-3">
        <label>Category</label>
        <input type="text" name="category" class="form-control">
    </div>

    <div class="mb-3">
        <label>Stock</label>
        <input type="number" name="stock" class="form-control">
    </div>

    <button class="btn btn-success">Save</button>

</form>

@endsection