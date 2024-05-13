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
    <div class="d-sm-flex align-items-center justify-content-between mb-5 mt-5">
        <h1 class="h3 mb-0 text-dark">Selamat Datang!</h1>
        
    </div>
    <div class="card shadow mb-4">
        <div class="card-body">
            @foreach($registrations as $registration)
                <a href="{{ route('dashboard', ['registration_id' => $registration->id]) }}" class="btn btn-primary">{{ $registration->tahunAjaran }}</a>
            @endforeach
        </div>
    </div>
</div>


@endsection