@extends('layouts.app')

@section('content')
<div class=" login-screen">
    <div class="row h-100">
        <div class="col ms-5 align-content-center">
            <div class="d-flex justify-content-start">
                {{-- <div class="card-header">{{ __('Login') }}</div> --}}
                

                <div class="card-body">
                    <div class="row mb-3">
                        <h1 class="fs-1">{{ __('Login') }}</h1>
                    </div>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="col mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-start">{{ __('Email Address') }}</label>

                            <div class="col">
                                <input id="email" type="email" class="rounded-pill p-2 form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-start">{{ __('Password') }}</label>

                            <div class="col">
                                <input id="password" type="password" class="rounded-pill p-2 form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row container">
                            <div class="d-flex justify-content-between">
                                <div class="p-2 form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                    
                                </div>
                                <div class="ms-auto">
                                    @if (Route::has('password.request'))
                                    <a class="btn btn-link text-end" href="{{ route('password.request') }}">
                                        {{ __('Lupa Password?') }}
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="pb-2 pt-2">
                            <hr class="border border-secondary border-1 opacity-50" />
                        </div>

                        <div class="col mb-3 container">
                            <div class="row">
                                <button type="submit" class="btn btn-primary p-2 fs-5 rounded-pill">
                                    {{ __('Login') }}
                                </button>

                            </div>

                            <div class="col d-flex justify-content-center">
                                <p class="p-2">Belum punya akun?</p>
                                <a href="{{ route('register') }}" class="p-2 fw-bold">Registrasi Disini</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
        <div class="col">
            <div class="bg-dark h-100">
                <a href="/" class="nav-link text-light d-flex justify-content-end p-5">Home</a>
                <img src="storage/thumb-welcome.jpg" class="img-fluid h-75" alt="">
                
            </div>
        </div>
        
        
    </div>
</div>
@endsection
