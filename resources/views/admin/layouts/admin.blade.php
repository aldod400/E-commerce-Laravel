<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <title>
            @if(View::hasSection('title'))
                @yield('title')
            @else
                Home
            @endif
        </title>

        <link rel="icon" type="image/png" href="{{ asset('storage\images\icon\shopping-bag.png') }}"/>
    		<!-- Google Font: Source Sans Pro -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
		<!-- Font Awesome -->
		<link rel="stylesheet" href="{{ asset('admin-assets/plugins/fontawesome-free/css/all.min.css') }}">

        <link rel="stylesheet" href="{{ asset('admin-assets/plugins/summernote/summernote-bs4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('admin-assets/plugins/dropzone/dropzone.css') }}">
		<!-- Theme style -->
		<link rel="stylesheet" href="{{ asset('admin-assets/css/adminlte.min.css') }}">
		<link rel="stylesheet" href="{{ asset('admin-assets/css/custom.css') }}">
	</head>
	<body class="hold-transition sidebar-mini">
        @if(session()->has("message"))
            <div class="alert alert-success" role="alert">
                {{session()->get('message') }}
            </div>
        @endif
		<!-- Site wrapper -->
		<div class="wrapper">
			<!-- Navbar -->
			<nav class="main-header navbar navbar-expand navbar-white navbar-light">
				<!-- Right navbar links -->
				<ul class="navbar-nav">
					<li class="nav-item">
					  	<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
					</li>
				</ul>
				<div class="navbar-nav pl-2">
					<ol class="breadcrumb p-0 m-0 bg-white">
						<li class="breadcrumb-item active">DashBoard</li>
					</ol>
				</div>

				<ul class="navbar-nav ml-auto">
					<li class="nav-item">
						<a class="nav-link" data-widget="fullscreen" href="#" role="button">
							<i class="fas fa-expand-arrows-alt"></i>
						</a>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link p-0 pr-3" data-toggle="dropdown" href="#">
							@if ((Auth::user()->picture) != null)
                                <img src="{{ asset('storage/images/user-image') . '/' .  Auth::user()->picture }}" class='img-circle elevation-2' width="40" height="40" alt="">
                            @else
                                <img src="{{ asset('admin-assets/img/avatar5.png') }}" class='img-circle elevation-2' width="40" height="40" alt="">
                            @endif
						</a>
						<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-3">
							<h4 class="h4 mb-0"><strong>{{ Auth::user()->name }}</strong></h4>
							<div class="mb-3">{{ Auth::user()->email }}</div>
                            <div class="dropdown-divider"></div>
							<a href="/" class="dropdown-item">
								<i class="fas fa-home"></i> Site
							</a>
							<div class="dropdown-divider"></div>
							<a href="{{ route('account', auth()->user()->id) }}" class="dropdown-item">
								<i class="fas fa-lock mr-2"></i> Change Password
							</a>
							<div class="dropdown-divider"></div>
							<a href="{{ route('logout') }}" class="dropdown-item text-danger"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
								<i class="fas fa-sign-out-alt mr-2"></i> Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
						</div>
					</li>
				</ul>
			</nav>
			<!-- /.navbar -->
			<!-- Main Sidebar Container -->
			<aside class="main-sidebar sidebar-dark-primary elevation-4">
				<!-- Brand Logo -->
				<a href="{{ route('home') }}" class="brand-link">
					<img src="{{ asset('admin-assets/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
					<span class="brand-text font-weight-light">LARAVEL SHOP</span>
				</a>
				<!-- Sidebar -->
				<div class="sidebar">
					<!-- Sidebar user (optional) -->
					<nav class="mt-2">
						<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
							<!-- Add icons to the links using the .nav-icon class
								with font-awesome or any other icon font library -->
							<li class="nav-item">
								<a href="{{ route('home') }}" class="nav-link">
									<i class="nav-icon fas fa-tachometer-alt"></i>
									<p>DashBoard</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="{{ route('categories.index') }}" class="nav-link">
									<i class="nav-icon fas fa-file-alt"></i>
									<p>Category</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="{{ route('subcategories.index') }}" class="nav-link">
									<i class="nav-icon fas fa-file-alt"></i>
									<p>Sub Category</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="{{ route('brands.index') }}" class="nav-link">
									<svg class="h-6 nav-icon w-6 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
										<path stroke-linecap="round" stroke-linejoin="round" d="M16 4v12l-4-2-4 2V4M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
									  </svg>
									<p>Brands</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="{{ route('products.index') }}" class="nav-link">
									<i class="nav-icon fas fa-tag"></i>
									<p>Products</p>
								</a>
							</li>

							<li class="nav-item">
								<a href="{{ route('shipping.index') }}" class="nav-link">
									<!-- <i class="nav-icon fas fa-tag"></i> -->
									<i class="fas fa-truck nav-icon"></i>
									<p>Shipping</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="{{ route('orders.index') }}" class="nav-link">
									<i class="nav-icon fas fa-shopping-bag"></i>
									<p>Orders</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="{{ route('users.index') }}" class="nav-link">
									<i class="nav-icon  fas fa-users"></i>
									<p>Users</p>
								</a>
							</li>
						</ul>
					</nav>
					<!-- /.sidebar-menu -->
				</div>
				<!-- /.sidebar -->
            </aside>
@yield('content')

<!-- ./wrapper -->
		<!-- jQuery -->
		<script src="{{ asset('admin-assets/plugins/jquery/jquery.min.js') }}"></script>
		<!-- Bootstrap 4 -->
		<script src="{{ asset('admin-assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
		<!-- AdminLTE App -->
		<script src="{{ asset('admin-assets/js/adminlte.min.js') }}"></script>
		<!-- AdminLTE for demo purposes -->
		<script src="{{ asset('admin-assets/js/demo.js') }}"></script>

	</body>
</html>
