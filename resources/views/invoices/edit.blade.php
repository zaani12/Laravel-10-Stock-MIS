@extends('layouts.app')
@section('contents')
<form action="{{ route('invoices.update', $invoice->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label for="invoice_number">Invoice Number:</label>
    <input type="text" name="invoice_number" value="{{ $invoice->invoice_number }}" required>

    <label for="invoice_date">Invoice Date:</label>
    <input type="date" name="invoice_date" value="{{ $invoice->invoice_date }}" required>

    <label for="supplier_id">Supplier:</label>
    <select name="supplier_id">
        @foreach($suppliers as $supplier)
            <option value="{{ $supplier->id }}" {{ $supplier->id == $invoice->supplier_id ? 'selected' : '' }}>
                {{ $supplier->fullName }}
            </option>
        @endforeach
    </select>

    <label for="amount">Amount:</label>
    <input type="number" name="amount" value="{{ $invoice->amount }}" required>

    <button type="submit">Update Invoice</button>
</form>
@endsection
