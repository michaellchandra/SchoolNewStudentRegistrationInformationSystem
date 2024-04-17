@extends('layouts.user')

@section('content')

<div class="container-fluid">
    <!-- Notifikasi Sukses Update -->
    

    <div class="card shadow mb-4">
        <div class="card-body">
            <h6 class="fs-5 mb-0">Informasi Pendaftaran Siswa Baru</h6>
        </div>
    </div>
    @if ($message)
    <div class="alert alert-info fw-bold" >
        {{ $message }}
    </div>
@endif
    
</div>
@endsection