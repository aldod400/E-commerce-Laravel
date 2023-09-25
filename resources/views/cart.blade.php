@section('title','My Cart')

@include('layouts.header')
<main>
    <section class="section-5 pt-3 pb-3 mb-3 bg-white">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="{{ route('/') }}">Home</a></li>
                    <li class="breadcrumb-item"><a class="white-text" href="{{ route('products') }}">Shop</a></li>
                    <li class="breadcrumb-item">Cart</li>
                </ol>
            </div>
        </div>
    </section>

    <section class=" section-9 pt-4">
        <div class="container">
            <div class="row">
                @if (Gloudemans\Shoppingcart\Facades\Cart::count() != 0)
                <div class="col-md-8">
                    <div class="table-responsive">
                        <table class="table" id="cart">
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th>Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cart_content as $item)
                                    <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset('storage\images\product-image\\') . $item->options->product_image }}" width="" height="">
                                            <h2>{{  $item->name }}</h2>
                                        </div>
                                    </td>
                                    <td>${{ $item->price }}</td>
                                    <td>
                                    <form action="{{ route('cart.update', $item->rowId) }}" method = 'get'>
                                        <div class="input-group quantity mx-auto" style="width: 100px;">
                                            <div class="input-group-btn">
                                                <button type = "submit" name = "down" class="btn btn-sm btn-dark btn-minus p-2 pt-1 pb-1">
                                                    <i class="fa fa-minus"></i>
                                                </button>
                                            </div>
                                            <input type="text" name ="qty"  class="form-control form-control-sm  border-0 text-center" value="{{ $item->qty }}">
                                            <div class="input-group-btn">
                                                <button type = "submit" name = "up" class="btn btn-sm btn-dark btn-plus p-2 pt-1 pb-1 add">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                    </td>
                                    <td>
                                        ${{ $item->qty * $item->price }}
                                    </td>
                                    <td>
                                        <form action="{{ route('cart.destroy',$item->rowId) }}" method="GET" style=" display:inline;">
                                            @csrf
                                            <button class="btn btn-sm btn-danger" type="submit" name="delete"><i class="fa fa-times"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card cart-summery">
                        <div class="sub-title">
                            <h2 class="bg-white">Cart Summery</h3>
                        </div>
                        <div class="card-body">

                            <div class="d-flex justify-content-between">
                                <div>Total</div>
                                <div>${{  Gloudemans\Shoppingcart\Facades\Cart::subtotal() }}</div>
                            </div>
                            <div class="pt-5">
                                <a href="{{ route('checkout.index') }}" class="btn-dark btn btn-block w-100">Proceed to Checkout</a>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="input-group apply-coupan mt-4">
                        <input type="text" placeholder="Coupon Code" class="form-control">
                        <button class="btn btn-dark" type="button" id="button-addon2">Apply Coupon</button>
                    </div> --}}
                </div>
                @else
                <div class="card">
                        <div class="card-body">
                            <div class="accordion accordion-flush" id="accordionExample">
                                <h3 align = 'center'>Cart is empty</h3>
                            </div>
                        </div>
                </div>
                @endif
            </div>
        </div>
    </section>
</main>

@extends('layouts.footer')

@section('custom')

    <script>
        $('#myModal').on('shown.bs.modal', function () {
            $('#myInput').trigger('focus')
        })
    </script>

@endsection
