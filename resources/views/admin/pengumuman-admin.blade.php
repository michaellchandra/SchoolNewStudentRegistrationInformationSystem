@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="d-flex align-items-center justify-content-between mb-5 mt-5">
            <h1 class="h3 mb-0 text-dark w-50">Pengumuman</h1>
            <div class="col d-flex justify-content-end">
                <button type="button" class="btn btn-primary m-2" data-bs-toggle="modal" data-bs-target="#editPengumuman">Ubah
                    Pengumuman</button>
                <button type="button" class="btn btn-danger m-2" data-bs-toggle="modal"
                    data-bs-target="#editPengumuman">Hapus Pengumuman</button>

            </div>

        </div>

        <!-- Modal Edit Pengumuman-->
        <div class="modal fade" id="editPengumuman" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fw-bold text-dark fs-5" id="ubahPengumuman">Ubah Pengumuman</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('pengumuman.update', $pengumuman->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="pengumumanDetail">Detail Pengumuman</label>
                                <textarea class="form-control" name="pengumumanDetail" id="pengumumanDetail" rows="5">{{ $pengumuman->pengumumanDetail }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </form>
                        <form>
                            
                            <div class="mb-3">
                                <label for="message-text" class="col-form-label">Masukkan Deskripsi Pengumuman</label>
                                <textarea class="form-control" id="message-text"></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Send message</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- View -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <h6 class="fs-5 mb-0">Informasi Pendaftaran Siswa Baru</h6>
            </div>
        </div>
        <div class="card shadow mb-4">
            <div class="card-body mb-0">
                
                <p>{{ $pengumuman->pengumumanDetail }}</p>
                
            </div>

        </div>
    </div>
@endsection
