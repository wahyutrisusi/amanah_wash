@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
    <!-- Stats Cards -->
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h5 class="card-title">Total Pemesanan</h5>
                    <h2 class="mb-0">{{ $total_pemesanan }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <h5 class="card-title">Pending</h5>
                    <h2 class="mb-0">{{ $pending_pemesanan }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5 class="card-title">Completed</h5>
                    <h2 class="mb-0">{{ $completed_pemesanan }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <h5 class="card-title">Total Layanan</h5>
                    <h2 class="mb-0">{{ $total_layanan }}</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Latest Orders -->
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Pemesanan Terbaru</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Pelanggan</th>
                            <th>Layanan</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($latest_pemesanans as $pemesanan)
                        <tr>
                            <td>#{{ str_pad($pemesanan->id, 5, '0', STR_PAD_LEFT) }}</td>
                            <td>{{ $pemesanan->nama }}</td>
                            <td>{{ $pemesanan->layanan->nama }}</td>
                            <td>{{ $pemesanan->tanggal->format('d M Y') }}</td>
                            <td>
                                <span class="badge bg-{{ $pemesanan->status == 'pending' ? 'warning' : 
                                    ($pemesanan->status == 'completed' ? 'success' : 'primary') }}">
                                    {{ ucfirst($pemesanan->status) }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection 