
@extends('layouts.app')

@section('title', 'Edit Barang')

@section('content')

<div class="mb-4">
    <a href="{{ route('items.index') }}" class="text-decoration-none text-secondary">
        <i class="bi bi-arrow-left"></i> Kembali ke Data Barang
    </a>
    <h2 class="fw-bold mt-3">Edit Barang</h2>
    <p class="text-secondary">Perbarui informasi {{ $item->name }}.</p>
</div>

<div class="content-card">
    <form action="{{ route('items.update', $item) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row g-3">

            <div class="col-md-6">
                <label class="form-label fw-semibold">Kode Barang</label>
                <input type="text" name="item_code" class="form-control"
                    value="{{ old('item_code', $item->item_code) }}" required>
                @error('item_code')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="col-md-6">
                <label class="form-label fw-semibold">Nama Barang</label>
                <input type="text" name="name" class="form-control"
                    value="{{ old('name', $item->name) }}" required>
            </div>

            <div class="col-md-6">
                <label class="form-label fw-semibold">Kategori</label>
                <select name="category_id" class="form-select" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ old('category_id', $item->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6">
                <label class="form-label fw-semibold">Satuan</label>
                <select name="unit" class="form-select" required>
                    @foreach(['pcs', 'unit', 'box', 'buah', 'set', 'rim'] as $unit)
                        <option value="{{ $unit }}"
                            {{ old('unit', $item->unit) == $unit ? 'selected' : '' }}>
                            {{ ucfirst($unit) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6">
                <label class="form-label fw-semibold">Jumlah Stok</label>
                <input type="number" name="stock" class="form-control"
                    value="{{ old('stock', $item->stock) }}" min="0" required>
            </div>

            <div class="col-md-6">
                <label class="form-label fw-semibold">Minimum Stok</label>
                <input type="number" name="minimum_stock" class="form-control"
                    value="{{ old('minimum_stock', $item->minimum_stock) }}" min="0" required>
            </div>

            <div class="col-12">
                <label class="form-label fw-semibold">Deskripsi</label>
                <textarea name="description" class="form-control" rows="3">{{ old('description', $item->description) }}</textarea>
            </div>

        </div>

        <div class="d-flex justify-content-end gap-2 mt-4">
            <a href="{{ route('items.index') }}" class="btn btn-light">Batal</a>
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-save me-1"></i> Simpan Perubahan
            </button>
        </div>

    </form>
</div>

@endsection
