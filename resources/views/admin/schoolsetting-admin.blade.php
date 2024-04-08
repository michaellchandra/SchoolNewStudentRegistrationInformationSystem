@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4 mt-5">
            <h1 class="h3 mb-0 text-dark">Pengaturan Sekolah</h1>
            {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> --}}
        </div>

        <!-- Edit Sekolah -->
        <div class="card shadow mb-4 pt-4 pb-4">
            

            <div class="card-header">{{ $school->schoolNama }}</div>

                    <div class="card-body">
                        <div>
                            <img src="{{ $school->schoolLogo }}" alt="School Logo" style="max-width: 100px;">
                        </div>
                        <div>
                            <p><strong>Deskripsi:</strong> {{ $school->schoolDeskripsi }}</p>
                            <p><strong>Telepon:</strong> {{ $school->schoolTelepon }}</p>
                            <p><strong>Admin ID:</strong> {{ $school->admin_id }}</p>
                        </div>
                    </div>
        </div>
    </div>
@endsection
