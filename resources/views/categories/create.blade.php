
@extends('layouts.app')

@section('title', 'Tambah Kategori')

@section('content')

<div class="mb-4">
    <a href="{{ route('categories.index') }}" class="text-decoration-none text-secondary">
        <i class="bi bi-arrow-left"></i> Kembali ke Kategori
    </a>

    <h2 class="fw-bold mt-3">Tambah Kategori</h2>
    <p class="text-secondary">Tambahkan kategori baru untuk mengelompokkan barang.</p>
</div>

<div class="content-card">
    <form action="{{ route('categories.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label fw-semibold">Nama Kategori</label>
            <input type="text" name="name"
                class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name') }}"
                placeholder="Contoh: Elektronik"
                required>

            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Deskripsi</label>
            <textarea name="description" class="form-control" rows="4"
                placeholder="Jelaskan kategori ini (opsional)">{{ old('description') }}</textarea>
        </div>

        <div class="d-flex justify-content-end gap-2 mt-4">
            <a href="{{ route('categories.index') }}" class="btn btn-light">Batal</a>

            <button type="submit" class="btn btn-primary">
                <i class="bi bi-save me-1"></i> Simpan Kategori
            </button>
        </div>
    </form>
</div>

@endsection
