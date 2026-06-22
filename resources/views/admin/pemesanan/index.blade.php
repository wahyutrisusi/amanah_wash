@extends('admin.layouts.app')

@section('title', 'Kelola Pemesanan')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Daftar Pemesanan</h5>
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
                            <th>ID</th>
                            <th>Tanggal</th>
                            <th>Pelanggan</th>
                            <th>Alamat</th>
                            <th>Layanan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pemesanans as $pemesanan)
                        <tr>
                            <td>#{{ str_pad($pemesanan->id, 5, '0', STR_PAD_LEFT) }}</td>
                            <td>
                                {{ $pemesanan->tanggal->format('d M Y') }}<br>
                                <small class="text-muted">{{ $pemesanan->waktu }}</small>
                            </td>
                            <td>
                                {{ $pemesanan->nama }}<br>
                                <small class="text-muted">{{ $pemesanan->telepon }}</small>
                            <td><small class="text-muted">
                                <i class="fas fa-map-marker-alt me-1"></i>
                                <small class="text-muted">{{ $pemesanan->alamat }}</small><br>
                                <i class="fas fa-map-marker-alt me-1"></i>                            
                                <small class="text-muted">{{ $pemesanan->kota}}</small>
                            </td>
                            <td>{{ $pemesanan->layanan->nama }}</td>
                            <td>
                                <span class="badge bg-{{ 
                                    $pemesanan->status == 'pending' ? 'warning' : 
                                    ($pemesanan->status == 'confirmed' ? 'primary' : 
                                    ($pemesanan->status == 'completed' ? 'success' : 'danger'))
                                }}">
                                    {{ ucfirst($pemesanan->status) }}
                                </span>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-primary dropdown-toggle" 
                                            data-bs-toggle="dropdown">
                                        Update Status
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <form action="{{ route('admin.pemesanan.update-status', $pemesanan) }}" 
                                                  method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="pending">
                                                <button type="submit" class="dropdown-item">Pending</button>
                                            </form>
                                        </li>
                                        <li>
                                            <form action="{{ route('admin.pemesanan.update-status', $pemesanan) }}" 
                                                  method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="confirmed">
                                                <button type="submit" class="dropdown-item">Confirmed</button>
                                            </form>
                                        </li>
                                        <li>
                                            <form action="{{ route('admin.pemesanan.update-status', $pemesanan) }}" 
                                                  method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="completed">
                                                <button type="submit" class="dropdown-item">Completed</button>
                                            </form>
                                        </li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li>
                                            <form action="{{ route('admin.pemesanan.update-status', $pemesanan) }}" 
                                                  method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="cancelled">
                                                <button type="submit" class="dropdown-item text-danger"
                                                        onclick="return confirm('Yakin ingin membatalkan pesanan ini?')">
                                                    Cancelled
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                                <a href="{{ route('pemesanan.cek', $pemesanan->id) }}" 
                                   class="btn btn-sm btn-info text-white" target="_blank">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $pemesanans->links() }}
            </div>
        </div>
    </div>
@endsection 