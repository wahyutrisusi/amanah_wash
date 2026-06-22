<div class="mb-3">
    <label class="form-label fw-semibold">Nama Layanan <span class="text-danger">*</span></label>
    <input type="text" class="form-control @error('nama') is-invalid @enderror"
           name="nama" value="{{ old('nama', $layanan->nama ?? '') }}"
           placeholder="Contoh: Cuci Karpet Reguler" required>
    @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
    <label class="form-label fw-semibold">Harga per Karpet <span class="text-danger">*</span></label>
    <div class="input-group">
        <span class="input-group-text">Rp</span>
        <input type="number" class="form-control @error('harga_per_karpet') is-invalid @enderror"
               name="harga_per_karpet"
               value="{{ old('harga_per_karpet', $layanan->harga_per_karpet ?? '') }}"
               min="0" step="500" placeholder="25000" required>
    </div>
    @error('harga_per_karpet')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
    <label class="form-label fw-semibold">Deskripsi</label>
    <textarea class="form-control @error('deskripsi') is-invalid @enderror"
              name="deskripsi" rows="3"
              placeholder="Keterangan singkat tentang layanan ini...">{{ old('deskripsi', $layanan->deskripsi ?? '') }}</textarea>
    @error('deskripsi')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
    <div class="form-check">
        <input type="checkbox" class="form-check-input" name="is_active" id="is_active" value="1"
               {{ old('is_active', $layanan->is_active ?? true) ? 'checked' : '' }}>
        <label class="form-check-label" for="is_active">Layanan Aktif</label>
    </div>
</div>
