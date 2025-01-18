@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Product Details</h1>
    <a href="{{ route('products.index') }}" class="btn btn-secondary mb-3">← Back</a>

    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h2>{{ $product->name }}</h2>
        </div>
        <div class="card-body">
            <p><strong>Product ID:</strong> {{ $product->product_id }}</p>
            <p><strong>Description:</strong> {{ $product->description }}</p>
            <p><strong>Price:</strong> ${{ number_format($product->price, 2) }}</p>
            <p><strong>Stock:</strong> {{ $product->stock }}</p>
            <div class="my-3">
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="img-thumbnail" style="max-width: 300px;">
            </div>
        </div>
        <div class="card-footer d-flex justify-content-between">
            <a href="{{ route('products.edit', $product) }}" class="btn btn-warning">Edit</a>
            <form method="POST" action="{{ route('products.destroy', $product) }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>
    </div>
</div>
@endsection