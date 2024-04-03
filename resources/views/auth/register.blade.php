@extends('layouts.app')

@section('content')
<div class=" login-screen">
    <div class="row h-100">
        <div class="col ms-5 align-content-center">
            <div class="d-flex justify-content-start">
                {{-- <div class="card-header">{{ __('Register') }}</div> --}}

                <div class="card-body">
                    <div class="row mb-3">
                        <h1 class="fs-1">{{ __('Register') }}</h1>
                    </div>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="col mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-start">{{ __('Name') }}</label>

                            <div class="col">
                                <input id="name" type="text" class="rounded-pill p-2 form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-start">{{ __('Email Address') }}</label>

                            <div class="col">
                                <input id="email" type="email" class="rounded-pill p-2 form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

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
                                <input id="password" type="password" class="rounded-pill p-2 form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-start">{{ __('Confirm Password') }}</label>

                            <div class="col">
                                <input id="password-confirm" type="password" class="rounded-pill p-2 form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="col mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-start">Asal Sekolah</label>

                            <div class="col">
                                <input id="asalSekolah" type="text" class="rounded-pill p-2 form-control @error('asalSekolah') is-invalid @enderror" name="asalSekolah" value="{{ old('asalSekolah') }}" required autocomplete="asalSekolah" autofocus>

                                @error('asalSekolah')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col mb-3">
                            <div class="col">
                                
                        
                                    <label for="asalReferensiSekolah" class="col-md-4 col-form-label text-md-start">Mengetahui Melalui</label>
                                    <select name="asalReferensiSekolah" class="rounded-pill p-2 form-select">
                                        <option value="EXPO">EXPO</option>
                                        <option value="Online">Online</option>
                                        <option value="Open House">Open House</option>
                                        <option value="Sosial Media">Sosial Media</option>
                                    </select>
                        
                                    
                                    
                                    
                                
                            </div>
                        </div>

                        <div class="pb-2 pt-2">
                            <hr class="border border-secondary border-1 opacity-50" />
                        </div>

                        <div class="col mb-3 container">
                            <div class="row">
                                <button type="submit" class="btn btn-primary p-2 fs-5 rounded-pill">
                                    {{ __('Register') }}
                                </button>
                            </div>

                            <div class="col d-flex justify-content-center">
                                <p class="p-2">Sudah punya akun?</p>
                                <a href="{{ route('login') }}" class="p-2 fw-bold">Login Disini</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="bg-dark h-100">
                
            </div>
        </div>
    </div>
</div>
@endsection
