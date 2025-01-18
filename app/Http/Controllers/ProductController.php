<?php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->search) {
            $query->where('product_id', 'like', "%{$request->search}%")
                  ->orWhere('name', 'like', "%{$request->search}%")
                  ->orWhere('description', 'like', "%{$request->search}%")
                  ->orWhere('price', $request->search);
        }

        if ($request->sort_by) {
            $query->orderBy($request->sort_by, $request->order ?? 'asc');
        }

        $products = $query->paginate(10);
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|unique:products',
            'name' => 'required',
            'price' => 'required|numeric',
            'image' => 'required|image',
        ]);

        $imagePath = $request->file('image')->store('products', 'public');

        Product::create([
            'product_id' => $validated['product_id'],
            'name' => $validated['name'],
            'description' => $request->description,
            'price' => $validated['price'],
            'stock' => $request->stock,
            'image' => $imagePath,
        ]);

        return redirect('/products')->with('success', 'Product created successfully!');
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'image' => 'nullable|image',
        ]);

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($product->image);
            $product->image = $request->file('image')->store('products', 'public');
        }

        $product->update($validated + ['description' => $request->description, 'stock' => $request->stock]);

        return redirect('/products')->with('success', 'Product updated successfully!');
    }

    public function destroy(Product $product)
    {
        Storage::disk('public')->delete($product->image);
        $product->delete();

        return redirect('/products')->with('success', 'Product deleted successfully!');
    }
}