<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Product Management')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <nav>
        <!-- Navigation Bar -->
        <a href="{{ route('products.index') }}">Products</a>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer>
        <p>&copy; 2025 Product Management</p>
    </footer>
</body>
</html>
