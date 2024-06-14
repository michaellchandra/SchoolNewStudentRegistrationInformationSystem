@extends('layouts.user')

@section('content')
    <div class="container-fluid">
        <a href="/user/dashboard" class="pt-5 link-primary">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            < Back to Dashboard</a>
                <div class="d-sm-flex align-items-center justify-content-between mb-4 mt-5">
                    <h1 class="h3 mb-0 text-dark">Pengisian Biodata & Berkas</h1>
                    <a href="#" class="p-2 fs-6 btn btn-sm btn-primary shadow-sm"><i
                            class="fas fa-solid fa-question  text-white-50"></i> Bantuan</a>
                </div>

                <form action="{{ route('user.biodata.store') }}"  id="biodataForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- Biodata Siswa -->
                    <div class="card shadow mb-4">
                        <div class="card-header d-flex justify-content-between py-3 align-items-center">
                            <h5 class="m-0 fw-bold text-primary">I. Biodata Calon Siswa</h5>
                        </div>

                        <div class="card-body">

                            <div class="row mb-2 d-flex align-items-center mb-3">
                                <div class="col-12 col-md-2 ">
                                    <h6 class="fw-bold ">Nama Lengkap Calon Siswa*</h6>
                                </div>
                                <div class="col-12 col-md-10">
                                    <input id="namaLengkap" type="text" class="rounded-pill p-2 form-control"
                                        name="namaLengkap"
                                        value="{{ $biodata ? $biodata->namaLengkap : old('namaLengkap') }}" required>
                                </div>
                            </div>

                            <!-- Jenis Kelamin -->
                            <div class="row mb-3">
                                <div class="col-12 col-md-2">
                                    <h6 class="fw-bold">Jenis Kelamin*</h6>
                                </div>
                                <div class="col-12 col-md-10 d-flex justify-content-center justify-content-md-start">
                                    <div
                                        class="d-flex align-items-center justify-content-start form-check form-check-inline">
                                        <input class="form-check-input mt-0" id="radioLaki" name="jenisKelamin"
                                            type="radio" value="Laki-laki" value="Laki-laki"
                                            {{ $biodata && $biodata->jenisKelamin === 'Laki-laki' ? 'checked' : '' }}
                                            aria-label="Radio button for following text input">
                                        <label class="form-check-label pe-3" for="radioLaki">
                                            Laki-laki
                                        </label>
                                        <input class="form-check-input mt-0" id="radioPerempuan" name="jenisKelamin"
                                            type="radio" value="Perempuan"
                                            {{ $biodata && $biodata->jenisKelamin === 'Perempuan' ? 'checked' : '' }}
                                            aria-label="Radio button for following text input">
                                        <label class="form-check-label" for="radioPerempuan">
                                            Perempuan
                                        </label>
                                    </div>
                                    @if ($errors->has('jenisKelamin'))
                                        <span class="text-danger">{{ $errors->first('jenisKelamin') }}</span>
                                    @endif
                                </div>
                            </div>
                            <!-- Nomor NIK  -->
                            <div class="row mb-3">
                                <div class="col-12 col-md-2 d-flex align-items-center">
                                    <h6 class="fw-bold ">Nomor NIK*</h6>
                                </div>
                                <div class="col-12 col-md-10 justify-content-md-start align-items-center">
                                    <input id="nomorNIK" type="number" class="rounded-pill p-2 form-control"
                                        name="nomorNIK" value="{{ $biodata ? $biodata->nomorNIK : old('nomorNIK') }}"
                                        required>
                                </div>
                            </div>
                            <!-- Tempat Lahir -->
                            <div class="row mb-3">
                                <div class="col-12 col-md-2 d-flex align-items-center">
                                    <h6 class="fw-bold ">Tempat Lahir*</h6>
                                </div>
                                <div class="col-12 col-md-10 justify-content-md-start align-items-center">
                                    <input id="tempatLahir" type="text" class="rounded-pill p-2 form-control"
                                        name="tempatLahir"
                                        value="{{ $biodata ? $biodata->tempatLahir : old('tempatLahir') }}" required>
                                </div>
                            </div>
                            <!-- Tanggal Lahir -->
                            <div class="row mb-3">
                                <div class="col-12 col-md-2 d-flex align-items-center">
                                    <h6 class="fw-bold">Tanggal Lahir*</h6>
                                </div>
                                <div class="col-12 col-md-10  justify-content-center justify-content-md-start">
                                    <input id="tanggalLahir" type="date" class="rounded-pill p-2 form-control"
                                        name="tanggalLahir"
                                        value="{{ $biodata ? $biodata->tanggalLahir : old('tanggalLahir') }}" required>
                                </div>
                            </div>

                            <!-- Jumlah Saudara Kandung -->
                            <div class="row mb-3">
                                <div class="col-12 col-md-2 d-flex align-items-center">
                                    <h6 class="fw-bold">Jumlah Saudara Kandung*</h6>
                                </div>
                                <div class="col-12 col-md-10  justify-content-start">
                                    <input id="jumlahSaudaraKandung" type="number" class="rounded-pill p-2 form-control"
                                        name="jumlahSaudaraKandung"
                                        value="{{ $biodata ? $biodata->jumlahSaudaraKandung : old('jumlahSaudaraKandung') }}"
                                        required>
                                </div>
                            </div>

                            <!-- Jumlah Saudara Tiri/Angkat -->
                            <div class="row mb-3">
                                <div class="col-12 col-md-2 d-flex align-items-center">
                                    <h6 class="fw-bold">Jumlah Saudara Tiri/Angkat*</h6>
                                </div>
                                <div class="col-12 col-md-10  justify-content-start">
                                    <div class="w-100">
                                        <input id="jumlahSaudaraAngkat" type="number" class="rounded-pill p-2 form-control"
                                            name="jumlahSaudaraAngkat"
                                            value="{{ $biodata ? $biodata->jumlahSaudaraAngkat : old('jumlahSaudaraAngkat') }}"
                                            required>
                                        <p class="text-xs">*Jika tidak ada isi dengan angka 0</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Tinggi Badan -->
                            <div class="row mb-3">
                                <div class="col-12 col-md-2 d-flex align-items-center">
                                    <h6 class="fw-bold">Tinggi Badan (cm)*</h6>
                                </div>
                                <div class="col-12 col-md-10  justify-content-start">
                                    <input id="tinggiBadan" type="number" class="rounded-pill p-2 form-control"
                                        name="tinggiBadan"
                                        value="{{ $biodata ? $biodata->tinggiBadan : old('tinggiBadan') }}" required>
                                </div>
                            </div>

                            <!-- Berat Badan -->
                            <div class="row mb-3">
                                <div class="col-12 col-md-2 d-flex align-items-center">
                                    <h6 class="fw-bold">Berat Badan (kg)*</h6>
                                </div>
                                <div class="col-12 col-md-10  justify-content-start">
                                    <input id="beratBadan" type="number" class="rounded-pill p-2 form-control"
                                        name="beratBadan"
                                        value="{{ $biodata ? $biodata->beratBadan : old('beratBadan') }}" required>
                                </div>
                            </div>

                            <!-- Alamat Siswa -->
                            <div class="row mb-3">
                                <div class="col-12 col-md-2 d-flex align-items-center">
                                    <h6 class="fw-bold">Alamat Siswa*</h6>
                                </div>
                                <div class="col-12 col-md-10  justify-content-start">
                                    <input id="alamatSiswa" type="text" class="rounded-pill p-2 form-control"
                                        name="alamatSiswa"
                                        value="{{ $biodata ? $biodata->alamatSiswa : old('alamatSiswa') }}" required>
                                </div>
                            </div>

                            <!-- Jenis Tinggal -->
                            <div class="row mb-3">
                                <div class="col-12 col-md-2 d-flex align-items-center">
                                    <h6 class="fw-bold">Jenis Tinggal*</h6>
                                </div>
                                <div class="col-12 col-md-10 d-flex align-items-center justify-content-start">
                                    <select name="jenisTinggal" class="rounded-pill p-2 form-select" required>
                                        <option value="Bersama Orang Tua"
                                            {{ $biodata && $biodata->jenisTinggal == 'Bersama Orang Tua' ? 'selected' : '' }}>
                                            Bersama Orang Tua</option>
                                        <option value="Bersama Wali"
                                            {{ $biodata && $biodata->jenisTinggal == 'Bersama Wali' ? 'selected' : '' }}>
                                            Bersama Wali</option>
                                        <option value="Kost"
                                            {{ $biodata && $biodata->jenisTinggal == 'Kost' ? 'selected' : '' }}>Kost
                                        </option>
                                        <option value="Asrama"
                                            {{ $biodata && $biodata->jenisTinggal == 'Asrama' ? 'selected' : '' }}>Asrama
                                        </option>
                                        <option value="Lainnya"
                                            {{ $biodata && $biodata->jenisTinggal == 'Lainnya' ? 'selected' : '' }}>
                                            Lainnya</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Transportasi ke Sekolah -->
                            <div class="row mb-3">
                                <div class="col-12 col-md-2 d-flex align-items-center">
                                    <h6 class="fw-bold">Alat Transportasi ke Sekolah*</h6>
                                </div>
                                <div class="col-12 col-md-10 d-flex align-items-center justify-content-start">
                                    <select name="transportasiKeSekolah" class="rounded-pill p-2 form-select" required>
                                        <option value="Jalan Kaki"
                                            {{ $biodata && $biodata->transportasiKeSekolah == 'Jalan Kaki' ? 'selected' : '' }}>
                                            Jalan Kaki</option>
                                        <option value="Mobil Pribadi"
                                            {{ $biodata && $biodata->transportasiKeSekolah == 'Mobil Pribadi' ? 'selected' : '' }}>
                                            Mobil Pribadi</option>
                                        <option value="Kendaraan Umum"
                                            {{ $biodata && $biodata->transportasiKeSekolah == 'Kendaraan Umum' ? 'selected' : '' }}>
                                            Kendaraan Umum (Angkot/Ojek Online/Becak)</option>
                                        <option value="Jemputan Sekolah"
                                            {{ $biodata && $biodata->transportasiKeSekolah == 'Jemputan Sekolah' ? 'selected' : '' }}>
                                            Jemputan Sekolah</option>
                                        <option value="Sepeda Motor"
                                            {{ $biodata && $biodata->transportasiKeSekolah == 'Sepeda Motor' ? 'selected' : '' }}>
                                            Sepeda Motor</option>
                                        <option value="Sepeda"
                                            {{ $biodata && $biodata->transportasiKeSekolah == 'Sepeda' ? 'selected' : '' }}>
                                            Sepeda</option>
                                        <option value="Lainnya"
                                            {{ $biodata && $biodata->transportasiKeSekolah == 'Lainnya' ? 'selected' : '' }}>
                                            Lainnya</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Agama Siswa -->
                            <div class="row mb-3">
                                <div class="col-12 col-md-2 d-flex align-items-center">
                                    <h6 class="fw-bold">Agama Siswa*</h6>
                                </div>
                                <div class="col-12 col-md-10 d-flex align-items-center justify-content-start">
                                <select name="agamaSiswa" class="rounded-pill p-2 form-select" required>
                                        <option value="Islam"
                                            {{ $biodata && $biodata->agamaSiswa == 'Islam' ? 'selected' : '' }}>Islam
                                        </option>
                                        <option value="Kristen"
                                            {{ $biodata && $biodata->agamaSiswa == 'Kristen' ? 'selected' : '' }}>Kristen
                                        </option>
                                        <option value="Katolik"
                                            {{ $biodata && $biodata->agamaSiswa == 'Katolik' ? 'selected' : '' }}>Katolik
                                        </option>
                                        <option value="Buddha"
                                            {{ $biodata && $biodata->agamaSiswa == 'Buddha' ? 'selected' : '' }}>Buddha
                                        </option>
                                        <option value="Hindu"
                                            {{ $biodata && $biodata->agamaSiswa == 'Hindu' ? 'selected' : '' }}>Hindu
                                        </option>
                                        <option value="Konghucu"
                                            {{ $biodata && $biodata->agamaSiswa == 'Konghucu' ? 'selected' : '' }}>
                                            Konghucu</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Nomor Telepon Siswa -->
                            <div class="row mb-3">
                                <div class="col-12 col-md-2 d-flex align-items-center">
                                    <h6 class="fw-bold">Nomor Telepon Siswa*</h6>
                                </div>
                                <div class="col-12 col-md-10  justify-content-start">
                                    <input id="nomorTeleponSiswa" type="number" class="rounded-pill p-2 form-control"
                                        name="nomorTeleponSiswa"
                                        value="{{ $biodata ? $biodata->nomorTeleponSiswa : old('nomorTeleponSiswa') }}"
                                        required>
                                </div>
                            </div>



                            <!-- Nama Sekolah Asal -->
                            <div class="row mb-3">
                                <div class="col-12 col-md-2 d-flex align-items-center">
                                    <h6 class="fw-bold">Nama Sekolah Asal*</h6>
                                </div>
                                <div class="col-12 col-md-10 justify-content-start">
                                    <input id="namaSekolahAsal" type="text" class="rounded-pill p-2 form-control"
                                        name="namaSekolahAsal"
                                        value="{{ $biodata ? $biodata->namaSekolahAsal : old('namaSekolahAsal') }}"
                                        required>
                                </div>
                            </div>

                            <!-- Alamat Sekolah Asal -->
                            <div class="row mb-3">
                                <div class="col-12 col-md-2 d-flex align-items-center">
                                    <h6 class="fw-bold">Alamat Sekolah Asal*</h6>
                                </div>
                                <div class="col-12 col-md-10 justify-content-start">
                                    <input id="alamatSekolahAsal" type="text" class="rounded-pill p-2 form-control"
                                        name="alamatSekolahAsal"
                                        value="{{ $biodata ? $biodata->alamatSekolahAsal : old('alamatSekolahAsal') }}"
                                        required>
                                </div>
                            </div>

                            <!-- Provinsi Sekolah Asal -->
                            <div class="row mb-3">
                                <div class="col-12 col-md-2 d-flex align-items-center">
                                    <h6 class="fw-bold">Provinsi Sekolah Asal*</h6>
                                </div>
                                <div class="col-12 col-md-10 justify-content-start">
                                    <input type="text" name="provinsiSekolahAsal" value="{{ $biodata ? $biodata->provinsiSekolahAsal : old('provinsiSekolahAsal') }}" class="rounded-pill p-2 form-control" id="provinsiInput" list="provinsiList" required>
                                    <datalist id="provinsiList">
                                        @foreach ($provinces as $provinsi)
                                            <option value="{{ $provinsi->name }}">
                                        @endforeach
                                    </datalist>
                                </div>
                            </div>

                            <!-- Kota Sekolah Asal -->
                            <div class="row mb-2">
                                <div class="col-12 col-md-2 d-flex align-items-center">
                                    <h6 class="fw-bold">Kota Sekolah Asal*</h6>
                                </div>
                                <div class="col-12 col-md-10 justify-content-start">
                                    <input type="text" name="kotaSekolahAsal" value="{{ $biodata ? $biodata->kotaSekolahAsal : old('kotaSekolahAsal') }}" class="rounded-pill p-2 form-control" id="kotaInput" list="kotaList" required>
                                    <datalist id="kotaList">
                                        @foreach ($regency as $kota)
                                            <option value="{{ $kota->name }}">
                                        @endforeach
                                    </datalist>
                                </div>
                            </div>

                            <!-- Kecamatan Sekolah Asal -->
                            <div class="row mb-2">
                                <div class="col-12 col-md-2 d-flex align-items-center">
                                    <h6 class="fw-bold">Kecamatan Sekolah Asal*</h6>
                                </div>
                                <div class="col-12 col-md-10 justify-content-start">
                                    <input type="text" name="kecamatanSekolahAsal" value="{{ $biodata ? $biodata->kecamatanSekolahAsal : old('kecamatanSekolahAsal') }}" class="rounded-pill p-2 form-control" id="kecamatanInput" list="kecamatanList" required>
                                    <datalist id="kecamatanList">
                                        @foreach ($districts as $kecamatan)
                                            <option value="{{ $kecamatan->name }}">
                                        @endforeach
                                    </datalist>
                                </div>
                            </div>

                        </div>


                    </div>

                    <!-- Biodata Orang Tua/Wali-->
                    <div class="card shadow mb-4">
                        <div class="card-header d-flex justify-content-between py-3 align-items-center">
                            <h5 class="m-0 fw-bold text-primary">II. Biodata Orang Tua/Wali</h5>
                        </div>

                        <div class="card-body">


                            <!-- Nama Lengkap Ibu Kandung-->
                            <div class="row mb-2">
                                <div class="col-12 col-md-2 d-flex align-items-center">
                                    <h6 class="fw-bold">Nama Lengkap Ibu Kandung*</h6>
                                </div>
                                <div class="col-12 col-md-10 justify-content-start">
                                    <input type="text" name="namaIbuKandung" class="rounded-pill p-2 form-control"
                                        value="{{ $biodata ? $biodata->namaIbuKandung : old('namaIbuKandung') }}">
                                </div>
                            </div>

                            <!-- Pekerjaan Ibu Kandung-->
                            <div class="row mb-2">
                                <div class="col-12 col-md-2 d-flex align-items-center">
                                    <h6 class="fw-bold">Pekerjaan Ibu Kandung*</h6>
                                </div>
                                <div class="col-12 col-md-10 justify-content-start">
                                    <input type="text" name="pekerjaanIbuKandung"
                                        class="rounded-pill p-2 form-control"
                                        value="{{ $biodata ? $biodata->pekerjaanIbuKandung : old('pekerjaanIbuKandung') }}">
                                </div>
                            </div>

                            <!-- Penghasilan Bulanan Ibu Kandung-->
                            <div class="row mb-2">
                                <div class="col-12 col-md-2 d-flex align-items-center">
                                    <h6 class="fw-bold">Penghasilan Bulanan Ibu Kandung*</h6>
                                </div>
                                <div class="col-12 col-md-10 justify-content-start">
                                    <input type="number" name="penghasilanIbuKandung"
                                        class="rounded-pill p-2 form-control"
                                        value="{{ $biodata ? $biodata->penghasilanIbuKandung : old('penghasilanIbuKandung') }}">
                                </div>
                            </div>

                            <!-- Nomor Telepon/WA Ibu Kandung-->
                            <div class="row mb-2">
                                <div class="col-12 col-md-2 d-flex align-items-center">
                                    <h6 class="fw-bold">Nomor Telepon/WhatsApp Ibu Kandung*</h6>
                                </div>
                                <div class="col-12 col-md-10 justify-content-start">
                                    <input type="number" name="nomorTeleponIbuKandung"
                                        class="rounded-pill p-2 form-control"
                                        value="{{ $biodata ? $biodata->nomorTeleponIbuKandung : old('nomorTeleponIbuKandung') }}">
                                </div>
                            </div>




                            <!--Div Kosong -->
                            <div class="d-flex justify-content-start align-items-center mb-5">

                            </div>

                            <!-- Nama Lengkap Ayah Kandung -->
                            <div class="row mb-2">
                                <div class="col-12 col-md-2 d-flex align-items-center">
                                    <h6 class="fw-bold">Nama Lengkap Ayah Kandung*</h6>
                                </div>
                                <div class="col-12 col-md-10 justify-content-start">
                                    <input type="text" name="namaAyahKandung" class="rounded-pill p-2 form-control"
                                        value="{{ $biodata ? $biodata->namaAyahKandung : old('namaAyahKandung') }}">
                                </div>
                            </div>

                            <!-- Pekerjaan Ayah Kandung -->
                            <div class="row mb-2">
                                <div class="col-12 col-md-2 d-flex align-items-center">
                                    <h6 class="fw-bold">Pekerjaan Ayah Kandung*</h6>
                                </div>
                                <div class="col-12 col-md-10 justify-content-start">
                                    <input type="text" name="pekerjaanAyahKandung"
                                        class="rounded-pill p-2 form-control"
                                        value="{{ $biodata ? $biodata->pekerjaanAyahKandung : old('pekerjaanAyahKandung') }}">
                                </div>
                            </div>

                            <!-- Penghasilan Bulanan Ayah Kandung -->
                            <div class="row mb-2">
                                <div class="col-12 col-md-2 d-flex align-items-center">
                                    <h6 class="fw-bold">Penghasilan Bulanan Ayah Kandung*</h6>
                                </div>
                                <div class="col-12 col-md-10 justify-content-start">
                                    <input type="number" name="penghasilanAyahKandung"
                                        class="rounded-pill p-2 form-control"
                                        value="{{ $biodata ? $biodata->penghasilanAyahKandung : old('penghasilanAyahKandung') }}">
                                </div>
                            </div>

                            <!-- Nomor Telepon/WA Ayah Kandung -->
                            <div class="row mb-2">
                                <div class="col-12 col-md-2 d-flex align-items-center">
                                    <h6 class="fw-bold">Nomor Telepon/WhatsApp Ayah Kandung*</h6>
                                </div>
                                <div class="col-12 col-md-10 justify-content-start">
                                    <input type="number" name="nomorTeleponAyahKandung"
                                        class="rounded-pill p-2 form-control"
                                        value="{{ $biodata ? $biodata->nomorTeleponAyahKandung : old('nomorTeleponAyahKandung') }}">
                                </div>
                            </div>

                            <!--Div Kosong -->
                            <div class="d-flex justify-content-start align-items-center mb-5">

                            </div>

                            <!-- Nama Lengkap Wali -->
                            <div class="row mb-2">
                                <div class="col-12 col-md-2 d-flex align-items-center">
                                    <h6 class="fw-bold">Nama Lengkap Wali</h6>
                                </div>
                                <div class="col-12 col-md-10 justify-content-start">
                                    <input type="text" name="namaWali" class="rounded-pill p-2 form-control"
                                        value="{{ $biodata ? $biodata->namaWali : old('namaWali') }}">
                                </div>
                            </div>

                            <!-- Pekerjaan Wali -->
                            <div class="row mb-2">
                                <div class="col-12 col-md-2 d-flex align-items-center">
                                    <h6 class="fw-bold">Pekerjaan Wali</h6>
                                </div>
                                <div class="col-12 col-md-10 justify-content-start">
                                    <input type="text" name="pekerjaanWali" class="rounded-pill p-2 form-control"
                                        value="{{ $biodata ? $biodata->pekerjaanWali : old('pekerjaanWali') }}">
                                </div>
                            </div>

                            <!-- Penghasilan Bulanan Wali -->
                            <div class="row mb-2">
                                <div class="col-12 col-md-2 d-flex align-items-center">
                                    <h6 class="fw-bold">Penghasilan Bulanan Wali</h6>
                                </div>
                                <div class="col-12 col-md-10 justify-content-start">
                                    <input type="number" name="penghasilanWali" class="rounded-pill p-2 form-control"
                                        value="{{ $biodata ? $biodata->penghasilanWali : old('penghasilanWali') }}">
                                </div>
                            </div>

                            <!-- Nomor Telepon/WA Wali -->
                            <div class="row mb-2">
                                <div class="col-12 col-md-2 d-flex align-items-center">
                                    <h6 class="fw-bold">Nomor Telepon/WhatsApp Wali</h6>
                                </div>
                                <div class="col-12 col-md-10 justify-content-start">
                                    <input type="number" name="nomorTeleponWali" class="rounded-pill p-2 form-control"
                                        value="{{ $biodata ? $biodata->nomorTeleponWali : old('nomorTeleponWali') }}">
                                </div>
                            </div>


                        </div>

                    </div>

                    <!-- Lampiran Dokumen -->
                    <div class="card shadow mb-4">
                        <div class="card-header d-flex justify-content-between py-3 align-items-center">
                            <h5 class="m-0 fw-bold text-primary">III. Lampiran Dokumen</h5>
                        </div>

                        <div class="card-body">
                            
                            <p class="p-0 m-0">Mohon untuk mengisi seluruh biodata dan administrasi yang dibutuhkan. Seluruh berkas yang masuk, akan kami verifikasi terlebih dahulu</p>   
                            <p class="fw-bold text-danger">Tanda * WAJIB DI ISI</p>
                            
                            <!-- Akta Kelahiran -->
                            <div class="mb-3">
                                <label for="berkasAktaKelahiran" class="form-label fw-bold">Akta Kelahiran*</label>
                                <div class="w-100">
                                    <input class="form-control rounded-pill p-2" name="berkasAktaKelahiran" type="file">
                                    @if ($biodata && $biodata->berkasAktaKelahiran)
                                        <p class="mt-2">File sebelumnya: {{ $biodata->berkasAktaKelahiran }}</p>
                                    @endif
                                    <p class="text-xs">*Format file yang diterima adalah JPG, PNG, GIF, SVG</p>
                                </div>
                                
                            </div>
                            

                            <!-- Kartu Keluarga -->
                            <div class="mb-3">
                                <label for="berkasKartuKeluarga" class="form-label fw-bold">Kartu Keluarga*</label>
                                <input class="form-control rounded-pill p-2" name="berkasKartuKeluarga" type="file">
                                <div class="w-100">
                                    @if ($biodata && $biodata->berkasKartuKeluarga)
                                    <p class="mt-2">File sebelumnya: {{ $biodata->berkasKartuKeluarga }}</p>
                                    @endif
                                    <p class="text-xs">*Format file yang diterima adalah JPG, PNG, GIF, SVG</p>
                                </div>
                                
                            </div>

                            <!-- KTP Ayah Kandung -->
                            <div class="mb-3">
                                <label for="berkasKTPAyahKandung" class="form-label fw-bold">KTP Ayah Kandung*</label>
                                <input class="form-control rounded-pill p-2" name="berkasKTPAyahKandung" type="file">
                                <div class="w-100">
                                    @if ($biodata && $biodata->berkasKTPAyahKandung)
                                    <p class="mt-2">File sebelumnya: {{ $biodata->berkasKTPAyahKandung }}</p>
                                @endif
                                    <p class="text-xs">*Format file yang diterima adalah JPG, PNG, GIF, SVG</p>
                                </div>
                                
                            </div>
                            <!-- KTP Ibu Kandung -->
                            <div class="mb-3">
                                <label for="berkasKTPIbuKandung" class="form-label fw-bold">KTP Ibu Kandung*</label>
                                <input class="form-control rounded-pill p-2" name="berkasKTPIbuKandung" type="file">
                                <div class="w-100">
                                    @if ($biodata && $biodata->berkasKTPIbuKandung)
                                    <p class="mt-2">File sebelumnya: {{ $biodata->berkasKTPIbuKandung }}</p>
                                @endif
                                    <p class="text-xs">*Format file yang diterima adalah JPG, PNG, GIF, SVG</p>
                                </div>
                                
                            </div>
                            <!-- KTP Wali -->
                            <div class="mb-3">
                                <label for="berkasKTPWali" class="form-label fw-bold">KTP Wali</label>
                                <input class="form-control rounded-pill p-2" name="berkasKTPWali" type="file">
                                <div class="w-100">
                                    @if ($biodata && $biodata->berkasKTPWali)
                                    <p class="mt-2">File sebelumnya: {{ $biodata->berkasKTPWali }}</p>
                                @endif
                                    <p class="text-xs">*Format file yang diterima adalah JPG, PNG, GIF, SVG</p>
                                </div>
                                
                            </div>
                            <!-- Scan Raport Kelas 7 Ganjil -->
                            <div class="mb-3">
                                <label for="scanRaportKelas7Ganjil" class="form-label fw-bold">Scan Raport Kelas VII -
                                    Semester Ganjil*</label>
                                <input class="form-control rounded-pill p-2" name="scanRaportKelas7Ganjil"
                                    type="file">
                                    <div class="w-100">
                                        @if ($biodata && $biodata->scanRaportKelas7Ganjil)
                                    <p class="mt-2">File sebelumnya: {{ $biodata->scanRaportKelas7Ganjil }}</p>
                                @endif
                                        <p class="text-xs">*Format file yang diterima adalah JPG, PNG, GIF, SVG</p>
                                    </div>
                                
                            </div>
                            <!-- Scan Raport Kelas 7 Genap -->
                            <div class="mb-3">
                                <label for="scanRaportKelas7Genap" class="form-label fw-bold">Scan Raport Kelas VII -
                                    Semester Genap*</label>
                                <input class="form-control rounded-pill p-2" name="scanRaportKelas7Genap" type="file">
                                <div class="w-100">
                                    @if ($biodata && $biodata->scanRaportKelas7Genap)
                                    <p class="mt-2">File sebelumnya: {{ $biodata->scanRaportKelas7Genap }}</p>
                                @endif
                                    <p class="text-xs">*Format file yang diterima adalah JPG, PNG, GIF, SVG</p>
                                </div>
                                
                            </div>
                            <!-- Scan Raport Kelas 8 Ganjil -->
                            <div class="mb-3">
                                <label for="scanRaportKelas8Ganjil" class="form-label fw-bold">Scan Raport Kelas VIII -
                                    Semester Ganjil*</label>
                                <input class="form-control rounded-pill p-2" name="scanRaportKelas8Ganjil"
                                    type="file">
                                    <div class="w-100">
                                        @if ($biodata && $biodata->scanRaportKelas8Ganjil)
                                    <p class="mt-2">File sebelumnya: {{ $biodata->scanRaportKelas8Ganjil }}</p>
                                @endif
                                        <p class="text-xs">*Format file yang diterima adalah JPG, PNG, GIF, SVG</p>
                                    </div>
                                
                            </div>
                            <!-- Scan Raport Kelas 8 Genap -->
                            <div class="mb-3">
                                <label for="scanRaportKelas8Genap" class="form-label fw-bold">Scan Raport Kelas VIII -
                                    Semester Genap*</label>
                                <input class="form-control rounded-pill p-2" name="scanRaportKelas8Genap" type="file">
                                <div class="w-100">
                                    @if ($biodata && $biodata->scanRaportKelas8Genap)
                                    <p class="mt-2">File sebelumnya: {{ $biodata->scanRaportKelas8Genap }}</p>
                                @endif
                                    <p class="text-xs">*Format file yang diterima adalah JPG, PNG, GIF, SVG</p>
                                </div>
                                
                            </div>
                            <!-- Scan Raport Kelas 9 Ganjil -->
                            <div class="mb-3">
                                <label for="scanRaportKelas9Ganjil" class="form-label fw-bold">Scan Raport Kelas IX -
                                    Semester Ganjil*</label>
                                <input class="form-control rounded-pill p-2" name="scanRaportKelas9Ganjil"
                                    type="file">
                                    <div class="w-100">
                                        @if ($biodata && $biodata->scanRaportKelas9Ganjil)
                                        <p class="mt-2">File sebelumnya: {{ $biodata->scanRaportKelas9Ganjil }}</p>
                                        @endif
                                        <p class="text-xs">*Format file yang diterima adalah JPG, PNG, GIF, SVG</p>
                                    </div>
                                
                            </div>
                            <!-- Scan Raport Kelas 9 Genap -->
                            <div class="mb-3">
                                <label for="scanRaportKelas9Genap" class="form-label fw-bold">Scan Raport Kelas IX -
                                    Semester Genap*</label>
                                <input class="form-control rounded-pill p-2" name="scanRaportKelas9Genap" type="file">
                                <div class="w-100">
                                    @if ($biodata && $biodata->scanRaportKelas9Genap)
                                    <p class="mt-2">File sebelumnya: {{ $biodata->scanRaportKelas9Genap }}</p>
                                    @endif
                                    <p class="text-xs">*Format file yang diterima adalah JPG, PNG, GIF, SVG</p>
                                </div>
                                
                            </div>
                            <!-- Sertifikat Lomba Akademik/Non-Akademik -->
                            <div class="mb-3">
                                <label for="sertifikatPrestasi" class="form-label fw-bold">Sertifikat Lomba
                                    Akademik/Non-Akademik</label>
                                <input class="form-control rounded-pill p-2" name="sertifikatPrestasi" type="file">
                                <div class="w-100">
                                    @if ($biodata && $biodata->sertifikatPrestasi)
                                    <p class="mt-2">File sebelumnya: {{ $biodata->sertifikatPrestasi }}</p>
                                @endif
                                    <p class="text-xs">*Format file yang diterima adalah JPG, PNG, GIF, SVG</p>
                                </div>
                                
                            </div>

                            <!-- Sertifikasi Bahasa -->
                            <div class="mb-3">
                                <label for="sertifikatSertifikasi" class="form-label fw-bold">Sertifikasi Bahasa</label>
                                <input class="form-control rounded-pill p-2" name="sertifikatSertifikasi" type="file">
                                <div class="w-100">
                                    @if ($biodata && $biodata->sertifikatSertifikasi)
                                        <p class="mt-2">File sebelumnya: {{ $biodata->sertifikatSertifikasi }}</p>
                                    @endif
                                    <p class="text-xs">*Format file yang diterima adalah JPG, PNG, GIF, SVG</p>
                                </div>
                                
                            </div>
                            
                            <button type="button" class="w-100 p-3 m-2 fs-5 btn btn-sm btn-success shadow-sm" data-toggle="modal" data-target="#confirmationModal">
                                <i class="fas fa-download fa-sm text-white-50"></i> Submit Biodata & Berkas
                            </button>
                            
                            <!-- Modal Submit Biodata & Berkas -->
                            <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Pengiriman</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Apakah anda yakin semua berkas administrasi sudah sesuai dan lengkap?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                            <button type="submit" name="submit" class="btn btn-success">Ya, Kirim Sekarang</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            

                </form>
                
    </div>
    </div>




    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{-- <script>
        $('#saveProgressButton').click(function() {
        $('#biodataForm input[required]').removeAttr('required');
        $('#biodataForm textarea[required]').removeAttr('required');
        $('#biodataForm').submit();
    });
    </script> --}}
    
@endsection
