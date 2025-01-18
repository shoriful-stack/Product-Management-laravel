@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Products</h1>

    <form method="GET" action="{{ route('products.index') }}">
        <input type="text" name="search" placeholder="Search..." value="{{ request('search') }}">
        <button type="submit">Search</button>
    </form>

    <a href="{{ route('products.create') }}">Add Product</a>

    <table>
        <thead>
            <tr>
                <th><a href="?sort_by=name&order={{ request('order') === 'asc' ? 'desc' : 'asc' }}">Name</a></th>
                <th><a href="?sort_by=price&order={{ request('order') === 'asc' ? 'desc' : 'asc' }}">Price</a></th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->price }}</td>
                    <td>
                        <a href="{{ route('products.show', $product) }}">View</a>
                        <a href="{{ route('products.edit', $product) }}">Edit</a>
                        <form method="POST" action="{{ route('products.destroy', $product) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $products->links() }}
</div>
@endsection
