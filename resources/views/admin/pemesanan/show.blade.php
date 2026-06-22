@extends('admin.layouts.app')

@section('title', 'Detail Pesanan #' . $pemesanan->nomor_antrian)

@section('content')
<div class="row g-4">
    {{-- Info Pesanan --}}
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h6 class="mb-0 fw-semibold">
                    <i class="fas fa-receipt me-2 text-primary"></i>
                    Pesanan #{{ $pemesanan->nomor_antrian }}
                </h6>
                <span class="badge badge-status bg-{{ $pemesanan->status_color }} fs-6">
                    {{ $pemesanan->status_label }}
                </span>
            </div>
            <div class="card-body">
                <div class="row g-4">
                    <div class="col-md-6">
                        <h6 class="text-muted text-uppercase fw-bold mb-3" style="font-size:11px;letter-spacing:1px;">
                            Data Pelanggan
                        </h6>
                        <table class="table table-sm table-borderless">
                            <tr>
                                <td class="text-muted" style="width:120px">Nama</td>
                                <td class="fw-semibold">{{ $pemesanan->nama }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">No. HP</td>
                                <td>
                                    {{ $pemesanan->telepon }}
                                    <a href="https://wa.me/{{ preg_replace('/^0/', '62', $pemesanan->telepon) }}"
                                       target="_blank" class="btn btn-sm btn-success ms-2 py-0 px-2">
                                        <i class="fab fa-whatsapp"></i>
                                    </a>
                                </td>
                            </tr>
                            @if($pemesanan->alamat)
                            <tr>
                                <td class="text-muted">Alamat</td>
                                <td>{{ $pemesanan->alamat }}</td>
                            </tr>
                            @endif
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-muted text-uppercase fw-bold mb-3" style="font-size:11px;letter-spacing:1px;">
                            Detail Layanan
                        </h6>
                        <table class="table table-sm table-borderless">
                            <tr>
                                <td class="text-muted" style="width:120px">Layanan</td>
                                <td class="fw-semibold">{{ $pemesanan->layanan->nama }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">Jumlah Karpet</td>
                                <td><span class="badge bg-primary">{{ $pemesanan->jumlah_karpet }} karpet</span></td>
                            </tr>
                            <tr>
                                <td class="text-muted">Harga/Karpet</td>
                                <td>Rp {{ number_format($pemesanan->layanan->harga_per_karpet, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">Tanggal Masuk</td>
                                <td>{{ $pemesanan->tanggal_masuk->format('d M Y') }}</td>
                            </tr>
                            @if($pemesanan->tanggal_selesai)
                            <tr>
                                <td class="text-muted">Tanggal Selesai</td>
                                <td class="text-success fw-semibold">{{ $pemesanan->tanggal_selesai->format('d M Y') }}</td>
                            </tr>
                            @endif
                        </table>
                    </div>
                </div>

                @if($pemesanan->catatan)
                <div class="alert alert-warning mt-2">
                    <i class="fas fa-sticky-note me-2"></i>
                    <strong>Catatan:</strong> {{ $pemesanan->catatan }}
                </div>
                @endif
            </div>
        </div>

        {{-- Update Status --}}
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3">
                <h6 class="mb-0 fw-semibold"><i class="fas fa-exchange-alt me-2 text-primary"></i>Update Status</h6>
            </div>
            <div class="card-body">
                @php
                    $statusList   = \App\Models\Pemesanan::statusList();
                    $statusColors = ['menunggu'=>'warning','dicuci'=>'info','dijemur'=>'primary','selesai'=>'success','diambil'=>'secondary'];
                    $statusIcons  = ['menunggu'=>'fa-clock','dicuci'=>'fa-tint','dijemur'=>'fa-sun','selesai'=>'fa-check-circle','diambil'=>'fa-box'];
                @endphp
                <div class="d-flex flex-wrap gap-2">
                    @foreach($statusList as $key => $label)
                    <form action="{{ route('admin.pemesanan.update-status', $pemesanan) }}" method="POST">
                        @csrf @method('PATCH')
                        <input type="hidden" name="status" value="{{ $key }}">
                        <button type="submit"
                                class="btn btn-{{ $pemesanan->status == $key ? $statusColors[$key] : 'outline-' . $statusColors[$key] }}">
                            <i class="fas {{ $statusIcons[$key] }} me-1"></i>{{ $label }}
                        </button>
                    </form>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    {{-- Pembayaran --}}
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3">
                <h6 class="mb-0 fw-semibold"><i class="fas fa-money-bill-wave me-2 text-success"></i>Pembayaran</h6>
            </div>
            <div class="card-body">
                @if($pemesanan->pembayaran)
                    @php $bayar = $pemesanan->pembayaran; @endphp
                    <div class="text-center mb-3">
                        <div class="fs-3 fw-bold text-primary">
                            Rp {{ number_format($bayar->total_harga, 0, ',', '.') }}
                        </div>
                        <span class="badge {{ $bayar->status_pembayaran == 'lunas' ? 'bg-success' : 'bg-danger' }} fs-6">
                            {{ $bayar->status_pembayaran == 'lunas' ? 'Lunas' : 'Belum Bayar' }}
                        </span>
                    </div>

                    @if($bayar->metode_pembayaran)
                    <p class="text-muted small mb-1">
                        <i class="fas fa-credit-card me-1"></i>{{ $bayar->metode_pembayaran }}
                    </p>
                    @endif
                    @if($bayar->tanggal_bayar)
                    <p class="text-muted small mb-3">
                        <i class="fas fa-calendar-check me-1"></i>{{ $bayar->tanggal_bayar->format('d M Y H:i') }}
                    </p>
                    @endif

                    @if($bayar->status_pembayaran != 'lunas')
                    <form action="{{ route('admin.transaksi.update-status', $bayar) }}" method="POST">
                        @csrf @method('PATCH')
                        <input type="hidden" name="status_pembayaran" value="lunas">
                        <div class="mb-2">
                            <select name="metode_pembayaran" class="form-select form-select-sm">
                                <option value="">Pilih Metode Bayar</option>
                                <option value="Tunai">Tunai</option>
                                <option value="Transfer Bank">Transfer Bank</option>
                                <option value="QRIS">QRIS</option>
                                <option value="GoPay">GoPay</option>
                                <option value="OVO">OVO</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success w-100">
                            <i class="fas fa-check me-1"></i>Tandai Lunas
                        </button>
                    </form>
                    @endif
                @else
                    <p class="text-muted text-center">Belum ada data pembayaran.</p>
                @endif
            </div>
        </div>

        <div class="mt-3">
            <a href="{{ route('admin.pemesanan.index') }}" class="btn btn-outline-secondary w-100">
                <i class="fas fa-arrow-left me-1"></i>Kembali ke Daftar
            </a>
        </div>
    </div>
</div>
@endsection
