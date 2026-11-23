
@extends('layouts.app')

@section('title', 'Tambah Barang')

@section('content')

<div class="mb-4">
    <a href="{{ route('items.index') }}" class="text-decoration-none text-secondary">
        <i class="bi bi-arrow-left"></i> Kembali ke Data Barang
    </a>
    <h2 class="fw-bold mt-3">Tambah Barang</h2>
    <p class="text-secondary">Masukkan informasi barang baru ke inventori.</p>
</div>

<div class="content-card">
    <form action="{{ route('items.store') }}" method="POST">
        @csrf

        <div class="row g-3">

            <div class="col-md-6">
                <label class="form-label fw-semibold">Kode Barang</label>
                <input type="text" name="item_code"
                    class="form-control @error('item_code') is-invalid @enderror"
                    value="{{ old('item_code') }}"
                    placeholder="Contoh: BRG001" required>
                @error('item_code')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label class="form-label fw-semibold">Nama Barang</label>
                <input type="text" name="name"
                    class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name') }}"
                    placeholder="Masukkan nama barang" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label class="form-label fw-semibold">Kategori</label>
                <select name="category_id" class="form-select" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6">
                <label class="form-label fw-semibold">Satuan</label>
                <select name="unit" class="form-select" required>
                    <option value="pcs">Pcs</option>
                    <option value="unit">Unit</option>
                    <option value="box">Box</option>
                    <option value="buah">Buah</option>
                    <option value="set">Set</option>
                    <option value="rim">Rim</option>
                </select>
            </div>

            <div class="col-md-6">
                <label class="form-label fw-semibold">Jumlah Stok</label>
                <input type="number" name="stock"
                    class="form-control"
                    value="{{ old('stock', 0) }}" min="0" required>
            </div>

            <div class="col-md-6">
                <label class="form-label fw-semibold">Batas Minimum Stok</label>
                <input type="number" name="minimum_stock"
                    class="form-control"
                    value="{{ old('minimum_stock', 5) }}" min="0" required>
            </div>

            <div class="col-12">
                <label class="form-label fw-semibold">Deskripsi</label>
                <textarea name="description" class="form-control" rows="3"
                    placeholder="Keterangan barang (opsional)">{{ old('description') }}</textarea>
            </div>

        </div>

        <div class="d-flex justify-content-end gap-2 mt-4">
            <a href="{{ route('items.index') }}" class="btn btn-light">Batal</a>
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-save me-1"></i> Simpan Barang
            </button>
        </div>

    </form>
</div>

@endsection
