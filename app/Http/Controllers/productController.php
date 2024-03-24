<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use App\Models\Product;
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
    $validatedData = $request->validate([
        'productName' => 'required',
        'unitPrice' => 'required',
        'quantity' => 'required',
        'supplier' => 'required',
        'file' => 'required|image|max:2048', 
    ]);

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
}