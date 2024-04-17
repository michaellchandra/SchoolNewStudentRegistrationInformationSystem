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
                                        <th>Role</th>
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
                                            <td>{{ $user->role }}</td>
                                            <td>
                                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#resetPasswordModal{{ $user->id }}">
                                            Reset Password
                                        </button>

                                        <!-- Modal Reset Password -->
                                        <div class="modal fade" id="resetPasswordModal{{ $user->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="resetPasswordModalLabel{{ $user->id }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="resetPasswordModalLabel{{ $user->id }}">Reset Password
                                                            Pengguna {{ $user->name }}</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="{{ route('admin.resetPasswordUser', $user->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="password">Password Baru</label>
                                                                <input type="password" name="password"
                                                                    class="form-control" required>
                                                                    
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="password_confirmation">Konfirmasi Password
                                                                    Baru</label>
                                                                <input type="password" name="password_confirmation"
                                                                    class="form-control" required>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Batal</button>
                                                            <button type="submit" class="btn btn-primary">Reset
                                                                Password</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Button Edit -->
                                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#editModal{{ $user->id }}">
                                            Edit
                                        </button>

                                        <!-- Modal Edit -->
                                        <div class="modal fade" id="editModal{{ $user->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="editModalLabel{{ $user->id }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editModalLabel{{ $user->id }}">
                                                            Edit
                                                            User</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('admin.updateUser', $user->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            
                                                            <label for="name">Nama</label>
                                                            <input type="text" name="name"
                                                                class="form-control mb-3" value="{{ $user->name }}">
                                                            <label for="email">Email</label>
                                                            <input type="email" name="email"
                                                                class="form-control mb-4" value="{{ $user->email }}">

                                                            <button type="submit" class="btn btn-primary">Simpan
                                                                Perubahan</button>
                                                        </form>

                                                    </div>

                                                </div>
                                            </div>
                                        </div>


                                        <!-- Button Delete -->
                                        <button type="button" class="btn btn-danger" data-toggle="modal"
                                            data-target="#deleteModal{{ $user->id }}">
                                            Hapus
                                        </button>

                                        <!-- Modal Delete -->
                                        <div class="modal fade" id="deleteModal{{ $user->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="deleteModalLabel{{ $user->id }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteModalLabel{{ $user->id }}">
                                                            Konfirmasi Hapus</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Apakah Anda yakin ingin menghapus pengguna ini?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Batal</button>
                                                        <form action="{{ route('admin.deleteUser', $user->id) }}"
                                                            method="POST">
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
    </div>
@endsection
