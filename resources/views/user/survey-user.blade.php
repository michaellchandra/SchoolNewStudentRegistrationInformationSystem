@extends('layouts.user')

@section('content')

<div class="container-fluid">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
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
    <div class="d-flex align-items-center justify-content-between mb-5 mt-5">
        <h1 class="h3 mb-0 text-dark w-50">Survey</h1>
        
    </div>
    <div class="card shadow mb-4">
        <div class="card-body">
            <p class="mb-0">
                Bantu kami untuk memberikan pelayanan terbaik bagi anda kedepannya dengan mengisi survey melalui tombol dibawah ini. Masukan dan kritikan anda sangat kami hargai.
            </p>
        </div>
        
    </div>
    <div class="card shadow mb-4">
        <div class="card-header">
            <p class="text-primary fw-bold m-0 fs-5">Pertanyaan</p>
        </div>
        
        <div class="card-body">
            <form method="post" action="{{ route('user.answer.store') }}">
                @csrf
            
                @if ($survey->pertanyaan1)
                    <div class="form-group">
                        <label for="jawabanPertanyaan1">Pertanyaan 1: {{ $survey->pertanyaan1 }}</label>
                        <textarea class="form-control" id="jawabanPertanyaan1" name="jawabanPertanyaan1" rows="3"></textarea>
                    </div>
                @endif
            
                @if ($survey->pertanyaan2)
                    <div class="form-group">
                        <label for="jawabanPertanyaan2">Pertanyaan 2: {{ $survey->pertanyaan2 }}</label>
                        <textarea class="form-control" id="jawabanPertanyaan2" name="jawabanPertanyaan2" rows="3"></textarea>
                    </div>
                @endif
            
                @if ($survey->pertanyaan3)
                    <div class="form-group">
                        <label for="jawabanPertanyaan3">Pertanyaan 3: {{ $survey->pertanyaan3 }}</label>
                        <textarea class="form-control" id="jawabanPertanyaan3" name="jawabanPertanyaan3" rows="3"></textarea>
                    </div>
                @endif
            
                <button type="submit" class="btn btn-primary">Kirim Survey</button>
            </form>
        </div>
    

    </div>

</div>

@endsection