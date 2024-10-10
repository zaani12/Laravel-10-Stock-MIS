@extends('layouts.app')

@section('contents')
<div class="container">
    <h1 class="mb-4">All Invoices</h1>

    <table class="table table-striped table-bordered">
        <thead class="thead-light">
            <tr>
                <th>Invoice Number</th>
                <th>Invoice Date</th>
                <th>Supplier</th>
                <th>Amount</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($invoices as $invoice)
                <tr>
                    <td>{{ $invoice->invoice_number }}</td>
                    <td>{{ $invoice->invoice_date }}</td>
                    <td>{{ $invoice->supplier->fullName }}</td> <!-- Assuming supplier relationship is set -->
                    <td>{{ number_format($invoice->amount, 2) }} MAD</td>
                    <td>
                        <a href="{{ route('invoices.show', $invoice->id) }}" class="btn btn-info btn-sm" title="View Invoice">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="" class="btn btn-warning btn-sm" title="Edit Invoice">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Invoice" onclick="return confirm('Are you sure you want to delete this invoice?');">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                        <a href="{{ asset('storage/invoices/invoice_' . $invoice->id . '.pdf') }}" target="_blank" class="btn btn-secondary btn-sm" title="Download PDF">
                            <i class="fas fa-file-pdf"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
