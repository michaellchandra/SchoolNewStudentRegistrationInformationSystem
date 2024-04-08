@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <a href="/admin/pendaftar" class="pt-5 link-primary">
            < Back to Pendaftar</a>
                <div class="d-sm-flex align-items-center justify-content-between mb-4 mt-5">
                    <h1 class="h3 mb-0 text-dark">Semua Akun</h1>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addUserModal">
                        Tambah Akun
                    </button>
                </div>

                <!-- Modal Tambah Akun -->
                <div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addUserModalLabel">Tambah Akun Pengguna</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('admin.tambahUser.store') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" id="email" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" name="password" id="password" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="asalSekolah">Asal Sekolah</label>
                                        <input type="text" name="asalSekolah" id="asal_sekolah" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="asalReferensiSekolah">Asal Referensi Sekolah</label>
                                        <select name="asalReferensiSekolah" class="p-2 form-select" required>
                                            <option value="EXPO">EXPO</option>
                                            <option value="Online">Online</option>
                                            <option value="Open House">Open House</option>
                                            <option value="Sosial Media">Sosial Media</option>
                                        </select>
                                    </div>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-primary">Tambah Akun</button>
                                    
                                </form>
                            </div>
                            
                        </div>
                    </div>
                </div>


                <!-- Daftar Akun -->
                <div class="card shadow mb-4">

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th class="th-sm-1">No.</th>
                                        <th>Email</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                @foreach ($users as $key => $user)
                                    <tbody>
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>
                                                {{ $user->email }}
                                            </td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-primary shadow-sm">Reset
                                                    Password</a>
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
