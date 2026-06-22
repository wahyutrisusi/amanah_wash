@extends('admin.layouts.app')

@section('title', 'Tambah Layanan')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3">
                <h6 class="mb-0 fw-semibold">
                    <i class="fas fa-plus-circle me-2 text-primary"></i>Tambah Layanan Baru
                </h6>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('admin.layanan.store') }}" method="POST">
                    @csrf

                    @include('admin.layanan._form')

                    <div class="d-flex gap-2 mt-3">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fas fa-save me-2"></i>Simpan
                        </button>
                        <a href="{{ route('admin.layanan.index') }}" class="btn btn-outline-secondary">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
