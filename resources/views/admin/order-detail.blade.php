@section('title','Order Details')
@extends('admin.layouts.admin')
@section('content')
			<!-- Content Wrapper. Contains page content -->
        <form action="{{ route('orders.updatedetails',$order->id) }}" method="POST">
            @csrf
            <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid my-2">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Order: #{{ $order->id }}</h1>
                        </div>
                        <div class="col-sm-6 text-right">
                            <a href="{{ route('orders.index') }}" class="btn btn-primary">Back</a>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </section>
            <!-- Main content -->
            <section class="content">
                <!-- Default box -->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="card">
                                <div class="card-header pt-3">
                                    <div class="row invoice-info">
                                        <div class="col-sm-4 invoice-col">
                                        <h1 class="h5 mb-3">Shipping Address</h1>
                                        <address>
                                            <strong>{{ $order->user->name }}</strong><br>
                                            {{ $order->user->address }}<br>
                                            Phone: {{ $order->user->phone }}<br>
                                            Email: {{ $order->user->email }}
                                        </address>
                                        </div>



                                        <div class="col-sm-4 invoice-col">
                                            {{-- <b>Invoice #007612</b><br> --}}
                                            <br>
                                            <b>Order ID:</b> {{ $order->id }}<br>
                                            <b>Total:</b> $ {{ $price }}<br>
                                            <b>Status:</b>
                                            @if( $order->status == 'Delivered')
                                                <span class="text-success">{{ $order->status }}</span>
                                            @elseif ( $order->status == 'Pending')
                                                <span class="text-danger">{{ $order->status }}</span>
                                            @elseif ( $order->status == 'Cancelled')
                                                <span class="text-info">{{ $order->status }}</span>
                                            @endif
                                            <br>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body table-responsive p-3">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Product</th>
                                                <th width="100">Price</th>
                                                <th width="100">Qty</th>
                                                <th width="100">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @for($i = 0; $i < count($order_items); $i++)
                                                @for ($j = 0; $j < count($products); $j++)
                                                    @if ($i == $j)
                                                        <tr>
                                                            <td>{{ $products[$j]->title }}</td>
                                                            <td>${{ $products[$j]->price }}</td>
                                                            <td>{{ $order_items[$i]->quantity }}</td>
                                                            <td>$ {{ $order_items[$i]->price }}</td>
                                                        </tr>
                                                    @endif
                                                @endfor
                                            @endfor
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body">
                                    <h2 class="h4 mb-3">Order Status</h2>
                                    <div class="mb-3">
                                        <select name="status" id="status" class="form-control">
                                            <option value="Pending" @selected($order->status == 'Pending')>Pending</option>
                                            <option value="Delivered" @selected($order->status == 'Delivered')>Delivered</option>
                                            <option value="Cancelled" @selected($order->status == 'Cancelled')>Cancelled</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <button class="btn btn-primary" type="submit">Update</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card -->
            </section>
            <!-- /.content -->
            </div>
        </form>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2014-2022 AmazingShop All rights reserved.
        </footer>
    </div>
@endsection
