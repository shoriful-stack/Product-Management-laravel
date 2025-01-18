@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Create Product</h1>
    <a href="{{ route('products.index') }}" class="btn btn-secondary mb-3">← Back</a>

    <div class="card p-4 shadow-sm">
        <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Product Name</label>
                <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Product Details</label>
                <textarea name="description" class="form-control" id="description" rows="4">{{ old('description') }}</textarea>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="stock" class="form-label">Stock</label>
                    <input type="number" name="stock" class="form-control" id="stock" value="{{ old('stock') }}">
                </div>
                <div class="col-md-6">
                    <label for="price" class="form-label">Price</label>
                    <input type="number" step="0.01" name="price" class="form-control" id="price" value="{{ old('price') }}" required>
                </div>
            </div>
            <div class="mb-3 mt-3">
                <label for="image" class="form-label">Product Image</label>
                <input type="file" name="image" class="form-control" id="image" required>
            </div>
            <button type="submit" class="btn btn-primary">Save Product</button>
        </form>
    </div>
</div>
@endsection
