<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order Email</title>
</head>
<body style="font-family: Arial; font-size:16px">
    <h1>Thanks For your Order!!</h1>
    <h2>Your order Id is: #{{ $mailData['order']->id }}</h2>
    <div class="col-sm-4 invoice-col">
        {{-- <b>Invoice #007612</b><br> --}}
        <address>
            <strong>{{ $mailData['order']->user->name }}</strong><br>
            {{ $mailData['order']->user->address }}<br>
            Phone: {{ $mailData['order']->user->phone }}<br>
            Email: {{ $mailData['order']->user->email }}
        </address>
        <b>Total:</b> $ {{ $mailData['order']->total_price}}<br>
        <b>Status:</b>
        @if( $mailData['order']->status == 'Delivered')
            <span class="text-success">{{ $mailData['order']->status }}</span>
        @elseif ( $mailData['order']->status == 'Pending')
            <span class="text-danger">{{ $mailData['order']->status }}</span>
        @elseif ( $mailData['order'] ->status == 'Cancelled')
            <span class="text-info">{{ $mailData['order']->status }}</span>
        @endif
        <br>
    </div>
    <h2>Products</h2>

    <table class="table table-striped">
        <thead>
            <tr style="background:#ccc">
                <th>Product</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @for($i = 0; $i < count($mailData['order_items']); $i++)
                @for ($j = 0; $j < count($mailData['products']); $j++)
                    @if ($i == $j)
                        <tr>
                            <td>{{ $mailData['products'][$j]->title }}</td>
                            <td>${{ $mailData['products'][$j]->price }}</td>
                            <td>{{ $mailData['order_items'][$i]->quantity }}</td>
                            <td>$ {{ $mailData['order_items'][$i]->price }}</td>
                        </tr>
                    @endif
                @endfor
            @endfor
        </tbody>
    </table>

</body>
</html>
