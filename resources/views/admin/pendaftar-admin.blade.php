@extends('layouts.admin')

@section('content')
    @php
        use App\Models\School;
        $school = School::first();
    @endphp
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
        @if ($school === null)
            <div class="alert alert-danger">
                <p class="fs-5 fw-bold">Sekolah belum ditambahkan, harap tambahkan seluruh informasi sekolah terlebih dulu,
                    sebelum menggunakan
                    sistem.</p>
                <a href="/admin/settings/school/create"><i class="fas fa-arrow-right me-2"></i>Tambahkan Sekolah Disini</a>
            </div>
        @endif
        <div class="d-sm-flex align-items-center justify-content-between mb-4 mt-5">
            <h1 class="h3 mb-0 text-dark">Pendaftar</h1>
            {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> --}}
        </div>

        <div class="row">
            <!-- Highlighted -->
            <div class="col mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2 p-3">
                                <div class="font-weight-bold text-primary text-uppercase mb-1">
                                    Total Akun Terdaftar</div>
                                <div class="h1 mb-0 font-weight-bold text-gray-800">
                                    {{ $totalUsers }}</div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2 p-3">
                                <div class="font-weight-bold text-primary text-uppercase mb-1">
                                    Biodata Butuh Verifikasi</div>
                                <div class="h1 mb-0 font-weight-bold text-gray-800">{{ $totalVerifyingBiodata }}</div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2 p-3">
                                <div class="font-weight-bold text-primary text-uppercase mb-1">
                                    Biodata Diterima</div>
                                <div class="h1 mb-0 font-weight-bold text-gray-800">{{ $totalAcceptedBiodata }}</div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>


        </div>

        <!-- Biodata Menunggu Verifikasi -->
        <div class="card shadow mb-4">
            <div class="card-header d-flex justify-content-between py-3 align-items-center">
                <h5 class="m-0 fw-bold text-primary">Biodata Menunggu Verifikasi</h5>
                
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    @if ($verifyingBiodata->isNotEmpty())
                        @foreach ($biodata as $data)
                                @php
                                    $user = $data->user;
                                    $count = 0;
                                @endphp
                                @if ($count >= 5)
                                @break
                                @endif
                            @if ($data->biodataStatus === 'Verifying')
                            <div class="table-responsive">
                                <table class="table table-bordered" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th class="th-sm-1">No.</th>
                                            <th>Email</th>
                                            <th>Nama Lengkap</th>
                                            <th>Status Biodata</th>
                                            <th>Status Pendaftaran</th>
                                            <th>Tahun Ajaran</th>
                                            <th>Biodata & Berkas</th>
                                            <th class="col-2">Action</th>
        
                                            <th>Hasil Test</th>
        
                                        </tr>
                                    </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        @if ($data->biodataStatus === 'accepted')
                                            <input class="form-check" type="checkbox" name="selectedUsers[]"
                                                value="{{ $user->id }}">
                                        @endif
                                    </td>
                                    <td>{{ $data->id }}</td>
                                    <td>{{ $data->user->email }}</td>
                                    <td>{{ $data->namaLengkap }}</td>
                                    <td>{{ $data->biodataStatus }}</td>
                                    <td>
                                        @foreach ($data->user->registrations as $registration)
                                            {{ $registration->registrationStatus }}
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach ($data->user->registrations as $registration)
                                            {{ $registration->tahunAjaran }}
                                        @endforeach
                                    </td>
                                    <td>
                                        <a href="#fileModal{{ $data->id }}" class="btn btn-primary"
                                            data-toggle="modal">
                                            Lihat Berkas
                                        </a>


                                        <!-- Modal Biodata-->
                                        <div class="modal fade" id="fileModal{{ $data->id }}"
                                            tabindex="-1" role="dialog"
                                            aria-labelledby="fileModalLabel{{ $data->id }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-xl" role="document">
                                                <div class="modal-content p-3">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title fw-bold"
                                                            id="fileModalLabel{{ $data->id }}">
                                                            Berkas
                                                            Biodata</h5>
                                                        <button type="button" class="close"
                                                            data-dismiss="modal" aria-label="Close">
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
                                                                            <p class="m-0">Jenis Kelamin :
                                                                            </p>
                                                                            <p class="fw-bold text-uppercase">
                                                                                {{ $data->jenisKelamin }}</p>
                                                                        </div>
                                                                        <div>
                                                                            <p class="m-0">Nomor Induk
                                                                                Kependudukan (NIK)
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
                                                                            <p class="m-0">Jumlah Saudara
                                                                                Kandung
                                                                            </p>
                                                                            <p class="fw-bold text-uppercase">
                                                                                {{ $data->jumlahSaudaraKandung }}
                                                                            </p>
                                                                        </div>
                                                                        <div>
                                                                            <p class="m-0">Jumlah Saudara
                                                                                Angkat/Tiri</p>
                                                                            <p class="fw-bold text-uppercase">
                                                                                {{ $data->jumlahSaudaraAngkat }}
                                                                            </p>
                                                                        </div>
                                                                        <div>
                                                                            <p class="m-0">Tinggi Badan</p>
                                                                            <p class="fw-bold">
                                                                                {{ $data->tinggiBadan }} cm
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
                                                                            <p class="m-0">Transportasi ke
                                                                                Sekolah</p>
                                                                            <p class="fw-bold text-uppercase">
                                                                                {{ $data->transportasiKeSekolah }}
                                                                            </p>
                                                                        </div>
                                                                        <div>
                                                                            <p class="m-0">Agama Siswa</p>
                                                                            <p class="fw-bold text-uppercase">
                                                                                {{ $data->agamaSiswa }}</p>
                                                                        </div>
                                                                        <div>
                                                                            <p class="m-0">Nomor Telepon
                                                                                Siswa
                                                                            </p>
                                                                            <p class="fw-bold text-uppercase">
                                                                                {{ $data->nomorTeleponSiswa }}
                                                                            </p>
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
                                                                        <p class="fs-5 fw-bold">Ayah Kandung
                                                                        </p>
                                                                        <div>
                                                                            <p class="m-0">Nama Ayah Kandung
                                                                                :
                                                                            </p>
                                                                            <p class="fw-bold text-uppercase">
                                                                                {{ $data->namaAyahKandung }}
                                                                            </p>
                                                                        </div>
                                                                        <div>
                                                                            <p class="m-0">Pekerjaan Ayah
                                                                                Kandung :</p>
                                                                            <p class="fw-bold text-uppercase">
                                                                                {{ $data->pekerjaanAyahKandung }}
                                                                            </p>
                                                                        </div>
                                                                        <div>
                                                                            <p class="m-0">Penghasilan Ayah
                                                                                Kandung :
                                                                            </p>
                                                                            <p class="fw-bold text-uppercase">
                                                                                {{ $data->penghasilanAyahKandung }}
                                                                            </p>
                                                                        </div>
                                                                        <div>
                                                                            <p class="m-0">Nomor Telepon
                                                                                Ayah
                                                                                Kandung :
                                                                            </p>
                                                                            <p class="fw-bold text-uppercase">
                                                                                {{ $data->nomorTeleponAyahKandung }}
                                                                            </p>
                                                                        </div>


                                                                    </div>
                                                                    <!-- Ibu Kandung -->
                                                                    <div class="card-body">
                                                                        <p class="fs-5 fw-bold">Ibu Kandung</p>
                                                                        <div>
                                                                            <p class="m-0">Nama Ibu Kandung
                                                                                Kandung :
                                                                            </p>
                                                                            <p class="fw-bold text-uppercase">
                                                                                {{ $data->namaIbuKandung }}</p>
                                                                        </div>
                                                                        <div>
                                                                            <p class="m-0">Pekerjaan Ibu
                                                                                Kandung
                                                                                :</p>
                                                                            <p class="fw-bold text-uppercase">
                                                                                {{ $data->pekerjaanIbuKandung }}
                                                                            </p>
                                                                        </div>
                                                                        <div>
                                                                            <p class="m-0">Penghasilan Ibu
                                                                                Kandung :</p>
                                                                            <p class="fw-bold text-uppercase">
                                                                                {{ $data->penghasilanIbuKandung }}
                                                                            </p>
                                                                        </div>
                                                                        <div>
                                                                            <p class="m-0">Nomor Telepon Ibu
                                                                                Kandung :
                                                                            </p>
                                                                            <p class="fw-bold text-uppercase">
                                                                                {{ $data->nomorTeleponIbuKandung }}
                                                                            </p>
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
                                                                            <p class="m-0">Pekerjaan Wali :
                                                                            </p>
                                                                            <p class="fw-bold text-uppercase">
                                                                                {{ $data->pekerjaanWali }}</p>
                                                                        </div>
                                                                        <div>
                                                                            <p class="m-0">Penghasilan Wali
                                                                                :
                                                                            </p>
                                                                            <p class="fw-bold text-uppercase">
                                                                                {{ $data->penghasilanWali }}
                                                                            </p>
                                                                        </div>
                                                                        <div>
                                                                            <p class="m-0">Nomor Telepon
                                                                                Wali :
                                                                            </p>
                                                                            <p class="fw-bold text-uppercase">
                                                                                {{ $data->nomorTeleponWali }}
                                                                            </p>
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
                                                                            <p class="m-0">Nama Sekolah Asal
                                                                                :
                                                                            </p>
                                                                            <p class="fw-bold text-uppercase">
                                                                                {{ $data->namaSekolahAsal }}
                                                                            </p>
                                                                        </div>
                                                                        <div>
                                                                            <p class="m-0">Provinsi Sekolah
                                                                                Asal
                                                                                :</p>
                                                                            <p class="fw-bold text-uppercase">
                                                                                {{ $data->provinsiSekolahAsal }}
                                                                            </p>
                                                                        </div>
                                                                        <div>
                                                                            <p class="m-0">Kota Sekolah Asal
                                                                                :
                                                                            </p>
                                                                            <p class="fw-bold text-uppercase">
                                                                                {{ $data->kotaSekolahAsal }}
                                                                            </p>
                                                                        </div>
                                                                        <div>
                                                                            <p class="m-0">Kecamatan Sekolah
                                                                                Asal :</p>
                                                                            <p class="fw-bold text-uppercase">
                                                                                {{ $data->kecamatanSekolahAsal }}
                                                                            </p>
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
                                                                            <p class="m-0">Akta Kelahiran
                                                                            </p>
                                                                            @if ($data->berkasAktaKelahiran)
                                                                                <a href="{{ route('admin.biodata.file', ['user_id' => $data->user_id, 'filename' => $data->berkasAktaKelahiran]) }}"
                                                                                    class="btn btn-sm btn-primary"
                                                                                    target="_blank">Lihat
                                                                                    Berkas</a>
                                                                            @else
                                                                                <span>Belum Upload Berkas Akta
                                                                                    Kelahiran</span>
                                                                            @endif
                                                                        </div>

                                                                        <div class="mb-3">
                                                                            <p class="m-0">Kartu Keluarga
                                                                            </p>
                                                                            @if ($data->berkasKartuKeluarga)
                                                                                <a href="{{ route('admin.biodata.file', ['user_id' => $data->user_id, 'filename' => $data->berkasKartuKeluarga]) }}"
                                                                                    class="btn btn-sm btn-primary"
                                                                                    target="_blank">Lihat
                                                                                    Berkas</a>
                                                                            @else
                                                                                <span>Belum Upload Berkas Kartu
                                                                                    Keluarga</span>
                                                                            @endif
                                                                        </div>

                                                                        <div class="mb-3">
                                                                            <p class="m-0">KTP Ayah Kandung
                                                                            </p>
                                                                            @if ($data->berkasKTPAyahKandung)
                                                                                <a href="{{ route('admin.biodata.file', ['user_id' => $data->user_id, 'filename' => $data->berkasKTPAyahKandung]) }}"
                                                                                    class="btn btn-sm btn-primary"
                                                                                    target="_blank">Lihat
                                                                                    Berkas</a>
                                                                            @else
                                                                                <span>Belum Upload Berkas KTP
                                                                                    Ayah
                                                                                    Kandung</span>
                                                                            @endif
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <p class="m-0">KTP Ibu Kandung
                                                                            </p>
                                                                            @if ($data->berkasKTPIbuKandung)
                                                                                <a href="{{ route('admin.biodata.file', ['user_id' => $data->user_id, 'filename' => $data->berkasKTPIbuKandung]) }}"
                                                                                    class="btn btn-sm btn-primary"
                                                                                    target="_blank">Lihat
                                                                                    Berkas</a>
                                                                            @else
                                                                                <span>Belum Upload Berkas KTP
                                                                                    Ibu
                                                                                    Kandung</span>
                                                                            @endif
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <p class="m-0">KTP Wali</p>
                                                                            @if ($data->berkasKTPWali)
                                                                                <a href="{{ route('admin.biodata.file', ['user_id' => $data->user_id, 'filename' => $data->berkasKTPWali]) }}"
                                                                                    class="btn btn-sm btn-primary"
                                                                                    target="_blank">Lihat
                                                                                    Berkas</a>
                                                                            @else
                                                                                <span>Belum Upload Berkas KTP
                                                                                    Wali</span>
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
                                                                            <p class="m-0">Scan Raport Kelas
                                                                                7
                                                                                Ganjil
                                                                            </p>
                                                                            @if ($data->scanRaportKelas7Ganjil)
                                                                                <a href="{{ route('admin.biodata.file', ['user_id' => $data->user_id, 'filename' => $data->scanRaportKelas7Ganjil]) }}"
                                                                                    class="btn btn-sm btn-primary"
                                                                                    target="_blank">Lihat
                                                                                    Berkas</a>
                                                                            @else
                                                                                <span>Belum Upload Scan Raport
                                                                                    Kelas
                                                                                    7
                                                                                    Ganjil</span>
                                                                            @endif
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <p class="m-0">Scan Raport Kelas
                                                                                7
                                                                                Genap</p>
                                                                            @if ($data->scanRaportKelas7Ganjil)
                                                                                <a href="{{ route('admin.biodata.file', ['user_id' => $data->user_id, 'filename' => $data->scanRaportKelas7Genap]) }}"
                                                                                    class="btn btn-sm btn-primary"
                                                                                    target="_blank">Lihat
                                                                                    Berkas</a>
                                                                            @else
                                                                                <span>Belum Upload Scan Raport
                                                                                    Kelas
                                                                                    7
                                                                                    Genap</span>
                                                                            @endif
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <p class="m-0">Scan Raport Kelas
                                                                                8
                                                                                Ganjil
                                                                            </p>
                                                                            @if ($data->scanRaportKelas8Ganjil)
                                                                                <a href="{{ route('admin.biodata.file', ['user_id' => $data->user_id, 'filename' => $data->scanRaportKelas8Ganjil]) }}"
                                                                                    class="btn btn-sm btn-primary"
                                                                                    target="_blank">Lihat
                                                                                    Berkas</a>
                                                                            @else
                                                                                <span>Belum Upload Scan Raport
                                                                                    Kelas
                                                                                    8
                                                                                    Ganjil</span>
                                                                            @endif
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <p class="m-0">Scan Raport Kelas
                                                                                8
                                                                                Genap</p>
                                                                            @if ($data->scanRaportKelas8Genap)
                                                                                <a href="{{ route('admin.biodata.file', ['user_id' => $data->user_id, 'filename' => $data->scanRaportKelas8Genap]) }}"
                                                                                    class="btn btn-sm btn-primary"
                                                                                    target="_blank">Lihat
                                                                                    Berkas</a>
                                                                            @else
                                                                                <span>Belum Upload Scan Raport
                                                                                    Kelas
                                                                                    8
                                                                                    Genap</span>
                                                                            @endif
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <p class="m-0">Scan Raport Kelas
                                                                                9
                                                                                Ganjil
                                                                            </p>
                                                                            @if ($data->scanRaportKelas9Ganjil)
                                                                                <a href="{{ route('admin.biodata.file', ['user_id' => $data->user_id, 'filename' => $data->scanRaportKelas9Ganjil]) }}"
                                                                                    class="btn btn-sm btn-primary"
                                                                                    target="_blank">Lihat
                                                                                    Berkas</a>
                                                                            @else
                                                                                <span>Belum Upload Scan Raport
                                                                                    Kelas
                                                                                    9
                                                                                    Ganjil</span>
                                                                            @endif
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <p class="m-0">Scan Raport Kelas
                                                                                9
                                                                                Genap</p>
                                                                            @if ($data->scanRaportKelas9Genap)
                                                                                <a href="{{ route('admin.biodata.file', ['user_id' => $data->user_id, 'filename' => $data->scanRaportKelas9Genap]) }}"
                                                                                    class="btn btn-sm btn-primary"
                                                                                    target="_blank">Lihat
                                                                                    Berkas</a>
                                                                            @else
                                                                                <span>Belum Upload Scan Raport
                                                                                    Kelas
                                                                                    9
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
                                                                            <p class="m-0">Sertifikat
                                                                                Prestasi
                                                                            </p>
                                                                            @if ($data->sertifikatPrestasi)
                                                                                <a href="{{ route('admin.biodata.file', ['user_id' => $data->user_id, 'filename' => $data->sertifikatPrestasi]) }}"
                                                                                    class="btn btn-sm btn-primary"
                                                                                    target="_blank">Lihat
                                                                                    Berkas</a>
                                                                            @else
                                                                                <span>Belum Upload Sertifikat
                                                                                    Prestasi</span>
                                                                            @endif
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <p class="m-0">Sertifikat Hasil
                                                                                Sertifikasi
                                                                                Bahasa</p>
                                                                            @if ($data->sertifikatSertifikasi)
                                                                                <a href="{{ route('admin.biodata.file', ['user_id' => $data->user_id, 'filename' => $data->sertifikatSertifikasi]) }}"
                                                                                    class="btn btn-sm btn-primary"
                                                                                    target="_blank">Lihat
                                                                                    Berkas</a>
                                                                            @else
                                                                                <span>Belum Upload Sertifikat
                                                                                    Hasil
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
                                                <!-- Accept  Button -->
                                                <div class="col">
                                                    <form
                                                        action="{{ route('admin.biodata.accept', $data->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        <button class="col btn btn-sm btn-success shadow-sm mb-2"
                                                            type="button" data-toggle="modal"
                                                            data-target="#acceptModal">Approve</button>

                                                        <!-- Modal for Accept Biodata -->
                                                        <div class="modal fade" id="acceptModal"
                                                            tabindex="-1" role="dialog"
                                                            aria-labelledby="acceptModalLabel"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title"
                                                                            id="acceptModalLabel">
                                                                            Konfirmasi Biodata & Berkas
                                                                        </h5>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal"
                                                                            aria-label="Close">
                                                                            <span
                                                                                aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        
                                                                        <form
                                                                            action="{{ route('admin.biodata.accept', $data->id) }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            <div class="mb-4">
                                                                                <label for="paymentAmount"
                                                                                    class="form-label">Masukkan Jumlah Administrasi yang harus dibayar</label>
                                                                                <input type="number"
                                                                                    class="form-control"
                                                                                    id="paymentAmount"
                                                                                    name="paymentAmount"
                                                                                    required>
                                                                            </div>
                                                                            <hr class="border border-dark border-1 opacity-25">
                                                                    
                                                                        <p>Apakah anda yakin ingin menerima
                                                                            biodata dan berkas ini?</p>
                                                                            <button type="button"
                                                                                class="btn btn-secondary"
                                                                                data-dismiss="modal">Batal</button>
                                                                            <button type="submit"
                                                                                class="btn btn-primary">Terima</button>
                                                                        </form>
                                                                        
                                                                        </div>
                                                                </div>
                                                            </div>


                                                        </div>
                                                    </form>
                                                </div>
                                            

                                            <!-- Reject Button-->
                                            <div class="">
                                                <form action="{{ route('admin.biodata.reject', $data->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <button class="col btn btn-sm btn-danger shadow-sm mb-2" type="button"
                                                        data-toggle="modal"
                                                        data-target="#rejectionModal">Reject</button>
                                                    <!-- Modal for Reject Biodata -->
                                                    <div class="modal fade" id="rejectionModal"
                                                        tabindex="-1" role="dialog"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title"
                                                                        id="rejectionModalLabel">
                                                                        Reject Biodata</h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal"
                                                                        aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <!-- Form untuk alasan penolakan -->
                                                                    <form
                                                                        action="{{ route('admin.biodata.reject', $data->id) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        <div class="form-group">
                                                                            <label for="rejectionReason">Alasan
                                                                                Penolakan Biodata</label>
                                                                            <textarea class="form-control" id="rejectionReason" name="rejectionReason" rows="3"></textarea>
                                                                        </div>
                                                                        <button type="submit"
                                                                            class="btn btn-danger">Submit</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        @elseif ($data->biodataStatus === 'pending')
                                            <span>Belum Upload Administrasi</span>
                                        @else
                                            <a href="{{ route('admin.biodata.edit', $data->id) }}"
                                                class="btn btn-primary">Edit</a>
                                        @endif

                                    </td>
                                    <td>
                                        @foreach ($data->user->registrations as $registration)
                                            {{ $registration->hasilTes }}
                                        @endforeach
                                    </td>
                                </tr>
                            </tbody>
                        
                    </table>
                    @endif
                        @endforeach
                    </table>
                    @else
                        
                    <td colspan="10" class="text-center">
                        Tidak ada biodata yang butuh diverifikasi saat ini.
                    </td>
                    @endif
                
                

            </div>
        </div>
            </div>
        </div>

    <!-- Semua Calon Siswa -->
    <div class="container-fluid">

    
    <div class="card shadow mb-4">
        <div class="card-header d-flex justify-content-between py-3 align-items-center">
            <h5 class="m-0 fw-bold text-primary">Daftar Calon Siswa</h5>
            <a href="/admin/pendaftar/all" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Lihat
                Semua</a>
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
                    <button type="button" class="btn btn-primary ms-2" data-toggle="modal" data-target="#confirmationModal">
                        Terapkan Status
                    </button>
                    <!-- Modal Confirmation Pilih Status -->
                        <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="confirmationModalLabel">Konfirmasi Status Hasil Tes</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Apakah anda yakin ingin menerapkan status hasil tes ini?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary">Ya, Terapkan</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                </div>
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th></th>
                                <th class="th-sm-1">No.</th>
                                <th>Email</th>
                                <th>Nama Lengkap</th>
                                <th>Status Biodata</th>
                                <th>Status Pendaftaran</th>
                                <th>Tahun Ajaran</th>
                                <th>Biodata & Berkas</th>
                                <th class="col-2">Action</th>

                                <th>Hasil Test</th>

                            </tr>
                        </thead>

                        @foreach ($biodata as $data)
                            @php
                                $user = $data->user;
                                $count = 0;
                            @endphp
                            @if ($count >= 5)
                            @break
                        @endif

                        <tr>
                            <td>
                                @if ($data->biodataStatus === 'accepted')
                                    <input class="form-check" type="checkbox" name="selectedUsers[]"
                                        value="{{ $user->id }}">
                                @endif
                            </td>
                            <td>{{ $data->id }}</td>
                            <td>{{ $data->user->email }}</td>
                            <td>{{ $data->namaLengkap }}</td>
                            <td>{{ $data->biodataStatus }}</td>
                            <td>
                                @foreach ($data->user->registrations as $registration)
                                    {{ $registration->registrationStatus }}
                                @endforeach
                            </td>
                            <td>
                                @foreach ($data->user->registrations as $registration)
                                    {{ $registration->tahunAjaran }}
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
                                                                    <p class="m-0">Nomor Induk Kependudukan
                                                                        (NIK)
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
                                                                    <p class="m-0">Jumlah Saudara Angkat/Tiri
                                                                    </p>
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
                                                                        Rp. {{ number_format($data->penghasilanAyahKandung, 0, ',', '.') }}
                                                                        </p>
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
                                                                        Rp. {{ number_format($data->penghasilanIbuKandung, 0, ',', '.') }}</p>
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
                                                                        Rp. {{ number_format($data->penghasilanWali, 0, ',', '.') }}</p>
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
                                        <!-- Accept  Button -->
                                        <div class="col">
                                            <form action="{{ route('admin.biodata.accept', $data->id) }}"
                                                method="POST">
                                                @csrf
                                                <button class="col btn btn-sm btn-success shadow-sm mb-2" type="button"
                                                    data-toggle="modal"
                                                    data-target="#acceptModal">Approve</button>

                                                <!-- Modal for Accept Biodata -->
                                                <div class="modal fade" id="acceptModal" tabindex="-1"
                                                    role="dialog" aria-labelledby="acceptModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="acceptModalLabel">
                                                                    Konfirmasi Biodata & Berkas
                                                                </h5>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Apakah Anda yakin ingin menerima biodata dan berkas
                                                                ini?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <form
                                                                    action="{{ route('admin.biodata.accept', $data->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    <button type="button"
                                                                        class="btn btn-secondary"
                                                                        data-dismiss="modal">Batal</button>
                                                                    <button type="submit" class="btn btn-primary" ">Terima</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <!-- Reject Button-->
                                    <div class="">
                                        <form action="{{ route('admin.biodata.reject', $data->id) }}" method="POST">
                                            @csrf
                                            <button class="col btn btn-sm btn-danger shadow-sm mb-2" type="button" data-toggle="modal" data-target="#rejectionModal">Reject</button>
                                            <!-- Modal for Reject Biodata -->
                                                            <div class="modal fade" id="rejectionModal" tabindex="-1"
                                                                role="dialog" aria-labelledby="rejectionModalLabel"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="rejectionModalLabel">
                                                                                Reject Biodata</h5>
                                                                            <button type="button" class="close"
                                                                                data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <!-- Form untuk alasan penolakan -->
                                                                            <form
                                                                                action="{{ route('admin.biodata.reject', $data->id) }}"
                                                                                method="POST">
                                                                                @csrf
                                                                                <div class="form-group">
                                                                                    <label for="rejectionReason">Alasan
                                                                                        Penolakan Biodata</label>
                                                                                    <textarea class="form-control" id="rejectionReason" name="rejectionReason" rows="3"></textarea>
                                                                                </div>
                                                                                <button type="submit"
                                                                                    class="btn btn-danger">Submit</button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                        </form>
                                    </div>
                @elseif ($data->biodataStatus === 'pending')
                <span>Belum Upload Administrasi</span>
                @else
                <a href="{{ route('admin.biodata.edit', $data->id) }}" class="btn btn-primary">Edit</a>
                @endif

                            </td>
                            <td>
                                @foreach ($data->user->registrations as $registration)
                                    {{ $registration->hasilTes }}
                                @endforeach
                            </td>
                        </tr>

            </div>
    </div>
    </div>
    </form>
    @endforeach

    </table>

    </div>
    </form>

    </div>
</div>

</div>




<!-- Daftar Akun -->
<div class="container-fluid">


<div class="card shadow mb-4">
<div class="card-header d-flex justify-content-between py-3 align-items-center">
    <h5 class="m-0 fw-bold text-primary">Daftar Akun</h5>
    <a href="/admin/semua-akun" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Lihat
        Semua</a>
</div>
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
            @foreach ($users as $user)
                @php $number = 1 @endphp
                <tbody>
                    <tr>
                        <td>{{ $user->id }}</td>
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
                                                    <input type="password" name="password" class="form-control"
                                                        required>

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
                                                <input type="text" name="name" class="form-control mb-3"
                                                    value="{{ $user->name }}">
                                                <label for="email">Email</label>
                                                <input type="email" name="email" class="form-control mb-4"
                                                    value="{{ $user->email }}">

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
</div>

@endsection
