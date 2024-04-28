@extends('layouts.user')

@section('content')
    <div class="container-fluid">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @elseif (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <div class="d-sm-flex align-items-center justify-content-between mb-5 mt-5">
            <h1 class="h3 mb-0 text-dark">Dashboard</h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm"><i
                    class="fas fa-warning fa-sm text-white-50"></i> Bantuan</a>
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
                                    </a> Akun Berhasil Registrasi</p>
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
                                    </a> Akun Berhasil Registrasi</p>
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
                                </a> Akun Berhasil Registrasi</p>
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
                                    Bukti Pembayaran Berhasil Di Upload</p>
                                <p class="fs-6">
                                    <a href="#" class="btn btn-warning btn-circle btn-sm">
                                    <i class="fas fa-exclamation"></i></a>
                                    Butuh Revisi Bukti Pembayaran Formulir</p>
                            </div>
                            <div>
                                <h6 class="mb-3 fw-bold text-warning text-end">BUTUH REVISI</h6>
                                @foreach ($payments as $payment )
                                <p class="fs-6">{{ $payment->updated_at_submit}}</p>
                                    <p class="fs-6">{{ $payment->updated_at_revision}}</p>
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
                                </a> Akun Berhasil Registrasi</p>
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
                                    Bukti Pembayaran Berhasil Di Upload, Menunggu Verifikasi Admin</p>
                                <p class="fs-6">
                                        <a href="#" class="btn btn-success btn-circle btn-sm">
                                        <i class="fas fa-check"></i></a>
                                        Pembayaran Formulir Terverifikasi</p>
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
                                </a> Akun Berhasil Registrasi</p>
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
                                    Bukti Pembayaran Berhasil Di Upload, Menunggu Verifikasi Admin</p>
                                <p class="fs-6">
                                        <a href="#" class="btn btn-success btn-circle btn-sm">
                                        <i class="fas fa-check"></i></a>
                                        Pembayaran Formulir Terverifikasi</p>
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

                            <div>
                                <p class="mb-3 fw-bold">Pengisian Biodata & Berkas</p>
                                <p class="fs-6">
                                    <a href="#" class="btn btn-info btn-circle btn-sm">
                                    <i class="fas fa-upload"></i></a>
                                    Biodata & Berkas Berhasil di Upload, Menunggu Verifikasi Admin</p>

                            </div>
                            <div>
                                <h6 class="mb-3 fw-bold text-info text-end">MENUNGGU VERIFIKASI</h6>
                                @foreach ($biodata as $data)
                                <p class="fs-6">{{ $data->updated_at_submit}}</p>
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

                            <p class="m-0">Pendaftaran Akun</p>
                            <h6 class="m-0 fw-bold text-success">SUDAH</h6>
                        </div>
                        <div class="card-header d-flex justify-content-between py-3 align-items-center">

                            <p class="m-0">Pembayaran Formulir</p>
                            <h6 class="m-0 fw-bold text-success">SUDAH</h6>
                        </div>
                        <div class="card-header d-flex justify-content-between py-3 align-items-center">

                            <p class="m-0">Pengisian Biodata & Berkas</p>
                            <h6 class="m-0 fw-bold text-warning">BUTUH REVISI</h6>
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

                            <p class="m-0">Pendaftaran Akun</p>
                            <h6 class="m-0 fw-bold text-success">SUDAH</h6>
                        </div>
                        <div class="card-header d-flex justify-content-between py-3 align-items-center">

                            <p class="m-0">Pembayaran Formulir</p>
                            <h6 class="m-0 fw-bold text-success">SUDAH</h6>
                        </div>
                        <div class="card-header d-flex justify-content-between py-3 align-items-center">

                            <p class="m-0">Pengisian Biodata & Berkas</p>
                            <h6 class="m-0 fw-bold text-success">SUDAH</h6>
                        </div>
                        <div class="card-header d-flex justify-content-between py-3 align-items-center">

                            <p class="m-0">Hasil Tes</p>
                            <h6 class="m-0 fw-bold text-danger">BELUM</h6>
                        </div>
                        <div class="card-header d-flex justify-content-between py-3 align-items-center">

                            <p class="m-0">Pembayaran Administrasi</p>
                            <h6 class="m-0 fw-bold text-danger">BELUM</h6>
                        </div>


                        @endif
                    @endforeach
                @endif
            @endforeach

        </div>

        @if ($registrationStatus === 'Pendaftaran Akun Selesai')
            <div id="paymentForm" class="card shadow mb-4">
                <div class="card-header d-flex justify-content-between py-3 align-items-center">

                    <p class="m-0">Pembayaran Formulir</p>
                    <h6 class="m-0 fw-bold text-primary">BELUM LUNAS</h6>
                </div>

                <div class="card-body">
                    <p>Biaya Pendaftaran</p>
                    {{-- @foreach ($payments as $payment)
            <h2 class="fs-2 fw-bold mb-4">Rp. {{ $payment->paymentAmount }}</h2>
            @endforeach --}}
                    <p>Silahkan melakukan transfer ke </p>
                    <p class="fs-4 fw-bold">0706012010052 a/n MICHAEL CHANDRA</p>
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
                    {{-- @foreach ($payments as $payment)
            <h2 class="fs-2 fw-bold mb-4">Rp. {{ $payment->paymentAmount }}</h2>
            @endforeach --}}
                    <p>Silahkan melakukan transfer ke </p>
                    <p class="fs-4 fw-bold">0706012010052 a/n MICHAEL CHANDRA</p>
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
                <div class="card-header d-flex flex-column justify-content-between py-3 align-items-start">


                    <h5 class="mb-3 fw-bold ">Syarat & Ketentuan Pendaftaran</h5>



                    <div class="mb-3 card">
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore accusamus, at blanditiis
                            inventore
                            ad optio laudantium alias veniam eveniet fuga consequuntur eaque maiores architecto temporibus
                            obcaecati voluptas. Voluptatibus, adipisci ipsum!</p>
                    </div>

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
                    {{-- <p>{{ $rejectionReason }}</p> --}}

                    <p>Mohon untuk melakukan revisi berkas sebelum tanggal penutupan pendaftaran</p>
                    <a href="/user/pengisian-biodata" class="btn btn-sm btn-primary w-100 shadow-sm p-2 fs-4">Revisi
                        Pengisian Biodata & Berkas</a>
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
                    <p>Mohon kesediaannya menunggu hingga Jadwal Tes telah diberikan.</p>
                </div>

            </div>
        @elseif ($registrationStatus === 'Jadwal Tes Terkonfirmasi')
            <div id="jadwalTes" class="card shadow mb-4">
                <div class="card-header d-flex justify-content-between py-3 align-items-center">

                    <p class="m-0">Jadwal Tes</p>
                    <h6 class="m-0 fw-bold text-primary">12 APRIL 2024</h6>
                </div>
                <div class="mb-3 card-body">
                    <p class="fs-4 fw-bold">Jadwal Tes anda sudah tampil</p>
                    <p>Tes dilaksanakan pada tanggal 12 April 2024 di Lt. 3 SMA Zion Makassar</p>
                </div>

            </div>
        @elseif($registrationStatus === 'Hasil Tes Gagal')
            <div id="hasilTesGagal" class="card shadow mb-4">
                <div class="card-header d-flex justify-content-between py-3 align-items-center">

                    <p class="m-0">Hasil Tes</p>
                    <h6 class="m-0 fw-bold text-danger">Tidak Lulus</h6>
                </div>
                <div class="mb-3 card-body">
                    <p class="fs-4 fw-bold">Terima kasih telah mengikuti proses pendaftaran di SMA Zion Makassar. </p>
                    <p>Setelah melakukan penilaian hasil tes, mohon maaf saudara XXXXX belum memenuhi minimum kriteria yang
                        dibutuhkan oleh SMA Zion.
                        Kami menghargai usaha dan partisipasi anda dalam proses pendaftaran siswa baru. Tetap semangat dan
                        mempersiapkan diri lebih baik untuk
                        kesempatan mendatang. Terima kasih atas telah mengikuti pendaftaran siswa baru di SMA Zion Makassar.
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
                        <h6 class="m-0 fw-bold text-info">24 Maret 2024</h6>
                    </div>
                </div>

                <div class="card-body">
                    <p class="fw-bold">Setelah melakukan penilaian hasil tes, kami dengan senang hati mengumumkan bahwa
                        saudara XXXXX telah berhasil lolos seleksi SMA Zion Makassar. </p>
                    <p>Selanjutnya, mohon untuk melunasi biaya administrasi sebelum tanggal Batas Akhir Pendaftaran.</p>
                    <p>Biaya Pendaftaran</p>
                    <p class="mt-5">Silahkan melakukan transfer ke </p>
                    <p class="fs-4 fw-bold">0706012010052 a/n MICHAEL CHANDRA</p>
                    <p class="mt-5">Sesuai dengan nominal tertera untuk memudahkan kami melakukan pengecekan, kemudian
                        lakukan konfirmasi
                        bukti pembayaran tombol dibawah ini.</p>
                    <div class="d-sm-flex align-items-center justify-content-between mb-4 mt-5">


                        <form action="{{ route('user.payment.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="paymentCategory" value="administrasi">
                            <input class="form-control form-control-lg w-50 me-3" name="paymentProof" type="file">
                            <button type="submit" class="p-3 m-2 fs-5 btn btn-sm btn-primary shadow-sm"
                                formmethod="post"><i class="fas fa-download fa-sm text-white-50"></i>Upload Bukti
                                Pembayaran</button>
                        </form>
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
                        <p>Mohon maaf, bukti pembayaran anda telah di tolak oleh admin sekolah dengan alasan :</p>
                        <p>Biaya Pendaftaran</p>
                        {{-- @foreach ($payments as $payment)
            <h2 class="fs-2 fw-bold mb-4">Rp. {{ $payment->paymentAmount }}</h2>
            @endforeach --}}
                        <p>Silahkan melakukan transfer ke </p>
                        <p class="fs-4 fw-bold">0706012010052 a/n MICHAEL CHANDRA</p>
                    </div>
                    <div class="card-body">
                        <p>Sesuai dengan nominal tertera untuk memudahkan kami melakukan pengecekan, kemudian lakukan
                            konfirmasi
                            bukti pembayaran tombol dibawah ini.</p>
                        <div class="d-sm-flex align-items-center justify-content-between mb-4 mt-5">


                            <form action="{{ route('user.payment.store') }}" method="POST"
                                enctype="multipart/form-data">
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
            @elseif ($registrationStatus === 'Seluruh Berkas Telah Memenuhi Syarat Pendaftaran')
                <div id="congratulations" class="card shadow mb-4">
                    <div class="card-header d-flex justify-content-between py-3 align-items-center">

                        <p class="m-0 fw-bold">CONGRATULATIONS</p>
                        <h6 class="m-0 fw-bold text-primary">SELESAI</h6>
                    </div>
                    <div class="mb-3 card-body">
                        <p class="fs-4 fw-bold">Anda telah memenuhi seluruh persyaratan pendaftaran di SMA Zion Makassar
                        </p>
                        <p>Informasi selanjutnya terkait pembelian baju, buku dan hal lainnya akan disampaikan kemudian.
                            Terima
                            kasih telah memilih SMA Zion Makassar!</p>
                    </div>

                </div>
        @endif


    </div>



    </div>
    </div>
    </div>


@endsection
