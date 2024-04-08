@extends('layouts.admin')

@section('content')
    <!-- Modal Popup -->
    <div class="container-fluid">
        <div class="card shadow m-2 p-4">
            <form action="{{ route('admin.store') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="user_id">Pilih Pengguna:</label>
                    <select name="user_id" id="user_id" class="form-control">
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->email }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="adminNama">Nama Admin</label>
                    <input type="text" id="adminNama" name="adminNama" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="adminFoto">Foto Admin</label>
                    <input type="file" id="adminFoto" name="adminFoto" class="form-control-file form-control form-control-md w-25 me-3" accept="image/*">
                    
                </div>

                <div class="form-group">
                    <label for="adminTelepon">Telepon Admin</label>
                    <input type="text" id="adminTelepon" name="adminTelepon" class="form-control" required>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Tambah Admin</button>
                </div>
            </form>
        </div>
        
    {{-- <a class="dropdown-item" href="{{ route('logout') }}"
        onclick="event.preventDefault();
             document.getElementById('logout-form').submit();">
        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
        {{ __('Logout') }}
    </a> --}}
    </div>
    
@endsection