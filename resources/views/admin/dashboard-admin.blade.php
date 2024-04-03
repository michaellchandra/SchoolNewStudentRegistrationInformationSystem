@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        {{-- <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div> --}}

        <div class="d-sm-flex align-items-center justify-content-between mb-4 mt-5">
            <h1 class="h3 mb-0 text-dark">Dashboard</h1>
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
                                    Total Pendaftar</div>
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
                                    Pendaftar Hari Ini</div>
                                <div class="h1 mb-0 font-weight-bold text-gray-800">231</div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            
        </div>
        <div class="card shadow mb-4">
            <div class="card-header d-flex justify-content-between py-3 align-items-center">
                <h5 class="m-0 fw-bold text-primary">Pendaftar Terbaru</h5>
                <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Lihat Semua</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Nama Lengkap</th>
                                <th>Tanggal Pendaftaran</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Michael Chandra</td>
                                <td>20 September 2020</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>



    </div>
    </div>
@endsection
