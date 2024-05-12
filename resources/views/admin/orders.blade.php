@section('title','Orders')
@extends('admin.layouts.admin')
@section('content')
			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				<!-- Content Header (Page header) -->
				<section class="content-header">
					<div class="container-fluid my-2">
						<div class="row mb-2">
							<div class="col-sm-6">
								<h1>Orders</h1>
							</div>
							<div class="col-sm-6 text-right">
							</div>
						</div>
					</div>
					<!-- /.container-fluid -->
				</section>
				<!-- Main content -->
				<section class="content">
					<!-- Default box -->
					<div class="container-fluid">
						<div class="card">
							<div class="card-header">
								<div class="card-tools">
									<div class="input-group input-group" style="width: 250px;">
										<form action="{{ route('orders.index') }}" method="get" style="display:inline-flex">
                                            <input value="{{ Request::get('search') }}" type="text" name= "search" class="form-control float-right" placeholder="Search" aria-label="Amount (to the nearest dollar)">
                                            <div class="input-group-append">
										        <button type="submit" class="btn btn-default">
											        <i class="fas fa-search"></i>
										        </button>
										    </div>
                                        </form>
									  </div>
								</div>
							</div>
							<div class="card-body table-responsive p-0">
								<table class="table table-hover text-nowrap">
									<thead>
										<tr>
											<th>Orders #</th>
                                            <th>Customer</th>
                                            <th>Email</th>
                                            <th>Phone</th>
											<th>Status</th>
                                            <th>Total</th>
                                            <th>Date Purchased</th>
										</tr>
									</thead>
									<tbody>
										@foreach ($orders as $order)
                                            <tr>
											<td><a href="{{ route('orders.details',$order->id) }}">{{ $order->id }}</a></td>
											<td>{{ $order->user->name }}</td>
                                            <td>{{ $order->user->email }}</td>
                                            <td>{{ $order->user->phone }}</td>
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
                                            <td>{{ $order->created_at }}</td>
										</tr>
                                        @endforeach
									</tbody>
								</table>
							</div>
							<div class="card-footer clearfix">
								{{ $orders->onEachSide(1)->links() }}
							</div>
						</div>
					</div>
					<!-- /.card -->
				</section>
				<!-- /.content -->
			</div>
			<!-- /.content-wrapper -->
			<footer class="main-footer">

				<strong>Copyright &copy; 2014-2022 AmazingShop All rights reserved.
			</footer>

		</div>
@endsection
