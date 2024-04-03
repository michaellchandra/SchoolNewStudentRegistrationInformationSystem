@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4 mt-5">
            <h1 class="h3 mb-0 text-dark">Pendaftar</h1>
            {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> --}}
        </div>

        <div class="row">
            <!-- Highlighted -->
            <div class="col mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2 p-3">
                                <div class="font-weight-bold text-primary text-uppercase mb-1">
                                    Total Akun Terdaftar</div>
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
                                    Sudah Bayar Formulir</div>
                                <div class="h1 mb-0 font-weight-bold text-gray-800">50</div>
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
                                    Seluruh Administrasi Lunas</div>
                                <div class="h1 mb-0 font-weight-bold text-gray-800">40</div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>


        </div>

        <!-- Menunggu Verifikasi Administrasi -->
        <div class="card shadow mb-4">
            <div class="card-header d-flex justify-content-between py-3 align-items-center">
                <h5 class="m-0 fw-bold text-primary">Menunggu Verifikasi Administrasi</h5>
                <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Lihat Semua</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="th-sm-1">No.</th>
                                <th >Nama Lengkap</th>
                                <th>Status</th>
                                <th>Biodata & Berkas</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1.</td>
                                <td>Michael Chandra</td>
                                <td>MENUNGGU VERIFIKASI</td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-primary w-100 shadow-sm">Cek Administrasi</a>
                                </td>
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

        <!-- Daftar Calon Siswa -->
        <div class="card shadow mb-4">
            <div class="card-header d-flex justify-content-between py-3 align-items-center">
                <h5 class="m-0 fw-bold text-primary">Daftar Calon Siswa</h5>
                <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Lihat Semua</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="th-sm-1">No.</th>
                                <th >Nama Lengkap</th>
                                <th>Status</th>
                                <th>Tanggal Pendaftaran</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1.</td>
                                <td>Michael Chandra</td>
                                <td>MENUNGGU VERIFIKASI</td>
                                <td>
                                    12 Februari 2023
                                </td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-primary shadow-sm">Detail</a>
                                    <a href="#" class="btn btn-sm btn-secondary shadow-sm">Edit</a>
                                    <a href="#" class="btn btn-sm btn-danger shadow-sm">Hapus</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Daftar Akun -->
        <div class="card shadow mb-4">
            <div class="card-header d-flex justify-content-between py-3 align-items-center">
                <h5 class="m-0 fw-bold text-primary">Daftar Akun</h5>
                <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Lihat Semua</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="th-sm-1">No.</th>
                                <th >Nama Lengkap</th>
                                <th>Email</th>
                                
                                <th>Action</th>

                            </tr>
                        </thead>
                        @foreach ($users as $key => $user)
                        <tbody>
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $user->name }}</td>
                                <td>
                                    {{ $user->email }}
                                </td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-primary shadow-sm">Reset Password</a>
                                    <a href="#" class="btn btn-sm btn-secondary shadow-sm">Edit</a>
                                    <a href="#" class="btn btn-sm btn-danger shadow-sm">Hapus</a>
                                </td>
                            </tr>
                        </tbody>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection
