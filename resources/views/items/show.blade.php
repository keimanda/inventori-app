
@extends('layouts.app')

@section('title', 'Detail Barang')

@section('content')

<div class="mb-4">
    <a href="{{ route('items.index') }}" class="text-decoration-none text-secondary">
        <i class="bi bi-arrow-left"></i> Kembali ke Data Barang
    </a>
    <h2 class="fw-bold mt-3">Detail Barang</h2>
</div>

<div class="content-card">
    <div class="d-flex justify-content-between align-items-start">
        <div>
            <h3 class="fw-bold">{{ $item->name }}</h3>
            <p class="text-secondary">{{ $item->item_code }}</p>
        </div>

        <a href="{{ route('items.edit', $item) }}" class="btn btn-warning">
            <i class="bi bi-pencil me-1"></i> Edit
        </a>
    </div>

    <hr>

    <div class="row g-4 mt-2">
        <div class="col-md-6">
            <small class="text-secondary">Kategori</small>
            <h6>{{ $item->category->name ?? '-' }}</h6>
        </div>

        <div class="col-md-6">
            <small class="text-secondary">Kode Barang</small>
            <h6>{{ $item->item_code }}</h6>
        </div>

        <div class="col-md-6">
            <small class="text-secondary">Stok Tersedia</small>
            <h4 class="fw-bold">{{ $item->stock }} {{ $item->unit }}</h4>
        </div>

        <div class="col-md-6">
            <small class="text-secondary">Stok Minimum</small>
            <h6>{{ $item->minimum_stock }} {{ $item->unit }}</h6>
        </div>

        <div class="col-md-6">
            <small class="text-secondary">Status</small>
            @if($item->stock <= $item->minimum_stock)
                <span class="badge badge-stock-low rounded-pill">Stok Menipis</span>
            @else
                <span class="badge badge-stock-safe rounded-pill">Stok Aman</span>
            @endif
        </div>

        <div class="col-12">
            <small class="text-secondary">Deskripsi</small>
            <p>{{ $item->description ?: 'Tidak ada deskripsi.' }}</p>
        </div>

        <div class="col-md-6">
            <small class="text-secondary">Ditambahkan</small>
            <p>{{ $item->created_at->format('d/m/Y H:i') }}</p>
        </div>
    </div>
</div>

@endsection
