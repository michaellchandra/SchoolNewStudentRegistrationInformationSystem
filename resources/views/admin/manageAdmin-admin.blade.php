@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <a href="/admin/settings" class="pt-5  link-primary ">< Kembali ke Pengaturan</a>

        <!-- Manage Admin -->
        <div class="card shadow mb-4 mt-5">
            <div class="card-header d-flex justify-content-between py-3 align-items-center">
                
                <h5 class="m-0 fw-bold text-primary">Daftar Admin</h5>
                
                <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#addAdminModal">
                    + Tambah Admin
                </button>
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
                                    <a href="#" class="btn btn-sm btn-primary w-100 shadow-sm">Lihat Foto</a>
                                </td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-primary shadow-sm">Ubah</a>
                                    <a href="#" class="btn btn-sm btn-danger shadow-sm">Hapus</a>
                                </td>
                            </tr>
                        </tbody>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>

        <!-- Tambah Admin Modal -->
        <div class="modal fade" id="addAdminModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Admin</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin.store') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="user_id">Pilih Pengguna:</label>
                                <select name="user_id" id="user_id" class="form-control">
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->email }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="adminNama">Nama Admin</label>
                                <input type="text" id="adminNama" name="adminNama" class="form-control" required>
                            </div>
        
                            <div class="form-group">
                                <label for="adminFoto">Foto Admin</label>
                                <input type="file" id="adminFoto" name="adminFoto" class="form-control-file form-control form-control-md w-25 me-3" accept="image/*">
                            </div>
        
                            <div class="form-group">
                                <label for="adminTelepon">Telepon Admin</label>
                                <input type="text" id="adminTelepon" name="adminTelepon" class="form-control" required>
                            </div>
        
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Tambah Admin</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection