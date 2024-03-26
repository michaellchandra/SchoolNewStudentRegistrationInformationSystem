@extends('layouts.app')

@section('content')
    <div class=" login-screen">
        <div class="row h-100">
            <div class="col ms-5 align-content-center">
                <div class="d-flex justify-content-start">
                    {{-- <div class="card-header">{{ __('Login') }}</div> --}}

                    <div class="row mb-3">
                        <h1 class="fs-1">Selamat Datang!</h1>
                    </div>

                </div>
                <div class="col">
                    <div class="col-sm-8 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title">Login</h3>
                                <p class="card-text">Login menggunakan akun yang telah di daftarkan ke sistem pendaftaran siswa baru.
                                </p>
                                <a href="{{ route('login') }}" class="btn btn-primary">Login Disini</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title">Registrasi</h3>
                                <p class="card-text">Belum memiliki akun? Lakukan registrasi akun terlebih dahulu untuk dapat mengakses seluruh fitur dari sistem informasi pendaftaran siswa baru. </p>
                                <a href="{{ route('register') }}" class="btn btn-primary">Registrasi Akun Disini</a>
                            </div>
                        </div>
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
