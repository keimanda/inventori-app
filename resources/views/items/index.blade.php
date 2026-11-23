
@extends('layouts.app')

@section('title', 'Data Barang - InventoriPro')

@section('content')

<div class="d-flex justify-content-between align-items-center flex-wrap mb-4">
    <div>
        <h2 class="fw-bold mb-1">Data Barang</h2>
        <p class="text-secondary mb-0">Kelola seluruh barang inventori kamu.</p>
    </div>

    <a href="{{ route('items.create') }}" class="btn btn-primary mt-2">
        <i class="bi bi-plus-lg me-1"></i> Tambah Barang
    </a>
</div>

<div class="content-card">

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-hover align-middle" id="itemsTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode</th>
                    <th>Nama Barang</th>
                    <th>Kategori</th>
                    <th>Stok</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach($items as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <span class="fw-semibold">{{ $item->item_code }}</span>
                        </td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->category->name ?? '-' }}</td>
                        <td>{{ $item->stock }} {{ $item->unit }}</td>
                        <td>
                            @if($item->stock <= $item->minimum_stock)
                                <span class="badge badge-stock-low rounded-pill px-3">
                                    Menipis
                                </span>
                            @else
                                <span class="badge badge-stock-safe rounded-pill px-3">
                                    Aman
                                </span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('items.show', $item) }}"
                                   class="btn btn-sm btn-outline-info"
                                   title="Detail">
                                    <i class="bi bi-eye"></i>
                                </a>

                                <a href="{{ route('items.edit', $item) }}"
                                   class="btn btn-sm btn-outline-warning"
                                   title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>

                                <form action="{{ route('items.destroy', $item) }}"
                                      method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus barang ini?')">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus">
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

@endsection

@push('scripts')
<link rel="stylesheet" href="https://cdn.datatables.net/2.3.0/css/dataTables.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/2.3.0/js/dataTables.min.js"></script>

<script>
    $(document).ready(function () {
        $('#itemsTable').DataTable({
            pageLength: 10,
            ordering: true,
            searching: true,
            paging: true,
            language: {
                search: "Cari:",
                lengthMenu: "Tampilkan _MENU_ data",
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                emptyTable: "Belum ada data barang",
                zeroRecords: "Data tidak ditemukan",
                paginate: {
                    previous: "Sebelumnya",
                    next: "Selanjutnya"
                }
            }
        });
    });
</script>
@endpush
