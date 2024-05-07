@extends('layouts.admin')

@section('content')

    <div class="container-fluid">
        @if (session('success') || session('error'))
            <div class="alert alert-{{ session('success') ? 'success' : 'danger' }}">
                {{ session('success') ?? session('error') }}
            </div>
        @endif
        



        <div class="card shadow mb-4  pb-4">

            <div class="card-header d-flex justify-content-between py-3 align-items-center">
                <h5 class="m-0 fw-bold text-primary">Pengaturan Sekolah</h5>
                <div>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editSchoolModal">
                        Ubah Sekolah
                    </button>
                    <button type="button" class="btn btn-danger" data-toggle="modal"
                        data-target="#deleteModal{{ $school->id }}">
                        Hapus
                    </button>
                </div>

            </div>


            <div class="row p-3 mt-3">
                <div>
                    <p class="fs-4 fw-bold">Identitas Sekolah</p>
                </div>
                <div class="col px-4">
                    <!-- Nama Sekolah -->

                    <div class="row mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2 p-3">
                                        <div class="font-weight-bold text-primary text-uppercase mb-1">
                                            Nama Sekolah</div>
                                        <div class="fs-3 mb-0 font-weight-bold text-gray-800 align-items-center">

                                            {{ $school->schoolNama }}</div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Telepon -->
                    <div class="row">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2 p-3">
                                        <div class="font-weight-bold text-primary text-uppercase mb-1">
                                            Telepon Sekolah</div>
                                        <div class="fs-4">
                                            {{ $school->schoolTelepon }}
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Logo -->
                <div class="col-sm-3">
                    <div class="card border-left-primary shadow py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2 p-3">
                                    <div class="font-weight-bold text-primary text-uppercase mb-1">
                                        Logo Sekolah</div>
                                    @if ($school->schoolLogo)
                                        <img src="{{ asset('storage/schoolSettings/' . $school->schoolLogo) }}"
                                            alt="School Logo" class="img-fluid img-thumbnail">
                                    @else
                                        <p>No school logo available</p>
                                    @endif
                                </div>
                                @if ($school->schoolLogo)
                                    <a href="{{ asset('storage/schoolSettings/' . $school->schoolLogo) }}" target="_blank"
                                        class="btn btn-primary">Lihat Foto</a>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <!-- Deskripsi Sekolah -->
            <div class="p-3 col">
                <div class="card border-bottom-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2 p-3">
                                <div class="font-weight-bold text-primary text-uppercase mb-1">
                                    Deskripsi Sekolah</div>
                                <div class="">
                                    <p>{{ $school->schoolDeskripsi }}</p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <!-- Section Pendaftaran Sekolah -->
            <div class="row p-3 mt-3">
                <div>
                    <p class="fs-4 fw-bold">Pendaftaran Sekolah</p>
                </div>
                <div class="row px-4 pb-5">

                    <!-- Nomor Rekening Pembayaran -->
                    <div class="col">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2 p-3">
                                        <div class="font-weight-bold text-primary text-uppercase mb-1">
                                            Nomor Rekening Pembayaran
                                        </div>
                                        <div class="fs-4 mb-0 font-weight-bold text-black align-items-center">

                                            {{ $school->schoolNomorRekening }}</div>
                                        <p class="fs-5">a/n</p>
                                        <p class="mb-0 font-weight-bold text-black align-items-center">
                                            {{ $school->schoolNamaRekening }}</p>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Biaya Formulir Pendaftaran -->
                    <div class="col">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2 p-3">
                                        <div class="font-weight-bold text-primary text-uppercase mb-1">
                                            Biaya Formulir Pendaftaran</div>
                                        <div class="fs-4">
                                            Rp. {{ number_format($school->schoolBiayaFormulir, 0, ',', '.') }}
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Batas Pendaftaran -->
                    <div class="col">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2 p-3">
                                        <div class="font-weight-bold text-primary text-uppercase mb-1">
                                            Batas Pendaftaran</div>
                                        <div class="fs-4">
                                            {{ $school->schoolBatasPendaftaran }}
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    

                </div>
                <!-- Syarat Ketentuan Pendaftaran -->
                <div class="col">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2 p-3">
                                    <div class="font-weight-bold text-primary text-uppercase mb-1">
                                        Syarat & Ketentuan Pendaftaran</div>
                                    <div class="fs-6">
                                        {!! nl2br(e($school->schoolSyaratKetentuanPendaftaran)) !!}
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                



                <!-- Modal Edit Sekolah -->
                <div class="modal fade" id="editSchoolModal" tabindex="-1" aria-labelledby="editSchoolModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editSchoolModalLabel">Ubah Sekolah</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <!-- Form untuk mengubah data sekolah -->
                                <form action="{{ route('admin.school.update', $school->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <!-- Isi form disini -->
                                    <div>
                                        <p class="fs-5 fw-bold">Identitas Sekolah</p>
                                    </div>
                                    <div class="mb-3">
                                        <label for="schoolNama" class="form-label">Nama Sekolah</label>
                                        <input type="text" class="form-control" id="schoolNama" name="schoolNama" value="{{ $school->schoolNama }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="schoolDeskripsi" class="form-label">Deskripsi Sekolah</label>
                                        <textarea class="form-control" id="schoolDeskripsi" name="schoolDeskripsi" rows="3" required>{{ $school->schoolDeskripsi }}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="schoolTelepon" class="form-label">Telepon Sekolah</label>
                                        <input type="text" class="form-control" id="schoolTelepon" name="schoolTelepon" value="{{ $school->schoolTelepon }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="schoolLogo" class="form-label">Logo Sekolah</label>
                                        @if($school->schoolLogo)
                                        <div class="mb-4">
                                            <img src="{{ asset('storage/schoolSettings/' . $school->schoolLogo) }}" alt="School Logo" class="img-fluid mt-2" style="max-height: 75px;">
                                        </div>
    
                                        @endif
                                        <input type="file" class="form-control" id="schoolLogo" name="schoolLogo">
                                    </div>
                                
                                    <div class="pt-3">
                                        <p class="fs-5 fw-bold">Pendaftaran Sekolah</p>
                                    </div>
                                    <div class="mb-3">
                                        <label for="schoolNomorRekening" class="form-label">Nomor Rekening Pembayaran Sekolah</label>
                                        <input type="number" class="form-control" id="schoolNomorRekening" name="schoolNomorRekening" value="{{ $school->schoolNomorRekening }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="schoolNamaRekening" class="form-label">Nama Rekening Pembayaran Sekolah</label>
                                        <input type="text" class="form-control" id="schoolNamaRekening" name="schoolNamaRekening" value="{{ $school->schoolNamaRekening }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="schoolBiayaFormulir" class="form-label">Biaya Formulir Pendaftaran</label>
                                        <input type="number" class="form-control" id="schoolBiayaFormulir" name="schoolBiayaFormulir" value="{{ $school->schoolBiayaFormulir }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="schoolBatasPendaftaran" class="form-label">Batas Akhir Pendaftaran Sekolah</label>
                                        <input type="date" class="form-control" id="schoolBatasPendaftaran" name="schoolBatasPendaftaran" value="{{ $school->schoolBatasPendaftaran }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="schoolDeskripsi" class="form-label">Syarat dan Ketentuan Pendaftaran</label>
                                        <textarea class="form-control" id="schoolSyaratKetentuanPendaftaran" name="schoolSyaratKetentuanPendaftaran" rows="10" value="{{ $school->schoolSyaratKetentuanPendaftaran }}" required>{{ htmlspecialchars($school->schoolSyaratKetentuanPendaftaran) }}</textarea>
                                    </div>


                                
                                
                                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                </form>
                                
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Hapus Sekolah -->
                <div class="modal fade" id="deleteModal{{ $school->id }}" tabindex="-1"
                    aria-labelledby="deleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Penghapusan</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Apakah Anda yakin ingin menghapus sekolah ini?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <form action="{{ route('admin.school.destroy', $school->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


            </div>

        </div>
    </div>
@endsection
