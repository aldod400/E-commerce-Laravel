@section('title','Order Details')
@include('layouts.header')
<main>
    <section class="section-5 pt-3 pb-3 mb-3 bg-white">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="{{ route('account',auth()->user()->id) }}">My Account</a></li>
                    <li class="breadcrumb-item">Settings</li>
                </ol>
            </div>
        </div>
    </section>

    <section class=" section-11 ">
        <div class="container  mt-5">
            <div class="row">
                <div class="col-md-3">
                    @include('layouts.account-panel')
                </div>
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="h5 mb-0 pt-2 pb-2">My Order {{ $order->id }}</h2>
                        </div>

                        <div class="card-body pb-0">
                            <!-- Info -->
                            <div class="card card-sm">
                                <div class="card-body bg-light mb-3">
                                    <div class="row">
                                        <div class="col-6 col-lg-3">
                                            <!-- Heading -->
                                            <h6 class="heading-xxxs text-muted">Order No:</h6>
                                            <!-- Text -->
                                            <p class="mb-lg-0 fs-sm fw-bold">
                                            {{ $order->id }}
                                            </p>
                                        </div>
                                        {{-- <div class="col-6 col-lg-3">
                                            <!-- Heading -->
                                            <h6 class="heading-xxxs text-muted">Shipped date:</h6>
                                            <!-- Text -->
                                            <p class="mb-lg-0 fs-sm fw-bold">
                                                <time datetime="2019-10-01">
                                                    01 Oct, 2019
                                                </time>
                                            </p>
                                        </div> --}}
                                        <div class="col-6 col-lg-3">
                                            <!-- Heading -->
                                            <h6 class="heading-xxxs text-muted">Status:</h6>
                                            <!-- Text -->
                                        @if( $order->status == 'Delivered')
                                            <span class="badge bg-success">{{ $order->status }}</span>
                                        @elseif ( $order->status == 'Pending')
                                            <span class="badge bg-danger">{{ $order->status }}</span>
                                        @elseif ( $order->status == 'Cancelled')
                                            <span class="badge bg-info">{{ $order->status }}</span>
                                        @endif
                                        </div>
                                        <div class="col-6 col-lg-3">
                                            <!-- Heading -->
                                            <h6 class="heading-xxxs text-muted">Order Amount:</h6>
                                            <!-- Text -->
                                            <p class="mb-0 fs-sm fw-bold">
                                            ${{ $order->total_price }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer p-3">

                            <!-- Heading -->
                            <h6 class="mb-7 h5 mt-4">Order Items ({{ count($products) }})</h6>

                            <!-- Divider -->
                            <hr class="my-3">

                            <!-- List group -->
                            <ul>
                                @for($i = 0; $i < count($order_items); $i++)
                                    @for($j=0; $j < count($products); $j++)
                                        @if($i==$j)
                                            <li class="list-group-item">
                                                <div class="row align-items-center">
                                                    <div class="col-4 col-md-3 col-xl-2">
                                                        <!-- Image -->
                                                        <a href="product.html"><img src="{{ asset('storage\images\product-image\\') .  $products[$j]->picture }}" alt="..." class="img-fluid"></a>
                                                    </div>
                                                    <div class="col">
                                                        <!-- Title -->
                                                        <p class="mb-4 fs-sm fw-bold">
                                                            <a class="text-body" href="{{ route('product.show',$products[$j]->id) }}">{{ $products[$j]->title }} x {{ $order_items[$i]->quantity }}</a> <br>
                                                            <span class="text-muted">${{ $order_items[$j]->price}}</span>
                                                        </p>
                                                    </div>
                                                </div>
                                            </li>
                                        @endif
                                    @endfor
                                @endfor
                            </ul>
                            <div class="card-footer clearfix">
								{{ $products->onEachSide(1)->links() }}
							</div>
                        </div>
                    </div>

                    <div class="card card-lg mb-5 mt-3">
                        <div class="card-body">
                            <!-- Heading -->
                            <h6 class="mt-0 mb-3 h5">Order Total</h6>

                            <!-- List group -->
                            <ul>
                                {{-- <li class="list-group-item d-flex">
                                    <span>Subtotal</span>
                                    <span class="ms-auto">$128.00</span>
                                </li>
                                <li class="list-group-item d-flex">
                                    <span>Tax</span>
                                    <span class="ms-auto">$0.00</span>
                                </li>
                                <li class="list-group-item d-flex">
                                    <span>Shipping</span>
                                    <span class="ms-auto">$8.00</span>
                                </li> --}}
                                <li class="list-group-item d-flex fs-lg fw-bold">
                                    <span>Total</span>
                                    <span class="ms-auto">${{ $order->total_price }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@include('layouts.footer')
