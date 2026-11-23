
@extends('layouts.app')

@section('title', 'Edit Kategori')

@section('content')

<div class="mb-4">
    <a href="{{ route('categories.index') }}" class="text-decoration-none text-secondary">
        <i class="bi bi-arrow-left"></i> Kembali ke Kategori
    </a>

    <h2 class="fw-bold mt-3">Edit Kategori</h2>
    <p class="text-secondary">Perbarui informasi kategori.</p>
</div>

<div class="content-card">
    <form action="{{ route('categories.update', $category) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label fw-semibold">Nama Kategori</label>
            <input type="text" name="name"
                class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name', $category->name) }}"
                required>

            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Deskripsi</label>
            <textarea name="description" class="form-control" rows="4">{{ old('description', $category->description) }}</textarea>
        </div>

        <div class="d-flex justify-content-end gap-2 mt-4">
            <a href="{{ route('categories.index') }}" class="btn btn-light">Batal</a>

            <button type="submit" class="btn btn-primary">
                <i class="bi bi-save me-1"></i> Simpan Perubahan
            </button>
        </div>
    </form>
</div>

@endsection
