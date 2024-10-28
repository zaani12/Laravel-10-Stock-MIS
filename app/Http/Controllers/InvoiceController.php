<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF; // Import the PDF facaduse App\Models\Invoice;
use Barryvdh\DomPDF\Facade ;
use App\Models\Supplier;
use App\Models\Invoice; // Import the Invoice model
class InvoiceController extends Controller
{
    public function create()
    {
        $suppliers = Supplier::all();
        return view('invoices.create', compact('suppliers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'invoice_number' => 'required|string',
            'invoice_date' => 'required|date',
            'supplier_id' => 'required|exists:suppliers,id',
            'amount' => 'required|numeric'
        ]);

        $invoiceData = $request->except('_token');
        $invoice = Invoice::create($invoiceData);

        $pdf = PDF::loadView('invoices.pdf', compact('invoice'));
        $pdfPath = storage_path("app/public/invoices/invoice_{$invoice->id}.pdf");

        $pdf->save($pdfPath);

        return redirect()->route('invoices.show', $invoice->id)->with('pdfPath', $pdfPath);
    }

    public function show($id)
    {
        $invoice = Invoice::with('supplier')->findOrFail($id);
        return view('invoices.show', compact('invoice'));
    }

    public function index()
    {
        $invoices = Invoice::all();
        return view('invoices.index', compact('invoices'));
    }

    public function edit($id)
    {
        $invoice = Invoice::findOrFail($id);
        $suppliers = Supplier::all();
        return view('invoices.edit', compact('invoice', 'suppliers'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'invoice_number' => 'required|string',
            'invoice_date' => 'required|date',
            'supplier_id' => 'required|exists:suppliers,id',
            'amount' => 'required|numeric'
        ]);

        $invoice = Invoice::findOrFail($id);
        $invoice->update($request->all());

        return redirect()->route('invoices.index')->with('success', 'Invoice updated successfully.');
    }

    public function destroy($id)
    {
        $invoice = Invoice::findOrFail($id);
        $invoice->delete();

        return redirect()->route('invoices.index')->with('success', 'Invoice deleted successfully.');
    }
}
