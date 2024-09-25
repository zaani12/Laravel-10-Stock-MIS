<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Sell;

use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sort = $request->input('sort', 'created_at');
        $direction = $request->input('direction', 'desc');

        $allowedColumns = ['unitPrice', 'created_at'];
        if (!in_array($sort, $allowedColumns)) {
            $sort = 'created_at';
        }

        $product = Product::orderBy($sort, $direction)->paginate(4);

        return view('products.index', [
            'product' => $product,
            'sort' => $sort,
            'direction' => $direction,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        // dd($request->all());
        $validatedData = $request->validate([
            'productName' => 'required',
            'unitPrice' => 'required|integer',
            'quantity' => 'required|integer',
            'supplier' => 'required|string',
            'registerDate' => 'required|date',
            'file' => 'required|image|max:2048',
        ]);
        // dd($validatedData);
       // Create the product
       $product = Product::create($validatedData);

        if ($request->hasFile('file')) {
            $photoPath = $request->file('file')->store('images', 'public');
            $product->photo = $photoPath;
            $product->save();
        }


        return redirect()->route('products')->with('success', 'Product added successfully');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::findOrFail($id);

        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);

        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    $product = Product::findOrFail($id);
    $previousPhoto = $product->photo;
    $product->update($request->all());

    if ($request->hasFile('file')) {
        $newPhoto = $request->file('file');

        $newPhotoPath = $newPhoto->store('images', 'public');

        $product->photo = $newPhotoPath;
        $product->save();

        if ($previousPhoto && Storage::disk('public')->exists($previousPhoto)) {
            Storage::disk('public')->delete($previousPhoto);
        }
    }

    return redirect()->route('products')->with('success', 'Product updated successfully');
}

    /**
     * Remove the specified resource from storage.
     */

public function destroy(string $id)
{
    $product = Product::findOrFail($id);

    if (!empty($product->photo)) {
        $photoPath = $product->photo;

        if (Storage::disk('public')->exists($photoPath)) {
            Storage::disk('public')->delete($photoPath);
        }
    }

    $product->delete();

    return redirect()->route('products')->with('success', 'Product deleted successfully.');
    }

public function search(Request $request){
    $search = $request->search;

    $product = Product::where(function($query) use($search){
        $query->where('productName','like',"%$search%")
        ->orWhere('registerDate','like',"%$search%")
        ->orWhere('supplier','like',"%$search%");
    })->paginate(4);

    return view('products.index', compact('product','search'));
}



public function sellConfirmed(Request $request, $id)
{
    // Validate the request data
    $request->validate([
        'quantity' => 'required|integer|min:1|max:' . Product::findOrFail($id)->quantity,
    ]);

    // Find the product by ID
    $product = Product::findOrFail($id);

    // Check if the quantity to sell is valid
    if ($request->quantity > $product->quantity) {
        return redirect()->back()->withErrors(['error' => 'Not enough quantity available']);
    }

    // Create a new entry in the sells table
    Sell::create([
        'product_id' => $product->id,
        'product_name' => $product->productName, // Store product name
        'unit_price' => $product->unitPrice, // Store unit price
        'quantity' => $request->quantity, // Store quantity sold
    ]);

    // Update the product quantity
    $product->quantity -= $request->quantity;
    $product->save();

    // Redirect back with a success message
    return redirect()->route('products')->with('success', 'Product sold successfully!');
}
}
