@extends('layouts.admin')

@section('content')
@php
use App\Models\School;
    $school = School::first();
@endphp
    <div class="container-fluid">
        @if ($school === null)
            <div class="alert alert-danger">
                <p class="fs-5 fw-bold">Sekolah belum ditambahkan, harap tambahkan seluruh informasi sekolah terlebih dulu, sebelum menggunakan
                    sistem.</p>
                    <a href="/admin/settings/school/create"><i class="fas fa-arrow-right me-2"></i>Tambahkan Sekolah Disini</a>
            </div>
        @endif
        <div class="d-sm-flex align-items-center justify-content-between mb-4 mt-5">
            <h1 class="h3 mb-0 text-dark">Pengaturan Sekolah</h1>
            {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> --}}
        </div>

        <div class="">
            <a href="/admin/settings/manageadmin" class="btn btn-primary btn-icon-split w-100 d-flex justify-content-start mb-3">
                <span class="icon text-white-50">
                    <i class="fas fa-flag"></i>
                </span>
                <span class="text">Pengaturan Admin</span>
            </a>

            <a href="/admin/settings/school" class="btn btn-info btn-icon-split w-100 d-flex justify-content-start mb-4">
                <span class="icon text-white-50">
                    <i class="fas fa-school"></i>
                </span>
                <span class="text">Pengaturan Sekolah</span>
            </a>
        </div>

    </div>
@endsection