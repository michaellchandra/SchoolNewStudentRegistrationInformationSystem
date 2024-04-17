@extends('layouts.admin')

@section('content')

<div class="container-fluid">
    @if (session('message'))
            <div class="alert alert-warning">
                {{ session('message') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
    <div class="card">
        
        <div class="card-header">
            Tambah Pengumuman
        </div>

        <div class="card-body">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('admin.pengumuman.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="pengumumanDetail" class="form-label" >Detail Pengumuman</label>
                <textarea class="form-control" id="pengumumanDetail" name="pengumumanDetail" rows='3' placeholder="Masukkan Detail Pengumuman" required></textarea>
            </div>
            
            <button type="submit" class="btn btn-primary">Simpan Pengumuman</button>
        </form>
        </div>
    </div>
</div>

@endsection