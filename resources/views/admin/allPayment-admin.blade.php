@extends('layouts.admin')

@section('content')

<div class="container-fluid">
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @elseif (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <a href="/admin/payment" class="pt-5 link-primary">
        < Back to Payment</a>
    <div class="d-sm-flex align-items-center justify-content-between mb-4 mt-5">
        <h1 class="h3 mb-0 text-dark">Pembayaran</h1>
        {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> --}}
    </div>

    <!-- Daftar Pembayaran -->
    <div class="card shadow mb-4">
        <div class="card-header d-flex justify-content-between py-3 align-items-center">
            <h5 class="m-0 fw-bold text-primary">Daftar Pembayaran</h5>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="th-sm-1">No.</th>
                            <th>Email</th>

                            <th>Bukti Pembayaran</th>
                            <th>Kategori</th>

                            <th>Status</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($payment as $payment)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $payment->user->email }}</td>
                                <td>
                                    @if ($payment->paymentProof)
                                        <a href="{{ route('payment.proof', ['user_id' => $payment->user_id, 'paymentProof' => $payment->paymentProof]) }}"
                                            target="_blank" class="btn btn-sm btn-primary w-100 shadow-sm">Lihat
                                            Bukti</a>
                                        {{-- @php
                                        dd($payment->paymentProof);
                                    @endphp --}}
                                    @else
                                        <span>Belum Upload Bukti Pembayaran</span>
                                    @endif
                                </td>
                                <td>{{ $payment->paymentCategory }}</td>

                                <td>{{ $payment->paymentStatus }}</td>
                                <td>


                                    @if ($payment->paymentStatus === 'Verifying')
                                        <form action="{{ route('admin.payments.approve', $payment->id) }}"
                                            method="POST">
                                            @csrf
                                            <button
                                                class="btn btn-sm btn-primary shadow-sm"type="submit">Approve</button>
                                        </form>

                                        <form action="{{ route('admin.payments.reject', $payment->id) }}"
                                            method="POST">
                                            @csrf
                                            <button class="btn btn-sm btn-primary shadow-sm" type="button"
                                                data-toggle="modal" data-target="#rejectionModal">Reject</button>
                                        </form>
                                        <!-- Model for Reject Payment -->
                                        <div class="modal fade" id="rejectionModal" tabindex="-1" role="dialog"
                                            aria-labelledby="rejectionModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="rejectionModalLabel">Reject
                                                            Payment
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <!-- Form untuk alasan penolakan -->
                                                        <form
                                                            action="{{ route('admin.payments.reject', $payment->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            <div class="form-group">
                                                                <label for="rejectionReason">Reason for
                                                                    rejection:</label>
                                                                <textarea class="form-control" id="rejectionReason" name="rejectionReason" rows="3"></textarea>
                                                            </div>
                                                            <button type="submit"
                                                                class="btn btn-danger">Submit</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Belum ada pembayaran yang masuk</td>

                            </tr>
                        @endforelse

                    </tbody>


                </table>
            </div>
        </div>
    </div>




</div>

@endsection