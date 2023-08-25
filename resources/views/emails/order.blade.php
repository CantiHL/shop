<!DOCTYPE html>
<html>
<head>
    <title>Hóa đơn</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        .total {
            font-weight: bold;
        }
    </style>
</head>
<body>
<h2>Hóa đơn</h2>

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
    @php
        $total=0
    @endphp
    @foreach($carts as $order)
        <tr>
            <td>{{$order['name']}}</td>
            <td>{{$order['price']}}</td>
            <td>{{$order['quantity']}}</td>
            <td>${{$order['price']*$order['quantity']}}</td>
        </tr>
        @php
            $total+=$order['price']*$order['quantity']
        @endphp
    @endforeach

    </tbody>
    <tfoot>
    <tr>
        <td colspan="3" class="total">SubTotal:</td>
        <td class="total">${{$total}}</td>
    </tr>
    </tfoot>
</table>
</body>
</html>
