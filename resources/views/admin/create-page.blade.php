@extends('admin.layouts.admin')
@section('content')
			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				<!-- Content Header (Page header) -->
				<section class="content-header">
					<div class="container-fluid my-2">
						<div class="row mb-2">
							<div class="col-sm-6">
								<h1>Create Page</h1>
							</div>
							<div class="col-sm-6 text-right">
								<a href="pages.html" class="btn btn-primary">Back</a>
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
							<div class="card-body">
								<div class="row">
									<div class="col-md-6">
										<div class="mb-3">
											<label for="name">Name</label>
											<input type="text" name="name" id="name" class="form-control" placeholder="Name">
										</div>
									</div>
									<div class="col-md-6">
										<div class="mb-3">
											<label for="email">Slug</label>
											<input type="text" name="slug" id="slug" class="form-control" placeholder="Slug">
										</div>
									</div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="content">Content</label>
                                            <textarea name="content" id="content" class="summernote" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>
								</div>
							</div>
						</div>
						<div class="pb-5 pt-3">
							<button class="btn btn-primary">Create</button>
							<a href="pages.html" class="btn btn-outline-dark ml-3">Cancel</a>
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
		<!-- ./wrapper -->
		<script src="{{ asset('admin-assets/js/demo.js') }}"></script>

        <script>
            $(function () {
                // Summernote
                $('.summernote').summernote({
                    height: '300px'
                });
            });
        </script>
@endsection
