
@extends('layouts.app')

@section('title', 'Kategori - InventoriPro')

@section('content')

<div class="d-flex justify-content-between align-items-center flex-wrap mb-4">
    <div>
        <h2 class="fw-bold mb-1">Kategori Barang</h2>
        <p class="text-secondary mb-0">Kelola pengelompokan barang inventori.</p>
    </div>

    <a href="{{ route('categories.create') }}" class="btn btn-primary mt-2">
        <i class="bi bi-plus-lg me-1"></i> Tambah Kategori
    </a>
</div>

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show">
        {{ session('error') }}
        <button class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="stat-card">
            <div class="text-secondary">Total Kategori</div>
            <h2 class="fw-bold text-primary">{{ $categories->count() }}</h2>
            <small>Jenis kategori terdaftar</small>
        </div>
    </div>

    <div class="col-md-4">
        <div class="stat-card">
            <div class="text-secondary">Total Barang Terdaftar</div>
            <h2 class="fw-bold text-success">{{ $categories->sum('items_count') }}</h2>
            <small>Barang di seluruh kategori</small>
        </div>
    </div>
</div>

<div class="content-card">
    <h5 class="fw-bold mb-3">Daftar Kategori</h5>

    <div class="table-responsive">
        <table class="table table-hover align-middle" id="categoryTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Kategori</th>
                    <th>Deskripsi</th>
                    <th>Jumlah Barang</th>
                    <th>Dibuat</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td>{{ $loop->iteration }}</td>

                        <td class="fw-semibold">
                            <i class="bi bi-tag text-primary me-2"></i>
                            {{ $category->name }}
                        </td>

                        <td>{{ $category->description ?: '-' }}</td>

                        <td>
                            <span class="badge bg-primary-subtle text-primary rounded-pill px-3">
                                {{ $category->items_count }} Barang
                            </span>
                        </td>

                        <td>{{ $category->created_at->format('d/m/Y') }}</td>

                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('categories.edit', $category) }}"
                                   class="btn btn-sm btn-outline-warning"
                                   title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>

                                <form action="{{ route('categories.destroy', $category) }}"
                                      method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                        class="btn btn-sm btn-outline-danger"
                                        title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@push('scripts')
<link rel="stylesheet" href="https://cdn.datatables.net/2.3.0/css/dataTables.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/2.3.0/js/dataTables.min.js"></script>

<script>
    $(document).ready(function () {
        $('#categoryTable').DataTable({
            pageLength: 10,
            ordering: true,
            searching: true,
            paging: true,
            language: {
                search: "Cari:",
                lengthMenu: "Tampilkan _MENU_ data",
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                emptyTable: "Belum ada kategori",
                zeroRecords: "Kategori tidak ditemukan",
                paginate: {
                    previous: "Sebelumnya",
                    next: "Selanjutnya"
                }
            }
        });
    });
</script>
@endpush

@endsection
