<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Sell;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
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




/**
* market function
*/
public function market(Request $request)
{
    // Fetch all products from the database
    $product = Product::all();

    // Check if a product is being added to the cart
    if ($request->isMethod('post')) {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');

        // Fetch the selected product
        $selectedProduct = Product::find($productId);

        // Check if the product exists and if enough stock is available
        if ($selectedProduct && $quantity <= $selectedProduct->quantity) {
            // Get the current cart from session or create an empty one
            $cart = session()->get('cart', []);

            // If the product is already in the cart, update its quantity
            if (isset($cart[$productId])) {
                $cart[$productId]['quantity'] += $quantity;
            } else {
                // Add the product to the cart
                $cart[$productId] = [
                    'name' => $selectedProduct->productName,
                    'price' => $selectedProduct->unitPrice,
                    'quantity' => $quantity,
                    'photo' => $selectedProduct->photo
                ];
            }

            // Update the session with the new cart
            session()->put('cart', $cart);

            // Redirect back with a success message
            return redirect()->back()->with('success', 'Product added to cart!');
        } else {
            // Redirect back with an error message if the quantity is invalid
            return redirect()->back()->with('error', 'Insufficient stock or invalid product.');
        }
    }

    // Return the view with the products
    return view('products.market', compact('product'));
}


    // public function cart()
    // {
    //     // Fetch all products from the database
    //     $product = Product::all();

    //     // Return the view with the products
    //     return view('products.cart', compact('product'));
    // }
//     public function cartIndex()
// {
//     // Fetch the cart from the session
//     $cart = session()->get('cart', []);

//     // Return the cart view with the cart data
//     return view('cart.index', compact('cart'));
// }
// public function market()
// {
//     // Fetch all products from the database
//     $product = Product::all();

//     // Return the view with the products
//     return view('products.market', compact('product'));
// }
public function addToCart(Request $request, $id)
{
    // Find the product by its ID
    $product = Product::findOrFail($id);

    // Get the quantity from the form
    $quantity = $request->input('quantity');

    // Logic for adding the product to the cart
    // Example: session-based cart
    $cart = session()->get('cart', []);

    // Check if the product is already in the cart
    if (isset($cart[$id])) {
        // Update the quantity if the product already exists in the cart
        $cart[$id]['quantity'] += $quantity;
    } else {
        // Add the product to the cart
        $cart[$id] = [
            'name' => $product->productName,
            'quantity' => $quantity,
            'price' => $product->unitPrice,
            'photo' => $product->photo
        ];
    }

    // Save the cart back to the session
    session()->put('cart', $cart);

    // Redirect back to the products market with success message
    return redirect()->route('products.market')->with('success', 'Product added to cart successfully!');
}






public function showCart()
{
    // Get the cart from the session (if it exists)
    $cart = session()->get('cart', []);

    // Return the cart view with the cart items
    return view('products.cart', compact('cart'));
}






public function removeFromCart($id)
{
    $cart = session()->get('cart', []);

    // Remove the product from the cart
    if (isset($cart[$id])) {
        unset($cart[$id]);
    }

    // Update the cart in the session
    session()->put('cart', $cart);

    // Redirect back to the cart with a success message
    return redirect()->route('cart.index')->with('success', 'Product removed from cart successfully!');
}






public function sellConfirmed(Request $request)
{
    // Retrieve the cart from the session
    $cart = session()->get('cart');
    if (!$cart || count($cart) === 0) {
        return redirect()->back()->withErrors(['error' => 'No items in the cart']);
    }

    // Loop through each item in the cart and process the sale
    foreach ($cart as $id => $details) {
        // Find the product
        $product = Product::findOrFail($id);

        // Check if the product has enough stock
        if ($product->quantity < $details['quantity']) {
            return redirect()->back()->withErrors(['error' => 'Not enough stock for ' . $product->name]);
        }

        // Create a new sale record in the sells table
        \DB::table('sells')->insert([
            'product_id' => $product->id,
            'product_name' => $product->productName, // Adjust this field if your product model uses a different field for the name
            'unit_price' => $details['price'], // Store the price from the cart
            'quantity' => $details['quantity'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Decrease the product quantity in the products table
        $product->quantity -= $details['quantity'];
        $product->save();
    }

    // Clear the cart after the sale
    session()->forget('cart');

    // Redirect with a success message
    return redirect()->route('products.market')->with('success', 'Sale confirmed and inventory updated!');
}





public function generatePDF()
{
    $cart = session()->get('cart');
    $totalAmount = 0;

    if ($cart) {
        foreach ($cart as $id => $details) {
            $totalAmount += $details['price'] * $details['quantity'];
        }
    }

    // Pass data to the view that will be used to generate the PDF
    $pdf = Pdf::loadView('products.pdf', compact('cart', 'totalAmount'));

    // Download the PDF file
    return $pdf->download('invoice.pdf');
}


}

