@extends('layouts.user')

@section('content')
    <div class="container-fluid">

        <div class="d-sm-flex align-items-center justify-content-between mb-4 mt-5">
            <h1 class="h3 mb-0 text-dark">Pembayaran</h1>
            <a href="#" class="p-2 fs-6 btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-solid fa-question  text-white-50"></i> Bantuan</a>
        </div>

        <!-- Pembayaran Formulir Card -->
        @foreach ($payments as $payment)
            @if ($payment->paymentCategory === 'formulir')
                <div class="card shadow mb-4">
                    <div class="card-header d-flex justify-content-between py-3 align-items-center">
                        <p class="m-0">Pembayaran Formulir</p>
                        <h6 class="m-0 fw-bold text-primary">

                            @if ($payment->paymentStatus === 'pending')
                                BELUM
                            @else
                                {{ $payment->paymentStatus }}
                            @endif

                        </h6>
                    </div>

                    <div class="card-body">
                        <p>Biaya Pendaftaran</p>
                        <p class="fs-2 fw-bold mb-4">
                            @isset($school->schoolBiayaFormulir)
                                Rp. {{ number_format($school->schoolBiayaFormulir, 0, ',', '.') }}
                            @else
                                Menunggu Konfirmasi dari Admin
                            @endisset
                        </p>
                        @isset($payment)
                            @if ($payment->paymentCategory === 'formulir')
                                @if ($payment->paymentProof)
                                    <a href="{{ route('payment.proof', ['user_id' => $payment->user_id, 'paymentProof' => $payment->paymentProof]) }}"
                                        target="_blank" class="btn btn-sm btn-primary w-100 shadow-sm">Lihat Bukti</a>
                                @endif
                            @endif
                        @endisset
                    </div>

                </div>
            @endif
        @endforeach

        <!-- Pembayaran Administrasi Card Card -->
        @foreach ($payments as $payment)
            @if ($payment->paymentCategory === 'administrasi')
                <div class="card shadow mb-4">
                    <div class="card-header d-flex justify-content-between py-3 align-items-center">
                        <p class="m-0">Pembayaran Administrasi</p>
                        <h6 class="m-0 fw-bold text-primary">

                            @if ($payment->paymentStatus === 'pending')
                                BELUM
                            @else
                                {{ $payment->paymentStatus }}
                            @endif

                        </h6>
                    </div>

                    <div class="card-body">
                        <p>Biaya Administrasi</p>
                        <p class="fs-2 fw-bold mb-4">
                            @foreach ($payments as $payment )
                                @if ($payment->paymentCategory === 'administrasi')
                                Rp. {{ number_format($payment->paymentAmount, 0, ',', '.') }}
                            
                            @endisset
                            @endforeach
                            
                                
                        </p>
                        @isset($payment)
                            @if ($payment->paymentCategory === 'administrasi')
                                @if ($payment->paymentProof)
                                    <a href="{{ route('payment.proof', ['user_id' => $payment->user_id, 'paymentProof' => $payment->paymentProof]) }}"
                                        target="_blank" class="btn btn-sm btn-primary w-100 shadow-sm">Lihat Bukti</a>
                                @endif
                            @endif
                        @endisset
                    </div>

                </div>
            @endif
        @endforeach


    </div>
@endsection
