@extends('layouts.user')

@section('content')

<div class="container-fluid">
    <a href="/user/dashboard" class="pt-5 link-primary">< Back to Dashboard</a>
    <div class="d-sm-flex align-items-center justify-content-between mb-4 mt-5">
        <h1 class="h3 mb-0 text-dark">Pengisian Biodata & Berkas</h1>
        <a href="#" class="p-2 fs-6 btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-solid fa-question  text-white-50"></i> Bantuan</a>
    </div>

    <!-- Biodata Siswa -->
    <div class="card shadow mb-4">
        <div class="card-header d-flex justify-content-between py-3 align-items-center">
            <h5 class="m-0 fw-bold text-primary">I. Biodata Calon Siswa</h5>
        </div>
        
        <div class="card-body">
            <form action="#" method="post">
                <!-- Nama Lengkap -->
                <div class="d-flex justify-content-start align-items-center mb-2">
                        <h6 class="col-2 fw-bold">Nama Lengkap</h6>
                        <input id="asalSekolah" type="text" class="rounded-pill p-2 form-control" name="asalSekolah" value="">  
                </div>

                <!-- Jenis Kelamin -->
                <div class="d-flex justify-content-start align-items-center mb-2">
                    <h6 class="col-2 fw-bold">Jenis Kelamin</h6>
                    <div class="d-flex p-2 align-items-center form-check form-check-inline">
                        <input class="form-check-input mt-0" id="radioLaki" name="radioJenisKelamin" type="radio" value="Laki-laki" aria-label="Radio button for following text input">
                        <label class="form-check-label pe-3" for="radioLaki">
                            Laki-laki
                        </label>
                    </div>
                    <div class="d-flex align-items-center p-2 form-check form-check-inline">
                        <input class="form-check-input mt-0" id="radioPerempuan" name="radioJenisKelamin" type="radio" value="Perempuan" aria-label="Radio button for following text input">
                        <label class="form-check-label" for="radioPerempuan">
                            Perempuan
                        </label>
                    </div>
                </div>
                <!-- Tempat Lahir -->
                <div class="d-flex justify-content-start align-items-center mb-2">
                    <h6 class="col-2 fw-bold">Tempat Lahir</h6>
                    <input id="asalSekolah" type="text" class="rounded-pill p-2 form-control" name="tempatLahir" value="">  
                </div>

                <!-- Tanggal Lahir -->
                <div class="d-flex justify-content-start align-items-center mb-2">
                    <h6 class="col-2 fw-bold">Tanggal Lahir</h6>
                    <input id="tanggalLahir" type="date" class="rounded-pill p-2 form-control" name="tanggalLahir" value="">  
                </div>

                <!-- Jumlah Saudara Kandung -->
                <div class="d-flex justify-content-start align-items-center mb-2">
                    <h6 class="col-2 fw-bold">Jumlah Saudara Kandung</h6>
                    <input id="jumlahSaudaraKandung" type="number" class="rounded-pill p-2 form-control" name="jumlahSaudaraKandung" value="">  
                </div>
                
                <!-- Jumlah Saudara Tiri/Angkat -->
                <div class="d-flex justify-content-start align-items-center mb-2">
                    <h6 class="col-2 fw-bold">Jumlah Saudara Tiri/Angkat</h6>
                    <div class="row-2 w-100">
                        <input id="jumlahSaudaraKandung" type="number" class="rounded-pill p-2 form-control" name="jumlahSaudaraKandung" value="">  
                        <p class="text-xs">*Jika tidak ada isi dengan angka 0</p>
                    </div>  
                </div>

                <!-- Tinggi Badan -->
                <div class="d-flex justify-content-start align-items-center mb-2">
                    <h6 class="col-2 fw-bold">Tinggi Badan (cm)</h6>
                    <input id="tinggiBadan" type="number" class="rounded-pill p-2 form-control" name="tinggiBadan" value="">  
                </div>

                <!-- Berat Badan -->
                <div class="d-flex justify-content-start align-items-center mb-2">
                    <h6 class="col-2 fw-bold">Berat Badan (kg)</h6>
                    <input id="beratBadan" type="number" class="rounded-pill p-2 form-control" name="beratBadan" value="">  
                </div>

                <!-- Alamat Siswa -->
                <div class="d-flex justify-content-start align-items-center mb-2">
                    <h6 class="col-2 fw-bold">Alamat Siswa</h6>
                    <input id="alamatSiswa" type="text" class="rounded-pill p-2 form-control" name="alamatSiswa" value="">  
                </div>

                <!-- Jenis Tinggal -->
                <div class="d-flex justify-content-start align-items-center mb-2">
                    <h6 class="col-2 fw-bold">Jenis Tinggal</h6>
                    <select name="jenisTinggal" class="rounded-pill p-2 form-select">
                        <option value="Orang Tua">Orang Tua</option>
                        <option value="Online">Online</option>
                        
                    </select>
                </div>

                <!-- Transportasi ke Sekolah -->
                <div class="d-flex justify-content-start align-items-center mb-2">
                    <h6 class="col-2 fw-bold">Transpor</h6>
                    <select name="transportasiKeSekolah" class="rounded-pill p-2 form-select">
                        <option value="Orang Tua">Orang Tua</option>
                        <option value="Becak">Becak</option>
                        
                    </select>
                </div>

                <!-- Agama SIswa -->
                <div class="d-flex justify-content-start align-items-center mb-2">
                    <h6 class="col-2 fw-bold">Agama Siswa</h6>
                    <select name="agamaSiswa" class="rounded-pill p-2 form-select">
                        <option value="Kristen">Kristen</option>
                        <option value="Katolik">Katolik</option>
                        <option value="Buddha">Buddha</option>
                        <option value="Islam">Islam</option>
                        <option value="Konghucu">Konghucu</option>
                        <option value="Hindu">Hindu</option>
                    </select>
                </div>

                <!-- Nomor Telepon Siswa -->
                <div class="d-flex justify-content-start align-items-center mb-2">
                    <h6 class="col-2 fw-bold">Nomor Telepon Siswa</h6>
                    <input id="nomorTeleponSiswa" type="number" class="rounded-pill p-2 form-control" name="nomorTeleponSiswa" value="">  
                </div>

                <!-- Nama Sekolah Asal -->
                <div class="d-flex justify-content-start align-items-center mb-2">
                    <h6 class="col-2 fw-bold">Nama Sekolah Asal</h6>
                    <input id="namaSekolahAsal" type="text" class="rounded-pill p-2 form-control" name="namaSekolahAsal" value="">  
                </div>

                <!-- Alamat Sekolah Asal -->
                <div class="d-flex justify-content-start align-items-center mb-2">
                    <h6 class="col-2 fw-bold">Alamat Sekolah Asal</h6>
                    <input id="alamatSekolahAsal" type="text" class="rounded-pill p-2 form-control" name="alamatSekolahAsal" value="">  
                </div>

                <!-- Provinsi Sekolah Asal -->
                <div class="d-flex justify-content-start align-items-center mb-2">
                    <h6 class="col-2 fw-bold">Provinsi Sekolah Asal</h6>
                    <select name="provinsiSekolahAsal" class="rounded-pill p-2 form-select">
                        <option value="Jawa Timur">Jawa Timur</option>
                        <option value="Sulawesi Selatan">Sulawesi Selatan</option>
              
                    </select>
                </div>

                <!-- Kota Sekolah Asal -->
                <div class="d-flex justify-content-start align-items-center mb-2">
                    <h6 class="col-2 fw-bold">Kota/Kabupaten Sekolah Asal</h6>
                    <select name="kotaSekolahAsal" class="rounded-pill p-2 form-select">
                        <option value="Jawa Timur">Jawa Timur</option>
                        <option value="Sulawesi Selatan">Sulawesi Selatan</option>
              
                    </select>
                </div>

                <!-- Kecamatan Sekolah Asal -->
                <div class="d-flex justify-content-start align-items-center mb-2">
                    <h6 class="col-2 fw-bold">Kecamatan Sekolah Asal</h6>
                    <select name="kecamatanSekolahAsal" class="rounded-pill p-2 form-select">
                        <option value="Jawa Timur">Jawa Timur</option>
                        <option value="Sulawesi Selatan">Sulawesi Selatan</option>
              
                    </select>
                </div>
            </form>
        </div>

    
    </div>

    <!-- Biodata Orang Tua/Wali-->
    <div class="card shadow mb-4">
        <div class="card-header d-flex justify-content-between py-3 align-items-center">
            <h5 class="m-0 fw-bold text-primary">II. Biodata Orang Tua/Wali</h5>
        </div>

        <div class="card-body">
            <form action="#" method="post">
                <!-- Nama Lengkap Ibu Kandung-->
                <div class="d-flex justify-content-start align-items-center mb-2">
                    <h6 class="col-2 fw-bold">Nama Lengkap Ibu Kandung</h6>
                    <input type="text" name="namaIbuKandung" class="rounded-pill p-2 form-control"  value="">  
                </div>

                <!-- Pekerjaan Ibu Kandung-->
                <div class="d-flex justify-content-start align-items-center mb-2">
                    <h6 class="col-2 fw-bold">Pekerjaan Ibu Kandung</h6>
                    <input type="text" name="pekerjaanIbuKandung" class="rounded-pill p-2 form-control"  value="">  
                </div>

                <!-- Penghasilan Bulanan Ibu Kandung-->
                <div class="d-flex justify-content-start align-items-center mb-2">
                    <h6 class="col-2 fw-bold">Penghasilan Bulanan Ibu Kandung</h6>
                    <input type="number" name="penghasilanIbuKandung" class="rounded-pill p-2 form-control"  value="">  
                </div>

                <!-- Nomor Telepon/WA Ibu Kandung-->
                <div class="d-flex justify-content-start align-items-center mb-2">
                    <h6 class="col-2 fw-bold">Nomor Telepon/WhatsApp Ibu Kandung</h6>
                    <input type="number" name="nomorTeleponIbuKandung" class="rounded-pill p-2 form-control"  value="">  
                </div>

                <!--Div Kosong -->
                <div class="d-flex justify-content-start align-items-center mb-5">
                    
                </div>

                <!-- Nama Lengkap Ibu Kandung-->
                <div class="d-flex justify-content-start align-items-center mb-2">
                    <h6 class="col-2 fw-bold">Nama Lengkap Ayah Kandung</h6>
                    <input type="text" name="namaAyahKandung" class="rounded-pill p-2 form-control"  value="">  
                </div>

                <!-- Pekerjaan Ayah Kandung-->
                <div class="d-flex justify-content-start align-items-center mb-2">
                    <h6 class="col-2 fw-bold">Pekerjaan Ayah Kandung</h6>
                    <input type="text" name="pekerjaanAyahKandung" class="rounded-pill p-2 form-control"  value="">  
                </div>

                <!-- Penghasilan Bulanan Ayah Kandung-->
                <div class="d-flex justify-content-start align-items-center mb-2">
                    <h6 class="col-2 fw-bold">Penghasilan Bulanan Ayah Kandung</h6>
                    <input type="number" name="penghasilanAyahKandung" class="rounded-pill p-2 form-control"  value="">  
                </div>

                <!-- Nomor Telepon/WA Ayah Kandung-->
                <div class="d-flex justify-content-start align-items-center mb-2">
                    <h6 class="col-2 fw-bold">Nomor Telepon/WhatsApp Ayah Kandung</h6>
                    <input type="number" name="nomorTeleponAyahKandung" class="rounded-pill p-2 form-control"  value="">  
                </div>

                <!--Div Kosong -->
                <div class="d-flex justify-content-start align-items-center mb-5">
                    
                </div>

                <!-- Nama Lengkap Wali-->
                <div class="d-flex justify-content-start align-items-center mb-2">
                    <h6 class="col-2 fw-bold">Nama Lengkap Wali</h6>
                    <input type="text" name="namaWali" class="rounded-pill p-2 form-control"  value="">  
                </div>

                <!-- Pekerjaan Wali-->
                <div class="d-flex justify-content-start align-items-center mb-2">
                    <h6 class="col-2 fw-bold">Pekerjaan Wali</h6>
                    <input type="text" name="pekerjaanWali" class="rounded-pill p-2 form-control"  value="">  
                </div>

                <!-- Penghasilan Bulanan Wali-->
                <div class="d-flex justify-content-start align-items-center mb-2">
                    <h6 class="col-2 fw-bold">Penghasilan Bulanan Wali</h6>
                    <input type="number" name="penghasilanWali" class="rounded-pill p-2 form-control"  value="">  
                </div>

                <!-- Nomor Telepon/WA Wali-->
                <div class="d-flex justify-content-start align-items-center mb-2">
                    <h6 class="col-2 fw-bold">Nomor Telepon/WhatsApp Wali</h6>
                    <input type="number" name="nomorTeleponWali" class="rounded-pill p-2 form-control"  value="">  
                </div>


            </form>
        </div>

    </div>

    <!-- Lampiran Dokumen -->
    <div class="card shadow mb-4">
        <div class="card-header d-flex justify-content-between py-3 align-items-center">
            <h5 class="m-0 fw-bold text-primary">III. Lampiran Dokumen</h5>
        </div>

        <div class="card-body">
            
            <form action="#" method="post">
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
                    <label for="scanRaportKelas7Ganjil" class="form-label fw-bold">Scan Raport Kelas VII - Semester Ganjil</label>
                    <input class="form-control rounded-pill p-2" name="scanRaportKelas7Ganjil"type="file">
                </div>
                <!-- Scan Raport Kelas 7 Genap -->
                <div class="mb-3">
                    <label for="scanRaportKelas7Genap" class="form-label fw-bold">Scan Raport Kelas VII - Semester Genap</label>
                    <input class="form-control rounded-pill p-2" name="scanRaportKelas7Genap"type="file">
                </div>
                <!-- Scan Raport Kelas 8 Ganjil -->
                <div class="mb-3">
                    <label for="scanRaportKelas8Ganjil" class="form-label fw-bold">Scan Raport Kelas VIII - Semester Ganjil</label>
                    <input class="form-control rounded-pill p-2" name="scanRaportKelas8Ganjil"type="file">
                </div>
                <!-- Scan Raport Kelas 8 Genap -->
                <div class="mb-3">
                    <label for="scanRaportKelas8Genap" class="form-label fw-bold">Scan Raport Kelas VIII - Semester Genap</label>
                    <input class="form-control rounded-pill p-2" name="scanRaportKelas8Genap"type="file">
                </div>

                <!-- Scan Raport Kelas 9 Ganjil -->
                <div class="mb-3">
                    <label for="scanRaportKelas9Ganjil" class="form-label fw-bold">Scan Raport Kelas IX - Semester Ganjil</label>
                    <input class="form-control rounded-pill p-2" name="scanRaportKelas9Ganjil"type="file">
                </div>
                <!-- Scan Raport Kelas 9 Genap -->
                <div class="mb-3">
                    <label for="scanRaportKelas9Genap" class="form-label fw-bold">Scan Raport Kelas IX - Semester Genap</label>
                    <input class="form-control rounded-pill p-2" name="scanRaportKelas9Genap"type="file">
                </div>

                <!--Div Kosong -->
                <div class="d-flex justify-content-start align-items-center mb-5">
                    
                </div>

                <!-- Scan Lomba Prestasi -->
                <div class="mb-3">
                    <label for="sertifikatPrestasi" class="form-label fw-bold">Sertifikat Lomba Akademik/Non-Akademik</label>
                    <input class="form-control rounded-pill p-2" name="sertifikatPrestasi"type="file">
                </div>

                <!-- Scan Sertifikasi  -->
                <div class="mb-3">
                    <label for="sertifikatSertifikasi" class="form-label fw-bold">Sertifikasi Bahasa</label>
                    <input class="form-control rounded-pill p-2" name="sertifikatSertifikasi"type="file">
                </div>

            </form>
        </div>
    </div>

    <div class="d-sm-flex align-items-center justify-content-between mb-4 mt-5">
        <a href="#" class="w-25 p-3 m-2 fs-5 btn btn-sm btn-info shadow-sm">
            <i class="fas fa-download fa-sm text-white-50"></i> Simpan Progres</a>
        <a href="#" class="w-100 p-3 m-2 fs-5 btn btn-sm btn-success shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Submit </a>
            
    </div>

    
</div>


@endsection