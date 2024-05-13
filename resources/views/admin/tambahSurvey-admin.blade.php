@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session('message'))
            <div class="alert alert-warning">
                {{ session('message') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="d-flex align-items-center justify-content-between mb-4 mt-5">
            <h1 class="h3 mb-0 text-dark w-50">Survey</h1>
        
        </div>
                <div class="card mb-5">
                    <div class="card-header">Buat Survey Baru</div>
                    <div class="card-body">
                        <p class="fw-bold fst-italic">*Masukkan Minimal 1 Pertanyaan untuk menyimpan survey</p>
                        <form action="{{ route('admin.survey.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="pertanyaan1">Masukkan Pertanyaan 1*</label>
                                <textarea class="form-control" id="pertanyaan1" name="pertanyaan1" placeholder="Masukkan pertanyaan 1" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="pertanyaan2">Masukkan Pertanyaan 2</label>
                                <textarea class="form-control" id="pertanyaan2" name="pertanyaan2" placeholder="Masukkan pertanyaan 2"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="pertanyaan3">Masukkan Pertanyaan 3</label>
                                <textarea class="form-control" id="pertanyaan3" name="pertanyaan3" placeholder="Masukkan pertanyaan 3"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Buat Survey</button>
                        </form>
                    </div>
                </div>
        
    </div>
@endsection
