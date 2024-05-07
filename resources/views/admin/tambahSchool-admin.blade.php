@extends('layouts.admin')

@section('content')

<div class="container-fluid">
    
    <div class="container-fluid mb-5">
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
                <form action="{{ route('admin.school.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <p class="fs-5 fw-bold">Identitas Sekolah</p>
                    </div>
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

                    <div class="pt-3">
                        <p class="fs-5 fw-bold">Pendaftaran Sekolah</p>
                    </div>
                    <div class="mb-3">
                        <label for="schoolNomorRekening" class="form-label">Nomor Rekening Pembayaran Sekolah</label>
                        <input type="number" class="form-control" id="schoolNomorRekening" name="schoolNomorRekening" required>
                    </div>
                    <div class="mb-3">
                        <label for="schoolNamaRekening" class="form-label">Nama Rekening Pembayaran Sekolah</label>
                        <input type="text" class="form-control" id="schoolNamaRekening" name="schoolNamaRekening" required>
                    </div>
                    <div class="mb-3">
                        <label for="schoolBiayaFormulir" class="form-label">Biaya Formulir Pendaftaran</label>
                        <input type="number" class="form-control" id="schoolBiayaFormulir" name="schoolBiayaFormulir" required>
                    </div>
                    <div class="mb-3">
                        <label for="schoolBatasPendaftaran" class="form-label">Batas Akhir Pendaftaran Sekolah</label>
                        <input type="date" class="form-control" id="schoolBatasPendaftaran" name="schoolBatasPendaftaran" required>
                    </div>
                    <div class="mb-3">
                        <label for="schoolDeskripsi" class="form-label">Syarat dan Ketentuan Pendaftaran</label>
                        <textarea class="form-control" id="schoolSyaratKetentuanPendaftaran" name="schoolSyaratKetentuanPendaftaran" rows="5" required></textarea>
                    </div>
                    
                    

                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection
