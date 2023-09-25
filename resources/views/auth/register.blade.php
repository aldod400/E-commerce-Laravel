@section('title','Register')
@include('layouts.header')
   <section class="section-5 pt-3 pb-3 mb-3 bg-white">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="{{ route('/') }}">Home</a></li>
                    <li class="breadcrumb-item">Register</li>
                </ol>
            </div>
        </div>
    </section>
<main>
    <section class=" section-10">
        <div class="container">
            <div class="login-form">
                <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf
                    <h4 class="modal-title">Register Now</h4>
                    <div class="form-group">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Name" id="name">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required autocomplete="email" placeholder="Email" id="email" name="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>
                    <div class="form-group">
                        <input type="text" value="{{ old('phone') }}" class="form-control @error('phone') is-invalid @enderror" placeholder="Phone" id="phone" name="phone">
                        @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="text" name="country" id="country" value="{{ old('country') }}" class="form-control @error('country') is-invalid @enderror" placeholder="Country">
                        @error('country')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="text" name="city" id="city" value="{{ old('city') }}" class="form-control @error('city') is-invalid @enderror" placeholder="City">
                        @error('city')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="text" value="{{ old('address') }}" class="form-control @error('address') is-invalid @enderror" placeholder="address" id="address" name="address">
                        @error('address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="password" value="{{ old('password') }}" class="form-control @error('password') is-invalid @enderror" required autocomplete="new-password" placeholder="Password" id="password" name="password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Confirm Password" id="password-confirm" name="password_confirmation" autocomplete="new-password">
                    </div>
                    <div class="mb-3">
                        <input class="form-control @error('picture') is-invalid @enderror" value="{{ old('picture') }}" type="file" id="formFile" name="picture">
                        @error('picture')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-dark btn-block btn-lg" value="Register">{{ __('Register') }}</button>
                </form>
                <div class="text-center small">Already have an account? <a href="{{ route('login') }}">Login Now</a></div>
            </div>
        </div>
    </section>
</main>
@include('layouts.footer')
