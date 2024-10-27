@extends('layouts.app')

@section('contents')
<div class="container mt-5">
    <h1>Create Invoice</h1>

    <form action="{{ route('invoices.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="invoice_number" class="form-label">Invoice Number</label>
            <input type="text" class="form-control" id="invoice_number" name="invoice_number" placeholder="Invoice Number" required>
        </div>

        <div class="mb-3">
            <label for="invoice_date" class="form-label">Invoice Date</label>
            <input type="date" class="form-control" id="invoice_date" name="invoice_date" required>
        </div>

        <div class="mb-3">
            <label for="supplier_id" class="form-label">Supplier</label>
            <select class="form-select" id="supplier_id" name="supplier_id" required>
                <option value="">Select Supplier</option>
                @foreach($suppliers as $supplier)
                    <option value="{{ $supplier->id }}">{{ $supplier->fullName }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="amount" class="form-label">Amount (MAD)</label>
            <input type="number" class="form-control" id="amount" name="amount" step="0.01" placeholder="Amount" required>
        </div>

        <button type="submit" class="btn btn-primary">Save Invoice</button>
    </form>
</div>
@endsection
