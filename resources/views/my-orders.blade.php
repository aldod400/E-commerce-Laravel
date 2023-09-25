@section('title','My Orders')

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
                            <h2 class="h5 mb-0 pt-2 pb-2">My Orders</h2>
                        </div>
                        <div class="card-body p-4">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Orders #</th>
                                            <th>Date Purchased</th>
                                            <th>Status</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $order)
                                            <tr>
                                            <td>
                                                <a href="{{ route('account.order.details',$order->id) }}">{{ $order->id }}</a>
                                            </td>
                                            <td>{{ $order->created_at->format('Y/m/d') }}</td>
                                            <td>
                                                @if( $order->status == 'Delivered')
                                                    <span class="badge bg-success">{{ $order->status }}</span>
                                                @elseif ( $order->status == 'Pending')
                                                    <span class="badge bg-danger">{{ $order->status }}</span>
                                                @elseif ( $order->status == 'Cancelled')
                                                    <span class="badge bg-info">{{ $order->status }}</span>
                                                @endif

                                            </td>
                                            <td>${{ $order->total_price }}</td>
                                        </tr>
                                        @endforeach
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="card-footer clearfix">
								{{ $orders->onEachSide(1)->links() }}
							</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@include('layouts.footer')
