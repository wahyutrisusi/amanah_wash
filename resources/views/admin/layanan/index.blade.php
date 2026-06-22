@extends('admin.layouts.app')

@section('title', 'Kelola Layanan')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Daftar Layanan</h5>
                <a href="{{ route('admin.layanan.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Tambah Layanan
                </a>
            </div>
        </div>
        <div class="card-body">
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($layanans as $layanan)
                        <tr>
                            <td>{{ $layanan->nama }}</td>
                            <td>
                                <span class="badge bg-{{ $layanan->kategori == 'motor' ? 'primary' : 'success' }}">
                                    {{ ucfirst($layanan->kategori) }}
                                </span>
                            </td>
                            <td>Rp {{ number_format($layanan->harga, 0, ',', '.') }}</td>
                            <td>
                                <span class="badge bg-{{ $layanan->is_active ? 'success' : 'danger' }}">
                                    {{ $layanan->is_active ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('admin.layanan.edit', $layanan) }}" 
                                   class="btn btn-sm btn-info text-white">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.layanan.destroy', $layanan) }}" 
                                      method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" 
                                            onclick="return confirm('Yakin ingin menghapus layanan ini?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection 