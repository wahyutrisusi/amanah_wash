@extends('layouts.app')

@section('title', 'Pembayaran')

@section('additional_css')
<style>
    .payment-details {
        background: #f8f9fa;
        border-radius: 10px;
        padding: 20px;
    }
</style>
@endsection

@section('content')
<div class="container py-5 mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-body">
                    <h3 class="card-title mb-4">Detail Pembayaran</h3>
                    
                    <div class="payment-details mb-4">
                        <div class="row mb-2">
                            <div class="col-6">Nomor Pesanan:</div>
                            <div class="col-6 text-end">#{{ str_pad($pemesanan->id, 5, '0', STR_PAD_LEFT) }}</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-6">Layanan:</div>
                            <div class="col-6 text-end">{{ $pemesanan->layanan->nama }}</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-6">Total Pembayaran:</div>
                            <div class="col-6 text-end">
                                <strong>Rp {{ number_format($pemesanan->layanan->harga, 0, ',', '.') }}</strong>
                            </div>
                        </div>
                    </div>

                    <div class="text-center">
                        <button id="pay-button" class="btn btn-primary btn-lg">
                            <i class="fas fa-credit-card me-2"></i>Bayar Sekarang
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('additional_scripts')
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
<script>
    const payButton = document.querySelector('#pay-button');
    payButton.addEventListener('click', function(e) {
        e.preventDefault();

        snap.pay('{{ $snapToken }}', {
            onSuccess: function(result) {
                window.location.href = '{{ route("pemesanan.cek", $pemesanan->id) }}';
            },
            onPending: function(result) {
                window.location.href = '{{ route("pemesanan.cek", $pemesanan->id) }}';
            },
            onError: function(result) {
                alert("Pembayaran gagal!");
                window.location.reload();
            },
            onClose: function() {
                alert('Anda menutup popup tanpa menyelesaikan pembayaran');
            }
        });
    });
</script>
@endsection 