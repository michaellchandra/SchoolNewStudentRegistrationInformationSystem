@extends('layouts.admin')

@section('content')
    <div class="container-fluid">

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($school === null)
            <div class="alert alert-danger">
                <p class="fs-5 fw-bold">Sekolah belum ditambahkan, harap tambahkan seluruh informasi sekolah terlebih dulu, sebelum menggunakan
                    sistem.</p>
                    <a href="/admin/settings/school/create"><i class="fas fa-arrow-right me-2"></i>Tambahkan Sekolah Disini</a>
            </div>
        @endif


        <div class="d-sm-flex align-items-center justify-content-between mb-4 mt-5">
            <h1 class="h3 mb-0 text-dark">Dashboard</h1>
            {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> --}}
        </div>
        <div class="card border-left-primary shadow h-100 py-2 mb-4">
            <div class="card-body row">
                <div class="col">
                    <div class="font-weight-bold text-primary text-uppercase mb-1">
                        Total Pendaftar Hari Ini</div>
                        <div>
                            {{ $todayDate }}
                        </div>
                </div>
                <div class="col text-end h4 mb-0 font-weight-bold text-gray-800">
                    {{ $todayRegistrations }}
                </div>
                
            </div>
            
        </div>

        <div class="row">
            <!-- Total Pendaftar -->
            <div class="col mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center d-flex justify-content-between">
                            <div class="col mr-2 p-3">
                                <div class="font-weight-bold text-primary text-uppercase mb-1">
                                    Pembayaran Menunggu Verifikasi
                                </div>
                                <div class="h1 mb-0 font-weight-bold text-gray-800">{{ $totalVerifyingPayments }}</div>
                            </div>
                            <div class="col d-flex justify-content-end p-3"> <!-- Tambahkan kelas d-flex dan justify-content-end di sini -->
                                <a href="/admin/payment" class="btn btn-primary rounded-circle d-flex justify-content-center align-items-center" style="width: 75px; height: 75px">
                                    <i class="fas fa-arrow-right fa-lg"></i>
                                </a>
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
                                    Administrasi Menunggu Verifikasi</div>
                                <div class="h1 mb-0 font-weight-bold text-gray-800">{{ $totalVerifyingBiodata }}</div>
                            </div>
                            <div class="col d-flex justify-content-end p-3"> <!-- Tambahkan kelas d-flex dan justify-content-end di sini -->
                                <a href="/admin/pendaftar" class="btn btn-primary rounded-circle d-flex justify-content-center align-items-center" style="width: 75px; height: 75px">
                                    <i class="fas fa-arrow-right fa-lg"></i>
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>


        </div>
        <div class="card shadow mb-4">
            <div class="card-header d-flex justify-content-between py-3 align-items-center">
                <h5 class="m-0 fw-bold text-primary">Pendaftar Terbaru</h5>
                <a href="/admin/pendaftar" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Lihat Semua</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Lengkap</th>
                                <th>Tanggal Registrasi</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($latestUsers as $index => $user)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->created_at->format('l, d F Y H:i') }}</td>
                                
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>



    </div>
    </div>
@endsection
