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


        <!-- Semua Calon Siswa -->
        <a href="/admin/pendaftar" class="pt-5 link-primary">
            < Back to Pendaftar</a>
        <div class="card shadow mb-4 mt-4">
            <div class="card-header d-flex justify-content-between py-3 align-items-center">
                <h5 class="m-0 fw-bold text-primary">Daftar Calon Siswa</h5>
                {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Lihat Semua</a> --}}
            </div>
            <div class="card-body">
                <form action="{{ route('admin.apply-status.test') }}" method="POST">
                    <div class="d-flex justify-content-end mb-3">

                        @csrf

                        <label for="hasilTes">Pilih Status Hasil Tes:</label>
                        <select id="hasilTes" name="hasilTes" class="dropdown dropdown-toggle ">
                            <option value="Lulus">Lulus</option>
                            <option value="Tidak Lulus">Tidak Lulus</option>
                        </select>
                        <button type="submit" class="btn btn-primary ms-2">Terapkan Status</button>

                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th class="th-sm-1">No.</th>
                                    <th>Nama Lengkap</th>
                                    <th>Status Biodata</th>
                                    <th>Status Pendaftaran</th>
                                    <th>Biodata & Berkas</th>
                                    <th class="col-2">Action</th>
                                    <th>Pilih User</th>
                                    <th>Hasil Test</th>

                                </tr>
                            </thead>

                            @foreach ($biodata as $data)
                                <tr>
                                    <td>{{ $data->id }}</td>
                                    <td>{{ $data->user->email }}</td>
                                    <td>{{ $data->biodataStatus }}</td>
                                    <td>
                                        @foreach ($users as $user)
                                            @foreach ($user->registrations as $registration)
                                                @if ($user->id)
                                                    {{ $registration->registrationStatus }}
                                                @endif
                                            @endforeach
                                        @endforeach
                                    </td>
                                    <td>
                                        <a href="#fileModal{{ $data->id }}" class="btn btn-primary"
                                            data-toggle="modal">
                                            Lihat Berkas
                                        </a>

                                        <!-- Modal Biodata-->
                                        <div class="modal fade" id="fileModal{{ $data->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="fileModalLabel{{ $data->id }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-xl" role="document">
                                                <div class="modal-content p-3">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title fw-bold"
                                                            id="fileModalLabel{{ $data->id }}">
                                                            Berkas
                                                            Biodata</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col m-0 p-0">
                                                            <div class="modal-body">
                                                                <div class="card shadow mb-4">
                                                                    <div
                                                                        class="card-header d-flex justify-content-between py-3 align-items-cente fs-5 fw-bold">
                                                                        Data Diri Siswa </div>

                                                                    <div class="card-body">
                                                                        <div>
                                                                            <p class="m-0">Nama Lengkap :</p>
                                                                            <p class="fw-bold text-uppercase">
                                                                                {{ $data->namaLengkap }}</p>
                                                                        </div>
                                                                        <div>
                                                                            <p class="m-0">Jenis Kelamin :</p>
                                                                            <p class="fw-bold text-uppercase">
                                                                                {{ $data->jenisKelamin }}</p>
                                                                        </div>
                                                                        <div>
                                                                            <p class="m-0">Nomor Induk Kependudukan (NIK)
                                                                            </p>
                                                                            <p class="fw-bold text-uppercase">
                                                                                {{ $data->nomorNIK }}</p>
                                                                        </div>
                                                                        <div>
                                                                            <p class="m-0">Tempat Lahir</p>
                                                                            <p class="fw-bold text-uppercase">
                                                                                {{ $data->tempatLahir }}</p>
                                                                        </div>
                                                                        <div>
                                                                            <p class="m-0">tanggalLahir</p>
                                                                            <p class="fw-bold text-uppercase">
                                                                                {{ $data->tanggalLahir }}</p>
                                                                        </div>
                                                                        <div>
                                                                            <p class="m-0">Jumlah Saudara Kandung</p>
                                                                            <p class="fw-bold text-uppercase">
                                                                                {{ $data->jumlahSaudaraKandung }}</p>
                                                                        </div>
                                                                        <div>
                                                                            <p class="m-0">Jumlah Saudara Angkat/Tiri</p>
                                                                            <p class="fw-bold text-uppercase">
                                                                                {{ $data->jumlahSaudaraAngkat }}</p>
                                                                        </div>
                                                                        <div>
                                                                            <p class="m-0">Tinggi Badan</p>
                                                                            <p class="fw-bold">{{ $data->tinggiBadan }} cm
                                                                            </p>
                                                                        </div>
                                                                        <div>
                                                                            <p class="m-0">Berat Badan</p>
                                                                            <p class="fw-bold text-uppercase">
                                                                                {{ $data->beratBadan }}</p>
                                                                        </div>
                                                                        <div>
                                                                            <p class="m-0">Alamat Siswa</p>
                                                                            <p class="fw-bold text-uppercase">
                                                                                {{ $data->alamatSiswa }}</p>
                                                                        </div>
                                                                        <div>
                                                                            <p class="m-0">Jenis Tinggal</p>
                                                                            <p class="fw-bold text-uppercase">
                                                                                {{ $data->jenisTinggal }}</p>
                                                                        </div>
                                                                        <div>
                                                                            <p class="m-0">Transportasi ke Sekolah</p>
                                                                            <p class="fw-bold text-uppercase">
                                                                                {{ $data->transportasiKeSekolah }}</p>
                                                                        </div>
                                                                        <div>
                                                                            <p class="m-0">Agama Siswa</p>
                                                                            <p class="fw-bold text-uppercase">
                                                                                {{ $data->agamaSiswa }}</p>
                                                                        </div>
                                                                        <div>
                                                                            <p class="m-0">Nomor Telepon Siswa</p>
                                                                            <p class="fw-bold text-uppercase">
                                                                                {{ $data->nomorTeleponSiswa }}</p>
                                                                        </div>


                                                                    </div>

                                                                </div>
                                                            </div>
                                                            <!-- Data Keluarga -->
                                                            <div class="modal-body">
                                                                <div class="card shadow mb-4">
                                                                    <div
                                                                        class="card-header d-flex justify-content-between py-3 align-items-center fs-5 fw-bold">
                                                                        Data Keluarga </div>


                                                                    <div class="card-body">
                                                                        <p class="fs-5 fw-bold">Ayah Kandung</p>
                                                                        <div>
                                                                            <p class="m-0">Nama Ayah Kandung :</p>
                                                                            <p class="fw-bold text-uppercase">
                                                                                {{ $data->namaAyahKandung }}</p>
                                                                        </div>
                                                                        <div>
                                                                            <p class="m-0">Pekerjaan Ayah Kandung :</p>
                                                                            <p class="fw-bold text-uppercase">
                                                                                {{ $data->pekerjaanAyahKandung }}</p>
                                                                        </div>
                                                                        <div>
                                                                            <p class="m-0">Penghasilan Ayah Kandung :
                                                                            </p>
                                                                            <p class="fw-bold text-uppercase">
                                                                                {{ $data->penghasilanAyahKandung }}</p>
                                                                        </div>
                                                                        <div>
                                                                            <p class="m-0">Nomor Telepon Ayah Kandung :
                                                                            </p>
                                                                            <p class="fw-bold text-uppercase">
                                                                                {{ $data->nomorTeleponAyahKandung }}</p>
                                                                        </div>


                                                                    </div>
                                                                    <!-- Ibu Kandung -->
                                                                    <div class="card-body">
                                                                        <p class="fs-5 fw-bold">Ibu Kandung</p>
                                                                        <div>
                                                                            <p class="m-0">Nama Ibu Kandung Kandung :
                                                                            </p>
                                                                            <p class="fw-bold text-uppercase">
                                                                                {{ $data->namaIbuKandung }}</p>
                                                                        </div>
                                                                        <div>
                                                                            <p class="m-0">Pekerjaan Ibu Kandung :</p>
                                                                            <p class="fw-bold text-uppercase">
                                                                                {{ $data->pekerjaanIbuKandung }}</p>
                                                                        </div>
                                                                        <div>
                                                                            <p class="m-0">Penghasilan Ibu Kandung :</p>
                                                                            <p class="fw-bold text-uppercase">
                                                                                {{ $data->penghasilanIbuKandung }}</p>
                                                                        </div>
                                                                        <div>
                                                                            <p class="m-0">Nomor Telepon Ibu Kandung :
                                                                            </p>
                                                                            <p class="fw-bold text-uppercase">
                                                                                {{ $data->nomorTeleponIbuKandung }}</p>
                                                                        </div>


                                                                    </div>

                                                                    <!-- Wali -->
                                                                    <div class="card-body">
                                                                        <p class="fs-5 fw-bold">Wali</p>
                                                                        <div>
                                                                            <p class="m-0">Nama Wali :</p>
                                                                            <p class="fw-bold text-uppercase">
                                                                                {{ $data->namaWali }}</p>
                                                                        </div>
                                                                        <div>
                                                                            <p class="m-0">Pekerjaan Wali :</p>
                                                                            <p class="fw-bold text-uppercase">
                                                                                {{ $data->pekerjaanWali }}</p>
                                                                        </div>
                                                                        <div>
                                                                            <p class="m-0">Penghasilan Wali :</p>
                                                                            <p class="fw-bold text-uppercase">
                                                                                {{ $data->penghasilanWali }}</p>
                                                                        </div>
                                                                        <div>
                                                                            <p class="m-0">Nomor Telepon Wali :</p>
                                                                            <p class="fw-bold text-uppercase">
                                                                                {{ $data->nomorTeleponWali }}</p>
                                                                        </div>


                                                                    </div>


                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="col m-0 p-0">
                                                            <!-- Sekolah Asal -->
                                                            <div class="modal-body">
                                                                <div class="card shadow mb-4">
                                                                    <div
                                                                        class="card-header d-flex justify-content-between py-3 align-items-center fs-5 fw-bold">
                                                                        Sekolah Asal </div>


                                                                    <div class="card-body">
                                                                        <div>
                                                                            <p class="m-0">Nama Sekolah Asal :</p>
                                                                            <p class="fw-bold text-uppercase">
                                                                                {{ $data->namaSekolahAsal }}</p>
                                                                        </div>
                                                                        <div>
                                                                            <p class="m-0">Provinsi Sekolah Asal :</p>
                                                                            <p class="fw-bold text-uppercase">
                                                                                {{ $data->provinsiSekolahAsal }}</p>
                                                                        </div>
                                                                        <div>
                                                                            <p class="m-0">Kota Sekolah Asal :</p>
                                                                            <p class="fw-bold text-uppercase">
                                                                                {{ $data->kotaSekolahAsal }}</p>
                                                                        </div>
                                                                        <div>
                                                                            <p class="m-0">Kecamatan Sekolah Asal :</p>
                                                                            <p class="fw-bold text-uppercase">
                                                                                {{ $data->kecamatanSekolahAsal }}</p>
                                                                        </div>


                                                                    </div>


                                                                </div>
                                                            </div>
                                                            <!-- Berkas Siswa -->
                                                            <div class="modal-body">
                                                                <div class="card shadow mb-4">
                                                                    <div
                                                                        class="card-header d-flex justify-content-between py-3 align-items-cente fs-5 fw-bold">
                                                                        Berkas Siswa
                                                                    </div>
                                                                    <div class="card-body">
                                                                        <div class="mb-3">
                                                                            <p class="m-0">Akta Kelahiran</p>
                                                                            @if ($data->berkasAktaKelahiran)
                                                                                <a href="{{ route('admin.biodata.file', ['user_id' => $data->user_id, 'filename' => $data->berkasAktaKelahiran]) }}"
                                                                                    class="btn btn-sm btn-primary"
                                                                                    target="_blank">Lihat Berkas</a>
                                                                            @else
                                                                                <span>Belum Upload Berkas Akta
                                                                                    Kelahiran</span>
                                                                            @endif
                                                                        </div>

                                                                        <div class="mb-3">
                                                                            <p class="m-0">Kartu Keluarga</p>
                                                                            @if ($data->berkasKartuKeluarga)
                                                                                <a href="{{ route('admin.biodata.file', ['user_id' => $data->user_id, 'filename' => $data->berkasKartuKeluarga]) }}"
                                                                                    class="btn btn-sm btn-primary"
                                                                                    target="_blank">Lihat Berkas</a>
                                                                            @else
                                                                                <span>Belum Upload Berkas Kartu
                                                                                    Keluarga</span>
                                                                            @endif
                                                                        </div>

                                                                        <div class="mb-3">
                                                                            <p class="m-0">KTP Ayah Kandung</p>
                                                                            @if ($data->berkasKTPAyahKandung)
                                                                                <a href="{{ route('admin.biodata.file', ['user_id' => $data->user_id, 'filename' => $data->berkasKTPAyahKandung]) }}"
                                                                                    class="btn btn-sm btn-primary"
                                                                                    target="_blank">Lihat Berkas</a>
                                                                            @else
                                                                                <span>Belum Upload Berkas KTP Ayah
                                                                                    Kandung</span>
                                                                            @endif
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <p class="m-0">KTP Ibu Kandung</p>
                                                                            @if ($data->berkasKTPIbuKandung)
                                                                                <a href="{{ route('admin.biodata.file', ['user_id' => $data->user_id, 'filename' => $data->berkasKTPIbuKandung]) }}"
                                                                                    class="btn btn-sm btn-primary"
                                                                                    target="_blank">Lihat Berkas</a>
                                                                            @else
                                                                                <span>Belum Upload Berkas KTP Ibu
                                                                                    Kandung</span>
                                                                            @endif
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <p class="m-0">KTP Wali</p>
                                                                            @if ($data->berkasKTPWali)
                                                                                <a href="{{ route('admin.biodata.file', ['user_id' => $data->user_id, 'filename' => $data->berkasKTPWali]) }}"
                                                                                    class="btn btn-sm btn-primary"
                                                                                    target="_blank">Lihat Berkas</a>
                                                                            @else
                                                                                <span>Belum Upload Berkas KTP Wali</span>
                                                                            @endif
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- Berkas Raport -->
                                                            <div class="modal-body">
                                                                <div class="card shadow mb-4">
                                                                    <div
                                                                        class="card-header d-flex justify-content-between py-3 align-items-cente fs-5 fw-bold">
                                                                        Raport
                                                                    </div>
                                                                    <div class="card-body">
                                                                        <div class="mb-3">
                                                                            <p class="m-0">Scan Raport Kelas 7 Ganjil
                                                                            </p>
                                                                            @if ($data->scanRaportKelas7Ganjil)
                                                                                <a href="{{ route('admin.biodata.file', ['user_id' => $data->user_id, 'filename' => $data->scanRaportKelas7Ganjil]) }}"
                                                                                    class="btn btn-sm btn-primary"
                                                                                    target="_blank">Lihat Berkas</a>
                                                                            @else
                                                                                <span>Belum Upload Scan Raport Kelas 7
                                                                                    Ganjil</span>
                                                                            @endif
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <p class="m-0">Scan Raport Kelas 7 Genap</p>
                                                                            @if ($data->scanRaportKelas7Ganjil)
                                                                                <a href="{{ route('admin.biodata.file', ['user_id' => $data->user_id, 'filename' => $data->scanRaportKelas7Genap]) }}"
                                                                                    class="btn btn-sm btn-primary"
                                                                                    target="_blank">Lihat Berkas</a>
                                                                            @else
                                                                                <span>Belum Upload Scan Raport Kelas 7
                                                                                    Genap</span>
                                                                            @endif
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <p class="m-0">Scan Raport Kelas 8 Ganjil
                                                                            </p>
                                                                            @if ($data->scanRaportKelas8Ganjil)
                                                                                <a href="{{ route('admin.biodata.file', ['user_id' => $data->user_id, 'filename' => $data->scanRaportKelas8Ganjil]) }}"
                                                                                    class="btn btn-sm btn-primary"
                                                                                    target="_blank">Lihat Berkas</a>
                                                                            @else
                                                                                <span>Belum Upload Scan Raport Kelas 8
                                                                                    Ganjil</span>
                                                                            @endif
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <p class="m-0">Scan Raport Kelas 8 Genap</p>
                                                                            @if ($data->scanRaportKelas8Genap)
                                                                                <a href="{{ route('admin.biodata.file', ['user_id' => $data->user_id, 'filename' => $data->scanRaportKelas8Genap]) }}"
                                                                                    class="btn btn-sm btn-primary"
                                                                                    target="_blank">Lihat Berkas</a>
                                                                            @else
                                                                                <span>Belum Upload Scan Raport Kelas 8
                                                                                    Genap</span>
                                                                            @endif
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <p class="m-0">Scan Raport Kelas 9 Ganjil
                                                                            </p>
                                                                            @if ($data->scanRaportKelas9Ganjil)
                                                                                <a href="{{ route('admin.biodata.file', ['user_id' => $data->user_id, 'filename' => $data->scanRaportKelas9Ganjil]) }}"
                                                                                    class="btn btn-sm btn-primary"
                                                                                    target="_blank">Lihat Berkas</a>
                                                                            @else
                                                                                <span>Belum Upload Scan Raport Kelas 9
                                                                                    Ganjil</span>
                                                                            @endif
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <p class="m-0">Scan Raport Kelas 9 Genap</p>
                                                                            @if ($data->scanRaportKelas9Genap)
                                                                                <a href="{{ route('admin.biodata.file', ['user_id' => $data->user_id, 'filename' => $data->scanRaportKelas9Genap]) }}"
                                                                                    class="btn btn-sm btn-primary"
                                                                                    target="_blank">Lihat Berkas</a>
                                                                            @else
                                                                                <span>Belum Upload Scan Raport Kelas 9
                                                                                    Genap</span>
                                                                            @endif
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- Berkas Sertifikat -->
                                                            <div class="modal-body">
                                                                <div class="card shadow mb-4">
                                                                    <div
                                                                        class="card-header d-flex justify-content-between py-3 align-items-cente fs-5 fw-bold">
                                                                        Sertifikat
                                                                    </div>
                                                                    <div class="card-body">
                                                                        <div class="mb-3">
                                                                            <p class="m-0">Sertifikat Prestasi</p>
                                                                            @if ($data->sertifikatPrestasi)
                                                                                <a href="{{ route('admin.biodata.file', ['user_id' => $data->user_id, 'filename' => $data->sertifikatPrestasi]) }}"
                                                                                    class="btn btn-sm btn-primary"
                                                                                    target="_blank">Lihat Berkas</a>
                                                                            @else
                                                                                <span>Belum Upload Sertifikat
                                                                                    Prestasi</span>
                                                                            @endif
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <p class="m-0">Sertifikat Hasil Sertifikasi
                                                                                Bahasa</p>
                                                                            @if ($data->sertifikatSertifikasi)
                                                                                <a href="{{ route('admin.biodata.file', ['user_id' => $data->user_id, 'filename' => $data->sertifikatSertifikasi]) }}"
                                                                                    class="btn btn-sm btn-primary"
                                                                                    target="_blank">Lihat Berkas</a>
                                                                            @else
                                                                                <span>Belum Upload Sertifikat Hasil
                                                                                    Sertifikasi
                                                                                    Bahasa</span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Tutup</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        @if ($data->biodataStatus === 'Verifying')
                                            <div class="row">
                                                <div class="col">
                                                    <form action="{{ route('admin.biodata.accept', $data->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        <button class="btn btn-primary shadow-sm" type="button"
                                                            data-toggle="modal"
                                                            data-target="#acceptModal">Approve</button>
                                                    </form>
                                                </div>

                                                <div class="col">
                                                    <form action="{{ route('admin.biodata.reject', $data->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        <button class="btn btn-danger shadow-sm" type="button"
                                                            data-toggle="modal"
                                                            data-target="#rejectionModal">Reject</button>
                                                    </form>
                                                </div>
                                            </div>
                                        @elseif ($data->biodataStatus === 'pending')
                                            <span>Belum Upload Administrasi</span>
                                        @endif

                                    </td>

                                    <td>
                                        <input class="form-check" type="checkbox" name="selectedUsers[]"
                                            value="{{ $user->id }}">
                                    </td>


                                    <td>
                                        @foreach ($users as $user)
                                            @foreach ($user->registrations as $registration)
                                                @if ($user->id)
                                                    {{ $registration->hasilTes }}
                                                @endif
                                            @endforeach
                                        @endforeach
                                    </td>


                                </tr>
                                <!-- Modal for Reject Biodata -->
                                <div class="modal fade" id="rejectionModal" tabindex="-1" role="dialog"
                                    aria-labelledby="rejectionModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="rejectionModalLabel">Reject Biodata</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Form untuk alasan penolakan -->
                                                <form action="{{ route('admin.biodata.reject', $data->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="rejectionReason">Alasan Penolakan Biodata</label>
                                                        <textarea class="form-control" id="rejectionReason" name="rejectionReason" rows="3"></textarea>
                                                    </div>
                                                    <button type="submit" class="btn btn-danger">Submit</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal for Accept Biodata -->
                                <div class="modal fade" id="acceptModal" tabindex="-1" role="dialog"
                                    aria-labelledby="acceptModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="acceptModalLabel">Konfirmasi Biodata & Berkas
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Apakah Anda yakin ingin menerima biodata dan berkas ini?
                                            </div>
                                            <div class="modal-footer">
                                                <form action="{{ route('admin.biodata.accept', $data->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary" ">Terima</button>
                    </form>
                </div>
              </div>
            </div>
          </div>
     @endforeach
</div>

@endsection