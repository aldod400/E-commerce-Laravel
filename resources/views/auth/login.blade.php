{{-- @extends('layouts.app')

@section('content') --}}
@section('title','Login')

@include('layouts.header')

    <section class="section-5 pt-3 pb-3 mb-3 bg-white">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="#">Home</a></li>
                    <li class="breadcrumb-item">Login</li>
                </ol>
            </div>
        </div>
    </section>

    <section class=" section-10">
        <div class="container">
            <div class="login-form">
                <form method="POST" action="{{ route('login') }}">
                        @csrf
                    <h4 class="modal-title">{{ __('Login to Your Account') }}</h4>
                    <div class="form-group">
                        <input type="text" class="form-control @error('email') is-invalid @enderror" placeholder="Email" required="required"  name="email" value="{{ old('email') }}" autocomplete="email" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="current-password" placeholder="Password" required="required" >
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">
                            {{ __('Remember Me') }}
                        </label>
                    </div>

                    <div class="form-group small">
                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </div>

                    <input type="submit" class="btn btn-dark btn-block btn-lg" value="Login">
                </form>
                <div class="text-center small">Don't have an account? <a href="{{ route('register') }}">Sign up</a></div>
            </div>
        </div>
    </section>
    @include('layouts.footer')
