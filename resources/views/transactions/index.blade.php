
@extends('layouts.app')

@section('title', 'Riwayat Transaksi')

@section('content')

<div class="d-flex justify-content-between align-items-center flex-wrap mb-4">
    <div>
        <h2 class="fw-bold mb-1">Riwayat Transaksi</h2>
        <p class="text-secondary mb-0">Pantau seluruh aktivitas barang masuk dan keluar.</p>
    </div>

    <div class="d-flex gap-2 mt-2">
        <a href="{{ route('transactions.create', ['type' => 'masuk']) }}"
           class="btn btn-success">
            <i class="bi bi-plus-circle me-1"></i> Barang Masuk
        </a>

        <a href="{{ route('transactions.create', ['type' => 'keluar']) }}"
           class="btn btn-danger">
            <i class="bi bi-dash-circle me-1"></i> Barang Keluar
        </a>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ session('success') }}
        <button class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="content-card">
    <div class="table-responsive">
        <table class="table table-hover align-middle" id="transactionTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Jenis</th>
                    <th>Jumlah</th>
                    <th>Catatan</th>
                </tr>
            </thead>

            <tbody>
                @foreach($transactions as $transaction)
                    <tr>
                        <td>{{ $loop->iteration }}</td>

                        <td>
                            {{ \Carbon\Carbon::parse($transaction->transaction_date)->format('d/m/Y H:i') }}
                        </td>

                        <td>{{ $transaction->item->item_code ?? '-' }}</td>

                        <td class="fw-semibold">
                            {{ $transaction->item->name ?? 'Barang dihapus' }}
                        </td>

                        <td>
                            @if($transaction->transaction_type == 'masuk')
                                <span class="badge bg-success rounded-pill px-3">
                                    <i class="bi bi-arrow-down-circle me-1"></i> Masuk
                                </span>
                            @else
                                <span class="badge bg-danger rounded-pill px-3">
                                    <i class="bi bi-arrow-up-circle me-1"></i> Keluar
                                </span>
                            @endif
                        </td>

                        <td>
                            <strong>{{ $transaction->quantity }}</strong>
                            {{ $transaction->item->unit ?? '' }}
                        </td>

                        <td>{{ $transaction->notes ?: '-' }}</td>
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
        $('#transactionTable').DataTable({
            pageLength: 10,
            ordering: true,
            searching: true,
            paging: true,
            order: [[1, 'desc']],
            language: {
                search: "Cari:",
                lengthMenu: "Tampilkan _MENU_ data",
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                emptyTable: "Belum ada transaksi",
                zeroRecords: "Transaksi tidak ditemukan",
                paginate: {
                    previous: "Sebelumnya",
                    next: "Selanjutnya"
                }
            }
        });
    });
</script>
@endpush
