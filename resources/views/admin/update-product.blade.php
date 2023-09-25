@extends('admin.layouts.admin')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <form action="{{ route('products.update',$product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="content-wrapper">
				<!-- Content Header (Page header) -->
				<section class="content-header">
					<div class="container-fluid my-2">
						<div class="row mb-2">
							<div class="col-sm-6">
								<h1>Create Product</h1>
							</div>
							<div class="col-sm-6 text-right">
								<a href="{{ route('products.index') }}" class="btn btn-primary">Back</a>
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
                            <div class="col-md-8">
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="title">Title</label>
                                                    <input type="text" name="title" id="title" value = "{{ $product->title }}" class="form-control @error('title') is-invalid @enderror" placeholder="Title">
                                                    @error('title')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="description">Description</label>
                                                    <textarea width="100%" name="description" id="description" cols="100" rows="10" class="form-control @error('description') is-invalid @enderror" placeholder="Description" style="display: block">{{ $product->description }}</textarea>
                                                    @error('description')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <h2 class="h4 mb-3">Media</h2>
                                        <label class="btn btn-default btn-file" style="width:100%" for="picture">
                                        Choose Your Photo <input type="file" class="form-control @error('picture') is-invalid @enderror" value="{{ $product->picture }}" name="picture" style="display: block;">
                                        </label>
                                        @error('picture')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <h2 class="h4 mb-3">Pricing</h2>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="price">Price</label>
                                                    <input type="text" name="price" value="{{ $product->price }}" id="price" class="form-control @error('price') is-invalid @enderror" placeholder="Price">
                                                    @error('price')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="quantity">Quantity</label>
                                                    <input type="text" name="quantity" value="{{ $product->quantity }}" id="quantity" class="form-control @error('quantity') is-invalid @enderror" placeholder="Quantity">
                                                    @error('quantity')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <h2 class="h4 mb-3">Product status</h2>
                                        <div class="mb-3">
                                            <select name="status" id="status" class="form-control">
                                                <option value="1" @if($product->status == 1) selected @endif>Active</option>
                                                <option value="0" @if($product->status == 0) selected @endif>Block</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <h2 class="h4  mb-3">Product category</h2>
                                        <div class="mb-3">
                                            <label for="category">Category</label>
                                            <select name="category" id="category" class="form-control">
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}" @selected($product->category_id == $category->id)>{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="subcategory">Sub category</label>
                                            <select name="subcategory" id="subcategory" class="form-control">
                                                @foreach ($subcategories as $subcategory)
                                                    <option value="{{ $subcategory->id }}" @selected($product->subcategory_id == $subcategory->id)>{{ $subcategory->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <h2 class="h4 mb-3">Product brand</h2>
                                        <div class="mb-3">
                                            <select name="brand" id="brand" class="form-control">
                                                @foreach ($brands as $brand)
                                                    <option value="{{ $brand->id }}" @selected($product->brand_id == $brand->id)>{{ $brand->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

						<div class="pb-5 pt-3">
							<button class="btn btn-primary" type="submit">Update</button>
							<a href="{{ route('products.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
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
    <!-- ./wrapper -->

    <!-- Summernote -->
    <script src="{{ asset('admin-assets/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('admin-assets/plugins/dropzone/dropzone.js') }}"></script>
    <script>
        Dropzone.autoDiscover = false;
        $(function () {
            // Summernote
            $('.summernote').summernote({
                height: '300px'
            });

            const dropzone = $("#image").dropzone({
                url:  "create-product.html",
                maxFiles: 5,
                addRemoveLinks: true,
                acceptedFiles: "image/jpeg,image/png,image/gif",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }, success: function(file, response){
                    $("#image_id").val(response.id);
                }
            });

        });
    </script>
@endsection
