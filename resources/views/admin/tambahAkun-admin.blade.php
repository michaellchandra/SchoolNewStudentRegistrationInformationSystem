@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="card shadow m-2 p-4">
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
                    <label for="asal_sekolah">Asal Sekolah</label>
                    <input type="text" name="asal_sekolah" id="asal_sekolah" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="asal_referensi_sekolah">Asal Referensi Sekolah</label>
                    <input type="text" name="asal_referensi_sekolah" id="asal_referensi_sekolah" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Tambah Akun</button>
            </form>
        </div>
    </div>

@endsection