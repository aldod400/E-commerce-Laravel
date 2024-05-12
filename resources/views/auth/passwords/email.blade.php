@section('title','Reset Password')
@include('layouts.header')

    <section class="section-5 pt-3 pb-3 mb-3 bg-white">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="#">Home</a></li>
                    <li class="breadcrumb-item">{{ __('Reset Password') }}</li>
                </ol>
            </div>
        </div>
    </section>

    <section class=" section-10">
        <div class="container">
            <div class="login-form">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <h4 class="modal-title">{{ __('Reset Password') }}</h4>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" required="required"  name="email" value="{{ old('email') }}" autocomplete="email" autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    <div class="form-group small">
                    </div>
                            <div class="col-md-6 offset-md-2">

                            <input type="submit" class="btn btn-dark btn-block btn-lg" value="{{ __('Send Password Reset Link') }}" >
                            </div>
                    </form>
                </div>
            </div>
</section>


@include('layouts.footer')
