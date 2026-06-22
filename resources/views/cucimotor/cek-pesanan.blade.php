@extends('layouts.app')

@section('title', 'Cek Status Pesanan')

@section('custom_css')
    .cek-hero {
        background: linear-gradient(135deg, #0d6efd 0%, #0a4fa0 100%);
        padding: 100px 0 60px;
    }
    .search-card {
        border-radius: 16px;
        box-shadow: 0 8px 32px rgba(0,0,0,.12);
    }
@endsection

@section('content')

{{-- Hero --}}
<div class="cek-hero text-white text-center">
    <div class="container">
        <i class="fas fa-search fa-3x mb-3 opacity-75"></i>
        <h1 class="fw-bold mb-2">Cek Status Pesanan</h1>
        <p class="lead opacity-90">Masukkan nomor antrian untuk melihat status karpet Anda</p>
    </div>
</div>

{{-- Form --}}
<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card search-card border-0">
                    <div class="card-body p-4 p-md-5">

                        @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show">
                            <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                        @endif

                        <form action="{{ route('pemesanan.cek-status') }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label class="form-label fw-semibold">Nomor Antrian</label>
                                <div class="input-group input-group-lg">
                                    <span class="input-group-text bg-primary text-white border-primary">
                                        <i class="fas fa-hashtag"></i>
                                    </span>
                                    <input type="text" name="nomor_antrian"
                                           class="form-control form-control-lg @error('nomor_antrian') is-invalid @enderror"
                                           value="{{ old('nomor_antrian') }}"
                                           placeholder="Contoh: 00001"
                                           autofocus required>
                                    @error('nomor_antrian')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-text">Nomor antrian diberikan saat Anda menitipkan karpet.</div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-lg w-100">
                                <i class="fas fa-search me-2"></i>Cek Status
                            </button>
                        </form>
                    </div>
                </div>

                {{-- Info --}}
                <div class="card border-0 bg-light mt-4">
                    <div class="card-body p-4">
                        <h6 class="fw-semibold mb-3"><i class="fas fa-info-circle text-primary me-2"></i>Informasi Status</h6>
                        <div class="d-flex flex-column gap-2">
                            <div class="d-flex align-items-center gap-2">
                                <span class="badge bg-warning text-dark px-3">Menunggu</span>
                                <small class="text-muted">Karpet diterima, menunggu giliran dicuci</small>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <span class="badge bg-info px-3">Dicuci</span>
                                <small class="text-muted">Karpet sedang dalam proses pencucian</small>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <span class="badge bg-primary px-3">Dijemur</span>
                                <small class="text-muted">Karpet sedang dijemur hingga kering</small>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <span class="badge bg-success px-3">Selesai</span>
                                <small class="text-muted">Karpet siap diambil</small>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <span class="badge bg-secondary px-3">Diambil</span>
                                <small class="text-muted">Karpet sudah diambil pelanggan</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <p class="text-muted small">Belum tahu nomor antrian?
                        <a href="{{ route('kontak') }}">Hubungi kami</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
