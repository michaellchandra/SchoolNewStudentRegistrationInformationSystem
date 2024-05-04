@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
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
                                <th>Email</th>
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
                                <td>{{ $admin->user->email }}</td>
                                <td>{{ $admin -> adminNama }}</td>
                                <td>{{ $admin -> adminTelepon }}</td>
                                <td class="">
                                    
                                    <a href="{{ asset('storage/AdminProfile/' . $admin->user_id . '/' . $admin->adminFoto) }}" target="_blank"
                                        class="btn btn-primary">Lihat Foto</a>
                                        
                                </td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-primary shadow-sm">Ubah</a>
                                    
                                    <button type="submit" class="btn btn-danger" data-toggle="modal" data-target="#confirmDeleteModal{{ $admin->id }}">Hapus</button>
                                    
                                    <div class="modal fade" id="confirmDeleteModal{{ $admin->id }}" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel{{ $admin->id }}" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="confirmDeleteModalLabel{{ $admin->id }}">Konfirmasi Hapus</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Apakah Anda yakin ingin menghapus admin ini?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                    <!-- Form untuk menghapus admin -->
                                                    <form action="{{ route('admin.destroy', $admin->id) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
                        <form action="{{ route('admin.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="user_id">Pilih Pengguna:</label>
                                <select name="user_id" id="user_id" class="form-control">
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">ID:{{ $user->id }} - {{ $user->email }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="adminNama">Nama Admin</label>
                                <input type="text" id="adminNama" name="adminNama" class="form-control" required>
                            </div>
        
                            <div class="form-group">
                                <label for="adminFoto">Foto Admin</label>
                                <input type="file" id="adminFoto" name="adminFoto" class="form-control-file form-control form-control-md w-100 me-3" accept="image/*">
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