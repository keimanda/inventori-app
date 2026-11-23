
@extends('layouts.app')

@section('title', 'Input Transaksi')

@section('content')

<div class="mb-4">
    <a href="{{ route('transactions.index') }}" class="text-decoration-none text-secondary">
        <i class="bi bi-arrow-left"></i> Kembali ke Riwayat
    </a>

    <h2 class="fw-bold mt-3">
        {{ $type == 'masuk' ? 'Barang Masuk' : 'Barang Keluar' }}
    </h2>

    <p class="text-secondary">
        {{ $type == 'masuk'
            ? 'Catat barang yang masuk ke gudang inventori.'
            : 'Catat barang yang keluar dari gudang inventori.' }}
    </p>
</div>

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="content-card">

    <form action="{{ route('transactions.store') }}" method="POST">
        @csrf

        <input type="hidden" name="transaction_type" value="{{ $type }}">

        <div class="row g-3">

            <div class="col-md-6">
                <label class="form-label fw-semibold">Pilih Barang</label>

                <select name="item_id" class="form-select" required>
                    <option value="">-- Pilih Barang --</option>

                    @foreach($items as $item)
                        <option value="{{ $item->id }}"
                            {{ old('item_id') == $item->id ? 'selected' : '' }}>
                            {{ $item->item_code }} - {{ $item->name }}
                            (Stok: {{ $item->stock }} {{ $item->unit }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6">
                <label class="form-label fw-semibold">Jenis Transaksi</label>

                <input type="text" class="form-control"
                    value="{{ ucfirst($type) }}" disabled>
            </div>

            <div class="col-md-6">
                <label class="form-label fw-semibold">Jumlah Barang</label>

                <input type="number" name="quantity"
                    class="form-control"
                    value="{{ old('quantity') }}"
                    placeholder="Masukkan jumlah"
                    min="1" required>
            </div>

            <div class="col-md-6">
                <label class="form-label fw-semibold">Tanggal Transaksi</label>

                <input type="datetime-local" name="transaction_date"
                    class="form-control"
                    value="{{ old('transaction_date', now()->format('Y-m-d\TH:i')) }}"
                    required>
            </div>

            <div class="col-12">
                <label class="form-label fw-semibold">Catatan</label>

                <textarea name="notes" class="form-control" rows="3"
                    placeholder="Contoh: Pembelian stok baru / digunakan bagian administrasi">{{ old('notes') }}</textarea>
            </div>

        </div>

        <div class="d-flex justify-content-end gap-2 mt-4">
            <a href="{{ route('transactions.index') }}" class="btn btn-light">
                Batal
            </a>

            <button type="submit"
                class="btn {{ $type == 'masuk' ? 'btn-success' : 'btn-danger' }}">
                <i class="bi bi-save me-1"></i>
                Simpan {{ ucfirst($type) }}
            </button>
        </div>

    </form>
</div>

@endsection
