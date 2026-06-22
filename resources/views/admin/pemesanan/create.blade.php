@extends('admin.layouts.app')

@section('title', 'Input Pesanan Baru')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3">
                <h6 class="mb-0 fw-semibold"><i class="fas fa-plus-circle me-2 text-primary"></i>Input Pesanan Baru</h6>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('admin.pemesanan.store') }}" method="POST">
                    @csrf

                    {{-- Data Pelanggan --}}
                    <h6 class="text-muted text-uppercase fw-bold mb-3" style="font-size:11px;letter-spacing:1px;">
                        <i class="fas fa-user me-1"></i> Data Pelanggan
                    </h6>
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" name="nama"
                                   class="form-control @error('nama') is-invalid @enderror"
                                   value="{{ old('nama') }}" placeholder="Nama pelanggan" required>
                            @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">No. HP / WhatsApp <span class="text-danger">*</span></label>
                            <input type="tel" name="telepon"
                                   class="form-control @error('telepon') is-invalid @enderror"
                                   value="{{ old('telepon') }}" placeholder="08xxxxxxxxxx" required>
                            @error('telepon')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Alamat</label>
                            <textarea name="alamat" rows="2"
                                      class="form-control @error('alamat') is-invalid @enderror"
                                      placeholder="Alamat pelanggan (opsional)">{{ old('alamat') }}</textarea>
                            @error('alamat')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <hr class="my-3">

                    {{-- Detail Pesanan --}}
                    <h6 class="text-muted text-uppercase fw-bold mb-3" style="font-size:11px;letter-spacing:1px;">
                        <i class="fas fa-soap me-1"></i> Detail Pesanan
                    </h6>
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Jenis Layanan <span class="text-danger">*</span></label>
                            <select name="layanan_id" id="layanan_id"
                                    class="form-select @error('layanan_id') is-invalid @enderror" required>
                                <option value="">-- Pilih Layanan --</option>
                                @foreach($layanans as $layanan)
                                    <option value="{{ $layanan->id }}"
                                            data-harga="{{ $layanan->harga_per_karpet }}"
                                            {{ old('layanan_id') == $layanan->id ? 'selected' : '' }}>
                                        {{ $layanan->nama }} — Rp {{ number_format($layanan->harga_per_karpet, 0, ',', '.') }}/karpet
                                    </option>
                                @endforeach
                            </select>
                            @error('layanan_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Jumlah Karpet <span class="text-danger">*</span></label>
                            <input type="number" name="jumlah_karpet" id="jumlah_karpet"
                                   class="form-control @error('jumlah_karpet') is-invalid @enderror"
                                   value="{{ old('jumlah_karpet', 1) }}" min="1" max="100" required>
                            @error('jumlah_karpet')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Tanggal Masuk <span class="text-danger">*</span></label>
                            <input type="date" name="tanggal_masuk"
                                   class="form-control @error('tanggal_masuk') is-invalid @enderror"
                                   value="{{ old('tanggal_masuk', now()->toDateString()) }}" required>
                            @error('tanggal_masuk')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Catatan</label>
                            <textarea name="catatan" rows="2"
                                      class="form-control"
                                      placeholder="Contoh: karpet tebal, ada noda membandel, karpet besar, dll.">{{ old('catatan') }}</textarea>
                        </div>
                    </div>

                    {{-- Estimasi Harga --}}
                    <div class="alert alert-info d-flex align-items-center gap-3" id="estimasi-box" style="display:none!important;">
                        <i class="fas fa-calculator fs-4"></i>
                        <div>
                            <div class="fw-semibold">Estimasi Total Harga</div>
                            <div class="fs-5 fw-bold" id="estimasi-harga">Rp 0</div>
                            <small class="text-muted">Nomor antrian akan digenerate otomatis</small>
                        </div>
                    </div>

                    <div class="d-flex gap-2 mt-3">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fas fa-save me-2"></i>Simpan Pesanan
                        </button>
                        <a href="{{ route('admin.pemesanan.index') }}" class="btn btn-outline-secondary">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('additional_scripts')
<script>
    const layananSelect = document.getElementById('layanan_id');
    const jumlahInput   = document.getElementById('jumlah_karpet');
    const estimasiBox   = document.getElementById('estimasi-box');
    const estimasiHarga = document.getElementById('estimasi-harga');

    function updateEstimasi() {
        const opt    = layananSelect.options[layananSelect.selectedIndex];
        const harga  = parseFloat(opt?.dataset?.harga || 0);
        const jumlah = parseInt(jumlahInput.value || 0);
        const total  = harga * jumlah;

        if (harga > 0 && jumlah > 0) {
            estimasiBox.style.display = 'flex';
            estimasiHarga.textContent = 'Rp ' + total.toLocaleString('id-ID');
        } else {
            estimasiBox.style.display = 'none';
        }
    }

    layananSelect.addEventListener('change', updateEstimasi);
    jumlahInput.addEventListener('input', updateEstimasi);
    updateEstimasi();
</script>
@endsection
