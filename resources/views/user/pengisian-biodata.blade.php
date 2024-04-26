@extends('layouts.user')

@section('content')
    <div class="container-fluid">
        <a href="/user/dashboard" class="pt-5 link-primary">
            < Back to Dashboard</a>
                <div class="d-sm-flex align-items-center justify-content-between mb-4 mt-5">
                    <h1 class="h3 mb-0 text-dark">Pengisian Biodata & Berkas</h1>
                    <a href="#" class="p-2 fs-6 btn btn-sm btn-primary shadow-sm"><i
                            class="fas fa-solid fa-question  text-white-50"></i> Bantuan</a>
                </div>

                <form action="{{ route('user.biodata.store') }}" method="POST" enctype="multipart/form-data">
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
                                        name="namaLengkap" value="" required>
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
                                            type="radio" value="Laki-laki"
                                            aria-label="Radio button for following text input">
                                        <label class="form-check-label pe-3" for="radioLaki">
                                            Laki-laki
                                        </label>
                                        <input class="form-check-input mt-0" id="radioPerempuan" name="jenisKelamin"
                                            type="radio" value="Perempuan"
                                            aria-label="Radio button for following text input">
                                        <label class="form-check-label" for="radioPerempuan">
                                            Perempuan
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <!-- Nomor NIK  -->
                            <div class="row mb-3">
                                <div class="col-12 col-md-2 d-flex align-items-center">
                                    <h6 class="fw-bold ">Nomor NIK*</h6>
                                </div>
                                <div class="col-12 col-md-10 justify-content-md-start align-items-center">
                                    <input id="nomorNIK" type="number" class="rounded-pill p-2 form-control"
                                        name="nomorNIK" value="" required>
                                </div>
                            </div>
                            <!-- Tempat Lahir -->
                            <div class="row mb-3">
                                <div class="col-12 col-md-2 d-flex align-items-center">
                                    <h6 class="fw-bold ">Tempat Lahir*</h6>
                                </div>
                                <div class="col-12 col-md-10 justify-content-md-start align-items-center">
                                    <input id="tempatLahir" type="text" class="rounded-pill p-2 form-control"
                                        name="tempatLahir" value="" required>
                                </div>
                            </div>

                            <!-- Tanggal Lahir -->
                            <div class="row mb-3">
                                <div class="col-12 col-md-2 d-flex align-items-center">
                                    <h6 class="fw-bold">Tanggal Lahir*</h6>
                                </div>
                                <div class="col-12 col-md-10  justify-content-center justify-content-md-start">
                                    <input id="tanggalLahir" type="date" class="rounded-pill p-2 form-control"
                                        name="tanggalLahir" value="" required>
                                </div>
                            </div>

                            <!-- Jumlah Saudara Kandung -->
                            <div class="row mb-3">
                                <div class="col-12 col-md-2 d-flex align-items-center">
                                    <h6 class="fw-bold">Jumlah Saudara Kandung*</h6>
                                </div>
                                <div class="col-12 col-md-10  justify-content-start">
                                    <input id="jumlahSaudaraKandung" type="number" class="rounded-pill p-2 form-control"
                                        name="jumlahSaudaraKandung" value="" required>
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
                                            name="jumlahSaudaraAngkat" value="" required>
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
                                        name="tinggiBadan" value="" required>
                                </div>
                            </div>

                            <!-- Berat Badan -->
                            <div class="row mb-3">
                                <div class="col-12 col-md-2 d-flex align-items-center">
                                    <h6 class="fw-bold">Berat Badan (kg)*</h6>
                                </div>
                                <div class="col-12 col-md-10  justify-content-start">
                                    <input id="beratBadan" type="number" class="rounded-pill p-2 form-control"
                                        name="beratBadan" value="" required>
                                </div>
                            </div>

                            <!-- Alamat Siswa -->
                            <div class="row mb-3">
                                <div class="col-12 col-md-2 d-flex align-items-center">
                                    <h6 class="fw-bold">Alamat Siswa*</h6>
                                </div>
                                <div class="col-12 col-md-10  justify-content-start">
                                    <input id="alamatSiswa" type="text" class="rounded-pill p-2 form-control"
                                        name="alamatSiswa" value="" required>
                                </div>
                            </div>

                            <!-- Jenis Tinggal -->
                            <div class="row mb-3">
                                <div class="col-12 col-md-2 d-flex align-items-center">
                                    <h6 class="fw-bold">Jenis Tinggal*</h6>
                                </div>
                                <div class="col-12 col-md-10 d-flex align-items-center justify-content-start">
                                    <select name="jenisTinggal" class="rounded-pill p-2 form-select" required>
                                        <option value="Bersama Orang Tua">Bersama Orang Tua</option>
                                        <option value="Bersama Wali">Bersama Wali</option>
                                        <option value="Kost">Kost</option>
                                        <option value="Asrama">Asrama</option>
                                        <option value="Lainnya">Lainnya</option>
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
                                        <option value="Jalan Kaki">Jalan Kaki</option>
                                        <option value="Mobil Pribadi">Mobil Pribadi</option>
                                        <option value="Kendaraan Umum">Kendaraan Umum (Angkot/Ojek Online/Becak)</option>
                                        <option value="Jemputan Sekolah">Jemputan Sekolah</option>
                                        <option value="Sepeda Motor">Sepeda Motor</option>
                                        <option value="Sepeda">Sepeda</option>
                                        <option value="Lainnya">Lainnya</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Agama Siswa -->
                            <div class="row mb-3">
                                <div class="col-12 col-md-2 d-flex align-items-center">
                                    <h6 class="fw-bold">Agama Siswa*</h6>
                                </div>
                                <div class="col-12 col-md-10 d-flex align-items-center justify-content-start">
                                    <select name="agamaSiswa" class="rounded-pill p-2 form-select">
                                        <option value="Islam">Islam</option>
                                        <option value="Kristen">Kristen</option>
                                        <option value="Katolik">Katolik</option>
                                        <option value="Buddha">Buddha</option>
                                        <option value="Hindu">Hindu</option>
                                        <option value="Konghucu">Konghucu</option>
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
                                        name="nomorTeleponSiswa" value="" required>
                                </div>
                            </div>



                            <!-- Nama Sekolah Asal -->
                            <div class="row mb-3">
                                <div class="col-12 col-md-2 d-flex align-items-center">
                                    <h6 class="fw-bold">Nama Sekolah Asal*</h6>
                                </div>
                                <div class="col-12 col-md-10 justify-content-start">
                                    <input id="namaSekolahAsal" type="text" class="rounded-pill p-2 form-control"
                                        name="namaSekolahAsal" value="" required>
                                </div>
                            </div>

                            <!-- Alamat Sekolah Asal -->
                            <div class="row mb-3">
                                <div class="col-12 col-md-2 d-flex align-items-center">
                                    <h6 class="fw-bold">Alamat Sekolah Asal*</h6>
                                </div>
                                <div class="col-12 col-md-10 justify-content-start">
                                    <input id="alamatSekolahAsal" type="text" class="rounded-pill p-2 form-control"
                                        name="alamatSekolahAsal" value="" required>
                                </div>
                            </div>

                            <!-- Provinsi Sekolah Asal -->
                            <div class="row mb-3">
                                <div class="col-12 col-md-2 d-flex align-items-center">
                                    <h6 class="fw-bold">Provinsi Sekolah Asal*</h6>
                                </div>
                                <div class="col-12 col-md-10 justify-content-start">
                                    <select name="provinsiSekolahAsal" class="rounded-pill p-2 form-select" required>
                                        <option value="Jawa Timur">Jawa Timur</option>
                                        <option value="Sulawesi Selatan">Sulawesi Selatan</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Kota Sekolah Asal -->
                            <div class="row mb-2">
                                <div class="col-12 col-md-2 d-flex align-items-center">
                                    <h6 class="fw-bold">Kota/Kabupaten Sekolah Asal*</h6>
                                </div>
                                <div class="col-12 col-md-10 justify-content-start">
                                    <select name="kotaSekolahAsal" class="rounded-pill p-2 form-select">
                                        <option value="Jawa Timur">Jawa Timur</option>
                                        <option value="Sulawesi Selatan">Sulawesi Selatan</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Kecamatan Sekolah Asal -->
                            <div class="row mb-2">
                                <div class="col-12 col-md-2 d-flex align-items-center">
                                    <h6 class="fw-bold">Kecamatan Sekolah Asal*</h6>
                                </div>
                                <div class="col-12 col-md-10 justify-content-start">
                                    <select name="kecamatanSekolahAsal" class="rounded-pill p-2 form-select">
                                        <option value="Jawa Timur">Jawa Timur</option>
                                        <option value="Sulawesi Selatan">Sulawesi Selatan</option>
                                    </select>
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
                                        value="">
                                </div>
                            </div>

                            <!-- Pekerjaan Ibu Kandung-->
                            <div class="row mb-2">
                                <div class="col-12 col-md-2 d-flex align-items-center">
                                    <h6 class="fw-bold">Pekerjaan Ibu Kandung*</h6>
                                </div>
                                <div class="col-12 col-md-10 justify-content-start">
                                    <input type="text" name="pekerjaanIbuKandung"
                                        class="rounded-pill p-2 form-control" value="">
                                </div>
                            </div>

                            <!-- Penghasilan Bulanan Ibu Kandung-->
                            <div class="row mb-2">
                                <div class="col-12 col-md-2 d-flex align-items-center">
                                    <h6 class="fw-bold">Penghasilan Bulanan Ibu Kandung*</h6>
                                </div>
                                <div class="col-12 col-md-10 justify-content-start">
                                    <input type="number" name="penghasilanIbuKandung"
                                        class="rounded-pill p-2 form-control" value="">
                                </div>
                            </div>

                            <!-- Nomor Telepon/WA Ibu Kandung-->
                            <div class="row mb-2">
                                <div class="col-12 col-md-2 d-flex align-items-center">
                                    <h6 class="fw-bold">Nomor Telepon/WhatsApp Ibu Kandung*</h6>
                                </div>
                                <div class="col-12 col-md-10 justify-content-start">
                                    <input type="number" name="nomorTeleponIbuKandung"
                                        class="rounded-pill p-2 form-control" value="">
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
                                        value="">
                                </div>
                            </div>

                            <!-- Pekerjaan Ayah Kandung -->
                            <div class="row mb-2">
                                <div class="col-12 col-md-2 d-flex align-items-center">
                                    <h6 class="fw-bold">Pekerjaan Ayah Kandung*</h6>
                                </div>
                                <div class="col-12 col-md-10 justify-content-start">
                                    <input type="text" name="pekerjaanAyahKandung"
                                        class="rounded-pill p-2 form-control" value="">
                                </div>
                            </div>

                            <!-- Penghasilan Bulanan Ayah Kandung -->
                            <div class="row mb-2">
                                <div class="col-12 col-md-2 d-flex align-items-center">
                                    <h6 class="fw-bold">Penghasilan Bulanan Ayah Kandung*</h6>
                                </div>
                                <div class="col-12 col-md-10 justify-content-start">
                                    <input type="number" name="penghasilanAyahKandung"
                                        class="rounded-pill p-2 form-control" value="">
                                </div>
                            </div>

                            <!-- Nomor Telepon/WA Ayah Kandung -->
                            <div class="row mb-2">
                                <div class="col-12 col-md-2 d-flex align-items-center">
                                    <h6 class="fw-bold">Nomor Telepon/WhatsApp Ayah Kandung*</h6>
                                </div>
                                <div class="col-12 col-md-10 justify-content-start">
                                    <input type="number" name="nomorTeleponAyahKandung"
                                        class="rounded-pill p-2 form-control" value="">
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
                                        value="">
                                </div>
                            </div>

                            <!-- Pekerjaan Wali -->
                            <div class="row mb-2">
                                <div class="col-12 col-md-2 d-flex align-items-center">
                                    <h6 class="fw-bold">Pekerjaan Wali</h6>
                                </div>
                                <div class="col-12 col-md-10 justify-content-start">
                                    <input type="text" name="pekerjaanWali" class="rounded-pill p-2 form-control"
                                        value="">
                                </div>
                            </div>

                            <!-- Penghasilan Bulanan Wali -->
                            <div class="row mb-2">
                                <div class="col-12 col-md-2 d-flex align-items-center">
                                    <h6 class="fw-bold">Penghasilan Bulanan Wali</h6>
                                </div>
                                <div class="col-12 col-md-10 justify-content-start">
                                    <input type="number" name="penghasilanWali" class="rounded-pill p-2 form-control"
                                        value="">
                                </div>
                            </div>

                            <!-- Nomor Telepon/WA Wali -->
                            <div class="row mb-2">
                                <div class="col-12 col-md-2 d-flex align-items-center">
                                    <h6 class="fw-bold">Nomor Telepon/WhatsApp Wali</h6>
                                </div>
                                <div class="col-12 col-md-10 justify-content-start">
                                    <input type="number" name="nomorTeleponWali" class="rounded-pill p-2 form-control"
                                        value="">
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


                            <div class="mb-3">
                                <label for="berkasAktaKelahiran" class="form-label fw-bold">Akta Kelahiran</label>
                                <input class="form-control rounded-pill p-2" name="berkasAktaKelahiran"type="file">
                            </div>
                            <div class="mb-3">
                                <label for="berkasKartuKeluarga" class="form-label fw-bold">Kartu Keluarga</label>
                                <input class="form-control rounded-pill p-2" name="berkasKartuKeluarga"type="file">
                            </div>
                            <div class="mb-3">
                                <label for="berkasKTPAyahKandung" class="form-label fw-bold">KTP Ayah Kandung</label>
                                <input class="form-control rounded-pill p-2" name="berkasKTPAyahKandung"type="file">
                            </div>

                            <div class="mb-3">
                                <label for="berkasKTPIbuKandung" class="form-label fw-bold">KTP Ibu Kandung</label>
                                <input class="form-control rounded-pill p-2" name="berkasKTPIbuKandung"type="file">
                            </div>

                            <div class="mb-3">
                                <label for="berkasKTPWali" class="form-label fw-bold">KTP Wali</label>
                                <input class="form-control rounded-pill p-2" name="berkasKTPWali"type="file">
                            </div>

                            <!--Div Kosong -->
                            <div class="d-flex justify-content-start align-items-center mb-5">

                            </div>

                            <!-- Scan Raport Kelas 7 Ganjil -->
                            <div class="mb-3">
                                <label for="scanRaportKelas7Ganjil" class="form-label fw-bold">Scan Raport Kelas VII -
                                    Semester Ganjil</label>
                                <input class="form-control rounded-pill p-2" name="scanRaportKelas7Ganjil"type="file">
                            </div>
                            <!-- Scan Raport Kelas 7 Genap -->
                            <div class="mb-3">
                                <label for="scanRaportKelas7Genap" class="form-label fw-bold">Scan Raport Kelas VII -
                                    Semester Genap</label>
                                <input class="form-control rounded-pill p-2" name="scanRaportKelas7Genap"type="file">
                            </div>
                            <!-- Scan Raport Kelas 8 Ganjil -->
                            <div class="mb-3">
                                <label for="scanRaportKelas8Ganjil" class="form-label fw-bold">Scan Raport Kelas VIII -
                                    Semester Ganjil</label>
                                <input class="form-control rounded-pill p-2" name="scanRaportKelas8Ganjil"type="file">
                            </div>
                            <!-- Scan Raport Kelas 8 Genap -->
                            <div class="mb-3">
                                <label for="scanRaportKelas8Genap" class="form-label fw-bold">Scan Raport Kelas VIII -
                                    Semester Genap</label>
                                <input class="form-control rounded-pill p-2" name="scanRaportKelas8Genap"type="file">
                            </div>

                            <!-- Scan Raport Kelas 9 Ganjil -->
                            <div class="mb-3">
                                <label for="scanRaportKelas9Ganjil" class="form-label fw-bold">Scan Raport Kelas IX -
                                    Semester Ganjil</label>
                                <input class="form-control rounded-pill p-2" name="scanRaportKelas9Ganjil"type="file">
                            </div>
                            <!-- Scan Raport Kelas 9 Genap -->
                            <div class="mb-3">
                                <label for="scanRaportKelas9Genap" class="form-label fw-bold">Scan Raport Kelas IX -
                                    Semester Genap</label>
                                <input class="form-control rounded-pill p-2" name="scanRaportKelas9Genap"type="file">
                            </div>

                            <!--Div Kosong -->
                            <div class="d-flex justify-content-start align-items-center mb-5">

                            </div>

                            <!-- Scan Lomba Prestasi -->
                            <div class="mb-3">
                                <label for="sertifikatPrestasi" class="form-label fw-bold">Sertifikat Lomba
                                    Akademik/Non-Akademik</label>
                                <input class="form-control rounded-pill p-2" name="sertifikatPrestasi"type="file">
                            </div>

                            <!-- Scan Sertifikasi  -->
                            <div class="mb-3">
                                <label for="sertifikatSertifikasi" class="form-label fw-bold">Sertifikasi Bahasa</label>
                                <input class="form-control rounded-pill p-2" name="sertifikatSertifikasi"type="file">
                            </div>


                            <button type="submit" class="w-100 p-3 m-2 fs-5 btn btn-sm btn-success shadow-sm" formmethod="post">
                                <i class="fas fa-download fa-sm text-white-50"></i> Submit
                            </button>

                </form>
    </div>
    </div>




    </div>
@endsection
