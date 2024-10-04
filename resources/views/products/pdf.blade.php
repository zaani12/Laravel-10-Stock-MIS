<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Invoice</h1>

    <table>
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @php $totalAmount = 0; @endphp
            @foreach($cart as $id => $details)
            <tr>
                <td>{{ $details['name'] }}</td>
                <td>${{ $details['price'] }}</td>
                <td>{{ $details['quantity'] }}</td>
                <td>${{ $details['price'] * $details['quantity'] }}</td>
            </tr>
            @php $totalAmount += $details['price'] * $details['quantity']; @endphp
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3" style="text-align: right;">Total Amount:</th>
                <th>${{ $totalAmount }}</th>
            </tr>
        </tfoot>
    </table>
</body>
</html>
