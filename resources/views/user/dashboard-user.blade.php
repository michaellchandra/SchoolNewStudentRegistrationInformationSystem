@extends('layouts.user')

@section('content')
    <div class="container-fluid">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="d-sm-flex align-items-center justify-content-between mb-5 mt-5">
            <h1 class="h3 mb-0 text-dark">Dashboard</h1>
            {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm"><i
                    class="fas fa-warning fa-sm text-white-50"></i> Bantuan</a> --}}
        </div>

        <!-- Status Pendaftaran -->
        <div class="card shadow mb-4">
            @php
                $loggedInUser = Auth::user();
            @endphp
            @foreach ($users as $user)
                @if ($user->id === $loggedInUser->id)
                    @foreach ($user->registrations as $registration)
                        <div class="card-header d-flex justify-content-between py-3 align-items-center">
                            <h5 class="m-0 fw-bold ">Status</h5>
                            <h6 class="m-0 fw-bold text-primary">{{ $registration->registrationStatus }}</h6>
                        </div>
                        @if ($registration->registrationStatus === 'Pendaftaran Akun Selesai')
                            <div class="card-header d-flex justify-content-between py-3 align-items-center">
                                <div class="">
                                    <p class="mb-3 fw-bold">Pendaftaran Akun</p>
                                    <p class="fs-6">
                                        <a href="#" class="btn btn-success btn-circle btn-sm">
                                            <i class="fas fa-check"></i>
                                        </a> Akun Berhasil Registrasi
                                    </p>
                                </div>
                                <div class="">
                                    <h6 class="mb-3 fw-bold text-success text-end">SUDAH</h6>
                                    <p class="fs-6">{{ Auth::user()->created_at }}</p>
                                </div>

                            </div>
                            <div class="card-header d-flex justify-content-between py-3 align-items-center">
                                <div>
                                    <p class="mb-3 fw-bold">Pembayaran Formulir</p>
                                    <p class="fs-6">
                                        <a href="#" class="btn btn-secondary btn-circle btn-sm">
                                            <i class="fas fa-chevron-right"></i></a>
                                        Menunggu Upload Bukti Pembayaran Formulir
                                </div>
                                <div>
                                    <h6 class="mb-3 fw-bold text-danger text-end">BELUM</h6>
                                </div>

                            </div>
                            <div class="card-header d-flex justify-content-between py-3 align-items-center">

                                <p class="m-0">Pengisian Biodata & Berkas</p>
                                <h6 class="m-0 fw-bold text-danger">BELUM</h6>
                            </div>

                            <div class="card-header d-flex justify-content-between py-3 align-items-center">

                                <p class="m-0">Hasil Tes</p>
                                <h6 class="m-0 fw-bold text-danger">BELUM</h6>
                            </div>
                            <div class="card-header d-flex justify-content-between py-3 align-items-center">

                                <p class="m-0">Pembayaran Administrasi</p>
                                <h6 class="m-0 fw-bold text-danger">BELUM</h6>
                            </div>
                        @elseif ($registration->registrationStatus === 'Menunggu Verifikasi Pembayaran Formulir')
                            <div class="card-header d-flex justify-content-between py-3 align-items-center">

                                <div class="">
                                    <p class="mb-3 fw-bold">Pendaftaran Akun</p>
                                    <p class="fs-6">
                                        <a href="#" class="btn btn-success btn-circle btn-sm">
                                            <i class="fas fa-check"></i>
                                        </a> Akun Berhasil Registrasi
                                    </p>
                                </div>
                                <div class="">
                                    <h6 class="mb-3 fw-bold text-success text-end">SUDAH</h6>
                                    <p class="fs-6">{{ Auth::user()->created_at }}</p>
                                </div>
                            </div>
                            <div class="card-header d-flex justify-content-between py-3 align-items-center">

                                <div>
                                    <p class="mb-3 fw-bold">Pembayaran Formulir</p>
                                    <p class="fs-6">
                                        <a href="#" class="btn btn-info btn-circle btn-sm">
                                            <i class="fas fa-upload"></i></a>
                                        Bukti Pembayaran Berhasil Di Upload, Menunggu Verifikasi Admin
                                </div>
                                <div>
                                    <h6 class="mb-3 fw-bold text-info text-end">MENUNGGU</h6>
                                    @foreach ($payments as $payment)
                                        <p class="fs-6">{{ $payment->updated_at_submit }}</p>
                                    @endforeach

                                </div>
                            </div>
                            <div class="card-header d-flex justify-content-between py-3 align-items-center">

                                <p class="m-0">Pengisian Biodata & Berkas</p>
                                <h6 class="m-0 fw-bold text-danger">BELUM</h6>
                            </div>
                            <div class="card-header d-flex justify-content-between py-3 align-items-center">

                                <p class="m-0">Hasil Tes</p>
                                <h6 class="m-0 fw-bold text-danger">BELUM</h6>
                            </div>
                            <div class="card-header d-flex justify-content-between py-3 align-items-center">

                                <p class="m-0">Pembayaran Administrasi</p>
                                <h6 class="m-0 fw-bold text-danger">BELUM</h6>
                            </div>
                        @elseif ($registration->registrationStatus === 'Butuh Revisi Pembayaran Formulir')
                            <div class="card-header d-flex justify-content-between py-3 align-items-center">

                                <div class="">
                                    <p class="mb-3 fw-bold">Pendaftaran Akun</p>
                                    <p class="fs-6">
                                        <a href="#" class="btn btn-success btn-circle btn-sm">
                                            <i class="fas fa-check"></i>
                                        </a> Akun Berhasil Registrasi
                                    </p>
                                </div>
                                <div class="">
                                    <h6 class="mb-3 fw-bold text-success text-end">SUDAH</h6>
                                    <p class="fs-6">{{ Auth::user()->created_at }}</p>
                                </div>
                            </div>
                            <div class="card-header d-flex justify-content-between py-3 align-items-center">

                                <div>
                                    <p class="mb-3 fw-bold">Pembayaran Formulir</p>
                                    <p class="fs-6">
                                        <a href="#" class="btn btn-info btn-circle btn-sm">
                                            <i class="fas fa-upload"></i></a>
                                        Bukti Pembayaran Berhasil Di Upload
                                    </p>
                                    <p class="fs-6">
                                        <a href="#" class="btn btn-warning btn-circle btn-sm">
                                            <i class="fas fa-exclamation"></i></a>
                                        Butuh Revisi Bukti Pembayaran Formulir
                                    </p>
                                </div>
                                <div>
                                    <h6 class="mb-3 fw-bold text-warning text-end">BUTUH REVISI</h6>
                                    @foreach ($payments as $payment)
                                        <p class="fs-6">{{ $payment->updated_at_submit }}</p>
                                        <p class="fs-6">{{ $payment->updated_at_revision }}</p>
                                    @endforeach

                                </div>
                            </div>
                            <div class="card-header d-flex justify-content-between py-3 align-items-center">

                                <p class="m-0">Pengisian Biodata & Berkas</p>
                                <h6 class="m-0 fw-bold text-danger">BELUM</h6>
                            </div>
                            <div class="card-header d-flex justify-content-between py-3 align-items-center">

                                <p class="m-0">Hasil Tes</p>
                                <h6 class="m-0 fw-bold text-danger">BELUM</h6>
                            </div>
                            <div class="card-header d-flex justify-content-between py-3 align-items-center">

                                <p class="m-0">Pembayaran Administrasi</p>
                                <h6 class="m-0 fw-bold text-danger">BELUM</h6>
                            </div>
                        @elseif ($registrationStatus === 'Pembayaran Formulir Terverifikasi')
                            <div class="card-header d-flex justify-content-between py-3 align-items-center">

                                <div class="">
                                    <p class="mb-3 fw-bold">Pendaftaran Akun</p>
                                    <p class="fs-6">
                                        <a href="#" class="btn btn-success btn-circle btn-sm">
                                            <i class="fas fa-check"></i>
                                        </a> Akun Berhasil Registrasi
                                    </p>
                                </div>
                                <div class="">
                                    <h6 class="mb-3 fw-bold text-success text-end">SUDAH</h6>
                                    <p class="fs-6">{{ Auth::user()->created_at }}</p>
                                </div>
                            </div>
                            <div class="card-header d-flex justify-content-between py-3 align-items-center">

                                <div>
                                    <p class="mb-3 fw-bold">Pembayaran Formulir</p>
                                    <p class="fs-6">
                                        <a href="#" class="btn btn-info btn-circle btn-sm">
                                            <i class="fas fa-upload"></i></a>
                                        Bukti Pembayaran Berhasil Di Upload, Menunggu Verifikasi Admin
                                    </p>
                                    <p class="fs-6">
                                        <a href="#" class="btn btn-success btn-circle btn-sm">
                                            <i class="fas fa-check"></i></a>
                                        Pembayaran Formulir Terverifikasi
                                    </p>
                                </div>
                                <div>
                                    <h6 class="mb-3 fw-bold text-info text-end">SUDAH</h6>
                                    @foreach ($payments as $payment)
                                        <p class="fs-6">{{ $payment->updated_at_submit }}</p>
                                        <p class="fs-6">{{ $payment->updated_at_accepted }}</p>
                                    @endforeach

                                </div>
                            </div>
                            <div class="card-header d-flex justify-content-between py-3 align-items-center">

                                <p class="m-0">Pengisian Biodata & Berkas</p>
                                <h6 class="m-0 fw-bold text-danger">BELUM</h6>
                            </div>
                            <div class="card-header d-flex justify-content-between py-3 align-items-center">

                                <p class="m-0">Hasil Tes</p>
                                <h6 class="m-0 fw-bold text-danger">BELUM</h6>
                            </div>
                            <div class="card-header d-flex justify-content-between py-3 align-items-center">

                                <p class="m-0">Pembayaran Administrasi</p>
                                <h6 class="m-0 fw-bold text-danger">BELUM</h6>
                            </div>
                        @elseif ($registrationStatus === 'Menunggu Verifikasi Biodata & Berkas')
                            <div class="card-header d-flex justify-content-between py-3 align-items-center">

                                <div class="">
                                    <p class="mb-3 fw-bold">Pendaftaran Akun</p>
                                    <p class="fs-6">
                                        <a href="#" class="btn btn-success btn-circle btn-sm">
                                            <i class="fas fa-check"></i>
                                        </a> Akun Berhasil Registrasi
                                    </p>
                                </div>
                                <div class="">
                                    <h6 class="mb-3 fw-bold text-success text-end">SUDAH</h6>
                                    <p class="fs-6">{{ Auth::user()->created_at }}</p>
                                </div>

                            </div>
                            <div class="card-header d-flex justify-content-between py-3 align-items-center">

                                <div>
                                    <p class="mb-3 fw-bold">Pembayaran Formulir</p>
                                    <p class="fs-6">
                                        <a href="#" class="btn btn-info btn-circle btn-sm">
                                            <i class="fas fa-upload"></i></a>
                                        Bukti Pembayaran Berhasil Di Upload, Menunggu Verifikasi Admin
                                    </p>
                                    <p class="fs-6">
                                        <a href="#" class="btn btn-success btn-circle btn-sm">
                                            <i class="fas fa-check"></i></a>
                                        Pembayaran Formulir Terverifikasi
                                    </p>
                                </div>
                                <div>
                                    <h6 class="mb-3 fw-bold text-success text-end">SUDAH</h6>
                                    @foreach ($payments as $payment)
                                        <p class="fs-6">{{ $payment->updated_at_submit }}</p>
                                        <p class="fs-6">{{ $payment->updated_at_accepted }}</p>
                                    @endforeach

                                </div>
                            </div>
                            <div class="card-header d-flex justify-content-between py-3 align-items-center">

                                <div>
                                    <p class="mb-3 fw-bold">Pengisian Biodata & Berkas</p>
                                    <p class="fs-6">
                                        <a href="#" class="btn btn-info btn-circle btn-sm">
                                            <i class="fas fa-upload"></i></a>
                                        Biodata & Berkas Berhasil di Upload, Menunggu Verifikasi Admin
                                    </p>

                                </div>
                                <div>
                                    <h6 class="mb-3 fw-bold text-info text-end">MENUNGGU VERIFIKASI</h6>
                                    @foreach ($biodata as $data)
                                        <p class="fs-6 text-end">{{ $data->updated_at_submit }}</p>
                                    @endforeach
                                </div>

                            </div>
                            <div class="card-header d-flex justify-content-between py-3 align-items-center">

                                <p class="m-0">Hasil Tes</p>
                                <h6 class="m-0 fw-bold text-danger">BELUM</h6>
                            </div>
                            <div class="card-header d-flex justify-content-between py-3 align-items-center">

                                <p class="m-0">Pembayaran Administrasi</p>
                                <h6 class="m-0 fw-bold text-danger">BELUM</h6>
                            </div>
                        @elseif ($registrationStatus === 'Butuh Revisi Biodata & Berkas')
                            <div class="card-header d-flex justify-content-between py-3 align-items-center">

                                <div class="">
                                    <p class="mb-3 fw-bold">Pendaftaran Akun</p>
                                    <p class="fs-6">
                                        <a href="#" class="btn btn-success btn-circle btn-sm">
                                            <i class="fas fa-check"></i>
                                        </a> Akun Berhasil Registrasi
                                    </p>
                                </div>
                                <div class="">
                                    <h6 class="mb-3 fw-bold text-success text-end">SUDAH</h6>
                                    <p class="fs-6">{{ Auth::user()->created_at }}</p>
                                </div>

                            </div>
                            <div class="card-header d-flex justify-content-between py-3 align-items-center">

                                <div>
                                    <p class="mb-3 fw-bold">Pembayaran Formulir</p>
                                    <p class="fs-6">
                                        <a href="#" class="btn btn-info btn-circle btn-sm">
                                            <i class="fas fa-upload"></i></a>
                                        Bukti Pembayaran Berhasil Di Upload, Menunggu Verifikasi Admin
                                    </p>
                                    <p class="fs-6">
                                        <a href="#" class="btn btn-success btn-circle btn-sm">
                                            <i class="fas fa-check"></i></a>
                                        Pembayaran Formulir Terverifikasi
                                    </p>
                                </div>
                                <div>
                                    <h6 class="mb-3 fw-bold text-success text-end">SUDAH</h6>
                                    @foreach ($payments as $payment)
                                        <p class="fs-6">{{ $payment->updated_at_submit }}</p>
                                        <p class="fs-6">{{ $payment->updated_at_accepted }}</p>
                                    @endforeach

                                </div>
                            </div>
                            <div class="card-header d-flex justify-content-between py-3 align-items-center">
                                <div>
                                    <p class="mb-3 fw-bold">Pengisian Biodata & Berkas</p>
                                    <p class="fs-6">
                                        <a href="#" class="btn btn-info btn-circle btn-sm">
                                            <i class="fas fa-upload"></i></a>
                                        Biodata & Berkas Berhasil di Upload, Menunggu Verifikasi Admin
                                    </p>
                                    <p class="fs-6">
                                        <a href="#" class="btn btn-warning btn-circle btn-sm">
                                            <i class="fas fa-exclamation"></i></a>
                                        Butuh Revisi Biodata & Formulir, Cek Alasan Penolakan
                                    </p>
                                </div>
                                <div>
                                    <h6 class="mb-3 fw-bold text-warning text-end">BUTUH REVISI</h6>
                                    @foreach ($biodata as $data)
                                        <p class="fs-6">{{ $data->updated_at_submit }}</p>
                                        <p class="fs-6">{{ $data->updated_at_revision }}</p>
                                    @endforeach

                                </div>

                            </div>
                            <div class="card-header d-flex justify-content-between py-3 align-items-center">

                                <p class="m-0">Hasil Tes</p>
                                <h6 class="m-0 fw-bold text-danger">BELUM</h6>
                            </div>
                            <div class="card-header d-flex justify-content-between py-3 align-items-center">

                                <p class="m-0">Pembayaran Administrasi</p>
                                <h6 class="m-0 fw-bold text-danger">BELUM</h6>
                            </div>
                        @elseif ($registrationStatus === 'Biodata & Berkas Terverifikasi')
                            <div class="card-header d-flex justify-content-between py-3 align-items-center">

                                <div class="">
                                    <p class="mb-3 fw-bold">Pendaftaran Akun</p>
                                    <p class="fs-6">
                                        <a href="#" class="btn btn-success btn-circle btn-sm">
                                            <i class="fas fa-check"></i>
                                        </a> Akun Berhasil Registrasi
                                    </p>
                                </div>
                                <div class="">
                                    <h6 class="mb-3 fw-bold text-success text-end">SUDAH</h6>
                                    <p class="fs-6">{{ Auth::user()->created_at }}</p>
                                </div>
                            </div>
                            <div class="card-header d-flex justify-content-between py-3 align-items-center">

                                <div>
                                    <p class="mb-3 fw-bold">Pembayaran Formulir</p>
                                    <p class="fs-6">
                                        <a href="#" class="btn btn-info btn-circle btn-sm">
                                            <i class="fas fa-upload"></i></a>
                                        Bukti Pembayaran Berhasil Di Upload, Menunggu Verifikasi Admin
                                    </p>
                                    <p class="fs-6">
                                        <a href="#" class="btn btn-success btn-circle btn-sm">
                                            <i class="fas fa-check"></i></a>
                                        Pembayaran Formulir Terverifikasi
                                    </p>
                                </div>
                                <div>
                                    <h6 class="mb-3 fw-bold text-success text-end">SUDAH</h6>
                                    @foreach ($payments as $payment)
                                        <p class="fs-6">{{ $payment->updated_at_submit }}</p>
                                        <p class="fs-6">{{ $payment->updated_at_accepted }}</p>
                                    @endforeach

                                </div>
                            </div>
                            <div class="card-header d-flex justify-content-between py-3 align-items-center">

                                <div>
                                    <p class="mb-3 fw-bold">Pengisian Biodata & Berkas</p>
                                    <p class="fs-6">
                                        <a href="#" class="btn btn-info btn-circle btn-sm">
                                            <i class="fas fa-upload"></i></a>
                                        Biodata & Berkas Berhasil di Upload, Menunggu Verifikasi Admin
                                    </p>
                                    <p class="fs-6">
                                        <a href="#" class="btn btn-success btn-circle btn-sm">
                                            <i class="fas fa-check"></i></a>
                                        Biodata & Berkas Administrasi Terverifikasi
                                    </p>
                                </div>
                                <div>
                                    <h6 class="mb-3 fw-bold text-success text-end">SUDAH</h6>
                                    @foreach ($biodata as $data)
                                        <p class="fs-6 text-end">{{ $data->updated_at_submit }}</p>
                                        <p class="fs-6 text-end">{{ $data->updated_at_accepted }}</p>
                                    @endforeach
                                </div>
                            </div>
                            <div class="card-header d-flex justify-content-between py-3 align-items-center">

                                <p class="m-0">Hasil Tes</p>
                                <h6 class="m-0 fw-bold text-danger">BELUM</h6>
                            </div>
                            <div class="card-header d-flex justify-content-between py-3 align-items-center">

                                <p class="m-0">Pembayaran Administrasi</p>
                                <h6 class="m-0 fw-bold text-danger">BELUM</h6>
                            </div>
                        @elseif ($registrationStatus === 'Jadwal Tes Terkonfirmasi')
                            <div class="card-header d-flex justify-content-between py-3 align-items-center">

                                <div class="">
                                    <p class="mb-3 fw-bold">Pendaftaran Akun</p>
                                    <p class="fs-6">
                                        <a href="#" class="btn btn-success btn-circle btn-sm">
                                            <i class="fas fa-check"></i>
                                        </a> Akun Berhasil Registrasi
                                    </p>
                                </div>
                                <div class="">
                                    <h6 class="mb-3 fw-bold text-success text-end">SUDAH</h6>
                                    <p class="fs-6">{{ Auth::user()->created_at }}</p>
                                </div>
                            </div>
                            <div class="card-header d-flex justify-content-between py-3 align-items-center">

                                <div>
                                    <p class="mb-3 fw-bold">Pembayaran Formulir</p>
                                    <p class="fs-6">
                                        <a href="#" class="btn btn-info btn-circle btn-sm">
                                            <i class="fas fa-upload"></i></a>
                                        Bukti Pembayaran Berhasil Di Upload, Menunggu Verifikasi Admin
                                    </p>
                                    <p class="fs-6">
                                        <a href="#" class="btn btn-success btn-circle btn-sm">
                                            <i class="fas fa-check"></i></a>
                                        Pembayaran Formulir Terverifikasi
                                    </p>
                                </div>
                                <div>
                                    <h6 class="mb-3 fw-bold text-success text-end">SUDAH</h6>
                                    @foreach ($payments as $payment)
                                        <p class="fs-6">{{ $payment->updated_at_submit }}</p>
                                        <p class="fs-6">{{ $payment->updated_at_accepted }}</p>
                                    @endforeach

                                </div>
                            </div>
                            <div class="card-header d-flex justify-content-between py-3 align-items-center">

                                <div>
                                    <p class="mb-3 fw-bold">Pengisian Biodata & Berkas</p>
                                    <p class="fs-6">
                                        <a href="#" class="btn btn-info btn-circle btn-sm">
                                            <i class="fas fa-upload"></i></a>
                                        Biodata & Berkas Berhasil di Upload, Menunggu Verifikasi Admin
                                    </p>
                                    <p class="fs-6">
                                        <a href="#" class="btn btn-success btn-circle btn-sm">
                                            <i class="fas fa-check"></i></a>
                                        Biodata & Berkas Administrasi Terverifikasi
                                    </p>
                                </div>
                                <div>
                                    <h6 class="mb-3 fw-bold text-success text-end">SUDAH</h6>
                                    @foreach ($biodata as $data)
                                        <p class="fs-6 text-end">{{ $data->updated_at_submit }}</p>
                                        <p class="fs-6 text-end">{{ $data->updated_at_accepted }}</p>
                                    @endforeach
                                </div>
                            </div>
                            <div class="card-header d-flex justify-content-between py-3 align-items-center">

                                <p class="m-0">Hasil Tes</p>
                                <h6 class="m-0 fw-bold text-danger">BELUM</h6>
                            </div>
                            <div class="card-header d-flex justify-content-between py-3 align-items-center">

                                <p class="m-0">Pembayaran Administrasi</p>
                                <h6 class="m-0 fw-bold text-danger">BELUM</h6>
                            </div>
                        @elseif ($registrationStatus === 'Hasil Tes Gagal')
                            <div class="card-header d-flex justify-content-between py-3 align-items-center">

                                <div class="">
                                    <p class="mb-3 fw-bold">Pendaftaran Akun</p>
                                    <p class="fs-6">
                                        <a href="#" class="btn btn-success btn-circle btn-sm">
                                            <i class="fas fa-check"></i>
                                        </a> Akun Berhasil Registrasi
                                    </p>
                                </div>
                                <div class="">
                                    <h6 class="mb-3 fw-bold text-success text-end">SUDAH</h6>
                                    <p class="fs-6">{{ Auth::user()->created_at }}</p>
                                </div>
                            </div>
                            <div class="card-header d-flex justify-content-between py-3 align-items-center">

                                <div>
                                    <p class="mb-3 fw-bold">Pembayaran Formulir</p>
                                    <p class="fs-6">
                                        <a href="#" class="btn btn-info btn-circle btn-sm">
                                            <i class="fas fa-upload"></i></a>
                                        Bukti Pembayaran Berhasil Di Upload, Menunggu Verifikasi Admin
                                    </p>
                                    <p class="fs-6">
                                        <a href="#" class="btn btn-success btn-circle btn-sm">
                                            <i class="fas fa-check"></i></a>
                                        Pembayaran Formulir Terverifikasi
                                    </p>
                                </div>
                                <div>
                                    <h6 class="mb-3 fw-bold text-success text-end">SUDAH</h6>
                                    @foreach ($payments as $payment)
                                    @if ($payment->paymentCategory === 'formulir')
                                    <p class="fs-6">{{ $payment->updated_at_submit }}</p>
                                    <p class="fs-6">{{ $payment->updated_at_accepted }}</p>
                                @endif
                                    @endforeach

                                </div>
                            </div>
                            <div class="card-header d-flex justify-content-between py-3 align-items-center">

                                <div>
                                    <p class="mb-3 fw-bold">Pengisian Biodata & Berkas</p>
                                    <p class="fs-6">
                                        <a href="#" class="btn btn-info btn-circle btn-sm">
                                            <i class="fas fa-upload"></i></a>
                                        Biodata & Berkas Berhasil di Upload, Menunggu Verifikasi Admin
                                    </p>
                                    <p class="fs-6">
                                        <a href="#" class="btn btn-success btn-circle btn-sm">
                                            <i class="fas fa-check"></i></a>
                                        Biodata & Berkas Administrasi Terverifikasi
                                    </p>
                                </div>
                                <div>
                                    <h6 class="mb-3 fw-bold text-success text-end">SUDAH</h6>
                                    @foreach ($biodata as $data)
                                        <p class="fs-6 text-end">{{ $data->updated_at_submit }}</p>
                                        <p class="fs-6 text-end">{{ $data->updated_at_accepted }}</p>
                                    @endforeach
                                </div>
                            </div>
                            <div class="card-header d-flex justify-content-between py-3 align-items-center">

                                <div>
                                    <p class="mb-3 fw-bold">Hasil Tes</p>
                                    <p class="fs-6">
                                        <a href="#" class="btn btn-danger btn-circle btn-sm">
                                            <i class="fas fa-exclamation"></i></a>
                                        Nilai anda tidak memenuhi kriteria
                                    </p>

                                </div>
                                <h6 class="m-0 fw-bold text-danger">TIDAK LULUS</h6>
                            </div>
                            <div class="card-header d-flex justify-content-between py-3 align-items-center">

                                <p class="m-0">Pembayaran Administrasi</p>
                                <h6 class="m-0 fw-bold text-danger">BELUM</h6>
                            </div>
                        @elseif ($registrationStatus === 'Hasil Tes Lulus')
                            <div class="card-header d-flex justify-content-between py-3 align-items-center">

                                <div class="">
                                    <p class="mb-3 fw-bold">Pendaftaran Akun</p>
                                    <p class="fs-6">
                                        <a href="#" class="btn btn-success btn-circle btn-sm">
                                            <i class="fas fa-check"></i>
                                        </a> Akun Berhasil Registrasi
                                    </p>
                                </div>
                                <div class="">
                                    <h6 class="mb-3 fw-bold text-success text-end">SUDAH</h6>
                                    <p class="fs-6">{{ Auth::user()->created_at }}</p>
                                </div>
                            </div>
                            <div class="card-header d-flex justify-content-between py-3 align-items-center">

                                <div>
                                    <p class="mb-3 fw-bold">Pembayaran Formulir</p>
                                    <p class="fs-6">
                                        <a href="#" class="btn btn-info btn-circle btn-sm">
                                            <i class="fas fa-upload"></i></a>
                                        Bukti Pembayaran Berhasil Di Upload, Menunggu Verifikasi Admin
                                    </p>
                                    <p class="fs-6">
                                        <a href="#" class="btn btn-success btn-circle btn-sm">
                                            <i class="fas fa-check"></i></a>
                                        Pembayaran Formulir Terverifikasi
                                    </p>
                                </div>
                                <div>
                                    <h6 class="mb-3 fw-bold text-success text-end">SUDAH</h6>
                                    @foreach ($payments as $payment )
                                    @if ($payment->paymentCategory === 'formulir')
                                    <p class="fs-6">{{ $payment->updated_at_submit }}</p>
                                    <p class="fs-6">{{ $payment->updated_at_accepted }}</p>
                                @endif
                                    @endforeach
                                    

                                </div>
                            </div>
                            <div class="card-header d-flex justify-content-between py-3 align-items-center">

                                <div>
                                    <p class="mb-3 fw-bold">Pengisian Biodata & Berkas</p>
                                    <p class="fs-6">
                                        <a href="#" class="btn btn-info btn-circle btn-sm">
                                            <i class="fas fa-upload"></i></a>
                                        Biodata & Berkas Berhasil di Upload, Menunggu Verifikasi Admin
                                    </p>
                                    <p class="fs-6">
                                        <a href="#" class="btn btn-success btn-circle btn-sm">
                                            <i class="fas fa-check"></i></a>
                                        Biodata & Berkas Administrasi Terverifikasi
                                    </p>
                                </div>
                                <div>
                                    <h6 class="mb-3 fw-bold text-success text-end">SUDAH</h6>
                                    @foreach ($biodata as $data)
                                        <p class="fs-6 text-end">{{ $data->updated_at_submit }}</p>
                                        <p class="fs-6 text-end">{{ $data->updated_at_accepted }}</p>
                                    @endforeach
                                </div>
                            </div>
                            <div class="card-header d-flex justify-content-between py-3 align-items-center">

                                <div>
                                    <p class="mb-3 fw-bold">Hasil Tes</p>
                                    <p class="fs-6">
                                        <a href="#" class="btn btn-success btn-circle btn-sm">
                                            <i class="fas fa-check"></i></a>
                                        Selamat anda lulus tes masuk @isset($school)
                                            {{ $school->schoolNama }}
                                        @else
                                            NULL
                                        @endisset
                                    </p>
                                </div>
                                <h6 class="m-0 fw-bold text-success">LULUS</h6>
                            </div>
                            <div class="card-header d-flex justify-content-between py-3 align-items-center">

                                <p class="m-0">Pembayaran Administrasi</p>
                                <h6 class="m-0 fw-bold text-danger">BELUM</h6>
                            </div>
                        @elseif ($registrationStatus === 'Menunggu Verifikasi Pembayaran Administrasi')
                            <div class="card-header d-flex justify-content-between py-3 align-items-center">

                                <div class="">
                                    <p class="mb-3 fw-bold">Pendaftaran Akun</p>
                                    <p class="fs-6">
                                        <a href="#" class="btn btn-success btn-circle btn-sm">
                                            <i class="fas fa-check"></i>
                                        </a> Akun Berhasil Registrasi
                                    </p>
                                </div>
                                <div class="">
                                    <h6 class="mb-3 fw-bold text-success text-end">SUDAH</h6>
                                    <p class="fs-6">{{ Auth::user()->created_at }}</p>
                                </div>
                            </div>
                            <div class="card-header d-flex justify-content-between py-3 align-items-center">

                                <div>
                                    <p class="mb-3 fw-bold">Pembayaran Formulir</p>
                                    <p class="fs-6">
                                        <a href="#" class="btn btn-info btn-circle btn-sm">
                                            <i class="fas fa-upload"></i></a>
                                        Bukti Pembayaran Berhasil Di Upload, Menunggu Verifikasi Admin
                                    </p>
                                    <p class="fs-6">
                                        <a href="#" class="btn btn-success btn-circle btn-sm">
                                            <i class="fas fa-check"></i></a>
                                        Pembayaran Formulir Terverifikasi
                                    </p>
                                </div>
                                <div>
                                    <h6 class="mb-3 fw-bold text-success text-end">SUDAH</h6>
                                    @foreach ($payments as $payment)
                                    @if ($payment->paymentCategory === 'formulir')
                                    <p class="fs-6">{{ $payment->updated_at_submit }}</p>
                                    <p class="fs-6">{{ $payment->updated_at_accepted }}</p>
                                @endif
                                    @endforeach

                                </div>
                            </div>
                            <div class="card-header d-flex justify-content-between py-3 align-items-center">

                                <div>
                                    <p class="mb-3 fw-bold">Pengisian Biodata & Berkas</p>
                                    <p class="fs-6">
                                        <a href="#" class="btn btn-info btn-circle btn-sm">
                                            <i class="fas fa-upload"></i></a>
                                        Biodata & Berkas Berhasil di Upload, Menunggu Verifikasi Admin
                                    </p>
                                    <p class="fs-6">
                                        <a href="#" class="btn btn-success btn-circle btn-sm">
                                            <i class="fas fa-check"></i></a>
                                        Biodata & Berkas Administrasi Terverifikasi
                                    </p>
                                </div>
                                <div>
                                    <h6 class="mb-3 fw-bold text-success text-end">SUDAH</h6>
                                    @foreach ($biodata as $data)
                                        <p class="fs-6 text-end">{{ $data->updated_at_submit }}</p>
                                        <p class="fs-6 text-end">{{ $data->updated_at_accepted }}</p>
                                    @endforeach
                                </div>
                            </div>
                            <div class="card-header d-flex justify-content-between py-3 align-items-center">

                                <div>
                                    <p class="mb-3 fw-bold">Hasil Tes</p>
                                    <p class="fs-6">
                                        <a href="#" class="btn btn-success btn-circle btn-sm">
                                            <i class="fas fa-check"></i></a>
                                        Selamat anda lulus tes masuk @isset($school)
                                            {{ $school->schoolNama }}
                                        @else
                                            NULL
                                        @endisset
                                    </p>
                                </div>
                                <h6 class="m-0 fw-bold text-success">LULUS</h6>
                            </div>
                            <div class="card-header d-flex justify-content-between py-3 align-items-center">

                                <div>
                                    <p class="mb-3 fw-bold">Pembayaran Administrasi</p>
                                    <p class="fs-6">
                                        <a href="#" class="btn btn-info btn-circle btn-sm">
                                            <i class="fas fa-upload"></i></a>
                                        Bukti Pembayaran Berhasil Di Upload, Menunggu Verifikasi Admin
                                    </p>

                                </div>
                                <div>
                                    <h6 class="mb-3 fw-bold text-info text-end">MENUNGGU VERIFIKASI</h6>
                                    @foreach ($payments as $payment)
                                        @if ($payment->paymentCategory === 'administrasi')
                                        <p class="fs-6 text-end">{{ $payment->updated_at_submit }}</p>
                                        @endif
                                    @endforeach

                                </div>
                            </div>
                        @elseif ($registrationStatus === 'Pembayaran Administrasi Terverifikasi')
                            <div class="card-header d-flex justify-content-between py-3 align-items-center">

                                <div class="">
                                    <p class="mb-3 fw-bold">Pendaftaran Akun</p>
                                    <p class="fs-6">
                                        <a href="#" class="btn btn-success btn-circle btn-sm">
                                            <i class="fas fa-check"></i>
                                        </a> Akun Berhasil Registrasi
                                    </p>
                                </div>
                                <div class="">
                                    <h6 class="mb-3 fw-bold text-success text-end">SUDAH</h6>
                                    <p class="fs-6">{{ Auth::user()->created_at }}</p>
                                </div>
                            </div>
                            <div class="card-header d-flex justify-content-between py-3 align-items-center">

                                <div>
                                    <p class="mb-3 fw-bold">Pembayaran Formulir</p>
                                    <p class="fs-6">
                                        <a href="#" class="btn btn-info btn-circle btn-sm">
                                            <i class="fas fa-upload"></i></a>
                                        Bukti Pembayaran Berhasil Di Upload, Menunggu Verifikasi Admin
                                    </p>
                                    <p class="fs-6">
                                        <a href="#" class="btn btn-success btn-circle btn-sm">
                                            <i class="fas fa-check"></i></a>
                                        Pembayaran Formulir Terverifikasi
                                    </p>
                                </div>
                                <div>
                                    <h6 class="mb-3 fw-bold text-success text-end">SUDAH</h6>
                                    @foreach ($payments as $payment)
                                    @if ($payment->paymentCategory === 'formulir')
                                    <p class="fs-6">{{ $payment->updated_at_submit }}</p>
                                    <p class="fs-6">{{ $payment->updated_at_accepted }}</p>
                                @endif
                                    @endforeach

                                </div>
                            </div>
                            <div class="card-header d-flex justify-content-between py-3 align-items-center">

                                <div>
                                    <p class="mb-3 fw-bold">Pengisian Biodata & Berkas</p>
                                    <p class="fs-6">
                                        <a href="#" class="btn btn-info btn-circle btn-sm">
                                            <i class="fas fa-upload"></i></a>
                                        Biodata & Berkas Berhasil di Upload, Menunggu Verifikasi Admin
                                    </p>
                                    <p class="fs-6">
                                        <a href="#" class="btn btn-success btn-circle btn-sm">
                                            <i class="fas fa-check"></i></a>
                                        Biodata & Berkas Administrasi Terverifikasi
                                    </p>
                                </div>
                                <div>
                                    <h6 class="mb-3 fw-bold text-success text-end">SUDAH</h6>
                                    @foreach ($biodata as $data)
                                        <p class="fs-6 text-end">{{ $data->updated_at_submit }}</p>
                                        <p class="fs-6 text-end">{{ $data->updated_at_accepted }}</p>
                                    @endforeach
                                </div>
                            </div>
                            <div class="card-header d-flex justify-content-between py-3 align-items-center">

                                <div>
                                    <p class="mb-3 fw-bold">Hasil Tes</p>
                                    <p class="fs-6">
                                        <a href="#" class="btn btn-success btn-circle btn-sm">
                                            <i class="fas fa-check"></i></a>
                                        Selamat anda lulus tes masuk @isset($school)
                                        {{ $school->schoolNama }}
                                    @else
                                        NULL
                                    @endisset
                                    </p>

                                </div>
                                <h6 class="m-0 fw-bold text-success">LULUS</h6>
                            </div>
                            <div class="card-header d-flex justify-content-between py-3 align-items-center">

                                <div>
                                    <p class="mb-3 fw-bold">Pembayaran Administrasi</p>
                                    <p class="fs-6">
                                        <a href="#" class="btn btn-info btn-circle btn-sm">
                                            <i class="fas fa-upload"></i></a>
                                        Bukti Pembayaran Berhasil Di Upload, Menunggu Verifikasi Admin
                                    </p>
                                    <p class="fs-6">
                                        <a href="#" class="btn btn-success btn-circle btn-sm">
                                            <i class="fas fa-check"></i></a>
                                        Pembayaran Administrasi Terverifikasi
                                    </p>
                                </div>
                                <div>
                                    <h6 class="mb-3 fw-bold text-success text-end">SUDAH</h6>
                                    @foreach ($payments as $payment)
                                    @if ($payment->paymentCategory === 'administrasi')
                                    <p class="fs-6">{{ $payment->updated_at_submit }}</p>
                                    <p class="fs-6">{{ $payment->updated_at_accepted }}</p>
                                @endif
                                    @endforeach

                                </div>
                            </div>

                        @elseif ($registrationStatus === 'Butuh Revisi Pembayaran Administrasi')
                            <div class="card-header d-flex justify-content-between py-3 align-items-center">

                                <div class="">
                                    <p class="mb-3 fw-bold">Pendaftaran Akun</p>
                                    <p class="fs-6">
                                        <a href="#" class="btn btn-success btn-circle btn-sm">
                                            <i class="fas fa-check"></i>
                                        </a> Akun Berhasil Registrasi
                                    </p>
                                </div>
                                <div class="">
                                    <h6 class="mb-3 fw-bold text-success text-end">SUDAH</h6>
                                    <p class="fs-6">{{ Auth::user()->created_at }}</p>
                                </div>
                            </div>
                            <div class="card-header d-flex justify-content-between py-3 align-items-center">

                                <div>
                                    <p class="mb-3 fw-bold">Pembayaran Formulir</p>
                                    <p class="fs-6">
                                        <a href="#" class="btn btn-info btn-circle btn-sm">
                                            <i class="fas fa-upload"></i></a>
                                        Bukti Pembayaran Berhasil Di Upload, Menunggu Verifikasi Admin
                                    </p>
                                    <p class="fs-6">
                                        <a href="#" class="btn btn-success btn-circle btn-sm">
                                            <i class="fas fa-check"></i></a>
                                        Pembayaran Formulir Terverifikasi
                                    </p>
                                </div>
                                <div>
                                    <h6 class="mb-3 fw-bold text-success text-end">SUDAH</h6>
                                    @foreach ($payments as $payment)
                                    @if ($payment->paymentCategory === 'formulir')
                                    <p class="fs-6">{{ $payment->updated_at_submit }}</p>
                                    <p class="fs-6">{{ $payment->updated_at_accepted }}</p>
                                @endif
                                    @endforeach

                                </div>
                            </div>
                            <div class="card-header d-flex justify-content-between py-3 align-items-center">

                                <div>
                                    <p class="mb-3 fw-bold">Pengisian Biodata & Berkas</p>
                                    <p class="fs-6">
                                        <a href="#" class="btn btn-info btn-circle btn-sm">
                                            <i class="fas fa-upload"></i></a>
                                        Biodata & Berkas Berhasil di Upload, Menunggu Verifikasi Admin
                                    </p>
                                    <p class="fs-6">
                                        <a href="#" class="btn btn-success btn-circle btn-sm">
                                            <i class="fas fa-check"></i></a>
                                        Biodata & Berkas Administrasi Terverifikasi
                                    </p>
                                </div>
                                <div>
                                    <h6 class="mb-3 fw-bold text-success text-end">SUDAH</h6>
                                    @foreach ($biodata as $data)
                                        <p class="fs-6 text-end">{{ $data->updated_at_submit }}</p>
                                        <p class="fs-6 text-end">{{ $data->updated_at_accepted }}</p>
                                    @endforeach
                                </div>
                            </div>
                            <div class="card-header d-flex justify-content-between py-3 align-items-center">

                                <div>
                                    <p class="mb-3 fw-bold">Hasil Tes</p>
                                    <p class="fs-6">
                                        <a href="#" class="btn btn-success btn-circle btn-sm">
                                            <i class="fas fa-check"></i></a>
                                        Selamat anda lulus tes masuk @isset($school)
                                        {{ $school->schoolNama }}
                                        @endisset
                                    </p>

                                </div>
                                <h6 class="m-0 fw-bold text-success">LULUS</h6>
                            </div>
                            <div class="card-header d-flex justify-content-between py-3 align-items-center">

                                <div>
                                    <p class="mb-3 fw-bold">Pembayaran Administrasi</p>
                                    <p class="fs-6">
                                        <a href="#" class="btn btn-info btn-circle btn-sm">
                                            <i class="fas fa-upload"></i></a>
                                        Bukti Pembayaran Berhasil Di Upload, Menunggu Verifikasi Admin
                                    </p>
                                    <p class="fs-6">
                                        <a href="#" class="btn btn-warning btn-circle btn-sm">
                                            <i class="fas fa-exclamation"></i></a>
                                            Butuh Revisi Bukti Pembayaran Administrasi, Cek Alasan Penolakan
                                    </p>
                                </div>
                                <div>
                                    <h6 class="mb-3 fw-bold text-warning text-end">BUTUH REVISI</h6>
                                    @foreach ($payments as $payment)
                                        @if ($payment->paymentCategory === 'administrasi')
                                        <p class="fs-6 text-end">{{ $payment->updated_at_submit }}</p>
                                        <p class="fs-6 text-end">{{ $payment->updated_at_revision }}</p>
                                        @endif
                                    @endforeach

                                </div>
                            </div>

                        @endif
                    @endforeach
                @endif
            @endforeach

        </div>

        <!-- Content -->
        @if ($registrationStatus === 'Pendaftaran Akun Selesai')
            <div id="paymentForm" class="card shadow mb-4">
                <div class="card-header d-flex justify-content-between py-3 align-items-center">

                    <p class="m-0">Pembayaran Formulir</p>
                    <h6 class="m-0 fw-bold text-primary">BELUM LUNAS</h6>
                </div>

                <div class="card-body">
                    <p>Biaya Pendaftaran</p>
                    
                    <h2 class="fs-2 fw-bold mb-4">Rp. @isset($school->schoolBiayaFormulir)
                        {{ number_format($school->schoolBiayaFormulir, 0, ',', '.') }}
                        @else
                            Menunggu Konfirmasi dari Admin
                    @endisset</h2>
                   
            
            
                    <p>Silahkan melakukan transfer ke </p>
                    <p class="fs-4 fw-bold">
                        @isset($school->schoolNomorRekening)
                            {{ $school->schoolNomorRekening }}
                        @else
                            Menunggu Konfirmasi dari Admin
                        @endisset
                        a/n
                        @isset($school->schoolNamaRekening)
                            {{ $school->schoolNamaRekening }}
                        @else
                            NULL
                        @endisset
                    </p>
                </div>
                <div class="card-body">
                    <p>Sesuai dengan nominal tertera untuk memudahkan kami melakukan pengecekan, kemudian lakukan konfirmasi
                        bukti pembayaran tombol dibawah ini.</p>
                        <div class="mb-4 mt-5">
                            <form action="{{ route('user.payment.store') }}" method="POST" enctype="multipart/form-data" class="row g-3 align-items-center">
                                @csrf
                                <input type="hidden" name="paymentCategory" value="formulir">
                                <input type="hidden" name="{{ $school->schoolBiayaFormulir ?? 'Menunggu Data' }}">
                                
                                <div class="col-md">
                                    <input class="form-control form-control-lg" name="paymentProof" type="file">
                                </div>
                        
                                <div class="col-md-auto">
                                    <button type="submit" class="btn btn-primary btn-lg btn-block"><i class="fas fa-download fa-sm text-white-50"></i> Konfirm</button>
                                </div>
                            </form>
                        </div>
                        
                    <p>
                        *Perlu mengupload bukti pembayaran sebelum melakukan konfirmasi pembayaran
                    </p>
                </div>
            </div>
        @elseif ($registrationStatus === 'Menunggu Verifikasi Pembayaran Formulir')
            <div id="paymentFormWaitingVerification" class="card shadow mb-4">
                <div class="card-header d-flex justify-content-between py-3 align-items-center">

                    <p class="m-0">Pembayaran Formulir</p>
                    <h6 class="m-0 fw-bold text-primary">MENUNGGU VERIFIKASI</h6>
                </div>
                <div class="mb-3 card-body">
                    <p class="fs-4 fw-bold">Terima Kasih telah melakukan Pembayaran Formulir</p>
                    <p>Kami sedang melakukan verifikasi pada pembayaran anda, mohon kesediannya untuk menunggu dalam 1x24
                        jam di
                        hari dan jam kerja.</p>
                </div>

            </div>
        @elseif ($registrationStatus === 'Butuh Revisi Pembayaran Formulir')
            <div id="paymentFormNeedRevision" class="card shadow mb-4">
                <div class="card-header d-flex justify-content-between py-3 align-items-center">

                    <p class="m-0">Pembayaran Formulir</p>
                    <h6 class="m-0 fw-bold text-warning">BUTUH REVISI</h6>
                </div>

                <div class="card-body">
                    <div class="mb-5">
                        <p>Mohon maaf, bukti pembayaran anda telah di tolak oleh admin sekolah dengan alasan :</p>
                        <p class="fw-bold text-info fs-3">
                            @foreach ($payments as $payment)
                                {{ $payment->rejectionReason }}
                            @endforeach
                        </p>
                    </div>

                    <p>Biaya Pendaftaran</p>
                    <h2 class="fs-2 fw-bold mb-4">Rp. {{ number_format($school->schoolBiayaFormulir, 0, ',', '.') }}</h2>
                    <p>Silahkan melakukan transfer ke </p>
                    <p class="fs-4 fw-bold">
                        @isset($school->schoolNomorRekening)
                            {{ $school->schoolNomorRekening }}
                        @else
                            Menunggu Konfirmasi dari Admin
                        @endisset
                        a/n
                        @isset($school->schoolNamaRekening)
                            {{ $school->schoolNamaRekening }}
                        @else
                            NULL
                        @endisset
                    </p>
                </div>
                <div class="card-body">
                    <p>Sesuai dengan nominal tertera untuk memudahkan kami melakukan pengecekan, kemudian lakukan konfirmasi
                        bukti pembayaran tombol dibawah ini.</p>
                    <div class="d-sm-flex align-items-center justify-content-between mb-4 mt-5">


                        <form action="{{ route('user.payment.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="paymentCategory" value="formulir">
                            <input class="form-control form-control-lg w-50 me-3" name="paymentProof" type="file">
                            <button type="submit" class="p-3 m-2 fs-5 btn btn-sm btn-primary shadow-sm"
                                formmethod="post"><i class="fas fa-download fa-sm text-white-50"></i>Konfirm</button>
                        </form>


                    </div>
                    <p>
                        *Perlu mengupload bukti pembayaran sebelum melakukan konfirmasi pembayaran
                    </p>
                </div>

            </div>
        @elseif ($registrationStatus === 'Pembayaran Formulir Terverifikasi')
            <div id="paymentAdministrativeWaitingVerification" class="card shadow mb-4">
                <div class="card-header d-flex justify-content-between py-3 align-items-center">

                    <p class="m-0">Pembayaran Formulir</p>
                    <h6 class="m-0 fw-bold text-primary">TERVERIFIKASI</h6>
                </div>
                <div class="mb-3 card-body">
                    <p class="fs-4 fw-bold">Terima Kasih telah melakukan Pembayaran Formulir</p>
                    <p>Bukti pembayaran formulir anda sudah kami terima dan verifikasi, silahkan lanjutkan dengan melakukan
                        Pengisian Biodata & Administrasi</p>
                </div>

            </div>

            <div id="biodataSyaratKetentuan" class="card shadow mb-4">
                <div class="card-header d-flex justify-content-between py-3 align-items-center">
                    <h5 class="fw-bold ">Syarat & Ketentuan Pendaftaran</h5>
                </div>
                    <div class="card-body">
                        <p class="w-100">{!! nl2br(e($school->schoolSyaratKetentuanPendaftaran)) !!}</p>
                        <a href="/user/pengisian-biodata" class="btn btn-sm btn-primary w-100 shadow-sm p-2 fs-4">Lanjut ke
                            Pengisian Biodata & Berkas</a>
                    </div>
                      



                
            </div>
        @elseif ($registrationStatus === 'Menunggu Verifikasi Biodata & Berkas')
            <div id="biodataWaitingVerification" class="card shadow mb-4">
                <div class="card-header d-flex justify-content-between py-3 align-items-center">

                    <p class="m-0">Biodata & Administrasi</p>
                    <h6 class="m-0 fw-bold text-primary">MENUNGGU VERIFIKASI</h6>
                </div>
                <div class="mb-3 card-body">
                    <p class="fs-4 fw-bold">Terima Kasih telah melakukan pengisian Biodata & Administrasi yang dibutuhkan
                        oleh
                        sekolah.</p>
                    <p>Kami sedang melakukan verifikasi pada administrasi anda, mohon kesediannya untuk menunggu dalam 3x24
                        jam
                        di
                        hari dan jam kerja.</p>
                </div>

            </div>
        @elseif ($registrationStatus === 'Butuh Revisi Biodata & Berkas')
            <div id="biodataNeedRevision" class="card shadow mb-4">
                <div class="card-header d-flex justify-content-between py-3 align-items-center">

                    <p class="m-0">Biodata & Administrasi</p>
                    <h6 class="m-0 fw-bold text-warning">BUTUH REVISI</h6>
                </div>
                <div class="mb-3 card-body">
                    <p>Mohon maaf, setelah dilakukan verifikasi berkas anda butuh revisi dengan alasan :</p>
                    <p class="fw-bold text-info fs-3 mb-3">
                        @foreach ($biodata as $data)
                            {{ $data->rejectionReason }}
                        @endforeach
                    </p>

                    <p>Mohon melakukan revisi berkas untuk dapat melanjutkan ke tahap berikutnya.</p>
                    @foreach ($biodata as $data)
                    <a href="/user/pengisian-biodata" class="btn btn-lg btn-primary w-100">Revisi Biodata & Administrasi</a>
                    @endforeach
                </div>

            </div>
        @elseif ($registrationStatus === 'Biodata & Berkas Terverifikasi')
            <div id="biodataApproved" class="card shadow mb-4">
                <div class="card-header d-flex justify-content-between py-3 align-items-center">

                    <p class="m-0">Biodata & Administrasi</p>
                    <h6 class="m-0 fw-bold text-primary">TELAH DITERIMA</h6>
                </div>
                <div class="mb-3 card-body">
                    <p class="fs-4 fw-bold">Terima Kasih telah melakukan pengisian Biodata & Administrasi yang dibutuhkan
                        oleh
                        sekolah.</p>
                    <p>Mohon kesediaannya menunggu hingga Jadwal Tes & Hasil Tes telah diberikan.</p>
                </div>

            </div>
            <div class="card shadow mb-4">
                <div class="card-header">
                    <p class="fw-bold fs-5 text-primary m-0">Bantu Kami Menjadi Lebih Baik</p>
                </div>
                <div class="card-body">
                    <p>Terima kasih telah melakukan pendaftaran, bantu kami untuk memberikan pelayanan terbaik bagi anda kedepannya dengan mengisi survey melalui tombol dibawah ini. Masukan dan kritikan anda sangat kami hargai.</p>
                    <a href="/user/survey" class="btn btn-sm btn-primary w-100 shadow-sm p-2 fs-4">Isi Survey Disini</a>
                    <p class="fs-6">*Abaikan jika telah mengisi survey</p>
                </div>
            </div>
        @elseif ($registrationStatus === 'Jadwal Tes Terkonfirmasi')
            <div id="jadwalTes" class="card shadow mb-4">
                <div class="card-header d-flex justify-content-between py-3 align-items-center">

                    <p class="m-0">Jadwal Tes</p>
                    <h6 class="m-0 fw-bold text-primary"></h6>
                </div>
                <div class="mb-3 card-body">
                    <p class="fs-4 fw-bold">Jadwal Tes anda sudah tampil</p>
                    <p>Tes dilaksanakan di Gedung @isset($school)
                            {{ $school->schoolNama }}
                        @else
                            NULL
                        @endisset
                    </p>
                </div>

            </div>
        @elseif($registrationStatus === 'Hasil Tes Gagal')
            <div id="hasilTesGagal" class="card shadow mb-4">
                <div class="card-header d-flex justify-content-between py-3 align-items-center">

                    <p class="m-0">Hasil Tes</p>
                    <h6 class="m-0 fw-bold text-danger">Tidak Lulus</h6>
                </div>
                <div class="mb-3 card-body">
                    <p class="fs-4 fw-bold">Terima kasih telah mengikuti proses pendaftaran di
                        @isset($school)
                            {{ $school->schoolNama }}
                        @else
                            NULL
                        @endisset </p>
                    <p>Setelah melakukan penilaian hasil tes, mohon maaf saudara
                        @foreach ($biodata as $data)
                            <b>{{ $data->namaLengkap }}</b>
                        @endforeach
                        belum memenuhi minimum kriteria yang
                        dibutuhkan oleh @isset($school)
                            {{ $school->schoolNama }}
                        @else
                            NULL
                        @endisset
                        . Kami menghargai usaha dan partisipasi anda dalam proses pendaftaran siswa baru. Tetap semangat dan
                        mempersiapkan diri lebih baik untuk
                        kesempatan mendatang. Terima kasih telah mengikuti pendaftaran siswa baru di
                        @isset($school)
                            {{ $school->schoolNama }}
                        @else
                            NULL
                        @endisset.
                    </p>
                </div>

            </div>
        @elseif($registrationStatus === 'Hasil Tes Lulus')
            <div id="hasilTesLulus" class="card shadow mb-4">
                <div class="card-header d-flex justify-content-between py-3 align-items-center">
                    <div class="d-flex flex-column justify-content-center align-items-start">
                        <p class="m-0">Hasil Tes</p>
                        <h6 class="m-0 fw-bold text-primary">LULUS</h6>
                    </div>
                    <div class="d-flex flex-column justify-content-center align-items-end">
                        <p class="m-0">Batas Akhir Pendaftaran</p>
                        <h6 class="m-0 fw-bold text-info">{{ $school->schoolBatasPendaftaran }}</h6>
                    </div>
                </div>
        
                <div class="card-body">
                    <p class="">Setelah melakukan penilaian hasil tes, kami dengan senang hati mengumumkan bahwa
                        saudara <b>
                            @foreach ($biodata as $data)
                                {{ $data->namaLengkap }}
                            @endforeach
                        </b>
                        telah berhasil lolos seleksi @isset($school)
                            {{ $school->schoolNama }}
                        @else
                            NULL
                        @endisset. </p>
                    <p>Selanjutnya, mohon untuk melunasi biaya administrasi sebelum tanggal Batas Akhir Pendaftaran.</p>
                    <p>Biaya Pendaftaran</p>
                    <p class="fs-2 fw-bold mb-4">Rp. {{ number_format($payment->paymentAmount, 0, ',', '.') }}</p>
                    <p class="mt-5">Silahkan melakukan transfer ke </p>
                    <p class="fs-4 fw-bold">
                        @isset($school)
                            {{ $school->schoolNomorRekening }}
                        @else
                            NULL
                        @endisset a/n @isset($school)
                            {{ $school->schoolNamaRekening }}
                        @else
                            NULL
                        @endisset
                    </p>
                    <p class="mt-5">Sesuai dengan nominal tertera untuk memudahkan kami melakukan pengecekan, kemudian
                        lakukan konfirmasi
                        bukti pembayaran tombol dibawah ini.</p>
                        <div class="mb-4 mt-5">
                            <form action="{{ route('user.payment.store') }}" method="POST" enctype="multipart/form-data" class="row g-3 align-items-center">
                                @csrf
                                <input type="hidden" name="paymentCategory" value="administrasi">
                                
                                <div class="col-md">
                                    <input class="form-control form-control-lg" name="paymentProof" type="file" required>
                                </div>
                        
                                <div class="col-md-auto mt-sm-3">
                                    <button type="submit" class="btn btn-primary btn-lg btn-block"><i class="fas fa-download fa-sm text-white-50"></i> Upload Bukti Pembayaran</button>
                                </div>
                            </form>
                        </div>
                        
        
                </div>
            </div>
        @elseif($registrationStatus === 'Menunggu Verifikasi Pembayaran Administrasi')
                <div id="paymentAdministrativeWaitingVerification" class="card shadow mb-4">
                    <div class="card-header d-flex justify-content-between py-3 align-items-center">

                        <p class="m-0">Pembayaran Administrasi</p>
                        <h6 class="m-0 fw-bold text-primary">MENUNGGU VERIFIKASI</h6>
                    </div>
                    <div class="mb-3 card-body">
                        <p class="fs-4 fw-bold">Terima Kasih telah melakukan Pembayaran Administrasi</p>
                        <p>Kami sedang melakukan verifikasi pada pembayaran anda, mohon kesediannya untuk menunggu dalam
                            2x24
                            jam di
                            hari dan jam kerja.</p>
                    </div>

                </div>
        @elseif ($registrationStatus === 'Butuh Revisi Pembayaran Administrasi')
                <div id="paymentAdministrativeNeedRevision" class="card shadow mb-4">
                    <div class="card-header d-flex justify-content-between py-3 align-items-center">

                        <p class="m-0">Pembayaran Administrasi</p>
                        <h6 class="m-0 fw-bold text-warning">BUTUH REVISI</h6>
                    </div>

                    <div class="card-body">
                        <div class="mb-5">
                            <p>Mohon maaf, bukti pembayaran anda telah di tolak oleh admin sekolah dengan alasan :</p>
                            <p class="fw-bold text-info fs-3">
                                @foreach ($payments as $payment)
                                    @if ($payment->paymentCategory === 'administrasi')
                                        {{ $payment->rejectionReason }}
                                    @endif
                                @endforeach
                            </p>
                        </div>

                        <p>Biaya Pendaftaran</p>
                    <p class="fs-2 fw-bold mb-4">Rp. {{ number_format($payment->paymentAmount, 0, ',', '.') }}</p>
                    <p class="mt-5">Silahkan melakukan transfer ke </p>
                    <p class="fs-4 fw-bold">
                        @isset($school)
                            {{ $school->schoolNomorRekening }}
                        @else
                            NULL
                        @endisset a/n @isset($school)
                            {{ $school->schoolNamaRekening }}
                        @else
                            NULL
                        @endisset
                    </p>
                    </div>
                    <div class="card-body">
                        <p>Sesuai dengan nominal tertera untuk memudahkan kami melakukan pengecekan, kemudian lakukan
                            konfirmasi
                            bukti pembayaran tombol dibawah ini.</p>
                        <div class="d-sm-flex align-items-center justify-content-between mb-4 mt-5">


                            <form action="{{ route('user.payment.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="paymentCategory" value="administrasi">
                                <input class="form-control form-control-lg w-50 me-3" name="paymentProof" type="file">
                                <button type="submit" class="p-3 m-2 fs-5 btn btn-sm btn-primary shadow-sm"
                                    formmethod="post"><i class="fas fa-download fa-sm text-white-50"></i>Konfirm</button>
                            </form>


                        </div>
                        <p>
                            *Perlu mengupload bukti pembayaran sebelum melakukan konfirmasi pembayaran
                        </p>
                    </div>

                </div>
        @elseif ($registrationStatus === 'Pembayaran Administrasi Terverifikasi')
                <div id="congratulations" class="card shadow mb-4">
                    <div class="card-header d-flex justify-content-between py-3 align-items-center">

                        <p class="m-0 fw-bold">CONGRATULATIONS</p>
                        <h6 class="m-0 fw-bold text-primary">SELESAI</h6>
                    </div>
                    <div class="mb-3 card-body">
                        <p class="fs-4 fw-bold">Anda telah memenuhi seluruh persyaratan pendaftaran di
                            @isset($school)
                                {{ $school->schoolNama }}
                            @else
                                NULL
                            @endisset
                        </p>
                        <p>Informasi selanjutnya terkait pembelian baju, buku dan hal lainnya akan disampaikan kemudian.
                            Terima
                            kasih telah memilih @isset($school)
                                {{ $school->schoolNama }}
                            @else
                                NULL
                            @endisset!</p>
                    </div>

                </div>
        @endif


    </div>



    </div>
    </div>
    </div>


@endsection
