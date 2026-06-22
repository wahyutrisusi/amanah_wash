@extends('layouts.app')

@section('title', 'Pemesanan')

@section('additional_css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection

@section('custom_css')
    .booking-form {
        background: rgba(255, 255, 255, 0.62);
        border-radius: 10px;
        box-shadow: 0 0 40px rgba(10, 76, 121, 0.7);
        margin-left: 10px;
        margin-right: 10px;
        margin-top: 10px;
        margin-bottom: 10px;
    }
@endsection

@section('content')
    <!-- Booking Section -->
    <section class="py-5 mt-5">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="booking-form p-4">
                        <h2 class="text-center mb-4">Form Pemesanan</h2>
                        
                        @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                        @endif

                        <form action="{{ route('pemesanan.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" 
                                       name="nama" value="{{ old('nama') }}" required>
                                @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Nomor Telepon</label>
                                <input type="tel" class="form-control @error('telepon') is-invalid @enderror" 
                                       name="telepon" value="{{ old('telepon') }}" required>
                                @error('telepon')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Pilih Layanan</label>
                                <select class="form-select @error('layanan_id') is-invalid @enderror" 
                                        name="layanan_id" id="layanan_id" required>
                                    <option value="">Pilih Layanan</option>
                                    @foreach($layanans as $layanan)
                                        <option value="{{ $layanan->id }}" {{ old('layanan_id') == $layanan->id ? 'selected' : '' }}>
                                            {{ $layanan->nama }} - Rp {{ number_format($layanan->harga, 0, ',', '.') }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('layanan_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            

                            <!-- <div class="mb-3">
                                <label class="form-label">Metode Pengambilan</label>
                                <select class="form-select @error('metode_pengambilan') is-invalid @enderror" 
                                        name="metode_pengambilan" id="metode_pengambilan" required>
                                    <option value="">Pilih Metode</option>
                                    <option value="jemput" {{ old('metode_pengambilan') == 'jemput' ? 'selected' : '' }}>Dijemput (+Rp 2.000)</option>
                                    <option value="datang" {{ old('metode_pengambilan') == 'datang' ? 'selected' : '' }}>Datang Sendiri</option>
                                </select>
                                @error('metode_pengambilan')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div> -->

                            <!-- <div class="mb-3">
                                <label class="form-label">Metode Pengembalian</label>
                                <select class="form-select @error('metode_pengembalian') is-invalid @enderror" 
                                        name="metode_pengembalian" id="metode_pengembalian" required>
                                    <option value="">Pilih Metode</option>
                                    <option value="antar" {{ old('metode_pengembalian') == 'antar' ? 'selected' : '' }}>Diantar (+Rp 2.000)</option>
                                    <option value="ambil" {{ old('metode_pengembalian') == 'ambil' ? 'selected' : '' }}>Ambil Sendiri</option>
                                </select>
                                @error('metode_pengembalian')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div> -->

                            <div class="mb-3">
                                <label class="form-label">Notifikasi</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="notifikasi_wa" id="notifikasi_wa" 
                                           value="1" {{ old('notifikasi_wa') ? 'checked' : '' }} checked>
                                    <label class="form-check-label" for="notifikasi_wa">
                                        Kirim notifikasi WhatsApp ketika selesai
                                    </label>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Alamat Lengkap</label>
                                <textarea class="form-control @error('alamat') is-invalid @enderror" 
                                          name="alamat" rows="3" placeholder="Masukkan alamat lengkap (nama jalan, nomor rumah, RT/RW, kelurahan)"
                                          required>{{ old('alamat') }}</textarea>
                                @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">patokan</label>
                                <textarea class="form-control" name="kota" rows="2">{{ old('kota') }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Tanggal</label>
                                <input type="date" class="form-control flatpickr @error('tanggal') is-invalid @enderror" 
                                       name="tanggal" value="{{ old('tanggal') }}" required>
                                @error('tanggal')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Waktu</label>
                                <select class="form-select @error('waktu') is-invalid @enderror" 
                                        name="waktu" required>
                                    <option value="">Pilih Waktu</option>
                                    <option value="09:00">09:00</option>
                                    <option value="10:00">10:00</option>
                                    <option value="11:00">11:00</option>
                                    <option value="13:00">13:00</option>
                                    <option value="14:00">14:00</option>
                                    <option value="15:00">15:00</option>
                                    <option value="16:00">16:00</option>
                                </select>
                                @error('waktu')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Catatan Tambahan (Opsional)</label>
                                <textarea class="form-control" name="catatan" rows="3">{{ old('catatan') }}</textarea>
                            </div>

                            <div class="alert alert-info">
                                <h6 class="alert-heading"><i class="fas fa-info-circle me-2"></i>Informasi Estimasi:</h6>
                                <ul class="mb-0">
                                    <li>Waktu pengerjaan: 1-2 jam</li>
                                    <li>Waktu jemput/antar: 15-30 menit</li>
                                    <li>Status pesanan dapat dicek melalui menu "Cek Status Pemesanan"</li>
                                </ul>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 py-2">
                                <i class="fas fa-calendar-check me-2"></i>Buat Pesanan
                            </button>
                        </form>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow">
                        <div class="card-body p-4">
                            <div class="booking-form p-4">
                                <h4 class="text-center mb-4">Cek Status Pemesanan</h4>
                                @if(session('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ session('error') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                                @endif
                                <form action="{{ route('pemesanan.cek-status') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label">Kode Pemesanan</label>
                                        <input type="text" class="form-control @error('kode_pemesanan') is-invalid @enderror" 
                                            name="kode_pemesanan" placeholder="Contoh: 00001" required>
                                        @error('kode_pemesanan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100">
                                        <i class="fas fa-search me-2"></i>Cek Status
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('additional_scripts')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr(".flatpickr", {
            minDate: "today",
            disable: [
                function(date) {
                    return (date.getDay() === 0);
                }
            ],
            locale: "id"
        });
    </script>
@endsection