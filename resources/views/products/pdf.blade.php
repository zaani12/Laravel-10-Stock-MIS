<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f6f9;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }
        .invoice-header {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            border: 1px solid #dee2e6;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            width: 100%;
            max-width: 800px;
        }
        .table-invoice th {
            background-color: #343a40;
            color: white;
        }
        .table-invoice td, .table-invoice th {
            vertical-align: middle;
        }
        .table-invoice {
            background-color: #ffffff;
            border: 1px solid #dee2e6;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }
        .total-row th, .total-row td {
            background-color: #343a40;
            color: white;
        }
        .signature-section {
            padding-top: 20px;
            border-top: 2px solid #343a40;
            margin-top: 30px;
        }
        .footer-text {
            font-size: 0.9rem;
            color: #6c757d;
            text-align: center;
            margin-top: 40px;
        }
        /* Full width for all sections */
        .full-width {
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="full-width">
        <!-- Invoice Header -->
        <div class="invoice-header text-center">
            <h1 class="mb-5">INVOICE</h1>
            <p class="mb-0"><strong>Invoice Date:</strong> {{ date('d/m/Y') }}</p>
            <p><strong>Invoice #:</strong> 123456</p>
            <h4 class="text-uppercase text-primary">Customer Information</h4>
            <p class="fs-5"><strong>Name:</strong> {{ auth()->user()->name }}</p>
        </div>

        <!-- Invoice Table -->
        <table class="table table-bordered table-invoice full-width">
            <thead class="table-invoice">
                <tr>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cart as $id => $details)
                <tr>
                    <td>{{ $details['name'] }}</td>
                    <td>${{ number_format($details['price'], 2) }}</td>
                    <td>{{ $details['quantity'] }}</td>
                    <td>${{ number_format($details['price'] * $details['quantity'], 2) }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot class="total-row">
                <tr>
                    <th colspan="3" class="text-end">Total Amount:</th>
                    <th class="text-success">${{ number_format($totalAmount, 2) }}</th>
                </tr>
            </tfoot>
        </table>

        <!-- Signature Section -->
        <div class="signature-section">
            <p class="fs-5 fw-bold">Signature:</p>
        </div>

        <!-- Footer Section -->
        <div class="footer-text">
            <p>Thank you for your business!</p>
        </div>
    </div>

    <!-- Include Bootstrap JS and Popper.js (optional, for interactive components) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
