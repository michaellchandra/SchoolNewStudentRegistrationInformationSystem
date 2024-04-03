@extends('layouts.user')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-5 mt-5">
            <h1 class="h3 mb-0 text-dark">Dashboard</h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm"><i
                    class="fas fa-warning fa-sm text-white-50"></i> Bantuan</a>
        </div>

        <!-- Status Pendaftaran -->
        <div class="card shadow mb-4">
            <div class="card-header d-flex justify-content-between py-3 align-items-center">
                <h5 class="m-0 fw-bold ">Status</h5>
                <p class="m-0 fst-italic">PENGISIAN BIODATA & BERKAS</p>
            </div>
            <div class="card-header d-flex justify-content-between py-3 align-items-center">

                <p class="m-0">Pendaftaran Akun</p>
                <h6 class="m-0 fw-bold text-primary">SUDAH</h6>
            </div>
            <div class="card-header d-flex justify-content-between py-3 align-items-center">

                <p class="m-0">Pembayaran Formulir</p>
                <h6 class="m-0 fw-bold text-primary">SUDAH</h6>
            </div>
            <div class="card-header d-flex justify-content-between py-3 align-items-center">

                <p class="m-0">Pengisian Biodata & Berkas</p>
                <h6 class="m-0 fw-bold text-primary">SUDAH</h6>
            </div>
            <div class="card-header d-flex justify-content-between py-3 align-items-center">

                <p class="m-0">Pembayaran Administrasi</p>
                <h6 class="m-0 fw-bold text-danger">BELUM</h6>
            </div>

        </div>

        <div class="card shadow mb-4">
            <div class="card-header d-flex flex-column justify-content-between py-3 align-items-start">
                
                
                <h5 class="mb-3 fw-bold ">Syarat & Ketentuan Pendaftaran</h5>
                
                
               
                <div class="mb-3 card">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore accusamus, at blanditiis inventore ad optio laudantium alias veniam eveniet fuga consequuntur eaque maiores architecto temporibus obcaecati voluptas. Voluptatibus, adipisci ipsum!</p>
                </div>
                
                <a href="/pengisian-biodata" class="btn btn-sm btn-primary w-100 shadow-sm p-2 ">Lanjut</a>
                
                
                
            </div>
        </div>

         <!-- Pembayaran Card -->
    <div class="card shadow mb-4">
        <div class="card-header d-flex justify-content-between py-3 align-items-center">

            <p class="m-0">Pembayaran Formulir</p>
            <h6 class="m-0 fw-bold text-primary">BELUM LUNAS</h6>
        </div>
        <div class="card-body">
            <p>Biaya Pendaftaran</p>
            <h2 class="fs-2 fw-bold mb-4">Rp 150.000</h2>
            <p>Silahkan melakukan transfer ke </p>
            <p class="fs-4 fw-bold">0706012010052 a/n MICHAEL CHANDRA</p>
        </div>
        <div class="card-body">
            <p>Sesuai dengan nominal tertera untuk memudahkan kami melakukan pengecekan, kemudian lakukan konfirmasi bukti pembayaran tombol dibawah ini.</p>
            <div class="d-sm-flex align-items-center justify-content-between mb-4 mt-5">
                <input class="form-control form-control-lg w-25 me-3" name="sertifikatPrestasi" type="file">
                {{-- <a href="#" class="w-100 p-3 m-2 fs-5 btn btn-sm btn-dark shadow-sm">
                    <i class="fas fa-download fa-sm text-white-50"></i>Upload Bukti Pembayaran</a> --}}
                    
                <a href="#" class="w-75 p-3 m-2 fs-5 btn btn-sm btn-primary shadow-sm"><i
                        class="fas fa-download fa-sm text-white-50"></i>Konfirmasi Pembayaran</a>
                    
            </div>
        </div>

        
        

    </div>
    </div>
    </div>
@endsection
