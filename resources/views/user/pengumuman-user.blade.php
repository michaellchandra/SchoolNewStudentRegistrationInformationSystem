@extends('layouts.user')

@section('content')

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-body">
            <h6 class="fs-5 mb-0">Informasi Pendaftaran Siswa Baru</h6>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-body mb-0">
            
            <p>{!! nl2br(e($pengumuman->pengumumanDetail)) !!}</p>
            
        </div>

    </div>
</div>

@endsection