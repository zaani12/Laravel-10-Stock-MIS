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
            // Fetch all suppliers from the database
            $suppliers = Supplier::all();

            // Pass the suppliers to the view
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

            // Create the invoice
            $invoiceData = $request->except('_token'); // Exclude the CSRF token
            $invoice = Invoice::create($invoiceData);

            // Generate the PDF
            $pdf = PDF::loadView('invoices.pdf', compact('invoice'));
            $pdfPath = storage_path("app/public/invoices/invoice_{$invoice->id}.pdf");

            $pdf->save($pdfPath);

            return redirect()->route('invoices.show', $invoice->id)->with('pdfPath', $pdfPath);
        }


        public function show($id)
        {
            $invoice = Invoice::with('supplier')->findOrFail($id);


            return view('invoices.show', compact('invoice'));}

        public function index()
        {
            $invoices = Invoice::all();
            return view('invoices.index', compact('invoices'));
        }

}
