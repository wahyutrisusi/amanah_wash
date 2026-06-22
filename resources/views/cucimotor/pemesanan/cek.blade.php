@extends('layouts.app')

@section('title', 'Status Pesanan #' . $pemesanan->nomor_antrian)

@section('custom_css')
    .status-hero { background: linear-gradient(135deg, #0d6efd, #0a4fa0); padding: 100px 0 60px; }
    .timeline-step {
        display: flex; flex-direction: column; align-items: center; flex: 1;
        position: relative;
    }
    .timeline-step:not(:last-child)::after {
        content: '';
        position: absolute;
        top: 22px; left: 60%;
        width: 80%; height: 3px;
        background: #dee2e6;
        z-index: 0;
    }
    .timeline-step.done:not(:last-child)::after { background: #0d6efd; }
    .step-dot {
        width: 44px; height: 44px; border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        font-size: 18px; z-index: 1; border: 3px solid #dee2e6;
        background: #fff; color: #adb5bd;
    }
    .step-dot.done { background: #0d6efd; border-color: #0d6efd; color: #fff; }
    .step-dot.active { background: #fff; border-color: #0d6efd; color: #0d6efd; box-shadow: 0 0 0 4px rgba(13,110,253,.2); }
@endsection

@section('content')

{{-- Hero --}}
<div class="status-hero text-white text-center">
    <div class="container">
        <h1 class="fw-bold mb-1">Status Pesanan</h1>
        <p class="lead opacity-90 mb-0">Nomor Antrian: <strong>#{{ $pemesanan->nomor_antrian }}</strong></p>
    </div>
</div>

<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7">

                {{-- Status Badge --}}
                <div class="text-center mb-4">
                    <span class="badge bg-{{ $pemesanan->status_color }} fs-5 px-4 py-2 rounded-pill">
                        {{ $pemesanan->status_label }}
                    </span>
                    @if($pemesanan->status === 'selesai')
                    <div class="alert alert-success mt-3">
                        <i class="fas fa-check-circle me-2"></i>
                        <strong>Karpet Anda sudah selesai!</strong> Silakan ambil di toko kami.
                    </div>
                    @endif
                </div>

                {{-- Timeline --}}
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <h6 class="fw-semibold mb-4 text-center">Progres Pengerjaan</h6>
                        @php
                            $steps = [
                                'menunggu' => ['label' => 'Menunggu',  'icon' => 'fa-clock'],
                                'dicuci'   => ['label' => 'Dicuci',    'icon' => 'fa-tint'],
                                'dijemur'  => ['label' => 'Dijemur',   'icon' => 'fa-sun'],
                                'selesai'  => ['label' => 'Selesai',   'icon' => 'fa-check-circle'],
                                'diambil'  => ['label' => 'Diambil',   'icon' => 'fa-box'],
                            ];
                            $order   = array_keys($steps);
                            $current = array_search($pemesanan->status, $order);
                        @endphp
                        <div class="d-flex justify-content-between">
                            @foreach($steps as $key => $step)
                            @php
                                $idx  = array_search($key, $order);
                                $done = $idx < $current;
                                $active = $idx === $current;
                            @endphp
                            <div class="timeline-step {{ $done ? 'done' : '' }}">
                                <div class="step-dot {{ $done ? 'done' : ($active ? 'active' : '') }}">
                                    <i class="fas {{ $step['icon'] }}"></i>
                                </div>
                                <small class="mt-2 text-center {{ $active ? 'fw-bold text-primary' : 'text-muted' }}" style="font-size:11px">
                                    {{ $step['label'] }}
                                </small>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- Info Pelanggan & Layanan --}}
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <h6 class="text-muted text-uppercase fw-bold mb-3" style="font-size:11px;letter-spacing:1px">
                                    Informasi Pelanggan
                                </h6>
                                <p class="mb-1"><strong>Nama:</strong> {{ $pemesanan->nama }}</p>
                                <p class="mb-0"><strong>Tanggal Masuk:</strong> {{ $pemesanan->tanggal_masuk->format('d M Y') }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted text-uppercase fw-bold mb-3" style="font-size:11px;letter-spacing:1px">
                                    Detail Layanan
                                </h6>
                                <p class="mb-1"><strong>Layanan:</strong> {{ $pemesanan->layanan->nama }}</p>
                                <p class="mb-1"><strong>Jumlah Karpet:</strong>
                                    <span class="badge bg-primary">{{ $pemesanan->jumlah_karpet }} karpet</span>
                                </p>
                                @if($pemesanan->tanggal_selesai)
                                <p class="mb-0 text-success"><strong>Selesai:</strong> {{ $pemesanan->tanggal_selesai->format('d M Y') }}</p>
                                @endif
                                @if($pemesanan->catatan)
                                <p class="mb-0 mt-1"><strong>Catatan:</strong> <em>{{ $pemesanan->catatan }}</em></p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Actions --}}
                <div class="d-flex gap-2 justify-content-center">
                    <a href="{{ route('pemesanan') }}" class="btn btn-outline-primary">
                        <i class="fas fa-search me-1"></i>Cek Pesanan Lain
                    </a>
                    <a href="{{ route('beranda') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-home me-1"></i>Beranda
                    </a>
                </div>

            </div>
        </div>
    </div>
</section>

@endsection
