@extends('admin.layouts.app')

@section('title', 'Tambah Layanan')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Tambah Layanan Baru</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.layanan.store') }}" method="POST">
                @csrf
                @include('admin.layanan._form')
                
                <div class="text-end">
                    <a href="{{ route('admin.layanan.index') }}" class="btn btn-secondary me-2">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection 