@extends('layouts.app')

@section('contents')

    <h1 class="mb-4">Invoice Details</h1>

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Invoice #{{ $invoice->invoice_number }}</h5>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th scope="col">Field</th>
                        <th scope="col">Details</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>Date:</strong></td>
                        <td>{{ $invoice->invoice_date }}</td>
                    </tr>
                    <tr>
                        <td><strong>Supplier:</strong></td>
                        <td>{{ $invoice->supplier->fullName }}</td>
                    </tr>
                    <tr>
                        <td><strong>Amount:</strong></td>
                        <td>{{ number_format($invoice->amount, 2) }} MAD</td>
                    </tr>
                    <tr>
                        <td><strong>Created At:</strong></td>
                        <td>{{ $invoice->created_at }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <a href="{{ route('invoices.index') }}" class="btn btn-primary mt-3">Back to Invoices</a>

@endsection
