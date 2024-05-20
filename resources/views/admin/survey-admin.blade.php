@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="d-flex align-items-center justify-content-between mb-5 mt-5">
            <h1 class="h3 mb-0 text-dark w-50">Survey</h1>
            <div class="col d-flex justify-content-end">
                <button type="button" class="btn btn-primary m-2" data-bs-toggle="modal"
                    data-bs-target="#editSurvey">Ubah</button>
                <button type="button" class="btn btn-danger m-2" data-bs-toggle="modal"
                    data-bs-target="#deleteSurvey">Hapus</button>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header">
                <p class="text-primary fw-bold fs-5 d-flex align-items-center m-0">Daftar Pertanyaan</p>
            </div>
            <div class="card-body mb-0">
                @if ($survey->count() > 0)
                    @if ($survey->pertanyaan1)
                        <div class="card p-3 mb-3">
                            <p class="fw-bold fs-5">Pertanyaan 1</p>
                            <p>{{ $survey->pertanyaan1 }}</p>
                        </div>
                    @endif

                    @if ($survey->pertanyaan2)
                        <div class="card p-3 mb-3">
                            <p class="fw-bold fs-5">Pertanyaan 2</p>
                            <p>{{ $survey->pertanyaan2 }}</p>
                        </div>
                    @endif

                    @if ($survey->pertanyaan3)
                        <div class="card p-3 mb-3">
                            <p class="fw-bold fs-5">Pertanyaan 3</p>
                            <p>{{ $survey->pertanyaan3 }}</p>
                        </div>
                    @endif
                @else
                    <p>Belum ada survei yang dibuat.</p>
                @endif
            </div>

        </div>

        <!-- Modal Edit Survey -->
        <div class="modal fade" id="editSurvey" tabindex="-1" role="dialog" aria-labelledby="editSurveyModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editSurveyLabel">Ubah Survey</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <form id="editSurvey" method="POST" action="{{ route('admin.survey.update', $survey->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="pertanyaan1">Pertanyaan 1</label>
                                <input type="text" class="form-control" id="pertanyaan1" name="pertanyaan1"
                                    value="{{ $survey->pertanyaan1 }}">
                            </div>
                            <div class="form-group">
                                <label for="pertanyaan2">Pertanyaan 2</label>
                                <input type="text" class="form-control" id="pertanyaan2" name="pertanyaan2"
                                    value="{{ $survey->pertanyaan2 }}">
                            </div>
                            <div class="form-group">
                                <label for="pertanyaan3">Pertanyaan 3</label>
                                <input type="text" class="form-control" id="pertanyaan3" name="pertanyaan3"
                                    value="{{ $survey->pertanyaan3 }}">
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Hapus Survey -->
        <div class="modal fade" id="deleteSurvey" tabindex="-1" role="dialog" aria-labelledby="deleteSurveyLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteSurveyModalLabel">Hapus Survey</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Pesan konfirmasi untuk menghapus survei -->
                        Apakah Anda yakin ingin menghapus survei ini?
                    </div>
                    <div class="modal-footer">
                        <form id="deleteSurveyForm" method="POST"
                            action="{{ route('admin.survey.destroy', $survey->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header">
                <p class="text-primary fw-bold fs-5 d-flex align-items-center m-0">Hasil Survey</p>
            </div>
            <div class="card-body">

            
            @if ($answer->count() > 0)
            <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Pertanyaan 1</th>
                        <th>Pertanyaan 2</th>
                        <th>Pertanyaan 3</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($answer as $answer)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $answer->jawabanPertanyaan1 }}</td>
                        <td>{{ $answer->jawabanPertanyaan2 }}</td>
                        <td>{{ $answer->jawabanPertanyaan3 }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
            @else
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Pertanyaan 1</th>
                        <th>Pertanyaan 2</th>
                        <th>Pertanyaan 3</th>

                    </tr>
                </thead>
                <tbody>
                    <td colspan="10" class="text-center">
                        Tidak ada jawaban survey saat ini.
                    </td>
                </tbody>
            </table>
            
            @endif
        </div>
    </div>

    </div>
@endsection
