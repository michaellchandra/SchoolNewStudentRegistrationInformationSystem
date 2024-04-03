@extends('layouts.admin')

@section('content')

    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4 mt-5">
            <h1 class="h3 mb-0 text-dark">Pembayaran</h1>
            {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> --}}
        </div>

        <div class="row">
            <!-- Total Pendaftar -->
            <div class="col mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2 p-3">
                                <div class="font-weight-bold text-primary text-uppercase mb-1">
                                    Pending Transaction</div>
                                <div class="h1 mb-0 font-weight-bold text-gray-800">231</div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2 p-3">
                                <div class="font-weight-bold text-primary text-uppercase mb-1">
                                   Pembayaran Formulir Berhasil</div>
                                <div class="h1 mb-0 font-weight-bold text-gray-800">40</div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2 p-3">
                                <div class="font-weight-bold text-primary text-uppercase mb-1">
                                   Pembayaran Administrasi Lunas</div>
                                <div class="h1 mb-0 font-weight-bold text-gray-800">50</div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            
        </div>

        <!-- Pembayaran Menunggu Verifikasi -->
        <div class="card shadow mb-4">
            <div class="card-header d-flex justify-content-between py-3 align-items-center">
                <h5 class="m-0 fw-bold text-primary">Menunggu Verifikasi Pembayaran</h5>
                <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Lihat Semua</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="th-sm-1">No.</th>
                                <th>Nama Lengkap</th>
                                <th>Nominal</th>
                                <th>Bukti Pembayaran</th>
                                <th>Kategori</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1.</td>
                                <td>Michael Chandra</td>
                                <td>Rp 150.000</td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-primary w-100 shadow-sm">Lihat Bukti</a>
                                </td>
                                <td>Formulir</td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-primary shadow-sm">Verifikasi</a>
                                    <a href="#" class="btn btn-sm btn-danger shadow-sm">Tolak</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Daftar Pembayaran -->
        <div class="card shadow mb-4">
            <div class="card-header d-flex justify-content-between py-3 align-items-center">
                <h5 class="m-0 fw-bold text-primary">Daftar Pembayaran</h5>
                <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Lihat Semua</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="th-sm-1">No.</th>
                                <th>Nama Lengkap</th>
                                <th>Bukti Pembayaran</th>
                                <th>Formulir</th>
                                <th>Administrasi</th>
                                <th>Status</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1.</td>
                                <td>Michael Chandra</td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-primary w-100 shadow-sm">Lihat Bukti</a>
                                </td>
                                <td>SUDAH</td>
                                <td>BELUM</td>
                                <td>SELESAI</td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-primary shadow-sm">Verifikasi</a>
                                    <a href="#" class="btn btn-sm btn-danger shadow-sm">Tolak</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>


@endsection