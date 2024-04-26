@extends('layouts.user')

@section('content')

<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4 mt-5">
        <h1 class="h3 mb-0 text-dark">Pembayaran</h1>
        <a href="#" class="p-2 fs-6 btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-solid fa-question  text-white-50"></i> Bantuan</a>
    </div>

    <!-- Pembayaran Card -->
    <div class="card shadow mb-4">
        <div class="card-header d-flex justify-content-between py-3 align-items-center">

            <p class="m-0">Pembayaran Formulir</p>
            <h6 class="m-0 fw-bold text-primary">BELUM LUNAS</h6>
        </div>
        
        <div class="card-body">
            <p>Biaya Pendaftaran</p>
            @foreach ($payments as $payment)
            <h2 class="fs-2 fw-bold mb-4">Rp. {{ $payment->paymentAmount }}</h2>
            @endforeach
            <p>Silahkan melakukan transfer ke </p>
            <p class="fs-4 fw-bold">0706012010052 a/n MICHAEL CHANDRA</p>
        </div>
        <div class="card-body">
            <p>Sesuai dengan nominal tertera untuk memudahkan kami melakukan pengecekan, kemudian lakukan konfirmasi bukti pembayaran tombol dibawah ini.</p>
            <div class="d-sm-flex align-items-center justify-content-between mb-4 mt-5">
                <input class="form-control form-control-lg w-50 me-3" name="paymentProof" type="file">
                
                    
                <a href="#" class="w-50 p-3 m-2 fs-5 btn btn-sm btn-primary shadow-sm"><i
                        class="fas fa-download fa-sm text-white-50"></i>Konfirmasi Pembayaran</a>
                    
            </div>
            <p>
                *Perlu mengupload bukti pembayaran sebelum melakukan konfirmasi pembayaran
            </p>
        </div>
        

        
        
        

    </div>


</div>

@endsection