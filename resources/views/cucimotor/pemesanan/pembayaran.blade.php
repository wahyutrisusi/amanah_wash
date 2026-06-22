@extends('layouts.app')

@section('title', 'Pembayaran')

@section('custom_css')
    .qr-container {
        max-width: 300px;
        margin: 0 auto;
    }
    .payment-info {
        background:rgba(122, 200, 219, 0.71);
        border-radius: 10px;
        padding: 20px;
    }
@endsection

@section('content')
<div class="container py-5 mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-body">
                    <h3 class="card-title text-center mb-4">Pilih Metode Pembayaran</h3>
                    
                    <div class="payment-info mb-4">
                        <div class="row mb-2">
                            <div class="col-6">Nomor Pesanan:</div>
                            <div class="col-6 text-end">#{{ str_pad($pemesanan->id, 5, '0', STR_PAD_LEFT) }}</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-6">Layanan:</div>
                            <div class="col-6 text-end">{{ $pemesanan->layanan->nama }}</div>
                        </div>

                        <!-- Detail Biaya -->
                        <div class="row mb-2">
                            <div class="col-6">Biaya {{ $pemesanan->layanan->nama }}:</div>
                            <div class="col-6 text-end">Rp {{ number_format($pemesanan->layanan->harga, 0, ',', '.') }}</div>
                        </div>

                        @if($pemesanan->cuci_karpet)
                        <div class="row mb-2">
                            <div class="col-6">Cuci Karpet:</div>
                            <div class="col-6 text-end">Rp {{ number_format($pemesanan->layanan->harga_karpet ?? 20000, 0, ',', '.') }}</div>
                        </div>
                        @endif

                        @if($pemesanan->metode_pengambilan === 'jemput')
                        <div class="row mb-2">
                            <div class="col-6">Biaya Jemput:</div>
                            <div class="col-6 text-end">Rp {{ number_format($pemesanan->layanan->biaya_jemput ?? 2000, 0, ',', '.') }}</div>
                        </div>
                        @endif

                        @if($pemesanan->metode_pengembalian === 'antar')
                        <div class="row mb-2">
                            <div class="col-6">Biaya Antar:</div>
                            <div class="col-6 text-end">Rp {{ number_format($pemesanan->layanan->biaya_antar ?? 2000, 0, ',', '.') }}</div>
                        </div>
                        @endif

                        <hr>
                        
                        <div class="row mb-2">
                            <div class="col-6">Total Pembayaran:</div>
                            <div class="col-6 text-end fw-bold">Rp {{ number_format(
                                $pemesanan->layanan->harga + 
                                ($pemesanan->cuci_karpet ? ($pemesanan->layanan->harga_karpet ?? 20000) : 0) + 
                                ($pemesanan->metode_pengambilan === 'jemput' ? ($pemesanan->layanan->biaya_jemput ?? 2000) : 0) + 
                                ($pemesanan->metode_pengembalian === 'antar' ? ($pemesanan->layanan->biaya_antar ?? 2000) : 0)
                            , 0, ',', '.') }}</div>
                        </div>
                    </div>

                    <div class="payment-methods mb-4">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="card h-100">
                                    <div class="card-body text-center">
                                        <h5 class="card-title">Pembayaran QRIS</h5>
                                        <div class="qr-container mb-3">
                                            <img src="{{ asset('images/qris.jpg') }}" alt="QRIS Code" class="img-fluid">
                                        </div>
                                        <p class="text-muted small">Scan QR Code menggunakan e-wallet atau m-banking</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="card h-100">
                                    <div class="card-body text-center">
                                        <h5 class="card-title">Bayar di Tempat (COD)</h5>
                                        <div class="my-4">
                                            <i class="fas fa-hand-holding-usd fa-4x text-success"></i>
                                        </div>
                                        <p class="text-muted small">Pembayaran tunai saat layanan selesai</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-center">
                        <p class="text-muted mb-3">Silakan konfirmasi pesanan Anda melalui WhatsApp</p>
                        <a href="https://wa.me/6289528424676?text=Halo%20Admin%2C%20saya%20ingin%20konfirmasi%20pesanan%20%23{{ str_pad($pemesanan->id, 5, '0', STR_PAD_LEFT) }}%0A%0ADetail%20Pesanan:%0A- Layanan:%20{{ $pemesanan->layanan->nama }}%0A- Total:%20Rp%20{{ number_format($pemesanan->layanan->harga + ($pemesanan->cuci_karpet ? ($pemesanan->layanan->harga_karpet ?? 20000) : 0) + ($pemesanan->metode_pengambilan === 'jemput' ? ($pemesanan->layanan->biaya_jemput ?? 2000) : 0) + ($pemesanan->metode_pengembalian === 'antar' ? ($pemesanan->layanan->biaya_antar ?? 2000) : 0), 0, ',', '.') }}%0A- Metode%20Pembayaran:%20" 
                           class="btn btn-success" target="_blank">
                            <i class="fab fa-whatsapp me-2"></i>Konfirmasi Pesanan
                        </a>
                        <a href="{{ route('pemesanan.cek', $pemesanan->id) }}" class="btn btn-outline-primary ms-2">
                            Cek Status Pesanan
                        </a>
                    </div>

                    <div class="alert alert-info mt-4">
                        <h5 class="alert-heading"><i class="fas fa-info-circle me-2"></i>Petunjuk Pembayaran:</h5>
                        <ol class="mb-0">
                            <li>Pilih metode pembayaran yang Anda inginkan (QRIS atau COD)</li>
                            <li>Untuk pembayaran QRIS:
                                <ul>
                                    <li>Scan QR Code menggunakan aplikasi e-wallet atau m-banking</li>
                                    <li>Masukkan nominal sesuai total pembayaran</li>
                                    <li>Simpan bukti pembayaran</li>
                                </ul>
                            </li>
                            <li>Untuk pembayaran COD:
                                <ul>
                                    <li>Siapkan uang tunai sesuai total pembayaran</li>
                                    <li>Pembayaran dilakukan setelah layanan selesai</li>
                                </ul>
                            </li>
                            <li>Klik tombol "Konfirmasi Pesanan" untuk menghubungi admin via WhatsApp</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 