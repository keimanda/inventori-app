
@extends('layouts.app')

@section('title', 'Dashboard - InventoriPro')

@section('content')

<div class="d-flex justify-content-between align-items-center flex-wrap mb-4">
    <div>
        <h2 class="fw-bold mb-1">Dashboard 👋</h2>
        <p class="text-secondary mb-0">Selamat datang di Sistem Inventori Barang!</p>
    </div>
    <div class="text-secondary mt-2">
        <i class="bi bi-calendar3 me-2"></i>
        {{ now()->translatedFormat('d F Y') }}
    </div>
</div>

<div class="row g-3 mb-4">

    <div class="col-md-6 col-xl-3">
        <div class="stat-card" style="background:#e4efff">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-secondary mb-2">Total Barang</p>
                    <h2 class="fw-bold">{{ $totalItems }}</h2>
                </div>
                <div class="stat-icon bg-primary text-white">
                    <i class="bi bi-box-seam"></i>
                </div>
            </div>
            <small class="text-primary">Barang terdaftar</small>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="stat-card" style="background:#dcf8ec">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-secondary mb-2">Total Stok</p>
                    <h2 class="fw-bold">{{ number_format($totalStock) }}</h2>
                </div>
                <div class="stat-icon bg-success text-white">
                    <i class="bi bi-stack"></i>
                </div>
            </div>
            <small class="text-success">Jumlah unit tersedia</small>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="stat-card" style="background:#ffecd7">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-secondary mb-2">Kategori</p>
                    <h2 class="fw-bold">{{ $totalCategories }}</h2>
                </div>
                <div class="stat-icon bg-warning text-white">
                    <i class="bi bi-tags"></i>
                </div>
            </div>
            <small class="text-warning">Jenis pengelompokan</small>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="stat-card" style="background:#f0e5ff">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-secondary mb-2">Stok Menipis</p>
                    <h2 class="fw-bold">{{ $lowStock }}</h2>
                </div>
                <div class="stat-icon text-white" style="background:#9254e9">
                    <i class="bi bi-exclamation-triangle"></i>
                </div>
            </div>
            <small style="color:#9254e9">Perlu perhatian</small>
        </div>
    </div>

</div>

<div class="row g-3">

    <div class="col-lg-7">
        <div class="content-card h-100">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="fw-bold mb-0">
                    <i class="bi bi-exclamation-circle text-danger me-2"></i>
                    Barang dengan Stok Rendah
                </h5>
                <a href="{{ route('items.index') }}" class="text-decoration-none small">
                    Lihat semua →
                </a>
            </div>

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Nama Barang</th>
                            <th>Stok</th>
                            <th>Minimum</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($lowStockItems as $item)
                            <tr>
                                <td>{{ $item->item_code }}</td>
                                <td>{{ $item->name }}</td>
                                <td>
                                    <span class="badge badge-stock-low rounded-pill">
                                        {{ $item->stock }} {{ $item->unit }}
                                    </span>
                                </td>
                                <td>{{ $item->minimum_stock }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-secondary">
                                    Semua stok dalam kondisi aman 🎉
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-lg-5">
        <div class="content-card h-100">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="fw-bold mb-0">Barang Terbaru</h5>
                <a href="{{ route('items.index') }}" class="text-decoration-none small">
                    Lihat semua →
                </a>
            </div>

            @forelse($latestItems as $item)
                <div class="d-flex justify-content-between align-items-center py-3 border-bottom">
                    <div>
                        <div class="fw-semibold">{{ $item->name }}</div>
                        <small class="text-secondary">
                            {{ $item->category->name ?? '-' }} · {{ $item->item_code }}
                        </small>
                    </div>
                    <div class="text-end">
                        <span class="fw-bold">{{ $item->stock }}</span>
                        <small class="text-secondary">{{ $item->unit }}</small>
                    </div>
                </div>
            @empty
                <p class="text-secondary text-center py-4">
                    Belum ada barang. Silakan tambahkan data barang.
                </p>
            @endforelse

            <a href="{{ route('items.create') }}" class="btn btn-primary w-100 mt-3">
                <i class="bi bi-plus-lg me-2"></i>Tambah Barang
            </a>
        </div>
    </div>

</div>

@endsection
