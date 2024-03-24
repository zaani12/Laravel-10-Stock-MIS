<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class supplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suppliers = Supplier::orderBy('created_at','DESC')->get();
        return view('suppliers/index',compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('suppliers/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'fullName'=>'required',
            'email'=>'required|email',
            'phone'=>'required|numeric',
            'address'=>'required',
        ]);    
        Supplier::create($validatedData);
        return redirect()->route('suppliers/index')->with('message','supplier added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $supplier = Supplier::find($id);
        return view('suppliers/edit',compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $supplier = Supplier::find($id);
        $supplier->update($request->all());

        // $supplier->fullName = $request->fullName;
        // $supplier->email = $request->email;
        // $supplier->phone = $request->phone;
        // $supplier->address = $request->address;
        // $supplier->save();

        return redirect()->route('suppliers/index')->with('message','Supplier information edited successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->delete();

        return redirect()->route('suppliers/index')->with('message','supplier successfully deleted');
    }
}
