<div class="mb-3">
    <label class="form-label">Nama Layanan</label>
    <input type="text" class="form-control @error('nama') is-invalid @enderror" 
           name="nama" value="{{ old('nama', $layanan->nama ?? '') }}" required>
    @error('nama')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label">Kategori</label>
    <select class="form-select @error('kategori') is-invalid @enderror" name="kategori" required>
        <option value="">Pilih Kategori</option>
        <option value="motor" {{ old('kategori', $layanan->kategori ?? '') == 'motor' ? 'selected' : '' }}>
            Motor
        </option>
        <option value="karpet" {{ old('kategori', $layanan->kategori ?? '') == 'karpet' ? 'selected' : '' }}>
            Karpet
        </option>
    </select>
    @error('kategori')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label">Harga</label>
    <div class="input-group">
        <span class="input-group-text">Rp</span>
        <input type="number" class="form-control @error('harga') is-invalid @enderror" 
               name="harga" value="{{ old('harga', $layanan->harga ?? '') }}" required>
    </div>
    @error('harga')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label">Deskripsi</label>
    <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
              name="deskripsi" rows="3" required>{{ old('deskripsi', $layanan->deskripsi ?? '') }}</textarea>
    @error('deskripsi')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <div class="form-check">
        <input type="checkbox" class="form-check-input" name="is_active" value="1"
               {{ old('is_active', $layanan->is_active ?? true) ? 'checked' : '' }}>
        <label class="form-check-label">Aktif</label>
    </div>
</div> 