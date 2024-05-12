@section('title','Update User')
@extends('admin.layouts.admin')
@section('content')
			<!-- Content Wrapper. Contains page content -->
			<form action="{{ route('users.update',$user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="content-wrapper">
				<!-- Content Header (Page header) -->
				<section class="content-header">
					<div class="container-fluid my-2">
						<div class="row mb-2">
							<div class="col-sm-6">
								<h1>Create User</h1>
							</div>
							<div class="col-sm-6 text-right">
								<a href="{{ route('users.index') }}" class="btn btn-primary">Back</a>
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
											<input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ $user->name }}" placeholder="Name">
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
										</div>
                                    </div>
									<div class="col-md-6">
										<div class="mb-3">
											<label for="email">Email</label>
											<input type="text" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ $user->email }}" placeholder="Email">
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
										</div>
									</div>
									<div class="col-md-6">
										<div class="mb-3">
											<label for="phone">Phone</label>
											<input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ $user->phone }}" placeholder="Phone">
                                            @error('phone')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
										</div>
									</div>
                                    <div class="col-md-6">
										<div class="mb-3">
											<label for="status">Status</label>
											<select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
                                                <option value="1" @if($user->status == 1) selected @endif>Active</option>
                                                <option value="0"  @if($user->status == 0) selected @endif>Disabled</option>
                                            </select>
                                            @error('status')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
										</div>
									</div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="country">Country</label>
                                            <input type="text" name="country" id="country" class="form-control @error('country') is-invalid @enderror" value="{{ $user->country }}" placeholder="Country">
                                            @error('country')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
										<div class="mb-3">
											<label for="city">City</label>
											<input type="text" name="city" id="city" class="form-control @error('city') is-invalid @enderror" value="{{ $user->city }}" placeholder="City">
                                            @error('city')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
										</div>
									</div>
									<div class="col-md-12">
										<div class="mb-3">
											<label for="phone">Address</label>
											<textarea name="address" id="address" class="form-control @error('address') is-invalid @enderror" cols="30" rows="5">{{ $user->address }}</textarea>
                                            @error('address')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
										</div>
									</div>
                                    <div class="col-md-6">
										<div class="mb-3">
											<label for="phone">Password</label>
											<input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password">
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
										</div>
									</div>
                                    <div class="col-md-6">
										<div class="mb-3">
											<label for="phone">Confirm Password</label>
                                            <input type="password" class="form-control" placeholder="Confirm Password" id="password-confirm" name="password_confirmation" autocomplete="new-password">
										</div>
									</div>
                                    <label class="btn btn-default btn-file @error('picture') is-invalid @enderror" style="width:49.5%">
                                        Choose Your Photo <input type="file" value="{{$user->picture }}" name="picture" style="display: none;">
                                    </label>
                                    @error('picture')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    <div class="col-md-6">
										<div class="mb-3">
											<label for="role">Role</label>
											<select name="role" id="role" class="form-control @error('role') is-invalid @enderror">
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role->id }}" @selected($user->role_id == $role->id)>{{ $role->title }}</option>
                                                @endforeach
                                            </select>
                                            @error('role')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
										</div>
								</div>
							</div>
						</div>
						<div class="pb-5 pt-3">
							<button class="btn btn-primary" type="submit">Update</button>
							<a href="{{ route('users.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
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
