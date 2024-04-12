@extends('layouts.admin')

@section('content')

<div class="container-fluid">
    
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                Tambah Sekolah
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('admin.school.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="schoolNama" class="form-label">Nama Sekolah</label>
                        <input type="text" class="form-control" id="schoolNama" name="schoolNama" required>
                    </div>
                    <div class="mb-3">
                        <label for="schoolDeskripsi" class="form-label">Deskripsi Sekolah</label>
                        <textarea class="form-control" id="schoolDeskripsi" name="schoolDeskripsi" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="schoolTelepon" class="form-label">Telepon Sekolah</label>
                        <input type="text" class="form-control" id="schoolTelepon" name="schoolTelepon" required>
                    </div>
                    <div class="mb-3">
                        <label for="schoolLogo" class="form-label">Logo Sekolah</label>
                        <input type="file" class="form-control" id="schoolLogo" name="schoolLogo" required>
                    </div>
                    <!-- Tambahkan input lainnya sesuai kebutuhan -->

                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection
