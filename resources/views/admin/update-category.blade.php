@extends('admin.layouts.admin')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid my-2">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Create Category</h1>
                    </div>
                    <div class="col-sm-6 text-right">
                        <a href="{{ route('categories.index') }}" class="btn btn-primary">Back</a>
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
                                    <input type="text" name="name" id="name" value = "{{ $category->name }}" class="form-control @error('name') is-invalid @enderror" placeholder="Name">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div>
                                    <label for="picture" style="display: block">Picture</label>
                                    <label class="btn btn-default btn-file @error('picture') is-invalid @enderror" style="width:500%;">
                                        Choose Photo <input type="file" value="{{ $category->picture }}" name="picture" style="display: none;">
                                    </label>
                                    @error('picture')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <h2 class="h4 mb-3">Show in Home Page</h2>
                                        <div class="mb-3">
                                            <select name="show" id="show" class="form-control">
                                                <option value="No" @selected($category->showHome == 'No')>No</option>
                                                <option value="Yes" @selected($category->showHome == 'Yes')>Yes</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
                <div class="pb-5 pt-3">
                    <button class="btn btn-primary" type="submit">Update</button>
                    <a href="{{ route('categories.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
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
    </form>
@endsection
