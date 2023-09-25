@section('title','My Account')

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
                    <ul id="account-panel" class="nav nav-pills flex-column" >
                        <li class="nav-item">
                            <img style="border: solid rgb(14, 4, 102) 5px; border-radius: 10px" src="{{ asset('storage\images\user-image\\') . auth()->user()->picture }}"  class="nav font-weight-bold" role="tab" aria-controls="tab-login" aria-expanded="false">
                        </li>
                    </ul>
                </div>
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="h5 mb-0 pt-2 pb-2">Personal Information</h2>
                        </div>
                        <form action="{{ route('account.update',auth()->user()->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body p-4">
                                <div class="row">
                                    <div class="mb-3">
                                                <label for="name">Name</label>
                                                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ auth()->user()->name }}" placeholder="Name">
                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="email">Email</label>
                                                <input type="text" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ auth()->user()->email }}" placeholder="Email">
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="phone">Phone</label>
                                                <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ auth()->user()->phone }}" placeholder="Phone">
                                                @error('phone')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="country">Country</label>
                                            <input type="text" name="country" id="country" value="{{ auth()->user()->country }}" class="form-control @error('country') is-invalid @enderror" placeholder="Country" style="display: inline">
                                            @error('country')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="city">City</label>
                                            <input type="text" name="city" id="city" value="{{ auth()->user()->city }}" class="form-control @error('city') is-invalid @enderror" placeholder="City" style="display: inline">
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
                                                <textarea name="address" id="address" class="form-control @error('address') is-invalid @enderror" cols="30" rows="5">{{ auth()->user()->address }}</textarea>
                                                @error('address')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
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
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="phone">Confirm Password</label>
                                                <input type="password" class="form-control" placeholder="Confirm Password" id="password-confirm" name="password_confirmation" autocomplete="new-password">
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="picture" class="form-label">Choose Your Photo</label>
                                            <input name = "picture" class="form-control @error('picture') is-invalid @enderror" type="file" id="formFile">
                                            @error('picture')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                        </div>
                                    </label>
                                    <div class="d-flex">
                                        <button class="btn btn-dark">Update</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@include('layouts.footer')
