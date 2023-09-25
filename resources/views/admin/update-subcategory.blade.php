@extends('admin.layouts.admin')
@section('content')
    <form action="{{ route('subcategories.update', $subcategory->id) }}" method="POST">
        @csrf
        @method('PUT')
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid my-2">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Create Sub Category</h1>
                        </div>
                        <div class="col-sm-6 text-right">
                            <a href="{{ route('subcategories.index') }}" class="btn btn-primary">Back</a>
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
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="category">Category</label>
                                        <select name="category" id="category" class="form-control">
                                            @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" id="name" value="{{ $subcategory->name }}" class="form-control @error('name') is-invalid @enderror" placeholder="Name">
                                        @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="pb-5 pt-3">
                        <button class="btn btn-primary" type="submit">Update</button>
                        <a href="{{ route('subcategories.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
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
