@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <a href="/admin/settings" class="pt-5  link-primary ">< Kembali ke Pengaturan</a>

        <!-- Manage Admin -->
        <div class="card shadow mb-4 mt-5">
            <div class="card-header d-flex justify-content-between py-3 align-items-center">
                
                <h5 class="m-0 fw-bold text-primary">Daftar Admin</h5>
                <a href="/admin/settings/tam" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">+ Tambah Admin</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="th-sm-1">No.</th>
                                <th>Nama Admin</th>
                                <th>Telepon</th>
                                <th>Foto</th>
                                <th>Action</th>

                            </tr>
                        </thead>

                        @foreach ($admins as $key => $admin)
                        <tbody>
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>Michael Chandra</td>
                                <td>{{ $admin -> adminNama }}</td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-primary w-100 shadow-sm">Cek Administrasi</a>
                                </td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-primary shadow-sm">Verifikasi</a>
                                    <a href="#" class="btn btn-sm btn-danger shadow-sm">Tolak</a>
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