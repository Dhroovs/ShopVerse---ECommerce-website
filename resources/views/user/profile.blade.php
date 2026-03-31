@extends('layouts.app')

@section('content')

<h2 class="mb-4">My Profile</h2>

<div class="card p-4 shadow-sm">
    <p><strong>Name:</strong> {{ auth()->user()->name }}</p>
    <p><strong>Email:</strong> {{ auth()->user()->email }}</p>
</div>

@endsection